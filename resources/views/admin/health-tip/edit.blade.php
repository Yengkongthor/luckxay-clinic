@extends('admin.layout.default')

@section('title', trans('admin.health-tip.actions.edit', ['name' => $healthTip->title]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <health-tip-form
                :action="'{{ $healthTip->resource_url }}'"
                :data="{{ $healthTip->toJson() }}"
                v-cloak
                inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.health-tip.actions.edit', ['name' => $healthTip->title]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.health-tip.components.form-elements')
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>

                </form>

        </health-tip-form>

        </div>

</div>

@endsection
