@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Zadanie publiczne</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $task->name }}</h5>
            <p class="card-text">{{ $task->description }}</p>
            <p><strong>Priorytet:</strong> {{ ucfirst($task->priority) }}</p>
            <p><strong>Status:</strong> {{ ucfirst($task->status) }}</p>
            <p><strong>Termin:</strong> {{ $task->due_date }}</p>
        </div>
    </div>
</div>
@endsection
