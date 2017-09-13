<?php

namespace App\Models\Report\Traits\Attribute;

/**
 * Class ReportAttribute
 */
trait ReportAttribute
{
    public function getSubmitByAttribute()
    {
        return $this->user ? $this->user->full_name : $this->ip;
    }

    public function isSolved()
    {
        return $this->solved_at;
    }

    /**
     * @return string
     */
    public function getSolveButtonAttribute()
    {
    	if (access()->user()->hasRole('User')) {
    		return '';
    	}

    	$action = !$this->isSolved() ? 'solve' : 'unsolve';
    	$css = !$this->isSolved() ? 'success' : 'warning';
    	$icon = !$this->isSolved() ? 'check-square-o' : 'times';

        return '<a href="'.route('admin.reports.'. $action, $this).'" class="btn btn-xs btn-'. $css .'"><i class="fa fa-'. $icon .'" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.reports.'. $action).'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        return '<a href="'.route('admin.reports.show', $this).'" class="btn btn-xs btn-info"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.view').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.reports.edit', $this).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.edit').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if (!$this->isSolved()) {
            return '<a href="'.route('admin.reports.destroy', $this).'"
                 data-method="delete"
                 data-trans-button-cancel="'.trans('buttons.general.cancel').'"
                 data-trans-button-confirm="'.trans('buttons.general.crud.delete').'"
                 data-trans-title="'.trans('strings.backend.general.are_you_sure').'"
                 class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.delete').'"></i></a> ';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return
            $this->show_button.
            $this->edit_button.
            $this->solve_button.
            $this->delete_button;
    }
}
