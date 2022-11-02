<?php
namespace App\Mailers;

use Illuminate\Contracts\Mail\Mailer;
use Brotzka\DotenvEditor\DotenvEditor;
use App\Models\Admin\Page;
use Auth;

class AppMailer {
    protected $mailer; 
    protected $fromAddress;
    protected $fromName;
    protected $to;
    protected $subject;
    protected $view;
    protected $data = [];

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function deliver()
    {
        $this->mailer->send($this->view, $this->data, function($message) {
            $message->from($this->fromAddress, $this->fromName)
                    ->to($this->to)->subject($this->subject);
        });
    }

    public function sendContactData($data)
    {
        $env               = new DotenvEditor();
        $this->fromAddress = $env->getValue("MAIL_USERNAME");
        $this->fromName    = Page::where('type', 'home')->first()->title;
        $this->to          = Auth::user()->email;
        $this->subject     = "New message from " . $data['email'];
        $this->view        = 'frontend.mail';
        $this->data        = compact('data');

        return $this->deliver();
    }

}
?>