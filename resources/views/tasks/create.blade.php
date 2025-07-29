@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dodaj zadanie</h1>

    @include('tasks.partials.form', ['task' => new \App\Models\Task(), 'route' => route('tasks.store'), 'method' => 'POST'])
</div>
@endsection
