<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Urls extends Model {

    protected $table = 'url';
    public $incrementing = false;
    public $primaryKey = 'id_url';
    protected $dates = ['created_at', 'updated_at'];

}
