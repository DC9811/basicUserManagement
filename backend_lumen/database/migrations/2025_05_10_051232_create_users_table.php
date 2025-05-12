<?php
use Carbon\Carbon;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('role_id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('users')->insert([
                                    [
                                        'name' => 'Admin',
                                        'role_id' => 1,
                                        'email' => 'admin@admin.com',
                                        'password' => Hash::make('Asdf1234*'),
                                        'created_at' => Carbon::now('Asia/Manila')
                                    ],
                                ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
