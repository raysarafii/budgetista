<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassUser extends Model
{
    use HasFactory;
    protected $table = 'class_user';
    protected $fillable = ['class_id', 'user_id', 'role'];
} 