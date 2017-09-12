<?php

namespace App\Models\Verify;

use Illuminate\Database\Eloquent\Model;
use App\Models\Verify\Traits\Scope\VerifyScope;
use App\Models\Verify\Traits\Attribute\VerifyAttribute;
use App\Models\Verify\Traits\Relationship\VerifyRelationship;

class Verify extends Model
{
    use VerifyAttribute, VerifyRelationship, VerifyScope;
    //
}
