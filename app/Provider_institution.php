<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider_institution extends Model
{
    //  
    use SoftDeletes;
    protected $table = "tbl_institution_providers";
    protected $fillable = ['*'];

    public function institution(){
        return $this->belongsTo(Institution::class);
    }
}
