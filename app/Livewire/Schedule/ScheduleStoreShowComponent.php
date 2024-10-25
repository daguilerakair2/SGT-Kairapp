<?php

namespace App\Livewire\Schedule;

use App\Jobs\SendScheduleToMobile;
use App\Models\Schedule;
use App\Models\SubStore;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ScheduleStoreShowComponent extends Component
{
    public $subStore; // The current selected sub-store

    public $containSchedules; // if the sub-store has schedules

    public $schedules = [];

    public $disabledButton = false; // Controls button state

    public $viewOptionalSchedules = false;

    public $days = [
        'Lu' => ['name' => 'Monday', 'position' => 1],
        'Ma' => ['name' => 'Thuesday', 'position' => 2],
        'Mie' => ['name' => 'Wednesday', 'position' => 3],
        'Ju' => ['name' => 'Thursday', 'position' => 4],
        'Vi' => ['name' => 'Friday', 'position' => 5],
        'Sa' => ['name' => 'Saturday', 'position' => 6],
        'Do' => ['name' => 'Sunday', 'position' => 7],
    ];

    public $listeners = ['updateSelectedSchedule'];

    /**
     * Validation rules for schedule creation.
     *
     * @return void
     */
    protected function rules()
    {
        return [
            'opening' => 'required',
            'closing' => 'required',
        ];
    }

    public function save()
    {
        $response = $this->validateDays();

        if ($response) {
            // Format the schedule
            $schedulesSubstore = $this->formatSchedule($this->subStore);

            // Add the schedules to the substore
            $this->addScheduleToSubstore($schedulesSubstore);

            // Obtain SubStoreMobileId
            $subStore = SubStore::find($this->subStore);

            // Send the schedule substore to the mobile app
            SendScheduleToMobile::dispatch($schedulesSubstore, $subStore->subStoreMobileId);

            toastr()->success('El horario fue asignado con éxito', 'Horario asignado!');
            $this->returnScheduleStore();
        }
    }

    /**
     * function that adds the schedule arrangement to the database.
     *
     * @return void
     */
    private function addScheduleToSubstore($schedulesSubstore)
    {
        try {
            DB::transaction(function () use ($schedulesSubstore) {
                Schedule::insert($schedulesSubstore);
            });
        } catch (\Throwable $th) {
            // Registra un mensaje de error en los registros de la aplicación
            Log::error('Error al insertar horarios en la tienda: '.$th->getMessage());

            // O lanza una nueva excepción con un mensaje descriptivo
            throw new \Exception('Error al insertar horarios en la tienda: '.$th->getMessage());
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
                            'opening_optional' => $schedule['openingOptional'],
                            'closing' => $schedule['closing'],
                            'closing_optional' => $schedule['closingOptional'],
                            'day' => $this->days[$key]['position'],
                            'day_name' => $this->days[$key]['name'],
                            'substore_id' => $subStoreId,
                        ];
                    } else {
                        $scheduleDays[] = [
                            'opening' => $schedule['opening'],
                            'closing' => $schedule['closing'],
                            'day' => $this->days[$key]['position'],
                            'day_name' => $this->days[$key]['name'],
                            'substore_id' => $subStoreId,
                        ];
                    }
                }
            }
        }

        return $scheduleDays;
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
                        $badListDays[$key] = $this->days[$key]['name'];
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

    public function mount()
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

    /**
     * Redirect to schedules store page.
     */
    public function returnScheduleStore()
    {
        $this->redirect('/schedule/store');
    }

    public function render()
    {
        return view('livewire.schedule.schedule-store-show-component');
    }
}
