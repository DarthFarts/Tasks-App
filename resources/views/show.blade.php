@extends('layouts.layout')

@section('title', $task->title)

@section('content')



<p class="mb-4 text-white">{{$task->description}}</p>

@if($task->long_description)
    <p class="mb-4 text-white">{{$task->long_description}}</p>
@endif

<p class="mb-4 text-sm text-slate-400">Created {{$task->created_at->diffForHumans()}} • Updated {{$task->updated_at->diffForHumans()}}</p>


<p class="mb-4">
    @if ($task->completed)
        <span class="font-medium text-green-500">Completed</span>
    @else
        <span class="font-medium text-red-500">Not Completed</span>
    @endif
</p>

<div class="flex gap-2">
    <a href="{{route('tasks.edit', ['task' => $task])}}" class="btn">Edit</a>

    <form method="POST" action="{{route('tasks.toggle-complete', ['task' => $task])}}">
        @csrf
        @method('PUT')
        <button type="submit" class="btn">
            Mark as {{$task->completed ? 'not completed' : 'completed'}} 
        </button>
    </form>

    <form action="{{route('tasks.destroy', ['task' => $task])}}", method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class = "btn">Delete</button>
    </form>

    <div class="btn">
        <a  href="{{route('tasks.index')}}">Back</a>
    </div>

</div>
@endsection