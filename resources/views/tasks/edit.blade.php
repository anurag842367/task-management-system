
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 30px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin: 8px 0 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            background: #2563eb;
            color: white;
            border: 0;
            padding: 11px 18px;
            border-radius: 5px;
            cursor: pointer;
        }
        .error { color: #dc2626; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Task</h1>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/tasks/{{ $task->id }}" method="POST">
            @csrf
            @method('PUT')

            <label for="title">Task Title</label>
            <input id="title" type="text" name="title"
                   value="{{ old('title', $task->title) }}" required>

            <label for="description">Description</label>
            <textarea id="description" name="description"
                      rows="4">{{ old('description', $task->description) }}</textarea>

            <label for="due_date">Due Date</label>
            <input id="due_date" type="date" name="due_date"
                   value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}">

            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>

            <button type="submit">Update Task</button>
        </form>

        <p><a href="/tasks">← Back to Task List</a></p>
    </div>
</body>
</html>
