<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class site extends Model
{
    protected $table = 'site'; // Specify the table name

    use HasFactory;
    protected $fillable = ['Site'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
