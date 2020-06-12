@extends('layouts.app')

@section('content')

    <div class="container bg-white mt-3 mb-3 border border-dark">
        <div class="row p-5">
            <div class="col-6 text-center">
                <img src="{{ $user->image_path }}" alt="avatar" style="width:150px; height:150px; float:lift; border-radius:50%; margin-right:25px;">
            </div>

            <div class="col-6 pl-5">
                <h3 class="text-danger">{{ $user->first_name . ' ' .  $user->last_name }}'s Profile</h3>
                <h3><i class="fa fa-phone" aria-hidden="true"></i> {{ $user->phone }}</h3>
                <h3><i class="fa fa-address-book" aria-hidden="true"></i> {{ $user->address }}</h3>
                <h3 style="direction: ltr !important;"><i class="fa fa-envelope" aria-hidden="true"></i> {{ $user->email }}</h3>

                @if (auth()->user()->hasRole(['client','admin']) & $user->id == auth()->user()->id )
                    <a href="{{ route('edit_profile' , $user->id ) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                @else
                    <a href="#" class="btn btn-primary btn-sm disabled"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                @endif
            </div>
        </div>
        
    </div>

@endsection