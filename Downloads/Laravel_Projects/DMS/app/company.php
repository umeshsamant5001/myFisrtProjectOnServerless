<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class company extends Model
{
  use SoftDeletes, Auditable;

  public $timestamps = false;

  protected $table = 'mst_comp_setup';
  
  protected $primaryKey = 'comp_id';

  protected $fillable = ['comp_name', 'contact_no', 'email_id', 'address', 'password_reset', 'after_no_of_days', 'app_name', 'db_name', ];

  protected static $logAttributes = ['comp_name', 'contact_no', 'email_id', 'address', 'password_reset', 'after_no_of_days', 'app_name', 'db_name', ];

}
