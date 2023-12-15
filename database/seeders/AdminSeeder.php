<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'company_name' => 'Pricol Corporate Services Ltd',
            'name' => 'Admin',
            'email' => 'Admin@pricol.com',
            'password' => Hash::make('Password@123'),
            'status' => 'active'
        ]);
    }
}
