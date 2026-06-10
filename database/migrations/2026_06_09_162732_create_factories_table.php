<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('factories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_en')->nullable();
            $table->string('city');
            $table->string('country');
            $table->integer('capacity_mt')->nullable();
            $table->enum('status', ['operational', 'construction', 'planned'])->default('operational');
            $table->text('description')->nullable();
            $table->text('description_en')->nullable();
            $table->string('image')->nullable();
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();
            $table->integer('order')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('factories'); }
};
