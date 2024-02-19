@extends('admin.layout.default')

@section('title', trans('admin.profit.actions.edit', ['name' => $profit->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <profit-form
                :action="'{{ $profit->resource_url }}'"
                :data="{{ $profit->toJson() }}"
                v-cloak
                inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.profit.actions.edit', ['name' => $profit->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.profit.components.form-elements')
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>

                </form>

        </profit-form>

        </div>

</div>

@endsection
