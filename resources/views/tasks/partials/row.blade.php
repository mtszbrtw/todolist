<tr id="task-row-{{ $task->id }}">
    <td>{{ $task->title }}</td>
    <td>{{ ucfirst($task->priority) }}</td>
    <td>{{ ucfirst($task->status) }}</td>
    <td>{{ $task->due_date }}</td>
    <td>
        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning edit-task-btn" data-id="{{ $task->id }}">Edytuj</a>
        <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="d-inline">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger" onclick="return confirm('Na pewno?')">Usuń</button>
        </form>
        <form method="POST" action="{{ route('tasks.share', $task) }}" class="d-inline">
            @csrf
            <button class="btn btn-sm btn-info">Udostępnij</button>
        </form>
    </td>
</tr>