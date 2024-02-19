<div class="card">
    <div class="card-header">{{ __('Examination Result File')}}</div>
    <div class="card-body">

        @if ($status ?? '' =='lab')
        <table class="table table-responsive-sm">
            <thead>
                <tr>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($upload as $item)
                <tr>
                    <td>
                        @foreach ($item->getMedia('upload_file') as $item)
                        <a target="_blank" class="btn btn-primary btn-sm"
                            href="{{url($item ? $item->getUrl() : 'https://via.placeholder.com/1000.png?text=No%20File')}}">
                            Open
                        </a>
                        @endforeach

                    </td>
                </tr>
                @endforeach


            </tbody>
        </table>
        @else
        <table class="table table-responsive-sm">
            <thead>
                <tr>
                    <th>Lab Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($upload as $item)
                <tr>
                    <td>{{ $item->employee->lao_first_name}}</td>
                    <td>
                        @foreach ($item->getMedia('upload_file') as $item)
                        <a target="_blank" class="btn btn-primary btn-sm"
                            href="{{url($item ? $item->getUrl() : 'https://via.placeholder.com/1000.png?text=No%20File')}}">
                            Open
                        </a>
                        @endforeach
                    </td>
                </tr>
                @endforeach


            </tbody>
        </table>
        @endif



    </div>
</div>
