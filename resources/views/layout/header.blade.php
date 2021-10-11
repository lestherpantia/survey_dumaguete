@section('header')
    <header class="d-flex justify-content-between align-items-center text-center">
        <img src="{{ asset('image/icons/Green Apple Transparent.png') }}" alt="">

        @if(strpos(Request::url(), 'bais'))

            <img class="logo" src="{{ asset('image/icons/bais_logo.jpg') }}" alt="">

        @else

            <img class="logo" src="{{ asset('image/icons/dumaguete_logo.png') }}" alt="">

        @endif
        
    </header>
@stop
