<?php

use Way\Tests\Factory;

class AlbumRepositoryTest extends TestCase {

    public function setUp() {
        parent::setUp();
        $this->prepareDatabase();
        $this->albumsRepository = App::make('Rui\Collection\Repositories\AlbumsRepositoryInterface');
    }

    public function test_order_by_updated_at_desc() {
        Factory::create('Album', array('name' => 'a1', 'updated_at' => strtotime('-2 days')));
        Factory::create('Album', array('name' => 'a2', 'updated_at' => strtotime('-1 days')));

        $albums = $this->albumsRepository->all();

        assertThat($albums, is(arrayValue()));
        assertThat($albums[0]->name, equalTo('a2'));
        assertThat($albums[1]->name, equalTo('a1'));
    }

    public function test_paginate_albums() {
        for ($i = 0; $i < 5; $i++) {
            Factory::create('Album');
        }

        $albums = $this->albumsRepository->all(array('page' => 1, 'limit' => 2));

        assertThat(count($albums), equalTo(2));
    }

    public function test_show_user_owned_albums() {
        $user1 = Factory::create('User');
        $user2 = Factory::create('User');
        Factory::create('Album', array('user_id' => $user1->id, 'name' => 'album1'));
        Factory::create('Album', array('user_id' => $user2->id, 'name' => 'album2'));

        $albums = $this->albumsRepository->all(array('user_id' => $user1->id));

        assertThat(count($albums), equalto(1));
        assertThat($albums[0]->name, equalTo('album1'));
    }

    public function test_save_album() {
        $user = Factory::create('User');
        $attrs = Factory::attributesFor('Album', array('user_id' => $user->id));

        $this->albumsRepository->save($attrs);

        assertThat(Album::count(), equalTo(1));
        assertThat(Album::first()->user_id, equalTo($user->id));
    }
}