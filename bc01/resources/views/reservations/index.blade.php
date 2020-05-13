@extends('layouts.app')

@section('content')
@php
    //urobit redirect na room_info ked neexistuje cookie
    if(!isset($_COOKIE['room'])) {
        header("Location: http://localhost/bc01/public/room_info"); //JE TO OK??
        exit();
    }
@endphp

<div class="container container-content">
    <div class="row">


        <div class="col-lg-8" id='calendar'></div>


        <div class="col-md-4">
            <form action="{{ route('reservations.store') }}" method="post">
                {{ csrf_field() }}

                <div class="card m-2">

                    <div class="card-header">@lang('reservations.info') {{ $_COOKIE['room'] }}</div>

                    <div class="card-body">

                        <div class="form-group row">
                            <label for="room" class="col-md-4 col-form-label text-md-right">@lang('reservations.room')</label>
                            <div class="col-md-6">
                                <input id="room" type="text" name="room" class="form-control" value="{{ $_COOKIE['room'] }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">@lang('reservations.name')</label>
                            <div class="col-md-6">
                                <input id="name" type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">@lang('reservations.description')</label>
                            <div class="col-md-6">
                                <input id="description" type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" autocomplete="off">
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="dateFrom" class="col-md-4 col-form-label text-md-right">@lang('reservations.from')</label>
                            <div class="col-md-6">

                                <input type="text" class="form-control @error('dateFrom') is-invalid @enderror" id="dateFrom" name="dateFrom" value="{{ old('dateFrom') }}" autocomplete="off" data-input>
                                @error('dateFrom')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dateTo" class="col-md-4 col-form-label text-md-right">@lang('reservations.to')</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('dateFrom') is-invalid @enderror" id="dateTo" name="dateTo" value="{{ old('dateTo') }}" autocomplete="off" data-input>
                                @error('dateTo')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-outline-primary">
                                    @lang('reservations.reserve_btn')
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            @if (Session::has('alert'))
                <div class="alert alert-warning alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>{{Session::get('alert')}}</strong>
                </div>
            @endif

            <div class="m-2">
                <a href="http://localhost/bc01/public/room_info">
                    <button class="btn btn-outline-dark">@lang('reservations.back_btn')</button>
                </a>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript" src="{{ asset('js/reservations/create.js') }}"></script>
<script>
    $(document).ready(function() {
        // page is now ready, initialize the calendar...

        $('#calendar').fullCalendar({
            // put your options and callbacks here
            header:{left:'prev,next', center:'title', right:'month,agendaWeek,agendaDay'},
            locale: '{{ $locale }}', //slovensky/anglicky jazyk (menit ked sa bude menit jazyk)
            editable:true,
            selectable:true,
            navLinks: true, // can click day/week names to navigate views
            slotLabelFormat:"HH:mm", //24h cas - vo view

            events : [
                    @foreach($reservations as $reservation)
                    {
                        title : '{{ $reservation->room }}.'+'.{{ $reservation->description }}',
                        start : '{{ $reservation->dateFrom }}',
                        end : '{{ $reservation->dateTo }}',
                        url : '{{ route('reservations.show', $reservation->id) }}'
                    },
                    @endforeach
            ],
            timeFormat: 'H(:mm)' // uppercase H for 24-hour clock - pre eventy
        })
    });
</script>

@endsection
