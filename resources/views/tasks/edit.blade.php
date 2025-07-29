@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edytuj zadanie</h1>

    @include('tasks.partials.form', ['task' => $task, 'route' => route('tasks.update', $task), 'method' => 'PUT'])
</div>
@endsection
