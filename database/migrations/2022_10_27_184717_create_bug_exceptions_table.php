<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bug_exceptions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('host');
            $table->string('method');
            $table->string('full_url');
            $table->json('executor');
            $table->text('exception');
            $table->text('environment');
            $table->json('additional')->nullable();
            $table->longText('errors');
            $table->integer('line');
            $table->json('storage');
            $table->text('file');
            $table->json('user')->nullable();
            $table->string('status')->default('unread');
            $table->string('project_id');
            $table->string('issue_id')->nullable();
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
        Schema::dropIfExists('bug_exceptions');
    }
};
