<?php

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class Album
{
  public static function allAlbums(): array
  {
      $data = File::get(storage_path('app/data/album-albums.json'));
      return json_decode($data);
  }

  public static function findAlbum(int $id): array|null
  {
      $str = File::get(storage_path('app/data/album-albums.json'));
      $data = json_decode($str, true);
      return Arr::first( $data, fn($item) => $item['id'] == $id);
  }

  public static function allEvents(): array
  {
      $data = File::get(storage_path('app/data/album-events.json'));
      return json_decode($data);
  }

  public static function findEvent(int $id): array|null
  {
      $str = File::get(storage_path('app/data/album-events.json'));
      $data = json_decode($str, true);
      return Arr::first( $data, fn($item) => $item['id'] == $id);
  }

  public static function allPhotos(): array
  {
      $fetchedPhotos = File::get(storage_path('app/data/album-photos.json'));
      return json_decode($fetchedPhotos);
  }
}
