@extends('layouts.app')

@section('content')
<App userName="{{Auth::user()->name}}"></App>
@endsection
