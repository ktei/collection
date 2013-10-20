<?php

use Way\Tests\Factory;

class PhotosRepositoryTest extends TestCase {

    public function setUp() {
        parent::setUp();
        $this->prepareDatabase();
        $this->photosRepository = App::make('Rui\Collection\Repositories\PhotosRepositoryInterface');
    }

    public function test_find_by_album_should_order_by_created_at_desc() {
        $album = Factory::create('Album');
        Factory::create('Photo', array('album_id' => $album->id, 'description' => 'p1', 'created_at' => strtotime('-2 days')));
        Factory::create('Photo', array('album_id' => $album->id, 'description' => 'p2', 'created_at' => strtotime('-1 days')));

        $photos = $this->photosRepository->findByAlbum($album->id);

        assertThat($photos, is(arrayValue()));
        assertThat($photos[0]->description, equalTo('p2'));
        assertThat($photos[1]->description, equalTo('p1'));
    }

    public function test_find_by_album_should_paginate() {
        $album = Factory::create('Album');
        for ($i = 0; $i < 5; $i++) {
            Factory::create('Photo', array('album_id' => $album->id));
        }

        $photos = $this->photosRepository->findByAlbum($album->id, array('page' => 2, 'limit' => 2));

        assertThat(count($photos), equalTo(2));
    }
}