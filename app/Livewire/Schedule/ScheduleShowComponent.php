<?php

namespace App\Livewire\Schedule;

use App\Models\SubStore;
use Livewire\Component;

class ScheduleShowComponent extends Component
{
    public $subStores = [];

    public $schedules = [];

    public $selectedSubStore; // The current selected sub-store
    public $selectedOption; // The current selected sub-store ID

    public $listeners = ['updateSelectedSchedule'];

    /**
     * Handle changes in the selected sub-store and update products accordingly.
     */
    public function handleSelectChange()
    {
        // Obtain the selected sub-store
        $searchSubStore = SubStore::find($this->selectedOption);
        $this->selectedSubStore = $searchSubStore;

        // dd($searchSubStore->schedulesSubstore()->get());
        return redirect()->route('schedule-stores-selected.index', ['id' => $this->selectedOption]);
    }

    public function mount()
    {
        $this->subStores = session('store')->subStores()->get();
        $this->selectedOption = $this->selectedSubStore->id;
        $this->schedules = $this->selectedSubStore->schedulesSubstore()->get();
    }

    public function render()
    {
        return view('livewire.schedule.schedule-show-component');
    }
}
