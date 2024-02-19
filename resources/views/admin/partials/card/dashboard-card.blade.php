<div class="card text-center" style="border-radius: 30px">
    <img class="card-img-top" src="{{ asset($image) }}" alt="Card image cap" width="50%">
    <div class="card-body">
        <h3 class="card-title text-primary">{{strlen($title) > 10 ? substr($title,0,10)."..." : $title}}</h3>
        <p class="card-text">
            {{$short_desc}}
        </p>
        @if (isset($report) && $report =='1')
        <input type="button" class="btn btn-primary btn-lg" @click.prevent="{{$click ?? ''}}"
            value="{{strlen($btn_name) > 10 ? substr($btn_name,0,10)."..." : $btn_name ?? 'Go to'}}">
        @else
        <a href="{{ $url ?? '#' }}" onclick="checkSound()"
            class="btn btn-primary btn-lg">{{strlen($btn_name) > 10 ? substr($btn_name,0,10)."..." : $btn_name ?? 'Go to'}}</a>

        @endif
    </div>
</div>
