@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Moje zadania</h1>

    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Dodaj zadanie</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('share_link'))
    <div>Share link: {{ session('share_link') }}</div>
@endif

    <form method="GET" class="mb-3 row g-2">
        <div class="col">
            <select name="priority" class="form-select">
                <option value="">Wszystkie priorytety</option>
                <option value="low">Niski</option>
                <option value="medium">Średni</option>
                <option value="high">Wysoki</option>
            </select>
        </div>
        <div class="col">
            <select name="status" class="form-select">
                <option value="">Wszystkie statusy</option>
                <option value="to-do">Do zrobienia</option>
                <option value="in-progress">W trakcie</option>
                <option value="done">Zrobione</option>
            </select>
        </div>
        <div class="col">
            <input type="date" name="due_date" class="form-control">
        </div>
        <div class="col">
            <button class="btn btn-secondary">Filtruj</button>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Nazwa</th>
                <th>Priorytet</th>
                <th>Status</th>
                <th>Termin</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ ucfirst($task->priority) }}</td>
                    <td>{{ ucfirst($task->status) }}</td>
                    <td>{{ $task->due_date }}</td>
                    <td>
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">Edytuj</a>
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
            @endforeach
        </tbody>
    </table>
</div>
@endsection
