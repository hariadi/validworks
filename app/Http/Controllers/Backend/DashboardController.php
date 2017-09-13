<?php

namespace App\Http\Controllers\Backend;

use App\Models\Report\Report;
use App\Http\Controllers\Controller;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
    	$reports = Report::latest()->paginate(5);

        return view('backend.dashboard')->withReports($reports);
    }
}
