@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <!--remove original styling-->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SMS Portal With Twilio</title>
        <!-- Bootstrap styles CDN -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    </head>
        <body>
        <div class="container">
            <div class="jumbotron">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                Add Phone Number
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="form-group">
                                        <label>Enter Phone Number</label>
                <input type="tel" class="form-control" placeholder="Enter Phone Number">
                                    </div>
                    <button type="submit" class="btn btn-primary">Register User</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                Send SMS message
                            </div>
                            <div class="card-body">
                                <!--add the method attribute to the Register User form also add the name attributes to the input field -->
                                <form method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>Enter Phone Number</label>
                                        <input type="tel" class="form-control" name="phone_number" placeholder="Enter Phone Number">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Register User</button>  
                                </form>
                                <!--add the method and action attributes to the Send custom message form
                                // also add the name attributes to the input fields -->
                                <form method="POST" action="/custom">
                                    @csrf
                                    <div class="form-group">
                                        <label>Select users to notify</label>
                                        <select name="users[]" multiple class="form-control">
                                            @foreach ($users as $user)
                                            <option>{{$user->phone_number}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Notification Message</label>
                                        <textarea name="body" class="form-control" rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Send Notification</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
@endsection
