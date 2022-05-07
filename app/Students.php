<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Students extends Model
{
    use SoftDeletes;
    protected $table="tbl_tiship_enrollees" ;
    protected $fillable = ['*'];
    public $timestamps = true;
}
