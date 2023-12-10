<?php

namespace App\Jobs;

use App\SentEmail;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class SendMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $mailTo, $copyMail, $template, $fields, $pathToFile;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mailTo, $copyMail, $template, array $fields=[], $pathToFile=null)
    {
        $this->mailTo = $mailTo;
        $this->copyMail = $copyMail;
        $this->template = $template;
        $this->fields = $fields;
        $this->pathToFile = $pathToFile;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (
            !User::where('email',$this->mailTo)->first() ||
            ($this->copyMail && !User::where('email',$this->copyMail)->first())
        ) abort(404);

        $view = 'emails.'.$this->template;
        $html = view($view, ['fields' => $this->fields])->render();
        $userId = !Auth::guest() ? Auth::id() : null;

        Mail::send($view, ['fields' => $this->fields], function($message) {
            $message->subject('Сообщение с сайта Nesmelov&Co');
            $message->from((string)Config::get('app.mail_to'), 'Nesmelov&Co');
            $message->to($this->mailTo);
            if ($this->copyMail) $message->cc($this->copyMail);
            if ($this->pathToFile) $message->attach($this->pathToFile);
        });

        SentEmail::create([
            'email' => $this->mailTo,
            'html' => $html,
            'user_id' => $userId
        ]);

        if ($this->copyMail) {
            SentEmail::create([
                'email' => $this->copyMail,
                'html' => $html,
                'user_id' => $userId
            ]);
        }

    }
}
