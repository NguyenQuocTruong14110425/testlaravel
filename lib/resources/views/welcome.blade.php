@extends('layouts.app')

@section('content')
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    {{__('messages.welcome')}}
                </div>

                <div class="links">
                    @can('manager')
                    <a href="{{URL::to('admin/categories')}}">Categories news</a>
                    @endcan
                    <a href="{{URL::to('test/')}}">Test language</a>
                    <a href="{{URL::to('language/vi')}}">Thay đổi ngôn ngữ tiếng việt</a>
                    <a href="{{URL::to('language/en')}}">Change language englist</a>
                </div>
            </div>
        </div>
@endsection