<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDownloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('downloads', function (Blueprint $table) {
            $table->increments('id');

            // download's package
            $table->unsignedInteger('package_id');
            $table->foreign('package_id')
                ->references('id')->on('packages')
                ->onDelete('cascade');

            // download author
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            // downloaded package version
            $table->string('package_version')->nullable();

            // package hash
            $table->string('package_hash')->nullable();

            // package identifier
            $table->string('package_identifier')->nullable();

            // download type
            $table->enum('type', ['direct', 'cydia', 'other'])->nullable();

            // downloads counter
            $table->unsignedInteger('count')->default(0);
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
        Schema::dropIfExists('downloads');
    }
}
