<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'title',
        'description',
        'file',
        'due_date',
        'created_by',
    ];
    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }
public function submissions()
{
    return $this->hasMany(\App\Models\Submission::class);
}

}
