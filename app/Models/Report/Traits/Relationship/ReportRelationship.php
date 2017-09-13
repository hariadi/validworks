<?php

namespace App\Models\Report\Traits\Relationship;

use App\Models\Project\Project;
use App\Models\Access\User\User;

/**
 * Class ReportRelationship
 */
trait ReportRelationship
{

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return mixed
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
