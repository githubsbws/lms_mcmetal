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
        Schema::create('pgroups', function (Blueprint $table) {
            $table->id('pgroup_id');
            $table->string('group_name');
            $table->boolean('active')->default(true);
            $table->timestamps('create_data','update_data');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pgroups');
    }
};
