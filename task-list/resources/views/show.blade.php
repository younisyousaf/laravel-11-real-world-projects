@extends('layouts.app')

@section('title', $task->title)

@section('content')

<div class="mb-4">
    <a class="font-medium text-gray-700 underline decoration-pink-500" href="{{ route('tasks.index') }}">
        &larr; Go back to the tasks list!
    </a>
</div>
{{-- <h1>{{ $task->title }}</h1> --}}
<p class="mb-4 text-slate-700 ">{{ $task->description }}</p>

@if ($task->long_description)
<p class="mb-4 text-slate-700 ">{{ $task->long_description }}</p>
@endif

<p class="mb-4 text-slate-700 ">{{ $task->created_at }} • {{ $task->updated_at }}</p>

<p>
    @if($task->completed)
    Completed
    @else
    Not Completed
    @endif
</p>

<div>
    <a href="{{ route('tasks.edit', ['task'=>$task->id]) }}"></a>
</div>

<div>
    <form method="POST" action="{{ route('tasks.toggle-complete',['task'=> $task]) }}">
        @csrf
        @method('put')
        <button type="submit">Mark as {{ $task->completed ? 'not-completed' : 'completed' }}</button>
    </form>
</div>

<div>
    <form action="{{route('tasks.destroy',['task'=> $task->id])}}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
</div>
@endsection