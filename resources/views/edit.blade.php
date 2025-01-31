@extends('layouts.layout')

@section('content')
    @include('form', ['task'=> $task])
@endsection 