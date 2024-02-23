<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','weekly_schedule_id', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function weeklySchedule()
    {
        return $this->belongsTo(WeeklySchedule::class);
    }
    public function monSite()
    {
        return $this->belongsTo(Site::class, 'mon');
    }
    public function tueSite()
    {
        return $this->belongsTo(Site::class, 'tue');
    }
    public function wedSite()
    {
        return $this->belongsTo(Site::class, 'wed');
    }
    public function thuSite()
    {
        return $this->belongsTo(Site::class, 'thu');
    }
    public function friSite()
    {
        return $this->belongsTo(Site::class, 'fri');
    }
    public function satSite()
    {
        return $this->belongsTo(Site::class, 'sat');
    }
    public function sunSite()
    {
        return $this->belongsTo(Site::class, 'sun');
    }
}
