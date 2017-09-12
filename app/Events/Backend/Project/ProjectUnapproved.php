<?php

namespace App\Events\Backend\Project;

use Illuminate\Queue\SerializesModels;

/**
 * Class ProjectUnapproved.
 */
class ProjectUnapproved
{
    use SerializesModels;

    /**
     * @var
     */
    public $project;

    /**
     * @param $project
     */
    public function __construct($project)
    {
        $this->project = $project;
    }
}
