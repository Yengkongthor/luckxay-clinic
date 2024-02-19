<button type="submit" class="btn btn-primary fixed-cta-button button-save " :disabled="submiting">
    <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-save'"></i>
    {{ $name ?? trans('brackets/admin-ui::admin.btn.save') }}
</button>
