<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'user_id',
        'performed_by_name',
        'performed_by_role',
        'status',
        'remark',
        'activity_date',
        'performed_at',
    ];

    protected $casts = [
        'activity_date' => 'date',
        'performed_at'  => 'datetime',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeBetween($query, $from, $to)
    {
        return $query->whereBetween('activity_date', [$from, $to]);
    }

    public function scopeForDate($query, $date)
    {
        return $query->whereDate('activity_date', $date);
    }
}