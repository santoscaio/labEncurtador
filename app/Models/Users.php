<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
DB::enableQueryLog();

class Users extends Model {

    protected $table = 'user';
    public $incrementing = false;
    public $primaryKey = 'id_user';
    protected $dates = ['created_at', 'updated_at'];

}
