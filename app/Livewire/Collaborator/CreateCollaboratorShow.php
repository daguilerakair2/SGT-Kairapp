<?php

namespace App\Livewire\collaborator;

use App\Models\Role;
use App\Models\User;
use App\Models\UserStore;
use App\Notifications\CreatedContributor;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Livewire\Component;

class CreateCollaboratorShow extends Component
{
    public $name;
    public $email;
    public $role;
    public $subStoreUser;

    protected $rules = [
        'name' => 'required|regex:/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]+$/u',
        'email' => 'required|email',
        'role' => 'required',
        'subStoreUser' => 'required',
    ];

    /**
     * Redirect to the collaborators page.
     */
    public function returnCollaborators()
    {
        $this->redirect('/collaborators');
    }

    /**
     * Redirect to the create collaborator page.
     */
    public function returnCreateCollaborator()
    {
        $this->redirect('/collaborator/create');
    }

    /**
     * Save the collaborator information.
     */
    public function save()
    {
        $this->validate();

        // Check if the email is in the system
        $searchUser = User::where('email', $this->email)->first();

        // Existing user
        if ($searchUser) {
            // Get the store of the authenticated admi
            $store = session('store');
            // Check if the user is already associated
            $userStore = $store->searchUserStore($searchUser->id);

            if ($userStore) {
                toastr()->error('El trabajador ya se encuentra asociado a la tienda', 'Colaborador no agregado!');
                $this->returnCreateCollaborator();
            } else {
                // Get the collaborator role
                $role = Role::where('name', '=', 'Colaborador')->first();

                $responseLink = $this->linkEmployeeToStore($this->role, $searchUser);

                // Obtenemos la informacion de la tienda, sucursal y rol de usuario de la respuesta.
                $store = $responseLink['store'];
                $subStore = $responseLink['subStore'];
                $role = $responseLink['role'];

                $this->notifySlack($userStore, $store, $role, $subStore);

                $this->dispatch('render')->to(CreateCollaboratorShow::class);
                toastr()->success('El trabajador fue agregado con éxito', 'Trabajador agregado!');
                $this->returnCollaborators();
            }
        } else {
            // New user
            $response = $this->createEmployee();

            // Obtenemos la informacion del usuario de la respuesta.
            $user = $response['user'];
            $password = $response['password'];

            $responseLink = $this->linkEmployeeToStore($this->role, $user);

            // Obtenemos la informacion de la tienda, sucursal y rol de usuario de la respuesta.
            $store = $responseLink['store'];
            $subStore = $responseLink['subStore'];
            $role = $responseLink['role'];

            $this->notifySlack($user, $store, $role, $subStore);

            // Flash the password variable
            session()->flash('password', $password);
            $this->dispatch('render')->to(CreateCollaboratorShow::class);
            $this->returnCollaborators();
        }
    }

    /**
     * Verify employee store association.
     */
    public function verifyEmployeeStore()
    {
    }

    public function createEmployee()
    {
        // Generate a random password
        $password = Str::random(8);
        // Create the user
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($password),
        ]);

        $response = [
            'user' => $user,
            'password' => $password,
        ];

        return $response;
    }

    /**
     * Link an employee to a store.
     */
    public function linkEmployeeToStore($role, $user)
    {
        // Role
        $role = Role::find($role)->first();
        // Obtenemos la tienda del administrador autenticado
        $store = session('store');

        $userStore = UserStore::create([
            'user_id' => $user->id,
            'store_rut' => $store->rut,
            'role_id' => $this->role,
            'subStore_id' => $this->subStoreUser,
            'admin' => false,
            'status' => true,
            'delete' => false,
        ]);

        $store = searchStore($userStore->store_rut);
        $subStore = searchSubStore($userStore->subStore_id);
        $role = searchRole($userStore->role_id);

        $response = [
            'store' => $store,
            'subStore' => $subStore,
            'role' => $role,
        ];

        return $response;
    }

    /**
     * Notify Slack about a new contributor.
     */
    public function notifySlack($user, $store, $role, $subStore)
    {
        // Send notification to Slack
        $information = [
            'name' => $user->name,
            'email' => $user->email,
            'role' => $role->name,
            'store' => $store->fantasyName,
            'subStore' => $subStore->name,
        ];
        Notification::route('slack', config('services.slack.notifications.slack_created_contributor'))
                    ->notify(new CreatedContributor($information));
    }

    /**
     * Render the Livewire component.
     */
    public function render()
    {
        // Obtain roles based on the user's role
        if (session('role')->id === 2) {
            // Obtain subStores
            $store = session('store');
            $subStores = $store->subStores()->get();

            // Return all roles except kairapp admin and store admin
            $roles = Role::whereNotIn('id', [1, 2])->orderBy('name', 'asc')->get();
        } elseif (session('role')->id === 3) {
            // Obtain subStores
            $store = session('store');
            $subStores = session('subStoreAdmin');

            // Return all roles except kairapp admin, store admin and subStore admin
            $roles = Role::whereNotIn('id', [1, 2, 3])->orderBy('name', 'asc')->get();
        }

        return view('livewire.collaborator.create-collaborator-show', compact('roles', 'subStores'));
    }
}
