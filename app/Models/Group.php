<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class Group extends Model
{
    use HasFactory, SoftDeletes;

    // protected $primaryKey = 'id';
    // public $incrementing = true;
    // protected $keyType = 'int';


    protected $fillable = [
        'id',
        'group_name',
        'port',
        'multicast_address',
    ];
}
