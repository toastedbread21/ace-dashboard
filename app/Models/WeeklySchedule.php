<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklySchedule extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','week_start_date', 'week_end_date'];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
