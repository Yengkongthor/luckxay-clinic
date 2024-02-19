<div class="{{ $col ?? 'col-md-6' }}">
    <div class="form-group "
        :class="{'has-danger': errors.has('{{ $name }}'), 'has-success': fields.{{ $name }} && fields.{{ $name }}.valid }">
        <p for="{{ $name }}">{{ $label }}</p>
        <input type="{{ $type ?? 'text' }}" min="{{ $min ?? '' }}" v-model="{{ $model }}"
            {{ isset($disabled) ? 'disabled' : '' }} v-validate="'{{ $validate ?? '' }}'" @input="validate($event)"
            class="form-control"
            :class="{'form-control-danger': errors.has('{{ $name }}'), 'form-control-success': fields.{{ $name }} && fields.{{ $name }}.valid}"
            id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}">
        <div v-if="errors.has('{{ $name }}')" class="form-control-feedback form-text" v-cloak>
            @{{ errors . first('{!! $name !!}') }}</div>
    </div>
</div>
