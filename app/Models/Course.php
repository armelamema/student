<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'courseID',
        'description'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get the faculty that owns the course
     */
    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    /**
     * Get the students enrolled in the course
     */
    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}