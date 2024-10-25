<?php

namespace App\Livewire\subStore;

use App\Jobs\SendStoreToMobile;
use App\Livewire\SubStore\SubstoreShowComponent;
use App\Models\City;
use App\Models\Country;
use App\Models\Schedule;
use App\Models\State;
use App\Models\SubStore;
use Livewire\Component;

class SubStoreFormShowComponent extends Component
{
    // Tienda seleccionada
    public $selectedStore;

    public $name;
    public $address;
    public $commission;
    public $phone;
    public $latitude = 0.0;
    public $longitude = 0.0;

    public $disabledButton = false; // Controls button state

    public $schedules = [];

    public $viewOptionalSchedules = false;

    public $days = [
        'Lu' => 'Lunes',
        'Ma' => 'Martes',
        'Mie' => 'Miércoles',
        'Ju' => 'Jueves',
        'Vi' => 'Viernes',
        'Sa' => 'Sábado',
        'Do' => 'Domingo',
    ];

    public $listeners = ['updateSelectedSchedule', 'handleSelectCountry', 'handleSelectState'];

    // Select country, state and city
    public $countries = []; // List of countries
    public $states = []; // List of states
    public $cities = []; // List of cities

    public $selectedCountry; // Selected country
    public $selectedState; // Selected state
    public $selectedCity; // Selected city

    public function addSubStore()
    {
        // $response = $this->validateDays();

        // if ($response) {
        // Validate information related to the substore
        $this->validate($this->rules());
        $this->disabledButton = true;

        // Create the substore
        $response = $this->createSubStore();

        $city = $response[0];
        $subStore = $response[1];

        // Format the schedule
        $schedulesSubstore = $this->formatSchedule($subStore->id);

        // Add the schedules to the substore
        $this->addScheduleToSubstore($schedulesSubstore);

        // Send the substore to the mobile app
        SendStoreToMobile::dispatch($this->selectedStore, $subStore, $city, $schedulesSubstore);

        $this->dispatch('render')->to(SubstoreShowComponent::class);
        toastr()->success('La sucursal fue creada con éxito', 'Sucursal creada!');
        $this->returnStoresManagement();
        // }
    }

    /**
     * function that validates the information of the substore.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'commission' => 'required|numeric',
            'phone' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ];
    }

    /**
     * function that creates a new substore in the database.
     *
     * @return Substore
     * @return City
     */
    private function createSubStore()
    {
        try {
            // Check city with selected city
            $city = City::find($this->selectedCity);

            // Creates a new subStore record in the database with the provided details.
            $subStore = SubStore::create([
                'name' => $this->name,
                'address' => $this->address,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'commission' => $this->commission,
                'phone' => $this->phone,
                'status' => true,
                'city_id' => $city->id,
                'store_rut' => $this->selectedStore->rut,
            ]);

            return [
                $city,
                $subStore,
            ];
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * function that performs the formatting expected by the schedule model.
     *
     * @return array
     */
    private function formatSchedule($subStoreId)
    {
        $scheduleDays = [];

        foreach ($this->schedules as $key => $schedule) {
            foreach ($schedule['selectDays'] as $key => $day) {
                if ($day) {
                    if ($schedule['viewOptionalSchedules']) {
                        $scheduleDays[] = [
                            'opening' => $schedule['opening'],
                            'openingOptional' => $schedule['openingOptional'],
                            'closing' => $schedule['closing'],
                            'closingOptional' => $schedule['closingOptional'],
                            'day' => $this->days[$key],
                            'substore_id' => $subStoreId,
                        ];
                    } else {
                        $scheduleDays[] = [
                            'opening' => $schedule['opening'],
                            'closing' => $schedule['closing'],
                            'day' => $this->days[$key],
                            'substore_id' => $subStoreId,
                        ];
                    }
                }
            }
        }

        return $scheduleDays;
    }

    /**
     * function that adds the schedule arrangement to the database.
     *
     * @return void
     */
    private function addScheduleToSubstore($schedulesSubstore)
    {
        try {
            Schedule::insert($schedulesSubstore);
        } catch (\Throwable $th) {
            // throw $th;
        }
    }

    /**
     * function return to the store management page.
     *
     * @return redirect(string)->route()
     */
    public function returnStoresManagement()
    {
        $this->redirect('/stores/management');
    }

    /**
     * function that validates the days of the week and the schedules.
     *
     * @return bool
     */
    private function validateDays()
    {
        $responses = $this->countDays();

        $checkRepeatDays = $responses[0];
        $emptySchedules = $responses[1];

        if (!$checkRepeatDays && !$emptySchedules) {
            return true;
        } else {
            if ($emptySchedules) {
                $message = 'Un horario debe ser asignado al menos a un día.';
                session()->flash('scheduleMessage', $message);
            } else {
                $message = 'Los siguientes días no pueden tener más de una jornada designada:    '.$checkRepeatDays;
                session()->flash('scheduleMessage', $message);
            }

            return false;
        }
    }

    private function verifyEmptySchedules()
    {
        $emptySchedules = [];
    }

    /**
     * function that counts the number of days that have been selected.
     *
     * @return array
     */
    private function countDays()
    {
        $countDays = [
            'Lu' => 0,
            'Ma' => 0,
            'Mie' => 0,
            'Ju' => 0,
            'Vi' => 0,
            'Sa' => 0,
            'Do' => 0,
        ];

        $emptySchedules = false;
        $badListDays = [];
        // Count the number of days that have been selected.
        foreach ($this->schedules as $key => $schedule) {
            if (count($schedule['selectDays']) === 0) {
                $emptySchedules = true;
                break;
            }
            foreach ($schedule['selectDays'] as $key => $day) {
                if ($day) {
                    if ($countDays[$key] > 0) {
                        $badListDays[$key] = $this->days[$key];
                    }
                    ++$countDays[$key];
                }
            }
        }

        $stringListDays = implode(', ', $badListDays);

        return [$stringListDays, $emptySchedules];
    }

    public function viewHiddenInformation($key)
    {
        $this->schedules[$key]['viewOptionalSchedules'] = !$this->schedules[$key]['viewOptionalSchedules'];
    }

    public function handleSelectCountry($id)
    {
        if ($id) {
            $this->states = Country::find($id)->states;
        }
    }

    public function handleSelectState($id)
    {
        if ($id) {
            $this->cities = State::find($id)->cities;
        }
    }

    public function addShieldSchedule()
    {
        $newKey = uniqid();
        $newShield = [
            'key' => $newKey,
            'days' => ['Lu', 'Ma', 'Mie', 'Ju', 'Vi', 'Sa', 'Do'],
            'selectDays' => [],
            'opening' => '08:00',
            'closing' => '21:00',
            'openingOptional' => '08:00', // These optional fields, depending on whether the store has a divided schedule.
            'closingOptional' => '21:00', // These optional fields, depending on whether the store has a divided schedule.
            'viewOptionalSchedules' => false,
        ];

        $this->schedules[$newKey] = $newShield;
    }

    public function removeShieldSchedule($key)
    {
        $nowCount = count($this->schedules);
        if ($nowCount === 1) {
            session()->flash('scheduleMessage', 'El horario debe poseer al menos una jornada.');
        } else {
            unset($this->schedules[$key]);
            $auxSchedules = $this->schedules;
            $this->reset('schedules');
            $this->schedules = $auxSchedules;
        }
    }

    public function mount($selectedStore)
    {
        $this->selectedStore = $selectedStore;

        $newKey = uniqid();
        $newShield = [
            'key' => $newKey,
            'days' => ['Lu', 'Ma', 'Mie', 'Ju', 'Vi', 'Sa', 'Do'],
            'selectDays' => [],
            'opening' => '08:00',
            'closing' => '21:00',
            'openingOptional' => '08:00', // These optional fields, depending on whether the store has a divided schedule.
            'closingOptional' => '21:00', // These optional fields, depending on whether the store has a divided schedule.
            'viewOptionalSchedules' => false,
        ];
        $this->schedules[$newKey] = $newShield;

        $this->countries = Country::all();
    }

    public function render()
    {
        return view('livewire.subStore.sub-store-form-show-component');
    }
}
