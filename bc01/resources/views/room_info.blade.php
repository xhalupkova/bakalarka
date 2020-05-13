@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 portfolio-item">
                <div class="card m-2">
                <canvas id="render-canvas"></canvas>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card m-2">
                    <div class="card-header">@lang('room_info.floor')</div>
                    <div class="card-body">

                        <select class="browser-default custom-select" id="floor">
                            <option value="" selected disabled>@lang('room_info.floorList')</option> <!-- moze byt este aj opcia hidden aby sa choose here uz neobjavovalo. CHCEME? -->
                        </select>

                    </div>
                </div>
                <div class="card m-2">
                    <div class="card-header">@lang('room_info.room')</div>
                    <div class="card-body" id="info"></div>
                </div>
                <div class="card m-2">
                    <div class="card-header">@lang('room_info.people')</div>
                    <div class="card-body" id="people"></div>
                </div>
                <div id="reservation" class="m-2">
                <!--<div class="card-header"></div>
                    <div class="card-body" id="reservation">
                    </div>-->
                </div>
            </div>
        </div>

    </div>

    <script type="application/javascript" src="{{ asset('js/load_floors.js') }}"></script>

@endsection
