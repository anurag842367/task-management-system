
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 30px;
        }
        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }
        h1 { color: #26344a; }
        .add-btn {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th { background: #eef2ff; }
        .success { color: green; margin-bottom: 15px; }
        .actions { display: flex; gap: 8px; align-items: center; }
        .edit-btn { color: #2563eb; }
        .delete-btn { color: #dc2626; }
        button { cursor: pointer; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Task Management System</h1>
        <p>Manage your daily tasks easily.</p>

        @if (session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        <a href="/tasks/create" class="add-btn">+ Add New Task</a>

        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description ?? '-' }}</td>
                        <td>{{ $task->due_date?->format('d M Y') ?? '-' }}</td>
                        <td>{{ str_replace('_', ' ', ucfirst($task->status)) }}</td>
                        <td>
                            <div class="actions">
                                <a class="edit-btn"
                                   href="/tasks/{{ $task->id }}/edit">Edit</a>

                                <form action="/tasks/{{ $task->id }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete this task?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="delete-btn" type="submit">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No tasks found. Add your first task!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
