<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Album extends Model implements HasMedia
{
    use InteractsWithMedia;
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('preview')
            ->width(100);
    }
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('images')
            ->acceptsMimeTypes(['image/jpeg','image/jpg']);
    }
    protected $fillable = ['name'];
}
