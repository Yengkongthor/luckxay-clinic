@if ($status == 'lab')
<table>
    <thead>
        <tr>
            @foreach ($service_name_key as $key=>$value)
            <th>{{$value}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        <tr>
            @foreach($service_name_price as $item)
            <td>{{ $item}}</td>
            @endforeach
        </tr>
    </tbody>
</table>

@endif

@if ($status == 'day')
<table>
    <thead>
        <tr>
            @foreach ($date as $key=>$value)
            <th>{{$value}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        <tr>
            @foreach($dateTotal as $item)
            <td>{{$item}}</td>
            @endforeach
        </tr>
    </tbody>
</table>

@endif

@if ($status == 'time')
<table>
    <thead>
        <tr>
            @foreach ($timeName as $key=>$value)
            <th>{{$value}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        <tr>
            @foreach($timeValue as $item)
            <td>{{ $item}}</td>
            @endforeach
        </tr>
    </tbody>
</table>

@endif

@if ($status == 'gender')
<table>
    <thead>
        <tr>
            @foreach ($femaleAge as $key=>$value)
            <th>{{$value}}</th>
            @endforeach
            @foreach ($maleAge as $key=>$value)
            <th>{{$value}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        <tr>
            @foreach($femaleTotal as $item)
            <td>{{ $item}}</td>
            @endforeach
            @foreach($maleTotal as $item)
            <td>{{ $item}}</td>
            @endforeach
        </tr>
    </tbody>
</table>

@endif


@if ($status == 'province')
<table>
    <thead>
        <tr>
            @foreach ($provinceName as $key=>$value)
            <th>{{$value}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        <tr>
            @foreach($provinceValue as $item)
            <td>{{ $item}}</td>
            @endforeach
        </tr>
    </tbody>
</table>

@endif
