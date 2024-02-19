<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Brackets\Media\HasMedia\ProcessMediaTrait;
use Brackets\Media\HasMedia\AutoProcessMediaTrait;
use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Brackets\Media\HasMedia\HasMediaThumbsTrait;

class Promotion extends Model implements HasMedia

{
    use ProcessMediaTrait;
    use AutoProcessMediaTrait;
    use HasMediaCollectionsTrait;
    use HasMediaThumbsTrait;


    protected $fillable = [
        'name',
        'short_desc',
        'link',

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/promotions/' . $this->getKey());
    }

    public function getPromotionImageAttribute()
    {
        return $this->getFirstMediaUrl('promotion', 'hd') ?: null;
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('promotion')
            ->accepts('image/*')
            ->maxNumberOfFiles(1);
    }
    public function registerMediaConversions(Media $media = null)
    {
        $this->autoRegisterThumb200();
        $this->addMediaConversion('hd')
            ->width(1020)
            ->height(1360)
            ->performOnCollections('promotion')
            ->nonQueued();
    }
}
