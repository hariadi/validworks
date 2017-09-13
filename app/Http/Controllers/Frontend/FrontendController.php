<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Project\Project;
use App\Http\Controllers\Controller;

/**
 * Class FrontendController.
 */
class FrontendController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
    	$projects = Project::latest()->approved()->paginate(5);

        return view('frontend.index')->withProjects($projects);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function map()
    {
    	$projects = Project::approved()->get();

        return view('frontend.map')->withProjects($projects);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function macros()
    {
        return view('frontend.macros');
    }
}
