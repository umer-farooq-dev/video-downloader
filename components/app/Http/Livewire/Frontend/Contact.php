<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Mailers\AppMailer;
class Contact extends Component
{
    public $name, $email, $message;

    public function render()
    {
        return view('livewire.frontend.contact');
    }

    public function sendMessage(AppMailer $mailer)
    {

        $validatedData = $this->validate([
            'name'    => 'required',
            'email'   => 'required|email',
            'message' => 'required'
        ]);

        try {

            $mailer->sendContactData( $validatedData );

            $this->name    = null;
            $this->email   = null;
            $this->message = null;

            session()->flash('status', 'success');
            session()->flash('message', __('Thank you for your message. It has been sent!'));

        } catch (\Exception $e) {
            session()->flash('status', 'error');
            session()->flash('message', __('There was an error trying to send your message. Please try again later.'));
        }
    }
}