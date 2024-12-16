@extends('layouts.app')
<style>
    .completed {
        text-decoration: line-through;
        color: gray;
    }
</style>

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-5">To-Do List of {{ Auth::user()->name }}</h1>

    <!-- Add Task Form -->
    <form action="{{ route('tasks.store') }}" method="POST" class="mb-5">
        @csrf
        <div class="flex items-center">
            <input 
                type="text" 
                name="name" 
                placeholder="New Task" 
                required 
                class="flex-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
            <button class="inline-flex items-center justify-center mr-2 text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800" type="submit">
              <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>Add Task
            </button>
            
        </div>
    </form>
        

    <!-- Task List -->
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2 text-left">Completed</th>
                <th class="border border-gray-300 px-4 py-2 text-left">To-Do</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr class="bg-white border border-gray-300">
                    <!-- Checkbox Column -->
                    <td class="px-4 py-2">
                        <form action="/tasks/{{ $task->id }}/toggle" method="POST">
                            @csrf
                            @method('PATCH')
                            <input 
                                type="checkbox" 
                                name="completed" 
                                onChange="this.form.submit()" 
                                {{ $task->completed ? 'checked' : '' }}
                            >
                        </form>
                    </td>
                    <!-- To-Do Column -->
                    <td class="border border-gray-400 px-4 py-2">
                        <span class="{{ $task->completed ? 'completed' : '' }}">
                            {{ $task->name }}
                        </span>
                    </td>

                    <!-- Actions Column -->
                    <td class="px-4 py-2">
                        <form action="/tasks/{{ $task->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection