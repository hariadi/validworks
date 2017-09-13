<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;
use App\Models\Report\Traits\Scope\ReportScope;
use App\Models\Report\Traits\Attribute\ReportAttribute;
use App\Models\Report\Traits\Relationship\ReportRelationship;

class Report extends Model
{
    use ReportAttribute, ReportRelationship, ReportScope;
    //
}
