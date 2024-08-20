<?php

namespace App\Models;

use Illuminate\Support\Facades\File;

class Album
{
  public static function allAlbums(): array
  {
    return [
      (object)[
        'id' => 1,
        'title' => 'Album 1',
        'description' => 'Album 1 description',
        'image' => 'album1.jpg',
      ],
      (object)[
        'id' => 2,
        'title' => 'Album 2',
        'description' => 'Album 2 description',
        'image' => 'album2.jpg',
      ],
      (object)[
        'id' => 3,
        'title' => 'Album 3',
        'description' => 'Album 3 description',
        'image' => 'album3.jpg',
      ],
    ];
  }

  public static function findAlbum(int $id): object
  {
    return (object)[
      'id' => $id,
      'title' => 'Album ' . $id,
      'description' => 'Album ' . $id . ' description',
      'image' => 'album' . $id . '.jpg',
    ];
  }

  public static function allEvents(): array
  {
    return [
      (object)[
        'id' => 1,
        'title' => 'Event 1',
        'description' => 'Event 1 description',
        'image' => 'event1.jpg',
      ],
      (object)[
        'id' => 2,
        'title' => 'Event 2',
        'description' => 'Event 2 description',
        'image' => 'event2.jpg',
      ],
      (object)[
        'id' => 3,
        'title' => 'Event 3',
        'description' => 'Event 3 description',
        'image' => 'event3.jpg',
      ],
    ];
  }

  public static function findEvent(int $id): object
  {
    return (object)[
      'id' => $id,
      'title' => 'Event ' . $id,
      'description' => 'Event ' . $id . ' description',
      'image' => 'event' . $id . '.jpg',
    ];
  }

  public static function allPhotos(): array
  {
      $fetchedPhotos = File::get(storage_path('app/data/album-photos.json'));
      return json_decode($fetchedPhotos);
  }
}
