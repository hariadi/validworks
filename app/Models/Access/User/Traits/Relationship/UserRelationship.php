<?php

namespace App\Models\Access\User\Traits\Relationship;

use App\Models\Vendor\Vendor;
use App\Models\Verify\Verify;
use App\Models\System\Session;
use App\Models\Project\Project;
use App\Models\Access\User\SocialLogin;

/**
 * Class UserRelationship.
 */
trait UserRelationship
{
	/**
     * @return mixed
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
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
     * Many-to-Many relations with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(config('access.role'), config('access.role_user_table'), 'user_id', 'role_id');
    }

    /**
     * @return mixed
     */
    public function providers()
    {
        return $this->hasMany(SocialLogin::class);
    }

    /**
     * @return mixed
     */
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    /**
     * @return mixed
     */
    public function verifies()
    {
        return $this->hasMany(Verify::class);
    }
}
