@extends('layouts.homepage.app')

@section('content')

    {{-- @if(session('success'))
        <div class="alert alert-success" dir="rtl">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('success') }}
        </div>
    @endif --}}

    <div class="container bg-white mt-3 mb-3 border border-dark">
        <div class="row p-5">
            <div class="col-m-6 m-auto pb-2">
                <img src="{{ $user->image_path }}" alt="avatar" style="width:250px; height:250px; float:lift; border-radius:45%; margin-right:25px;">
            </div>

            <div class="col-m-6 pl-2">
                <h3 class="text-danger">{{ $user->first_name . ' ' .  $user->last_name }}'s Profile</h3>
                <h3><i class="fa fa-phone" aria-hidden="true"></i> {{ $user->phone }}</h3>
                <h3><i class="fa fa-address-book" aria-hidden="true"></i> {{ $user->address }}</h3>
                <h3 style="direction: ltr !important;"><i class="fa fa-envelope" aria-hidden="true"></i> {{ $user->email }}</h3>

                @if (auth()->user()->hasRole(['client','admin','super_admin']) & $user->id == auth()->user()->id )
                    <a href="{{ route('edit_profile' , $user->id ) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                @else
                    <a href="#" class="btn btn-primary btn-sm disabled"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                @endif
            </div>
        </div>
        
    </div>

@endsection