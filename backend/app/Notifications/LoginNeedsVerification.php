<?php

namespace App\Notifications;
use NotificationChannels\Twilio\TwilioChannel;
use NotificationChannels\Twilio\TwilioMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoginNeedsVerification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string> 
     */
    public function via(object $notifiable): array
    {
        return [TwilioChannel::class];
    }

    public function toTwilio(object $notifiable)
    {
        $loginCode = rand(100000, 999999);


        $notifiable->update([
            'login_code' => $loginCode
        ]);

        //store the code somewhere like cache or database associated with the user

        return (new TwilioMessage())
            ->content("Your login  code is {$loginCode}, don't share it with anyone!");
    }
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
