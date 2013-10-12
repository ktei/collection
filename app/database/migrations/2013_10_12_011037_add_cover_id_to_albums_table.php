<?php

use Illuminate\Database\Migrations\Migration;

class AddCoverIdToAlbumsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('albums', function($table)
        {
            $table->integer('cover_id')->unsigned()->nullable();

            // FKs
            $table->foreign('cover_id')->references('id')->on('photos');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('albums', function($table)
        {
            $table->dropForeign('albums_cover_id_foreign');
            $table->dropColumn('cover_id');
        });
	}

}