<?php

use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;

class ValidWorksTableSeeder extends Seeder
{
	use DisableForeignKeys;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        $this->call(ProjectTableSeeder::class);
        $this->call(ProjectPermissionTableSeeder::class);

        $this->enableForeignKeys();
    }
}
