<a href="{{ isset($url) ? $url : url()->previous() }}">
    <button type="button" class="btn btn-warning   fixed-cta-button text-white btn-back" role="button">
        <i class="fa fa-arrow-left"></i>
        {{ trans('admin.actions.back') }}
    </button>
</a>
