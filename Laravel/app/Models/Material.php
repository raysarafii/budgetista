<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = ['class_id', 'title', 'file', 'content', 'created_by'];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }
}
