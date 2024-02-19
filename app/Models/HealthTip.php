<?php

namespace App\Models;

use Brackets\AdminUI\Traits\HasWysiwygMediaTrait;
use Illuminate\Database\Eloquent\Model;
use Brackets\Media\HasMedia\ProcessMediaTrait;
use Brackets\Media\HasMedia\AutoProcessMediaTrait;
use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Brackets\Media\HasMedia\HasMediaThumbsTrait;


class HealthTip extends Model implements HasMedia
{
    use ProcessMediaTrait;
    use AutoProcessMediaTrait;
    use HasMediaCollectionsTrait;
    use HasMediaThumbsTrait;
    use HasWysiwygMediaTrait;

    protected $fillable = [
        'title',
        'short_desc',
        'detail',

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/health-tips/' . $this->getKey());
    }

    public function getHealthtipsImageAttribute()
    {
        if ($media = $this->getMedia('healthTips')->first()) {
            return $media->getUrl('hd');
        }
        return null;
        // return $this->getFirstMediaUrl('healthTips','') ?: null;
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('healthTips')
            ->accepts('image/*')
            ->maxNumberOfFiles(1);
    }
    public function registerMediaConversions(Media $media = null)
    {
        $this->autoRegisterThumb200();
        $this->addMediaConversion('hd')
            ->width(1024)
            ->height(576)
            ->performOnCollections('healthTips')
            ->nonQueued();
    }
}
