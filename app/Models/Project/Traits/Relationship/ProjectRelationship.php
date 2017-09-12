<?php

namespace App\Models\Project\Traits\Relationship;

use App\Models\Report\Report;
use App\Models\Vendor\Vendor;
use App\Models\Verify\Verify;
use App\Models\Access\User\User;

/**
 * Class ProjectRelationship
 */
trait ProjectRelationship
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
     * Get the projection's vendor.
     *
     * @return \Illuminate\Database\Eloquent\Concerns\belongsTo
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * Get all of the project's verifies.
     */
    public function verifies()
    {
        return $this->hasMany(Verify::class);
    }
}
