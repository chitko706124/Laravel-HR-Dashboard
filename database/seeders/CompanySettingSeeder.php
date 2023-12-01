<?php

namespace Database\Seeders;

use App\Models\CompanySetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!CompanySetting::exists()) {
            $setting = new CompanySetting();
            $setting->company_name = 'Ninja Company';
            $setting->company_email = 'ninja@gmail.com';
            $setting->company_phone = '09963176145';
            $setting->company_address = 'NO(123), 4 th Floor, Ninja Condo, Thingangyun, Yangon.';
            $setting->office_start_time = '09:00';
            $setting->office_end_time = '18:00';
            $setting->break_start_time = '12:00';
            $setting->break_end_time = '13:00';
            $setting->save();
        }
    }
}
