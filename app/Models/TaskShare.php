<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskShare extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'token', 'expires_at'];

    protected $dates = ['expires_at'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
