<?php

use Database\TruncateTable;
use App\Models\Vendor\Vendor;
use App\Models\Project\Project;
use Illuminate\Database\Seeder;
use App\Models\Access\User\User;
use Database\DisableForeignKeys;

class VendorTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::whereNull('vendor_id')->get()->each(function($user) {
        	$user->vendor_id = factory(Vendor::class)->create()->id;
        	$user->save();
        });
    }
}
