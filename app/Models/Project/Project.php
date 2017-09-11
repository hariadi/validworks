<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project\Traits\Scope\ProjectScope;
use App\Models\Project\Traits\Attribute\ProjectAttribute;
use App\Models\Project\Traits\Relationship\ProjectRelationship;

class Project extends Model
{
    use ProjectAttribute, ProjectRelationship, ProjectScope;
    //
}
