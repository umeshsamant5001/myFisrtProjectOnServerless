<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class MstDesignation extends Model
{
    use SoftDeletes, Auditable;

    public $timestamps = false;

    protected $table = 'mst_designations';

    public $primaryKey = 'designation_id';

    protected $fillable = ['designation'];

    protected static $logAttributes = ['designation'];
}
