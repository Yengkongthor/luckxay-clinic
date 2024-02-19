@extends('admin.layout.master')

@section('header')
@include('admin.partials.header')
@endsection

@section('content')

<div class="app-body">

    @if(View::exists('admin.layout.sidebar'))
    @include('admin.layout.sidebar')
    @endif

    <main class="main">

        <div class="container-fluid" id="app" :class="{'loading': loading}">
            <div class="modals">
                <v-dialog />
            </div>
            <div>
                <notifications position="bottom right" :duration="2000" />
            </div>
            <div>
                <component-notification inline-template
                    :reception="'{{ Auth::user()->employee->department_code ?? null}}'"
                    :assign-doctor-id="'{{ Auth::user()->employee->admin_user_id ?? null}}'">
                    <div>

                        <audio id="audioSound">
                            <source src="../audio/sound.mp3" type="audio/mp3">
                        </audio>
                    </div>
                </component-notification>
            </div>

            @yield('body')
        </div>
    </main>
</div>
@endsection

@section('footer')
{{-- @include('admin.partials.footer') --}}
@endsection

@section('bottom-scripts')
@parent

<script>
    var x = document.getElementById("audioSound");
    function checkSound() {
        vid.muted = true;
        x.play();
    }

</script>
@endsection
