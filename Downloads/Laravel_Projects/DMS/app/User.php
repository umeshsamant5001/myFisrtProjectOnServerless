<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    protected $primaryKey = 'user_id';

    protected $table = 'mst_users';

    protected $fillable = [
        
        'name','contact_no','email_id', 'username', 'password', 'location', 'designation','role_id','group_id','created_by', 'created_date', 'created_time','updated_by', 'updated_date', 'updated_time', 'flag',
    ];

   
    protected $hidden = [
        'password',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
