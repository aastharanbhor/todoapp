<!DOCTYPE html>
<html>
<head>
    <title>To-Do List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body class="bg-gray-100">
@extends('layouts.app')
@section('content')
    <div class="container mx-auto mt-1">
        <h1 class="text-2xl font-bold mb-5">To-Do List of {{ Auth::user()->name }}</h1>

        <!-- Add Task Form -->
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="New Task" required>
            <button class="inline-flex items-center justify-center mr-2 text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800" type="submit">
              <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>Add Task
            </button>
        </form>

        <!-- Task List -->
        <ul>
            @foreach ($tasks as $task)
                <li class="flex justify-between items-center mb-2">
                    <!-- Update Task Form -->
                    <form action="/tasks/{{ $task->id }}" method="POST" class="flex items-center">
                        @csrf
                        @method('PUT')
                        <input type="checkbox" name="completed" onChange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                        <span class="ml-2 {{ $task->completed ? 'line-through text-gray-500' : '' }}">{{ $task->name }}</span>
                    </form>

                    <!-- Delete Task Form -->
                    <form action="/tasks/{{ $task->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
    @endsection

</body>
</html>
