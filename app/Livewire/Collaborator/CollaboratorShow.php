<?php

namespace App\Livewire\collaborator;

use App\Models\UserStore;
use Livewire\Component;

class CollaboratorShow extends Component
{
    // Event listeners
    protected $listeners = ['render', 'delete'];

    /**
     * Receive updates for a collaborator's status.
     *
     * @param int $id the ID of the user store relationship to update
     */
    public function receiveUpdates(int $id)
    {
        $userStore = UserStore::findOrFail($id);

        if ($userStore) {
            // Toggle the status
            $userStore->status = !$userStore->status;
            // Save the changes to the database
            $userStore->save();
        }
    }

    /**
     * Delete a collaborator.
     *
     * @param int $id the ID of the user store relationship to delete
     */
    public function delete($id)
    {
        $userStore = UserStore::findOrFail($id);

        if ($userStore) {
            // Toggle the delete status and set the status to false
            $userStore->delete = !$userStore->delete;
            $userStore->status = false;
            // Save the changes to the database
            $userStore->save();
        }
    }

    /**
     * Render the Livewire component.
     */
    public function render()
    {
        // Retrieve store collaborators from the session
        $storeCollaborators = session('store')->userStore()->get();

        // Filter store collaborators based on conditions
        $storeCollaborators = $storeCollaborators->filter(function ($userStore) {
            $roleAuthUser = session('role');

            // Check conditions for filtering
            if ($roleAuthUser->id === 2) {
                return $userStore->roleUser->id != 2 && $userStore->roleUser->id != $roleAuthUser->id && $userStore->delete == false;
            } elseif ($roleAuthUser->id === 3) {
                $subStoreAdmin = session('subStoreAdmin');

                // Agregar validacion de que la subStore del user sea igual a la del admin substore autenticado.
                return $userStore->roleUser->id != 2 && $userStore->roleUser->id != $roleAuthUser->id && $userStore->subStoreUser->id == $subStoreAdmin[0]->id && $userStore->delete == false;
            }
        });

        return view('livewire.collaborator.collaborator-show', compact('storeCollaborators'));
    }
}
