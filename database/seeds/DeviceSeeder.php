<?php

use Illuminate\Database\Seeder;
use App\Models\Device;
class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $device = new Device();
        $device->ip = '192.168.1.11';
        $device->port = '80';
        $device->save();
    }
}
