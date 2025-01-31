@extends('layouts.layout')

@section('title', 'List of tasks') 

@section('content')





    @forelse($tasks as $task)
        <nav class="mb-1 text-white">
            <a href="{{ route('tasks.show', ['task' => $task->id]) }}" @class(['line-through' => $task->completed])>{{$task->title}}</a>
        </nav>
    @empty
        <div>There are no tasks</div>
    @endforelse 

    @if ($tasks->count())
        <nav class="mt-4">
            {{$tasks->links()}}
        </nav>
    @endif

    <div class="btn mt-4">
        <a href="{{route('tasks.create')}}">ADD TASK</a>
    </div>

@endsection

