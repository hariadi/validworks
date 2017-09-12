<?php

namespace App\Models\Project\Traits\Attribute;

/**
 * Class ProjectAttribute
 */
trait ProjectAttribute
{
	public function isVerified()
    {
    	return $this->verifies->contains('ip', request()->ip());
    }

    public function getSubmitByAttribute()
    {
    	return $this->user->full_name;
    }

    /**
     * @return string
     */
    public function getUuidLabelAttribute()
    {
        return "<code>". $this->uuid .'</code>';
    }

    /**
     * @return string
     */
    public function getStatusAttribute()
    {
        if ($this->isApproved()) {
            return "<label class='label label-success'>".trans('labels.general.yes').'</label>';
        }

        return "<label class='label label-danger'>".trans('labels.general.no').'</label>';
    }

    public function isApproved()
    {
        return $this->approved_at;
    }

    /**
     * @return string
     */
    public function getApproveButtonAttribute()
    {
        if (! $this->isApproved()) {
            return '<a href="'.route('admin.projects.account.confirm.resend', $this).'" class="btn btn-xs btn-success"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title='.trans('buttons.backend.projectss.resend_email').'"></i></a> ';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        return '<a href="'.route('admin.projects.show', $this).'" class="btn btn-xs btn-info"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.view').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getApprovedButtonAttribute()
    {
    	if (access()->user()->hasRole('User')) {
    		return '';
    	}

    	$action = !$this->isApproved() ? 'approve' : 'unapprove';
    	$css = !$this->isApproved() ? 'success' : 'warning';
    	$icon = !$this->isApproved() ? 'up' : 'down';

        return '<a href="'.route('admin.projects.'. $action, $this).'" class="btn btn-xs btn-'. $css .'"><i class="fa fa-thumbs-o-'. $icon .'" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.projects.'. $action).'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.projects.edit', $this).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.edit').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if (!$this->isApproved() && $this->id != access()->id() && $this->id != 1) {
            return '<a href="'.route('admin.projects.destroy', $this).'"
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
            $this->approved_button.
            $this->delete_button;
    }
}
