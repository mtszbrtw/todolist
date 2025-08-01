@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Moje zadania</h1>

    <button type="button" class="btn btn-primary mb-3" id="add-task-btn">Dodaj zadanie</button>

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

    <div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Nazwa</th>
                <th>Priorytet</th>
                <th>Status</th>
                <th>Termin</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody id="tasks-table">
            @foreach($tasks as $task)
                <tr class="task-row-{{ $task->id }}">
                    <td>{{ $task->title }}</td>
                    <td>{{ ucfirst($task->priority) }}</td>
                    <td>{{ ucfirst($task->status) }}</td>
                    <td>{{ $task->due_date }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning edit-task-btn"
                        data-edit-url="{{ route('tasks.edit', $task)
                        }}">Edytuj</button>
                        <button 
    class="btn btn-sm btn-danger delete-task-btn" 
    data-id="{{ $task->id }}" 
    data-url="{{ route('tasks.destroy', $task) }}">
    Usuń
                        </button>
                        <button class="btn btn-sm btn-info share-task-btn"
        data-url="{{ route('tasks.share', $task) }}"
        data-id="{{ $task->id }}">
    Udostępnij
                        </button>
                    </td>
                </tr>
        
    <tr class="task-row-{{ $task->id }}">
        <td colspan="5">
            <div class="text-muted">{{ $task->description ?? 'Brak opisu' }}</div>
        </td>
    </tr>
    <tr class="task-row-{{ $task->id }}">
        <td colspan="5" style="height: 10px; padding: 0;"></td>
    </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="taskModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Zadanie</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="taskModalBody">Ładowanie...</div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteTaskModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Potwierdź usunięcie</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Czy na pewno chcesz usunąć to zadanie?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
        <button type="button" class="btn btn-danger" id="confirm-delete-btn">Tak, usuń</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Udostępniania -->
<div class="modal fade" id="shareTaskModal" tabindex="-1" aria-labelledby="shareTaskModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="shareTaskModalLabel">Udostępnij zadanie</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zamknij"></button>
      </div>
      <div class="modal-body">
        <div class="input-group">
          <input type="text" class="form-control" id="shareLinkInput" readonly>
          <button class="btn btn-outline-secondary" id="copyLinkBtn">Kopiuj</button>
        </div>
        <small class="text-muted mt-2 d-block">Link wygaśnie za 24 godziny.</small>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const taskModalEl = document.getElementById('taskModal');
    const taskModal = new bootstrap.Modal(taskModalEl);

    // Obsługa kliknięcia "Dodaj zadanie"
    $(document).on('click', '#add-task-btn', function (e) {
        e.preventDefault();
        $.get('{{ route('tasks.create') }}', function (html) {
            $('#taskModalBody').html(html);
            taskModal.show();
        });
    });

    // Obsługa kliknięcia "Edytuj"
    $(document).on('click', '.edit-task-btn', function (e) {
        e.preventDefault();
        const url = $(this).data('edit-url');
        $.get(url, function (html) {
            $('#taskModalBody').html(html);
            taskModal.show();
        });
    });

    // Obsługa wysyłki formularza (dodawanie lub edycja) AJAX
    $(document).on('submit', '#create-task-form, #edit-task-form', function (e) {
        e.preventDefault();
        let form = $(this);
        let url = form.attr('action');
        let method = form.find('input[name="_method"]').val() || 'POST';
        let data = form.serialize();

        $.ajax({
            url: url,
            type: method,
            data: data,
            success: function () {
                taskModal.hide();
                showToast('Zadanie zapisane!');
                refreshTasksTable();
            },
            error: function (xhr) {
                let errors = xhr.responseJSON.errors;
                let html = '';
                for (let field in errors) {
                    html += `<div class="alert alert-danger">${errors[field][0]}</div>`;
                }
                $('#taskModalBody').prepend(html);
            }
        });
    });

    function refreshTasksTable() {
        $.get(window.location.href, function (html) {
            const newTable = $(html).find('#tasks-table').html();
            $('#tasks-table').html(newTable);
        });
    }

    function showToast(message) {
        let toast = $(`
            <div class="toast align-items-center text-bg-success border-0
            position-fixed top-0 start-50 translate-middle-x mt-3" role="alert"
            aria-live="assertive" aria-atomic="true" style="z-index:1055;">
                <div class="d-flex">
                    <div class="toast-body">${message}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        `);
        $('body').append(toast);
        const bsToast = new bootstrap.Toast(toast[0]);
        bsToast.show();
        setTimeout(() => toast.remove(), 3000);
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteTaskModal'));
    let deleteUrl = '';
    let taskId = null;

    // Kliknięcie "Usuń" (otwiera modal)
    $(document).on('click', '.delete-task-btn', function () {
        deleteUrl = $(this).data('url');
        taskId = $(this).data('id');
        deleteModal.show();
    });

    // Kliknięcie "Tak, usuń" w modalu
    $('#confirm-delete-btn').on('click', function () {
        $.ajax({
            url: deleteUrl,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'DELETE'
            },
            success: function () {
                deleteModal.hide();

                // Usuń element z listy (DOM)
                $('.task-row-' + taskId).remove();

                // Powiadomienie
                const alert = $(`
                    <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3" role="alert" style="z-index: 9999; min-width: 300px;">
                        Zadanie usunięte!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `);
                $('body').append(alert);
                setTimeout(() => alert.alert('close'), 3000);
            },
            error: function () {
                alert('Wystąpił błąd przy usuwaniu zadania.');
            }
        });
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const shareModal = new bootstrap.Modal(document.getElementById('shareTaskModal'));
    const shareInput = document.getElementById('shareLinkInput');

    $(document).on('click', '.share-task-btn', function () {
        const url = $(this).data('url');

        $.post(url, {
            _token: '{{ csrf_token() }}'
        })
        .done(function (res) {
            if (res.link) {
                shareInput.value = res.link;
                shareModal.show();
            } else {
                alert('Nie udało się wygenerować linku.');
            }
        })
        .fail(function () {
            alert('Wystąpił błąd przy generowaniu linku.');
        });
    });

    $('#copyLinkBtn').on('click', function () {
        shareInput.select();
        document.execCommand('copy');

        const alert = $(`
            <div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3" role="alert" style="z-index: 9999; min-width: 300px;">
                Skopiowano link!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Zamknij"></button>
            </div>
        `);
        $('body').append(alert);
        setTimeout(() => alert.alert('close'), 3000);
    });
});
</script>
@endsection