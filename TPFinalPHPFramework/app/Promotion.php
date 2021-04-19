<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    public function modules(){
        return $this->belongsToMany(Module::class, 'promotion_module');
    }
    public function students() {
        return $this->hasMany(Student::class);
    }
}
