@if($tasks->isEmpty())
    <tr>
        <td colspan="5">
            <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
                <div class="text-center text-muted">
                    <h5 class="mb-2">Brak zadań w wybranych filtrach</h5>
                    <p>zmień je lub usuń ;)</p>
                </div>
            </div>
        </td>
    </tr>
@else

@foreach($tasks as $task)
    <tr class="task-main-row-{{ $task->id }}">
        <td>{{ $task->title }}</td>
        <td>{{ ucfirst($task->priority) }}</td>
        <td>{{ ucfirst($task->status) }}</td>
        <td>{{ $task->due_date }}</td>
        <td>
            <button class="btn btn-sm btn-warning edit-task-btn"
                data-edit-url="{{ route('tasks.edit', $task) }}">Edytuj</button>
            <button class="btn btn-sm btn-danger delete-task-btn" 
                data-id="{{ $task->id }}" 
                data-url="{{ route('tasks.destroy', $task) }}">Usuń</button>
            <button class="btn btn-sm btn-info share-task-btn"
                data-url="{{ route('tasks.share', $task) }}"
                data-id="{{ $task->id }}">Udostępnij</button>
        </td>
    </tr>
    <tr class="task-main-row-{{ $task->id }}"><td colspan="5"><div class="text-muted">{{ $task->description ?? 'Brak opisu' }}</div></td></tr>
    <tr class="task-main-row-{{ $task->id }}"><td colspan="5" style="height: 10px; padding: 0;"></td></tr>
@endforeach
@endif