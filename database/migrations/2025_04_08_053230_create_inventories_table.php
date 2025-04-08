<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('inventory_name');
            $table->string('region');
            $table->string('connection_type');
            $table->string('port_info');
            $table->string('city_location');
            $table->string('building_name');
            $table->string('floor');
            $table->string('room_name');
            $table->date('installation_date');
            $table->string('asset_code');
            $table->string('contractor_company');
            $table->string('contractor_number');
            $table->date('warranty_expiration_date');
            $table->string('ip_address');
            $table->string('mac_address');
            $table->string('gateaway');
            $table->string('subnetmask');
            $table->string('hardware_serial_number');
            $table->string('software_version');
            $table->string('device_status');
            $table->softDeletes();

            $table->foreignId('user_id')->index();
            $table->foreignId('alarm_id')->index();
            $table->foreignId('group_id')->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
