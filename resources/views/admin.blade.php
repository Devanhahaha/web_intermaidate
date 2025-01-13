@extends('app')
@section('body')
    @include('navbar')
    @include('sidebar')
    <div class="p-4 sm:mt-14 sm:ml-64">
        @yield('content')
    </div>
@endsection