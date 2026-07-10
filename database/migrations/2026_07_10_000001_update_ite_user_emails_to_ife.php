<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('users')
            ->where('email', 'like', '%@verifika.ite.com.bo')
            ->update([
                'email' => DB::raw("REPLACE(email, '@verifika.ite.com.bo', '@verifika.ife.com.bo')"),
            ]);
    }

    public function down(): void
    {
        DB::table('users')
            ->where('email', 'like', '%@verifika.ife.com.bo')
            ->update([
                'email' => DB::raw("REPLACE(email, '@verifika.ife.com.bo', '@verifika.ite.com.bo')"),
            ]);
    }
};
