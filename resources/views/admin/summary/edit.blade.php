@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.summary.actions.edit', ['name' => $summary->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <summary-form
                :action="'{{ $summary->resource_url }}'"
                :data="{{ $summary->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.summary.actions.edit', ['name' => $summary->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.summary.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </summary-form>

        </div>
    
</div>

@endsection