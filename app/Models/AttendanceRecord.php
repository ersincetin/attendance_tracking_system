<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceRecord extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'semester_id',
        'user_id',
        'class_id',
        'course_id',
        'updated_user_id',
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
