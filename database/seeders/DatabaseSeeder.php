<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Jabatan;
use App\Models\Setting;
use App\Models\Absensi;
use App\Models\Lembur;
use App\Models\SurveyEvent;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // =========================
        // CLEAR TABLE
        // =========================
        DB::table('survey_event_user')->truncate();

        Absensi::truncate();
        Lembur::truncate();
        SurveyEvent::truncate();
        Setting::truncate();
        User::truncate();
        Jabatan::truncate();

        // =========================
        // JABATAN
        // =========================
        Jabatan::insert([
            [
                'id' => 1,
                'nama' => 'Staff Admin',
                'rate_per_jam' => 25000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nama' => 'Drafter',
                'rate_per_jam' => 30000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nama' => 'Helper',
                'rate_per_jam' => 30000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // =========================
        // USERS
        // =========================
        User::insert([
            [
                'id' => 2,
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => '$2y$12$1gSHT/0QYxHr01LX6alah.PkHf0jPmulRN57v.KnU6BGWYEXIMbXe',
                'role' => 'admin',
                'rate_per_jam' => 0,
                'sisa_kuota_lembur' => 50,
                'jabatan_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 5,
                'name' => 'rahadian',
                'email' => 'rahadian@gmail.com',
                'password' => '$2y$12$T0urhOUwSgsLLucKs822w.EBtQqTgSqLpqY0m1zp9binjqI7yRXjm',
                'role' => 'karyawan',
                'rate_per_jam' => 0,
                'sisa_kuota_lembur' => 46,
                'jabatan_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 6,
                'name' => 'aden',
                'email' => 'aden@gmail.com',
                'password' => '$2y$12$WMKj1f6VwBipf78JRvQpyeV8V5YCeFudJKT4Q8aUKdZlHnxJqRKmO',
                'role' => 'karyawan',
                'rate_per_jam' => 0,
                'sisa_kuota_lembur' => 50,
                'jabatan_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 7,
                'name' => 'alam',
                'email' => 'alam@gmail.com',
                'password' => '$2y$12$9vRWFlxlmdCl.vcD2JDKe.tpU63qfq7XQ1U10c6/jA4fWwlFp8y5a',
                'role' => 'karyawan',
                'rate_per_jam' => 0,
                'sisa_kuota_lembur' => 46,
                'jabatan_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // =========================
        // SETTINGS
        // =========================
        Setting::insert([
            [
                'id' => 1,
                'key' => 'rate_lembur',
                'value' => '20000',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 2,
                'key' => 'spj',
                'value' => '150000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // =========================
        // ABSENSI
        // =========================
        Absensi::insert([
            [
                'id' => 13,
                'user_id' => 7,
                'tanggal' => '2026-05-05',
                'tipe' => 'luar',
                'status' => 'approved',
                'jam_masuk' => '12:19:00',
                'jam_pulang' => null,
                'jam_kerja' => 0,
                'status_hadir' => 'hadir',
                'alasan' => 'Meeting diluar',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // =========================
        // LEMBUR
        // =========================
        Lembur::insert([
            [
                'id' => 4,
                'user_id' => 5,
                'tanggal' => '2026-05-05',
                'durasi_jam' => 4,
                'tujuan' => 'pengen aja',
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 5,
                'user_id' => 7,
                'tanggal' => '2026-05-06',
                'durasi_jam' => 4,
                'tujuan' => 'sadwqwdwd',
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // =========================
        // SURVEY EVENTS
        // =========================
        SurveyEvent::insert([
            [
                'id' => 2,
                'judul' => 'SIERA',
                'tanggal_mulai' => '2026-05-05',
                'tanggal_selesai' => '2026-05-06',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 3,
                'judul' => 'surevey standard bio',
                'tanggal_mulai' => '2026-05-07',
                'tanggal_selesai' => '2026-05-08',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // =========================
        // SURVEY EVENT USER
        // =========================
        DB::table('survey_event_user')->insert([
            [
                'survey_event_id' => 2,
                'user_id' => 5,
            ],

            [
                'survey_event_id' => 2,
                'user_id' => 6,
            ],

            [
                'survey_event_id' => 3,
                'user_id' => 5,
            ],

            [
                'survey_event_id' => 3,
                'user_id' => 7,
            ],

            [
                'survey_event_id' => 3,
                'user_id' => 6,
            ],
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}