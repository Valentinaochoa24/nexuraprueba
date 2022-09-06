<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class area extends Model
{
    use HasFactory;
    public function empleado()
    {
        return $this->hasMany(empleado::class,'id');
    }
    protected $guarded = [];
}
