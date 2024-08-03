<?php

namespace App\Models;

use App\Enums\MediaCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @method static create(array $data)
 */
class Article extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
    ];

    /**
     * Custom Attributes
     *
     * @var string[]
     */
    protected $appends = [
        'image_url'
    ];


    /**
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(
            MediaCollection::ARTICLE_MAIN_IMAGE->value
        )->singleFile();
    }

    /**
     * @return string|null
     */
    public function getImageUrlAttribute(): ?string
    {
        $media = $this->getFirstMedia(
            MediaCollection::ARTICLE_MAIN_IMAGE->value
        );
        return $media ? $media->getUrl() : null;
    }
}
