<modal name="{{$name}}" @before-open="{{$beforeOpen ?? ''}}" class="modal--translation {{$class ?? ''}}" v-cloak height="{{ $height ?? 'auto'}}"
    width="{{ $width ?? '50%'}}" :scrollable="true" :adaptive="true" :pivot-y="0.25">
    {!! $body ?? '' !!}
</modal>
