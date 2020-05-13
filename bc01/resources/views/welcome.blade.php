@extends('layouts.app')

@section('content')
    @guest

        <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="title m-b-md">
                        @lang('welcome.welcome_msg')
                    </div>
                    <p class="welcome">@lang('welcome.info')</p>
                </div>
        </div>
    </div>
    @endguest
    @auth
        <script>window.location = "./room_info";</script>
    @endauth


@endsection
