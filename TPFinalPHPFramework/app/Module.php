<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    public function students(){
        return $this->belongsToMany(Student::class, 'student_module');
    }
    public function promotions(){
        return $this->belongsToMany(Promotion::class, 'promotion_module');
    }
}
