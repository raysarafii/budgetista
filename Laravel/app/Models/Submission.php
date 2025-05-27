<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_id', 
        'student_id', 
        'file', 
        'text', 
        'submitted_at', 
        'grade', 
        'feedback'
    ];
    public function student()
    {
        return $this->belongsTo(\App\Models\User::class, 'student_id');
    }
}
