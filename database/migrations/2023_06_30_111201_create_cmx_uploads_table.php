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
        Schema::create(config('cmx_media.table_prefix') . config('cmx_media.table'), function (Blueprint $table) {
            $table->integer('id', true);
            $table->unsignedBigInteger('user_id')->nullable()->index('user_id');
            $table->string('file_original_name')->nullable();
            $table->string('file_name')->nullable();
            $table->integer('file_size')->nullable();
            $table->string('extension', 10)->nullable();
            $table->string('type', 15)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();

            // Add the foreign key constraint
            Schema::table(config('cmx_media.table_prefix') . config('cmx_media.table'), function (Blueprint $table) {
                $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(config('cmx_media.table_prefix') . config('cmx_media.table'), function (Blueprint $table) {
            $table->dropForeign('cmx_uploads_user_id_foreign');
        });

        Schema::dropIfExists(config('cmx_media.table_prefix') . config('cmx_media.table'));
    }
};
