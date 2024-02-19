<upload-form :action="' {{ $upload ? $upload->resource_url : url('admin/uploads')  }}'"
    :employee-id="{{ auth()->user()->employee->id}}" :patient-history-id="{{ $patientHistoryId }}" v-cloak
    inline-template>

    <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action" novalidate>

        @if (isset($upload))
        @include('brackets/admin-ui::admin.includes.media-uploader', [
        'mediaCollection' => app(App\Models\Upload::class)->getMediaCollection('upload_file'),
        'media' => $upload->getThumbs200ForCollection('upload_file'),
        'label' => 'Upload File'
        ])
        @else
        @include('brackets/admin-ui::admin.includes.media-uploader', [
        'mediaCollection' => app(App\Models\Upload::class)->getMediaCollection('upload_file'),
        'label' => 'Upload File'
        ])
        @endif
        @include('admin.partials.save-button')

    </form>

</upload-form>
