<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'id',
        'group_id',
        'name',
        'description',
        'serial_number',
        'model_number',
        'mac_address',
        'ip_address',
        'port',
        'multicast_address',
    ];
    //
}
