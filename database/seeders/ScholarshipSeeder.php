<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScholarshipSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::table('scholarships')->exists()) {
            return;
        }

        // name, quota, applicants, passed_admin, passed_selection, recipients  (data simulasi)
        $rows = [
            ['KIP Kuliah',         190, 750, 480, 220, 175],
            ['Prestasi Akademik',   75, 300, 190,  90,  70],
            ['Bantuan Pendidikan',  55, 200, 130,  65,  50],
            ['Kepemimpinan',        30, 100,  65,  32,  25],
            ['Beasiswagibran',      50, 200, 130,  58,  45],
            ['Beasiswa Daerah',     49, 200, 140,  60,  45],
        ];

        foreach ($rows as [$name, $quota, $app, $adm, $sel, $rec]) {
            DB::table('scholarships')->insert([
                'name' => $name, 'quota' => $quota, 'applicants' => $app,
                'passed_admin' => $adm, 'passed_selection' => $sel, 'recipients' => $rec,
                'created_at' => now(), 'updated_at' => now(),
            ]);
        }
    }
}
