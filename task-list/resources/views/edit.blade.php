@extends('layouts.app')

@section('content')
{{-- Sub View --}}
@include('form', ['task' => $task])

@endsection