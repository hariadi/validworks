<?php

namespace App\Http\Controllers\Backend\Report;

use Illuminate\Http\Request;
use App\Models\Report\Report;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Report\ReportRepository;
use App\Http\Requests\Backend\Report\ApproveReportRequest;

class ReportController extends Controller
{
	protected $reports;

	public function __construct(ReportRepository $reports)
	{
		$this->reports = $reports;
	}

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

    /**
     * @param Report              $report
     * @param ApproveReportRequest $request
     *
     * @return mixed
     */
    public function solve(Report $report, ApproveReportRequest $request)
    {
        $this->reports->solve($report);

        return redirect()->route('admin.reports.index')->withFlashSuccess(trans('alerts.backend.reports.solved'));
    }

    /**
     * @param Report              $report
     * @param ApproveReportRequest $request
     *
     * @return mixed
     */
    public function unsolve(Report $report, ApproveReportRequest $request)
    {
        $this->reports->unsolve($report);

        return redirect()->route('admin.reports.index')->withFlashSuccess(trans('alerts.backend.reports.unsolved'));
    }
}
