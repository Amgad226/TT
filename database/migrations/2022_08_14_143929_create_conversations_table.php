<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('lable')->nullable();
            $table->string('img')->default(URL::to('/img/group.jpg'));
            $table->enum('type',['peer','group'])->default('peer');
            $table->string('description')->nullable();

            
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */     
    public function down()
    {
        Schema::dropIfExists('conversations');
    }
};
