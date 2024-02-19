<div class="row">
    <div class="col">
        <div>
            <div class="card-header">
                {{ __('admin.queue.columns.comment')}}
            </div>
            <div class="card-body p-0" v-cloak>
                <div class="card-block p-0">
                    <p>@{{form.comment | striphtml}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
