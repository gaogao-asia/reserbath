<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url')->default('');
            $table->string('title')->nullable()->default('');
            $table->string('entity_type')->default('');
            $table->unsignedBigInteger('entity_id')->default(0);
            $table->string('storage_type')->default('');
            $table->string('file_category_type')->default('');
            $table->string('file_type')->default('');
            $table->string('s3_key')->default('');
            $table->string('s3_bucket')->default('');
            $table->string('s3_region')->default('');
            $table->string('s3_extension')->default('');
            $table->string('media_type')->default('');
            $table->string('original_file_name')->default('');
            $table->unsignedBigInteger('file_size')->default(0);
            $table->boolean('is_enabled')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
