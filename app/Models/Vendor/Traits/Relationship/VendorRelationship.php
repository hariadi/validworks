<?php

namespace App\Models\Vendor\Traits\Relationship;

/**
 * Class VendorRelationship
 */
trait VendorRelationship
{
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
