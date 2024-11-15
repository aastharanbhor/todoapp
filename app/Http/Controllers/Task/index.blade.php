<!DOCTYPE html>
<html>
<head>
    <title>To-Do List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body class="bg-gray-100">

    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-5">To-Do List</h1>

        <!-- Add Task Form -->
        <form action="/tasks" method="POST" class="mb-5">
            @csrf
            <input type="text" name="title" placeholder="New task" class="border rounded p-2 w-full" required>
            <button type="submit" class="mt-2 bg-blue-500 text-white rounded p-2">Add Task</button>
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
                        <span class="ml-2 {{ $task->completed ? 'line-through text-gray-500' : '' }}">{{ $task->title }}</span>
                    </form>

                    <!-- Delete Task Form -->
                    <form action="/tasks/{{ $task->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Delete</button>
                    </form>
                </li>
                
                 <li style="list-style-type: none;">
                  <!-- Form to toggle completion status when the checkbox is clicked -->
                    <form action="{{ route('tasks.toggleCompletion', $task->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PATCH')
                        <!-- Checkbox to mark task as completed or not -->
                        <input type="checkbox" name="completed" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                    </form>
                
                <!-- Display the task name with strikethrough if completed -->
                    <span style="{{ $task->completed ? 'text-decoration: line-through;' : '' }}">
                        {{ $task->name }}
                    </span>
                </li>
            @endforeach
        </ul>
    </div>

</body>
</html>
