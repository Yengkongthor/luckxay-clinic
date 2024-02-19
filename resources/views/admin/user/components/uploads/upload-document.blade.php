<div class="card" id="upload-document">
    <div>

        @if (isset($user))
            @include('brackets/admin-ui::admin.includes.media-uploader', [
            'mediaCollection' => app(App\Models\Patient::class)->getMediaCollection('patient_document'),
            'media' => $user->patient->getThumbs200ForCollection('patient_document'),
            'label' => 'Patient Document'
            ])
        @else
            @include('brackets/admin-ui::admin.includes.media-uploader', [
            'mediaCollection' => app(App\Models\Patient::class)->getMediaCollection('patient_document'),
            'label' => 'Patient Document'
            ])
        @endif

    </div>
</div>
