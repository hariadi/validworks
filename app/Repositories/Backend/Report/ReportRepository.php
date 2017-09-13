<?php

namespace App\Repositories\Backend\Report;

use Carbon\Carbon;
use App\Models\Report\Report;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class ReportRepository extends BaseRepository
{
	/**
     * Associated Repository Model.
     */
    const MODEL = Report::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
    	//
    }

    /**
     * Get all instance of Report.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Report[]
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
    public function getReportsPaginated($per_page = 10, $order_by = 'id', $sort = 'asc')
    {
        return $this->query()->orderBy($order_by, $sort)->paginate($per_page);
    }

   /**
     * Create a new instance of Report.
     *
     * @param  array  $input
     * @return object
     */
    public function create($input)
    {
        $report = $this->createReportStub($input);

        if ($report->save()) {
        	// event(new ReportCreated($report));

        	return $report;
        }

        throw new GeneralException('There was a problem creating this report. Please try again.');
    }

    /**
     * Update the Report with the given attributes.
     *
     * @param  int    $id
     * @param  array  $input
     * @return bool|int
     */
    public function update(Model $report, array $input)
    {
        if ($report->update($input)) {
    		//event(new ReportUpdated($report));

    		return $report;
    	}

        throw new GeneralException('There was a problem updating this report. Please try again.');
    }

    /**
     * @param Model $report
     *
     * @return bool
     * @throws GeneralException
     */
    public function solve(Model $report)
    {
        if ($report->solved_at) {
            throw new GeneralException(trans('exceptions.backend.reports.already_solved'));
        }

        $report->solved_at = Carbon::now();

        if ($report->save()) {
            // event(new ReportSolved($report));

            // if ($vendor = $report->user) {
            // 	// Let vendor know their account was solved
            // 	$vendor->notify(new ReportVendorSolved($report));
            // }

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.reports.cant_confirm'));
    }

    /**
     * @param Model $report
     *
     * @return bool
     * @throws GeneralException
     */
    public function unsolve(Model $report)
    {
        if (is_null($report->solved_at)) {
            throw new GeneralException(trans('exceptions.backend.access.reports.not_solved'));
        }

        $report->solved_at = null;

        if ($report->save()) {
            //event(new ReportUnsolved($report));
        	//$vendor = $report->user;
            //$vendor->notify(new ReportVendorSolved($report));

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.reports.cant_unsolve')); // TODO
    }

    /**
     * @param  $id
     * @throws GeneralException
     * @return boolean|null
     */
    public function destroy(Model $report)
    {
        if ($report->delete()) {
            //event(new ReportDeleted($report));

            return true;
        }

        throw new GeneralException('There was a problem deleting this report. Please try again.');
    }

    /**
     * @param  $input
     * @return mixed
     */
    private function createReportStub($input)
    {
        $report = self::MODEL;
        $report = new $report;

        foreach ($report->getFillable() as $column) {
        	if (array_key_exists($column, $input)) {
        		$report->{$column} = $input[$column];
        	}
        }

        return $report;
    }
}
