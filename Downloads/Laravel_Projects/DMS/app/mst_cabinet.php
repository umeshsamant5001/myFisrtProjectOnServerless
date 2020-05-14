<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class mst_cabinet extends Model
{
    use SoftDeletes, Auditable;

    public $timestamps = false;

    protected $table = 'mst_cabinets';

    protected $primaryKey = 'cabinet_id';

    protected $fillable = ['cabinet_name','cabinet_size','cabinet_description', 'Parent_cabinet_id','subfolder_id','currentPath1'];

    protected static $logAttributes = ['cabinet_name','cabinet_size','cabinet_description', 'Parent_cabinet_id','subfolder_id','currentPath1'];

}
