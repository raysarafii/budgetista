<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;


    protected $table = 'classes';


    protected $fillable = ['name', 'code', 'created_by'];

    /**
     * Relasi many-to-many ke model User melalui pivot table class_users
     */
    public function users()
    {
        return $this->belongsToMany(
            User::class,        
            'class_user',      
            'class_id',         
            'user_id'            
        )
        ->withPivot('role')     
        ->withTimestamps();     
    }
   public function materials()
    {
        return $this->hasMany(Material::class, 'class_id');
    }
    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'class_id');
    }
}
