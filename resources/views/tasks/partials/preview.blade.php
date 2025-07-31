<div class="p-3">
    <h5>{{ $task->title }}</h5>
    <p class="text-muted">{{ $task->description ?? 'Brak opisu' }}</p>
    <ul class="list-unstyled">
        <li><strong>Status:</strong> {{ ucfirst($task->status) }}</li>
        <li><strong>Priorytet:</strong> {{ ucfirst($task->priority) }}</li>
        <li><strong>Termin:</strong> {{ $task->due_date }}</li>
    </ul>

    <div class="mt-3 d-flex gap-2">
        <button class="btn btn-sm btn-warning edit-task-btn"
            data-edit-url="{{ route('tasks.edit', $task) }}">Edytuj</button>

        <button class="btn btn-sm btn-danger delete-task-btn"
            data-id="{{ $task->id }}"
            data-url="{{ route('tasks.destroy', $task) }}">Usuń</button>

        <button class="btn btn-sm btn-info share-task-btn"
            data-url="{{ route('tasks.share', $task) }}"
            data-id="{{ $task->id }}">Udostępnij</button>
    </div>
</div>