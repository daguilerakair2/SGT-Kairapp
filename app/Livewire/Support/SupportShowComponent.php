<?php

namespace App\Livewire\support;

use App\Notifications\support\CreatedRequestHelp;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class SupportShowComponent extends Component
{
    public $title;
    public $message;
    public $phone;

    protected $rules = [
        'title' => 'required',
        'phone' => 'required',
        'message' => 'required',
    ];

    public function returnDashboard()
    {
        $this->redirect('/dashboard');
    }

    public function save()
    {
        $this->validate();
        $counterCharacters = strlen($this->message);
        if ($counterCharacters >= 500) {
            session()->flash('message', 'El mensaje no puede superar los 500 carácteres.');
        }

        $this->notifySlack();

        toastr()->success('Pronto te daremos una respuesta.!', 'Tu solicitud fue enviada con exito.');
        $this->returnDashboard();
    }

    public function notifySlack()
    {
        $auth_user = auth()->user();
        $store = session('store');
        $date = date('d-m-Y H:i:s');

        $information = [
            'name_user' => $auth_user->name,
            'email_user' => $auth_user->email,
            'companyNameStore' => $store->companyName,
            'nameStore' => $store->fantasyName,
            'title' => $this->title,
            'message' => $this->message,
            'phone' => $this->phone,
            'date' => $date,
        ];

        Notification::route('slack', config('services.slack.notifications.slack_created_request_help'))
                    ->notify(new CreatedRequestHelp($information));
    }

    public function render()
    {
        return view('livewire.support.support-show-component');
    }
}
