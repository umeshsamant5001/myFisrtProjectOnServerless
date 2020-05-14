<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class mst_right extends Model
{
    use SoftDeletes, Auditable;

    public $timestamps = false;

    protected $table = 'mst_rights';

    protected $primaryKey = 'rights_id';

    protected $fillable = ['doc_category_limit', 'workflow_limit', 'cabinet_limit', 'folders_limit', 'folder_structure_level'];

    protected static $logAttributes = ['doc_category_limit', 'workflow_limit', 'cabinet_limit', 'folders_limit', 'folder_structure_level'];

}
