<?php

namespace App\Models;

use Brackets\Media\HasMedia\AutoProcessMediaTrait;
use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Brackets\Media\HasMedia\HasMediaThumbsTrait;
use Brackets\Media\HasMedia\ProcessMediaTrait;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;

class Patient extends Model implements HasMedia
{

    use ProcessMediaTrait;
    use AutoProcessMediaTrait;
    use HasMediaCollectionsTrait;
    use HasMediaThumbsTrait;
    use SoftDeletes;



    protected $fillable = [
        'user_id',
        'lao_first_name',
        'lao_last_name',
        'age',
        'gender',
        'province',
        'district',
        'village',
        'marital_status',
        'blood_group',
        'nick_name',
        'birth_date',
        'diseases_history',
        'medicine_history',
        'drug_allergy_or_food',
        'drug_or_food',
        'job',
        'salary',
        'sos'
    ];


    protected $dates = [
        'created_at',
        'updated_at',
    ];



    protected $appends = ['resource_url', 'patient_logo'];

    protected $with = ['user', 'basicPhysicalExamination'];

    /* ************************ Generate Patient Code ************************* */

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->patient_code = IdGenerator::generate(['table' => 'patients', 'field' => 'patient_code', 'length' => 10, 'prefix' => 'LH-']);
        });
    }



    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/patients/' . $this->getKey());
    }


    /* ************************ Media ************************* */

    public function registerMediaCollections()
    {
        $this->addMediaCollection('patient_photo')
            ->accepts('image/*')
            ->maxNumberOfFiles(1);

        $this->addMediaCollection('patient_document')
            ->maxFilesize(1024 * 1024 * 20)
            ->maxNumberOfFiles(1);
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->autoRegisterThumb200();
    }

    public function getPatientLogoAttribute()
    {
        if ($media = $this->getMedia('patient_photo')->first()) {
            return $media->getUrl();
        }
        return asset('images/logo/profile.png');
    }

    /* ************************ Relation ************************* */

    public function user()
    {
        return $this->belongsTo('App\Models\User')->withDefault();
    }

    public function patientHistory()
    {
        return $this->hasMany('App\Models\PatientHistory');
    }

    public function basicPhysicalExamination()
    {
        return $this->hasMany('App\Models\BasicPhysicalExamination');
    }

    /**
     * Get the province that owns the Patient
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provinceLa(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province', 'en_name');
    }
}
