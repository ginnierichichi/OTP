@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Enter OTP') }}</div>

                @if($errors->count() > 0 )
                    <div class="alter-danger">
                    @foreach ($errors->all() as $error)
                        {{$error}}
                    @endforeach
                    </div>
                @endif

                @if(session()->has('Message'))
                    <div class="alert alert-info">
                    {{ session()->get('Message') }}
                    </div>
                @endif

                <div class="card-body">
                    <form action="/verifyOTP" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="otp">Your OTP</label>
                        <input type="text" name="OTP" id="otp" class="form-control" required>
                        <input type="submit" value= "Verify">
                    </div>
                    <input type="submit" value="Verify" class="btm btm-info">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection