@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card m-2">

                    <div class="card-header">@lang('reservations.info_detail')</div>

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="room" class="col-md-4 col-form-label text-md-right">@lang('reservations.room')</label>
                            <div class="col-md-6">
                                <input id="room" type="text" name="room" class="form-control" value="{{ $reservationData->room }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">@lang('reservations.name')</label>
                            <div class="col-md-6">
                                <input id="name" type="text" name="name" class="form-control" value="{{ $reservationData->name }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">@lang('reservations.description')</label>
                            <div class="col-md-6">
                                <input id="description" type="text" name="description" class="form-control" value="{{ $reservationData->description }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dateFrom" class="col-md-4 col-form-label text-md-right">@lang('reservations.from')</label>
                            <div class="col-md-6">
                                <input id="dateFrom" type="text" name="dateFrom" class="form-control" value="{{ date('d.m.Y H:i', strtotime($reservationData->dateFrom)) }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dateTo" class="col-md-4 col-form-label text-md-right">@lang('reservations.to')</label>
                            <div class="col-md-6">
                                <input id="dateTo" type="text" name="dateTo" class="form-control" value="{{ date('d.m.Y H:i', strtotime($reservationData->dateTo)) }}" readonly>
                            </div>
                        </div>

                        <div class="m-2">
                            <a href="http://localhost/bc01/public/reservations">
                                <button class="btn btn-outline-dark">@lang('reservations.back_btn')</button>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
