<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alarm extends Model
{
    protected $fillable = [
        'id',
        'alarm_name',
        'alarm_duration',
        'alarm_serverity',
        'alarm_description',
        'alarm_type',
        'alarm_status'
    ];
}
