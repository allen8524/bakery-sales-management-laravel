<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id(); 
            $table->string('coname', 20);            
            $table->string('cotel', 11)->default('01022223333'); 
            $table->date('startday')->nullable();  
            $table->unsignedInteger('cokind');      
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
