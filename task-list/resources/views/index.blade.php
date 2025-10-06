<h1>Tasks List</h1>
<div>
    {{-- @if(count($tasks))
    <div>
        There are tasks!
    </div>
    @else
    <div>
        There are no tasks!
    </div>
    @endif --}}

    @forelse($tasks as $task)
    <div>
        <a href="{{ route('tasks.show', ['id' => $task -> id])}}">
            {{$task -> title}}
        </a>
    </div>
    @empty
    <div>There are no tasks!</div>
    @endforelse
</div>
