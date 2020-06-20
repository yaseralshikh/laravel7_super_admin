@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>

            <!-- Page Content -->
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h3>@lang('site.edit')</h3>
                    </div>
                    <div class="card-body">
                        @include('partials._errors')
                        <form action="{{ route('update_profile', $user->id) }}" method="post" enctype="multipart/form-data">

                            {{ csrf_field() }}
                            {{ method_field('put') }}

                            <div class="form-group">
                                <label>@lang('site.first_name')</label>
                                <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}">
                            </div>

                            <div class="form-group">
                                <label>@lang('site.last_name')</label>
                                <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}">
                            </div>

                            <div class="form-group">
                                <label>@lang('site.email')</label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                            </div>

                            <div class="form-group">
                                <label>@lang('site.phone')</label>
                                <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                            </div>

                            <div class="form-group">
                                <label>@lang('site.address')</label>
                                <input type="text" name="address" class="form-control" value="{{ $user->address }}">
                            </div>

                            <div class="form-group">
                                <label>@lang('site.image')</label>
                                <input type="file" name="image" class="form-control-file" onchange="document.getElementById('image-preview').src = window.URL.createObjectURL(this.files[0])">
                            </div>

                            <div class="form-group">
                                <img src="{{ $user->image_path }}" style="width: 100px" id="image-preview" class="img-thumbnail form-control-file" alt="">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.edit')</button>
                            </div>

                        </form><!-- end of form -->
                    </div>
                </div>
            </div>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->
    
@endsection