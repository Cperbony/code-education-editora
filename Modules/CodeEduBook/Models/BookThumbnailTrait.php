<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 03/06/2018
 * Time: 23:04
 */

namespace CodeEduBook\Models;


trait BookThumbnailTrait
{

    public function getThumbnailNameAttribute()
    {
        return "{$this->id}.jpg";
    }

    public function getThumbnailSmallNameAttribute()
    {
        return "{$this->id}_small.jpg";
    }

    public function getThumbsPathAttribute()
    {
        return config('codeedubook.book_thumbs');
    }

    public function getThumbsStorageAttribute()
    {
        return public_path($this->thumbs_path);
    }

    public function getThumbnailRelativeAttribute()
    {
        return "{$this->thumbs_path}/{$this->thumbnail_name}";
    }

    public function getThumbnailSmallRelativeAttribute()
    {
        return "{$this->thumbs_path}/{$this->thumbnail_small_name}";
    }

    public function getThumbnailFileAttribute()
    {
        return "{$this->thumbs_storage}/{$this->thumbnail_name}";
    }

    public function getThumbnailSmallFileAttribute()
    {
        return "{$this->thumbs_storage}/{$this->thumbnail_small_name}";
    }
}