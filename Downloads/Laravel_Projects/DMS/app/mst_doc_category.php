<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class mst_doc_category extends Model
{
    use SoftDeletes, Auditable;

    public $timestamps = false;

    protected $table = 'mst_doc_category';

    protected $primaryKey = 'doc_category_id';

    protected $fillable = ['doc_category_name','doc_category_caption','doc_category_desc','doc_category_type'];

    protected static $logAttributes = ['doc_category_name','doc_category_caption','doc_category_desc','doc_category_type'];
    
}
