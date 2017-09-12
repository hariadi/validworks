<?php

namespace App\Listeners\Backend\Project;

/**
 * Class ProjectEventListener.
 */
class ProjectEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'Project';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->project->id)
            ->withText('trans("history.backend.projects.created") <strong>{project}</strong>')
            ->withIcon('plus')
            ->withClass('bg-green')
            ->withAssets([
                'project_link' => ['admin.projects.show', $event->project->title, $event->project->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->project->id)
            ->withText('trans("history.backend.projects.updated") <strong>{project}</strong>')
            ->withIcon('save')
            ->withClass('bg-aqua')
            ->withAssets([
                'project_link' => ['admin.projects.show', $event->project->title, $event->project->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->project->id)
            ->withText('trans("history.backend.projects.deleted") <strong>{project}</strong>')
            ->withIcon('trash')
            ->withClass('bg-maroon')
            ->withAssets([
                'project_link' => ['admin.projects.show', $event->project->title, $event->project->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onApproved($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->project->id)
            ->withText('trans("history.backend.projects.approved") <strong>{project}</strong>')
            ->withIcon('check')
            ->withClass('bg-green')
            ->withAssets([
                'project_link' => ['admin.projects.show', $event->project->title, $event->project->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onUnapproved($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->project->id)
            ->withText('trans("history.backend.projects.unapproved") <strong>{project}</strong>')
            ->withIcon('times')
            ->withClass('bg-red')
            ->withAssets([
                'project_link' => ['admin.projects.show', $event->project->title, $event->project->id],
            ])
            ->log();
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Project\ProjectCreated::class,
            'App\Listeners\Backend\Project\ProjectEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Project\ProjectUpdated::class,
            'App\Listeners\Backend\Project\ProjectEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Project\ProjectDeleted::class,
            'App\Listeners\Backend\Project\ProjectEventListener@onDeleted'
        );

        $events->listen(
            \App\Events\Backend\Project\ProjectApproved::class,
            'App\Listeners\Backend\Project\ProjectEventListener@onApproved'
        );

        $events->listen(
            \App\Events\Backend\Project\ProjectUnapproved::class,
            'App\Listeners\Backend\Project\ProjectEventListener@onUnapproved'
        );
    }
}
