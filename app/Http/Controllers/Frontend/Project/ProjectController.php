<?php

namespace App\Http\Controllers\Frontend\Project;

use Illuminate\Http\Request;
use App\Models\Verify\Verify;
use App\Models\Project\Project;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
	/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('frontend.projects.show')->withProject($project);
    }

    public function check($uuid, Request $request)
    {
    	$project = Project::uuid($uuid)->approved()->first();

    	if (!$project) {
    		return view('frontend.projects.error');
    	}

    	$locations = $request->only(['lat', 'lng']);

    	return view('frontend.projects.show')->withProject($project)->withLocations($locations);
    }

    public function verify(Project $project)
    {
    	$validate = new Verify;

    	$validate->ip = request()->ip();
    	$validate->choice = request('choice');

    	if (request('lat') && preg_match('/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/', request('lat')) ) {
    		$validate->latitude = (float) request('lat');
    	}

    	if (request('lng') && preg_match('/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/', request('lng')) ) {
    		$validate->longitude = (float) request('lng');
    	}

    	$validate->project_id = $project->id;

    	if (auth()->check()) {
    		$validate->user_id = access()->id();
    	}

    	$responses = request('choice') == 'Yes' ? [
    		'status' => true,
		    'message' => 'Thank you for your verification.'
		] : [
			'status' => false,
		    'message' => 'Your report has been saved. <a href="' . route('frontend.projects.report', $project) . '">Do you want to add more info?</a>',
		];

    	if ($validate->save()) {
    		return response()->json($responses);
    	}
    }
}
