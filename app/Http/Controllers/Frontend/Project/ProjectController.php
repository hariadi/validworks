<?php

namespace App\Http\Controllers\Frontend\Project;

use Illuminate\Http\Request;
use App\Models\Project\Project;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function check($uuid, Request $request)
    {
    	$project = Project::uuid($uuid)->approved()->first();

    	if (!$project) {
    		return view('frontend.projects.error');
    	}

    	//'https://maps.googleapis.com/maps/api/geocode/json?latlng=2.909047,101.654669&key=AIzaSyBPl9YmWREYZ6FLFa03YVXp4rH92uAtBJY'

    	//dd($uuid, $request->all(), $project);
    	return view('frontend.projects.show')->withProject($project);
    }
}
