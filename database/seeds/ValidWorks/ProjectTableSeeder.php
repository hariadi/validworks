<?php

use Database\TruncateTable;
use App\Models\Project\Project;
use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;

class ProjectTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('projects');

        factory(Project::class, 5)->states('approved')->create();
        factory(Project::class, 2)->create();

        $this->enableForeignKeys();
    }
}
