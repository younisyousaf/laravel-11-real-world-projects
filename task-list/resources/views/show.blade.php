@extends('layouts.app')

@section('title', $task->title)

@section('content')

<div class="mb-4">
    <a class="link" href="{{ route('tasks.index') }}">
        &larr; Go back to the tasks list!
    </a>
</div>
{{-- <h1>{{ $task->title }}</h1> --}}
<p class="mb-4 text-slate-700 ">{{ $task->description }}</p>

@if ($task->long_description)
<p class="mb-4 text-slate-700 ">{{ $task->long_description }}</p>
@endif

<p class="mb-4 text-sm text-slate-700 ">
    Created {{ $task->created_at->diffForHumans() }}
    •
    Updated {{ $task->updated_at->diffForHumans()}}
</p>

<p>
    @if($task->completed)
    <span class="font-medium text-green-500">Completed</span>
    @else
    <span class="font-medium text-red-500">Not Completed</span>
    @endif
</p>

<div class="flex gap-2 ">
    <a href="{{ route('tasks.edit', ['task'=>$task->id]) }}" class="btn">Edit</a>

    <form method="POST" action="{{ route('tasks.toggle-complete',['task'=> $task]) }}">
        @csrf
        @method('put')
        <button type="submit" class="btn">Mark as {{ $task->completed ? 'not-completed' : 'completed' }}</button>
    </form>
    <form action="{{route('tasks.destroy',['task'=> $task->id])}}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn">Delete</button>
    </form>
</div>
@endsection