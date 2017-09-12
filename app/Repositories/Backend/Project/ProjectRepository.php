<?php

namespace App\Repositories\Backend\Project;

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use App\Models\Project\Project;
use App\Models\Access\User\User;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Events\Backend\Project\ProjectCreated;
use App\Events\Backend\Project\ProjectDeleted;
use App\Events\Backend\Project\ProjectUpdated;
use App\Events\Backend\Project\ProjectApproved;
use App\Events\Backend\Project\ProjectUnapproved;
use App\Notifications\Backend\Project\ProjectVendorCreated;
use App\Notifications\Backend\Project\ProjectVendorApproved;
use App\Notifications\Backend\Project\ProjectVendorUnapproved;

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
    public function getAll($order_by = 'id', $sort = 'desc')
    {
        return $this->query()->orderBy($order_by, $sort)->get();
    }

    /**
     * Get all instance of Project.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Project[]
     */
    public function getByVendor($vendors, $by = 'name', $order_by = 'id', $sort = 'desc', $paginate = 25)
    {
    	if ($vendors instanceof User) {
    		$vendors = $vendors->vendor_id;
    	}

    	if (! is_array($vendors)) {
            $vendors = [$vendors];
        }

        if ($paginate) {
        	return $this->query()->orderBy($order_by, $sort)->whereIn('vendor_id', $vendors)->paginate($paginate);
        }

        return $this->query()->orderBy($order_by, $sort)->whereIn('vendor_id', $vendors)->get();
    }

    /**
     * Get latest Projection.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Projection[]
     */
    public function latest()
    {
        return $this->query()->latest();
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
        	event(new ProjectCreated($project));

        	$agencies = User::whereHas('roles', function ($query) {
	            $query->where('roles.name', 'Executive');
	        })->get();

        	foreach ($agencies as $pbt) {
        		$pbt->notify(new ProjectVendorCreated($project));
        	}

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
    		event(new ProjectUpdated($project));

    		return $project;
    	}

        throw new GeneralException('There was a problem updating this project. Please try again.');
    }

    /**
     * @param Model $project
     *
     * @return bool
     * @throws GeneralException
     */
    public function approve(Model $project)
    {
        if ($project->approved_at == 1) {
            throw new GeneralException(trans('exceptions.backend.projects.already_approved'));
        }

        $vendor = $project->user;

        $project->approved_at = Carbon::now();
        $project->approved_by = access()->id();

        if ($project->save()) {
            event(new ProjectApproved($project));

            // Let vendor know their account was approved
            $vendor->notify(new ProjectVendorApproved($project));

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.projects.cant_confirm'));
    }

    /**
     * @param Model $project
     *
     * @return bool
     * @throws GeneralException
     */
    public function unapprove(Model $project)
    {
        if (is_null($project->approved_at)) {
            throw new GeneralException(trans('exceptions.backend.access.projects.not_approved'));
        }

        $vendor = $project->user;

        $project->approved_at = null;
        $project->approved_by = null;

        if ($project->save()) {
            event(new ProjectUnapproved($project));

            $vendor->notify(new ProjectVendorApproved($project));

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.projects.cant_unapprove')); // TODO
    }

    /**
     * @param  $id
     * @throws GeneralException
     * @return boolean|null
     */
    public function destroy(Model $project)
    {
        if ($project->delete()) {
            event(new ProjectDeleted($project));

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
