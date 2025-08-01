<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo List by Mateusz Bartków</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">ToDo</a>
            <div class="ms-auto">
                <button class="btn btn-outline-primary" id="open-auth">Logowanie</button>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Witaj na stronie głównej</h1>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="authModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="authModalLabel">Logowanie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zamknij"></button>
                </div>
                <div class="modal-body">
                    <div id="auth-forms">
                        @include('auth.partials.login')
                    </div>
                </div>
                <div class="modal-footer">
                    <small id="toggle-links">
                        Nie masz konta? <a href="#" id="show-register">Zarejestruj się!</a>
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/auth-modal.js') }}"></script>
</body>
</html>
