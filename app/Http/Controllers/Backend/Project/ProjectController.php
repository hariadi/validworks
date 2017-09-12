<?php

namespace App\Http\Controllers\Backend\Project;

use Illuminate\Http\Request;
use App\Models\Vendor\Vendor;
use App\Filters\ProjectFilters;
use App\Models\Project\Project;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Project\ProjectRepository;
use App\Http\Requests\Backend\Project\ApproveProjectRequest;

class ProjectController extends Controller
{
	protected $projects;

	public function __construct(ProjectRepository $projects)
	{
		$this->projects = $projects;
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProjectFilters $filters)
    {
    	$projects = $this->projects->latest()->filter($filters);

    	if (access()->user()->hasRole('User')) {
    		$projects->byVendor(access()->user());
    	}

    	$projects = $projects->paginate();

        return view('backend.projects.index')->withProjects($projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->projects->create($request->all());

        return redirect()
            ->route('admin.projects.index')
            ->withFlashSuccess(trans('alerts.backend.projects.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('backend.projects.show')->withProject($project);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('backend.projects.edit')->withProject($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Project $project, Request $request)
    {
        $this->projects->update($project, $request->all());

        return redirect()
            ->route('admin.projects.index')
            ->withFlashSuccess(trans('alerts.backend.projects.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $this->projects->destroy($project);

        return redirect()->route('admin.projects.index')->withFlashSuccess(trans('alerts.backend.projects.deleted'));
    }

    /**
     * @param Project              $project
     * @param ApproveProjectRequest $request
     *
     * @return mixed
     */
    public function approve(Project $project, ApproveProjectRequest $request)
    {
        $this->projects->approve($project);

        return redirect()->route('admin.projects.index')->withFlashSuccess(trans('alerts.backend.projects.approved'));
    }

    /**
     * @param Project              $project
     * @param ApproveProjectRequest $request
     *
     * @return mixed
     */
    public function unapprove(Project $project, ApproveProjectRequest $request)
    {
        $this->projects->unapprove($project);

        return redirect()->route('admin.projects.index')->withFlashSuccess(trans('alerts.backend.projects.unapproveed'));
    }
}
