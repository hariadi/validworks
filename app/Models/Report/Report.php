<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;
use App\Models\Report\Traits\Scope\ReportScope;
use App\Models\Report\Traits\Attribute\ReportAttribute;
use App\Models\Report\Traits\Relationship\ReportRelationship;

class Report extends Model
{
    use ReportAttribute, ReportRelationship, ReportScope;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'project_id', 'solved_at', 'ip', 'solved_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['solved_at'];

   	protected $with = ['project', 'user'];
}
