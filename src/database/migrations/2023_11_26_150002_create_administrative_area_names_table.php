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
        Schema::connection(config('nep-address.connection'))->create('administrative_area_names', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->unsignedBigInteger('district_id')->nullable()->index();  
            $table->unsignedBigInteger("area_type_id")->nullable()->index(); 
            $table->timestamps();

            // Foreign Key
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('set null');
            $table->foreign('area_type_id')->references('id')->on('administrative_area_types')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrative_area_names');
    }
};
