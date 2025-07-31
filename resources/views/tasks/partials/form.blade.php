<form method="POST" id="create-task-form" action="{{ $route }}">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <div class="mb-3">
        <label class="form-label">Nazwa</label>
        <input type="text" name="title" class="form-control" value="{{ old('name', $task->title) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Opis</label>
        <textarea name="description" class="form-control">{{ old('description', $task->description) }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Priorytet</label>
        <select name="priority" class="form-select">
            <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Niski</option>
            <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Średni</option>
            <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>Wysoki</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="to-do" {{ old('status', $task->status) == 'to-do' ? 'selected' : '' }}>Do zrobienia</option>
            <option value="in-progress" {{ old('status', $task->status) == 'in-progress' ? 'selected' : '' }}>W trakcie</option>
            <option value="done" {{ old('status', $task->status) == 'done' ? 'selected' : '' }}>Zrobione</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Termin</label>
        <input type="date" name="due_date" class="form-control" value="{{ old('due_date', $task->due_date) }}" required>
    </div>

    <button class="btn btn-success">Zapisz</button>
</form>
