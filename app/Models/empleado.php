<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class empleado extends Model
{
    use HasFactory;
    public function area()
    {
        return $this->belongsTo(area::class);
    }
    public function empleado_rol()
    {
        return $this->hasMany(empleado_rol::class);
    }
    protected $guarded = [];
}
