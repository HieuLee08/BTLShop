<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo transaction test
        $tstId = DB::table('tbl_transactions')->insertGetId([
            'cusId' => 1,
            'tstTotalMoney' => 250000,
            'tstNote' => 'Test order'
        ]);

        // Tạo order test
        $ibId = DB::table('tbl_inbox')->insertGetId([
            'tstId' => $tstId,
            'cusId' => 1,
            'ibDate' => now(),
            'ibQuantity' => 2,
            'ibPrice' => 250000,
            'cusName' => 'Nguyễn Văn A',
            'cusAddress' => '123 Đường ABC, TP HCM',
            'cusPhone' => '0987654321',
            'ibStatus' => 'pending'
        ]);

        // Tạo order detail test
        DB::table('tbl_detail_inbox')->insert([
            'proId' => 1,
            'odQuantity' => 2,
            'cusId' => 1,
            'ibId' => $ibId
        ]);
    }
}
