<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('staff_id')->nullable()->after('id'); //add staff_id column after id column
            $table->string('phone')->nullable()->after('name'); //add phone column after name column
            $table->text('address')->nullable()->after('phone');  // "->after('column_name')"'is optional, tak letak dia akan letak at the end of db
            $table->integer('status')->default(0)->after('remember_token'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('staff_id');
            $table->dropColumn('phone');
            
            $table->dropColumn('status');
        });
    }
};
