<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    //
    protected $table = "tbl_roles";

    public function permissions(){
        return $this->belongsTo(Permission::class);
    }
}
