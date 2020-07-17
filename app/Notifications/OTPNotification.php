<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OTPNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $via;
    
    public $OTP;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($via, $OTP)
    {
        $this->via = $via;
        $this->OTP = $OTP;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return $this->via == 'sms' ? [TwilioChannel::class] : ['mail'];
    }

    public function toTwilio($notifiable)
    {
        return TwilioSmsMessage::create()
           // ->to('07772778204')  commenting out as not needed
            ->from('07772778204')
            ->content("Your OTP login is {$this->OTP}");
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->markdown('OTP', ['OTP' => $this-> $OTP]);
                    //->line('The introduction to the notification.')
                    //->action('Notification Action', url('/'))
                    //->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
