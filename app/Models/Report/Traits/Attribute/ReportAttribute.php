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
}
