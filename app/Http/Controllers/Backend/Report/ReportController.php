<?php

namespace App\Http\Controllers\Backend\Report;

use Illuminate\Http\Request;
use App\Models\Report\Report;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    	$reports = Report::latest()->paginate();

        return view('backend.reports.index')->withReports($reports);
    }
}
