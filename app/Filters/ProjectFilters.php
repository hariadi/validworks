<?php

namespace App\Filters;

use App\Models\Access\User\User;

class ProjectFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['by', 'status'];

    /**
     * Filter the query by a given username.
     *
     * @param  string $username
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }

    /**
     * Filter the query by given status.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function status($status)
    {
        if ($status == 'unapproved') {
        	return $this->builder->whereNull('approved_at');
        } else {
        	return $this->builder->whereNotNull('approved_at');
        }

    }
}
