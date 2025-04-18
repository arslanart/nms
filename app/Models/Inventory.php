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
       'inventory_name',
        'region',
        'connection_type',
        'port_info',
        'city_location',
        'building_name',
        'floor',
        'room_name',
        'installation_date',
        'asset_code',
        'contractor_company',
        'contractor_number',
        'warranty_expiration_date',
        'ip_address',
        'mac_address',
        'gateway',
        'subnet_mask',
        'hardware_serial_number',
        'software_version',
        'device_status'
    ];
    //
}
