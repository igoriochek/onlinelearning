<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CourseRejected extends Notification
{
  use Queueable;

  /**
   * Create a new notification instance.
   */
  public function __construct(
    public string $courseTitle,
    public string $reason
  ) {}

  /**
   * Get the notification's delivery channels.
   *
   * @return array<int, string>
   */
  public function via(object $notifiable): array
  {
    return ['mail'];
  }

  /**
   * Get the mail representation of the notification.
   */
  public function toMail($notifiable)
  {
    return (new MailMessage)
      ->subject('Your course has been rejected')
      ->greeting("Hello {$notifiable->name},")
      ->line("Your course **\"{$this->courseTitle}\"** has been rejected.")
      ->line("**Reason:** {$this->reason}")
      ->line('You can update the course and submit it again for review.')
      ->salutation('Regards, Online Learning Team');
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
