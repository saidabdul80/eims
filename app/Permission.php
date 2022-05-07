<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //
    protected $table = "tbl_permission";

    public function role(){
        return $this->belongsTo(Roles::class);
    }

 

    /* public function getrole() {
        $permission = Permission::where($this->tpa_id);
        return "{$permission->role_id}";
    } */

}
