<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Access\Role\Role;
use App\Models\Access\Permission\Permission;

class ProjectPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['Project', 'Vendor', 'Report'] as $model) {

            $permission = 'Manage';

            $permit               = new Permission;
            $permit->name         = str_slug($permission . '-' . $model);
            $permit->display_name = $permission . ' ' . $model;
            $permit->created_at   = Carbon::now();
            $permit->updated_at   = Carbon::now();
            $permit->save();

            Role::whereIn('id', [3, 4])->each(function($role) use ($permit) {
			    $role->permissions()->attach([$permit->id]);
			});

        }

        /*
         * Assign view backend to user role
         */
        Role::find(3)->permissions()->sync([1]);

    }
}
