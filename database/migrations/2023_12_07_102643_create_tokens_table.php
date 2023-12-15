<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\MenuMaster;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(MenuMaster::class, 'menu_master_id')->constrained()->cascadeOnDelete();
            $table->date('day')->nullable();
            $table->string('spm')->nullable();
            $table->string('sim')->nullable();
            $table->string('curd')->nullable();
            $table->boolean('monthly_sim');
            $table->boolean('monthly_curd');
            $table->date('monthly')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tokens');
    }
};
