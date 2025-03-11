@extends('layouts.app')

@section('title', 'Hello I am a blade template / homepage')

@section('content')
    @forelse ($tasks as $task)
        <div>
            <a href="{{ route('tasks.show', ['task'=>$task->id]) }}">{{ $task->title }}</a>
        </div>
    @empty
        <div>There are not tasks!</div>
    @endforelse
@endsection

{{--
<div>
    @if (count($tasks))
        @foreach ($tasks as $task)
            <div>{{ $task->title }}</div>
        @endforeach
    @else
        <div>There are no tasks!</div>
    @endif
</div>
--}}

{{--
@isset($name)
    <div>The name is: {{ $name }}</div>
@endisset
--}}