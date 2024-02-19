<div class="card" id="upload-profile">
    <div>
        @if (isset($user))
            @include('brackets/admin-ui::admin.includes.media-uploader', [
            'mediaCollection' => app(App\Models\Patient::class)->getMediaCollection('patient_photo'),
            'media' => $user->patient->getThumbs200ForCollection('patient_photo'),
            'label' => 'Patient Photo'
            ])
        @else
            @include('brackets/admin-ui::admin.includes.media-uploader', [
            'mediaCollection' => app(App\Models\Patient::class)->getMediaCollection('patient_photo'),
            'label' => 'Patient Photo'
            ])
        @endif
    </div>
</div>
