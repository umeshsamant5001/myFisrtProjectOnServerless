<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class mst_group extends Model
{
    use SoftDeletes, Auditable;

    public $timestamps = false;

    protected $table = 'mst_groups';

    protected $primaryKey = 'group_id';

    protected $fillable = ['group_name'];

    protected static $logAttributes = ['group_name'];
    
}
