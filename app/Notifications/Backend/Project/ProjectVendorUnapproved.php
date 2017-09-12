<?php

namespace App\Notifications\Backend\Project;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class ProjectVendorUnapproved.
 */
class ProjectVendorUnapproved extends Notification
{
	protected $project;

	public function __construct($project)
	{
		$this->project = $project;
	}

    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->subject(app_name())
            ->line(trans('strings.emails.project.unapproved'))
            ->action(trans('labels.frontend.project.view_button'), route('admin.projects.show', $this->project))
            ->line(trans('strings.emails.auth.thank_you_for_using_app'));
    }
}
