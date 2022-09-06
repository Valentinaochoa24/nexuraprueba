<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class empleado_rol extends Model
{
    use HasFactory;
    public function empleado()
    {
        return $this->belongsTo(empleado::class);
    }
    public function rol()
    {
        return $this->hasOne(rol::class,'id');
    }
    protected $guarded = [];
}
