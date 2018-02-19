@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Awaiting Activation</div>

                    <div class="card-body">
                        Thank you for registering!  You have received an SMS message with an activation code.
                        Please enter it below.

                        <form method="POST" action="{{ route('user.activate.handle') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="activation_code" class="form-control" /> <br/>

                                    <input type="submit" class="btn btn-info btn-sm" value="Activate" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
