<?php

namespace App\Livewire\store;

use App\Livewire\Store\StoreShow;
use App\Models\Role;
use App\Models\Store;
use App\Models\User;
use App\Models\UserStore;
use App\Notifications\CreatedStore;
use Freshwork\ChileanBundle\Facades\Rut;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Livewire\Component;

class StoreFormShowComponent extends Component
{
    // Store Fields
    public $rut;
    public $checkDigit;
    public $companyName;
    public $fantasyName;
    public $address;
    public $radioCheckedItinerant = 'Y';
    public $radioCheckedCustom = 'Y';

    // Store Administrator Fields
    public $nameAdmin;
    public $email;

    /**
     * Validation rules for store creation.
     *
     * @return void
     */
    protected function rules()
    {
        return [
            'rut' => 'required|regex:/^[0-9]+$/|unique:stores',
            'checkDigit' => 'required|max:1|regex:/^[0-9K]+$/i',
            'companyName' => 'required|min:3',
            'fantasyName' => 'required|min:3',
            'radioCheckedItinerant' => 'required',
            'radioCheckedCustom' => 'required',
            'nameAdmin' => 'required|regex:/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]+$/u',
            'email' => 'required|email',
        ];
    }

    /**
     * Write code on Method.
     *
     * @return response()
     */
    public function render()
    {
        return view('livewire.store.store-form-show-component');
    }

    /**
     * Create a new store.
     *
     * @return response()
     */
    public function addStore()
    {
        // dd($this->rut);
        $this->validate($this->rules());

        $completeRut = $this->rut.'-'.$this->checkDigit;
        $validateRut = Rut::parse($completeRut)->validate();
        if (!$validateRut) {
            session()->flash('message', 'El RUT ingresado no existe.');
        } else {
            // Validate if the store exists
            $existStore = Store::find($this->rut);
            if (!$existStore) {
                // Create store
                $store = $this->createStore();

                // Validate existing user
                // Verify that the email is in the system
                $searchUser = User::where('email', $this->email)->first();

                if ($searchUser) {
                    // Assign role to user
                    $this->linkUserToRole($searchUser, $store);

                    // Notify to slack
                    $this->notifyStoreCreation($store, $searchUser);

                    $this->dispatch('render')->to(StoreShow::class);
                    toastr()->success('La tienda fue creada con éxito', 'Tienda creada!');
                    $this->returnStoresManagement();
                } else {
                    // Create admin store
                    $dates = $this->createAdminStore($store);

                    $user = $dates[0];
                    $password = $dates[1];

                    // Notify to slack
                    $this->notifyStoreCreation($store, $user);

                    // Store the variable in the flash session
                    session()->flash('password', $password);

                    $this->dispatch('render')->to(StoreShow::class);
                    toastr()->success('La tienda fue creada con éxito', 'Tienda creada!');

                    return redirect()->to('subStore/create/%24'.$store->rut);
                }
            }
        }
    }

    private function createStore()
    {
        // Clean values of radio button
        $radioCheckedCustom = ($this->radioCheckedCustom === 'Y') ? true : false;
        $radioCheckedItinerant = ($this->radioCheckedItinerant === 'Y') ? true : false;

        // Creates a new store record in the database with the provided details.
        $store = Store::create([
            'rut' => $this->rut,
            'checkDigit' => $this->checkDigit,
            'companyName' => $this->companyName,
            'fantasyName' => $this->fantasyName,
            'description' => 'Tienda Afiliada a Kairapp',
            'itinerant' => $radioCheckedItinerant,
            'custom' => $radioCheckedCustom,
            'pathProfile' => 'https://alphakairappbucket.s3.sa-east-1.amazonaws.com/stores/profile/kairapp-isologo-negro-avatar-300px+(1).png',
            'pathBackground' => 'https://alphakairappbucket.s3.sa-east-1.amazonaws.com/stores/background/kairapp-logo-horizontal-1000px.png',
            'status' => 1,
        ]);

        return $store;
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    private function createAdminStore(Store $store)
    {
        // Generate the user's password
        $password = Str::random(8);

        // Create user
        $user = User::create([
            'name' => $this->nameAdmin,
            'email' => $this->email,
            'password' => bcrypt($password),
        ]);

        // Assign role to user
        $this->linkUserToRole($user, $store);

        return [
            $user,
            $password,
        ];
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    private function linkUserToRole(User $user, Store $store)
    {
        // Obtains the role of collaborator
        $role = Role::where('name', '=', 'Administrador Tienda')->first();

        // Assign the role directly to the user
        UserStore::create([
            'user_id' => $user->id,
            'store_rut' => $store->rut,
            'role_id' => $role->id,
            'admin' => true,
            'status' => true,
            'delete' => false,
        ]);
    }

    /**
     * Undocumented function.
     *
     * @param [type] $user
     *
     * @return void
     */
    private function notifyStoreCreation(Store $store, $user)
    {
        // Sends a notification (e.g., to Slack) about the new store.
        Notification::route('slack', config('services.slack.notifications.slack_created_store'))
        ->notify(new CreatedStore([
            'rut' => $store->rut,
            'companyName' => $store->companyName,
            'fantasyName' => $store->fantasyName,
            'nameAdmin' => $user->name,
            'emailAdmin' => $user->email,
        ]));
    }

    public function returnStoresManagement()
    {
        $this->redirect('/stores/management');
    }
}
