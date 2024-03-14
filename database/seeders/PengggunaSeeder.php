<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Pengguna::factory(10)->create();

        \App\Models\Pengguna::factory()->create([
            'name' => 'jihooon',
            'password' =>md5('123'),
            'peran' => 'admin',
            'email' => 'jihoon@admin.com',
        ]);
    }
}
