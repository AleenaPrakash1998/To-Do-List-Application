@extends('layouts.master')
@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <h1 class="mb-0 fw-semibold fs-5">Share your task</h1>
            <p class="card-text pt-2">
                Define your project&#39;s new look. Easily set up a new task with our intuitive
                customization tool.
            </p>
        </div>
    </div>
        <h1 class="mb-3 fw-semibold fs-5">Share Task: {{ $task->title }}</h1>
        <form method="POST" action="{{ route('tasks.shareTask', $task->id) }}">
            @csrf
            <div class="mb-3">
                <label for="user_id" class="form-label">Select User to Share With</label>
                <div class="mb-3">
                <select class="form-control" name="user_id" id="user_id">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                </div>
            </div>
            <div class="mb-3">
            <button type="submit" class="btn btn-primary">Share Task</button>
            </div>
        </form>
@endsection
