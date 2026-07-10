<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = '71039910@verifika.ife.com.bo';
        $phone = '71039910';

        $data = [
            'name' => 'David',
            'phone' => $phone,
            'email' => $email,
            'password' => Hash::make('123456789'),
            'is_admin' => true,
        ];

        $existing = User::where('email', $email)
            ->orWhere('phone', $phone)
            ->first();

        if ($existing) {
            $existing->fill($data);
            $existing->save();
        } else {
            User::create($data);
        }
    }
}
