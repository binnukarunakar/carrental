{{-- In this file we will create a view for  Completed Reservation  --}}

{{-- Extending a layouts/app view because this file is available for the users and guests --}}
@extends('layouts.app')

{{-- Below is the content of the Page --}}
@section('content')
    <div style="margin-top:50px" class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                @if(Session::has('created_reservation_car'))
                    <div class="alert alert-success" role="alert">
                        <p>{!! trans('home.completed_reservation1') !!}</p>

                        {{-- Redirect to their Prpfile's page --}}
                        <p>{!! trans('home.Go_to') !!} <a href="{{route('user.user-reservations')}}"><strong>{!! trans('home.Your_Account') !!}</strong></a> {!! trans('home.completed_reservation2') !!}.</p>
                    </div>
                @else
                    <script>window.location = "/";</script>
                @endif
            </div>
        </div>
    </div>
@endsection