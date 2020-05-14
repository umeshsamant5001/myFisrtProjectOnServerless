<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class tran_doc_cat_column extends Model
{
    use SoftDeletes, Auditable;

    public $timestamps = false;

    protected $table = 'tran_doc_cat_columns';

    protected $primaryKey = 'doc_cat_columns_id';

    protected $fillable = ['col_caption','col_name','data_type', 'data_length','data_control','mandatory_status', 'special_char_status', 'int_between_val', 'min_value', 'max_value'];

    protected static $logAttributes = ['col_caption','col_name','data_type', 'data_length','data_control','mandatory_status', 'special_char_status', 'int_between_val', 'min_value', 'max_value'];
}
