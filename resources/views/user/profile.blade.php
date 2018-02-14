@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">

                        <img class="img-fluid img-thumbnail" height="75" width="75" src="{{$profile_img}}" />
                        {{$user->name}}

                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('profile.picture.upload') }}" enctype="multipart/form-data">

                            @csrf

                            <div class="input-group">
                                <label for="profile_picture">Profile Picture</label>
                                <input type="file" name="profile_picture" class="form-control-file" id="profile_picture_file "/>
                            </div>


                            <input type="submit" class="btn btn-sm btn-primary" value="Upload Picture" />


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection