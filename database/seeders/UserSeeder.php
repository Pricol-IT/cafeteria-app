<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'company_name' => 'Pricol Corporate Services Ltd',
            'emp_id' => 'PCS661',
            'name' => 'User',
            'email' => 'user@pricol.com',
            'password' => Hash::make('Password@123'),
            'location' => 'Coimbatore',
            'role' => 'user',
            'status' => 'active'
        ]);
    }
}
