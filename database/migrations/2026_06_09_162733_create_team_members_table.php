<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title')->nullable();
            $table->string('title_en')->nullable();
            $table->text('bio')->nullable();
            $table->text('bio_en')->nullable();
            $table->text('quote')->nullable();
            $table->text('quote_en')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('is_director')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('team_members'); }
};
