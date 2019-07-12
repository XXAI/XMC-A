<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informacion extends Model{
    protected $table = 'informacion';
    protected $fillable = ['clues','nombre','email','telefono','celular','user_id'];

    public function loginLog(){
        return $this->hasMany('App\Models\LoginLog','user_id','user_id');
    }
}
