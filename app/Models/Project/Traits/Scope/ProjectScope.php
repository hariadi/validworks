<?php

namespace App\Models\Project\Traits\Scope;

use App\Filters\ProjectFilters;
use App\Models\Access\User\User;

/**
 * Class ProjectScope
 */
trait ProjectScope
{
    /**
     * @param $query
     * @param bool $confirmed
     *
     * @return mixed
     */
    public function scopeApproved($query)
    {
        return $query->whereNotNul('approved_at');
    }

    /**
     * @param $query
     * @param bool $status
     *
     * @return mixed
     */
    public function scopeByVendor($query, $vendor)
    {
    	if ($vendor instanceof User) {
    		$vendor = $vendor->vendor_id;
    	}

        return $query->where('vendor_id', $vendor);
    }

    /**
     * Apply all relevant projection filters.
     *
     * @param  Builder       $query
     * @param  ProjectionFilters $filters
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, ProjectFilters $filters)
    {
        return $filters->apply($query);
    }
}
