<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;

class ReservationStore extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(
        \App\Models\Reservation $reservation
    )
    {
        $this->reservation = $reservation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toSlack($notifiable)
    {
        $url = 'https://reserbath.herokuapp.com';

        return (new SlackMessage)
            ->success()
            ->from('Reserbath[新規予約]')
            ->to('#tokyo-house-keeping')
            ->image('https://2.bp.blogspot.com/-PKJQQdEUaPI/UZmCUb6z8NI/AAAAAAAATgk/wa0GwBgomFA/s400/onsen_man.png')
            ->content($this->reservation->user->name.'が'.$this->reservation->reserve_time.'に予約を入れました。')
            ->success()
            ->attachment(function ($attachment) use ($url) {
                $attachment->title('お風呂予約はこちら', $url);
            });
    }
}
