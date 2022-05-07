<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tpa_institution extends Model
{
    use SoftDeletes;
   protected $table = "tbl_tpa_institution";
    protected $fillable = ['*'];

   public function institution(){
       return $this->belongsTo(Institution::class);
   }

   
}
