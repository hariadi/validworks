<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project\Traits\Scope\ProjectScope;
use App\Models\Project\Traits\Attribute\ProjectAttribute;
use App\Models\Project\Traits\Relationship\ProjectRelationship;

class Project extends Model
{
    use ProjectAttribute, ProjectRelationship, ProjectScope;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['vendor_id', 'uuid', 'title', 'description', 'address', 'latitude', 'longitude', 'approved_by', 'approved_at', 'started_at', 'ended_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['approved_at', 'started_at', 'ended_at'];

    /**
     * The relationships to always eager-load.
     *
     * @var array
     */
    protected $with = ['user', 'vendor'];
}
