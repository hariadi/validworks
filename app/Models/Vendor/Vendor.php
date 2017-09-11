<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vendor\Traits\Scope\VendorScope;
use App\Models\Vendor\Traits\Attribute\VendorAttribute;
use App\Models\Vendor\Traits\Relationship\VendorRelationship;

class Vendor extends Model
{
    use VendorAttribute, VendorRelationship, VendorScope;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
