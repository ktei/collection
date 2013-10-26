<?php

use Illuminate\Database\Migrations\Migration;

class Init extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$this->users();
        $this->albums();
        $this->photos();
        $this->comments();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comments');
        Schema::drop('photos');
        Schema::drop('albums');
        Schema::drop('users');
	}

    private function users() {
        Schema::create('users', function($table) {
            $table->increments('id');
            $table->string('email');
            $table->string('password');
            $table->string('full_name');
            $table->boolean('has_avatar')->default(false);
            $table->integer('albums_count')->default(0);
            $table->integer('photos_count')->default(0);

            $table->timestamps();

            $table->unique('email');
        });
    }

    private function albums() {
        Schema::create('albums', function($table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('photos_count')->default(0);;

            $table->timestamps();

            // FKs
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    private function photos() {
        Schema::create('photos', function($table) {
            $table->increments('id');
            $table->integer('album_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('description')->nullable();
            $table->integer('comments_count')->default(0);;

            $table->timestamps();

            // FKs
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
        });
    }

    private function comments() {
        Schema::create('comments', function($table) {
            $table->increments('id');
            $table->integer('photo_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('content');

            $table->timestamps();

            // FKs
            $table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

}