<?php

use Carbon\Carbon;
use Faker\Generator;
use App\Models\Vendor\Vendor;
use App\Models\Project\Project;
use App\Models\Access\Role\Role;
use App\Models\Access\User\User;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(User::class, function (Generator $faker) {
    static $password;

    return [
        'first_name'        => $faker->firstName,
        'last_name'         => $faker->lastName,
        'email'             => $faker->safeEmail,
        'password'          => $password ?: $password = bcrypt('secret'),
        'remember_token'    => str_random(10),
        'confirmation_code' => md5(uniqid(mt_rand(), true)),
    ];
});

$factory->state(User::class, 'active', function () {
    return [
        'status' => 1,
    ];
});

$factory->state(User::class, 'inactive', function () {
    return [
        'status' => 0,
    ];
});

$factory->state(User::class, 'confirmed', function () {
    return [
        'confirmed' => 1,
    ];
});

$factory->state(User::class, 'unconfirmed', function () {
    return [
        'confirmed' => 0,
    ];
});

/*
 * Roles
 */
$factory->define(Role::class, function (Generator $faker) {
    return [
        'name' => $faker->name,
        'all'  => 0,
        'sort' => $faker->numberBetween(1, 100),
    ];
});

$factory->state(Role::class, 'admin', function () {
    return [
        'all' => 1,
    ];
});

$factory->define(Vendor::class, function (Generator $faker) {
    return [
        'name' => $faker->company,
    ];
});

$factory->define(Project::class, function (Generator $faker) {

	$start = Carbon::now();

    return [
    	'user_id' => function () {
            return factory(User::class)->states('active')->create()->id;
        },
    	'vendor_id' => function () {
            return factory(Vendor::class)->create()->id;
        },
        'uuid'        		=> $faker->uuid,
        'title'         	=> $faker->sentence,
        'description'       => $faker->paragraph,
        'address'          	=> $faker->address,
        'latitude'    		=> $faker->latitude,
        'longitude'   		=> $faker->longitude,
        'started_at'   		=> $start,
        'ended_at'   		=> $start->copy()->addDays(3),
    ];
});

$factory->state(Project::class, 'approved', function () {
    return [
        'approved_by' => function () {
            return factory(User::class)->states('active')->create()->id;
        },
        'approved_at' => Carbon::now()
    ];
});
