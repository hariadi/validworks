<?php

namespace App\Repositories\Backend\Project;

use Ramsey\Uuid\Uuid;
use App\Models\Project\Project;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class ProjectRepository extends BaseRepository
{
	/**
     * Associated Repository Model.
     */
    const MODEL = Project::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
    	//
    }

    /**
     * Get all instance of Project.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Project[]
     */
    public function getAll($order_by = 'id', $sort = 'asc')
    {
        return $this->query()->orderBy($order_by, $sort)->get();
    }

   /**
     * @param  $per_page
     * @param  string      $order_by
     * @param  string      $sort
     * @param  int         $status
     * @return mixed
     */
    public function getProjectsPaginated($per_page = 10, $order_by = 'id', $sort = 'asc')
    {
        return $this->query()->orderBy($order_by, $sort)->paginate($per_page);
    }

   /**
     * Create a new instance of Project.
     *
     * @param  array  $input
     * @return object
     */
    public function create($input)
    {
        $project = $this->createProjectStub($input);

        $project->uuid = Uuid::uuid4()->toString();
        $project->user_id = access()->id();
        $project->vendor_id = access()->user()->vendor->id;

        if ($project->save()) {
        	// event(new ProjectCreated($project));

        	return $project;
        }

        throw new GeneralException('There was a problem creating this project. Please try again.');
    }

    /**
     * Update the Project with the given attributes.
     *
     * @param  int    $id
     * @param  array  $input
     * @return bool|int
     */
    public function update(Model $project, array $input)
    {
        if ($project->update($input)) {
    		//event(new ProjectUpdated($project));

    		return $project;
    	}

        throw new GeneralException('There was a problem updating this project. Please try again.');
    }

    /**
     * @param  $id
     * @throws GeneralException
     * @return boolean|null
     */
    public function destroy(Model $project)
    {
        if ($project->delete()) {
            //event(new ProjectDeleted($project));

            return true;
        }

        throw new GeneralException('There was a problem deleting this project. Please try again.');
    }

    /**
     * @param  $input
     * @return mixed
     */
    private function createProjectStub($input)
    {
        $project = self::MODEL;
        $project = new $project;

        foreach ($project->getFillable() as $column) {
        	if (array_key_exists($column, $input)) {
        		$project->{$column} = $input[$column];
        	}
        }

        return $project;
    }
}
