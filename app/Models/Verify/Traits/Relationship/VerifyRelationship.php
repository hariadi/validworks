<?php

namespace App\Models\Verify\Traits\Relationship;

use App\Models\Project\Project;
use App\Models\Access\User\User;

/**
 * Class VerifyRelationship
 */
trait VerifyRelationship
{
    /**
     * Get the projection's user.
     *
     * @return \Illuminate\Database\Eloquent\Concerns\belongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the projection's user.
     *
     * @return \Illuminate\Database\Eloquent\Concerns\belongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
