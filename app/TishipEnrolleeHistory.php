<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TishipEnrolleeHistory extends Model
{
    protected $table = "tiship_enrollee_histories";
    protected $fillable = ["*"];
    public $timestamps = true;
}
