<form id="register-form" method="POST" action="{{ route('register') }}">
    <div class="error-container"></div>
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Imię</label>
        <input type="text" name="name" id="name" class="form-control" required autofocus>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Adres e-mail</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Hasło</label>
        <input type="password" name="password" id="password" class="form-control" required autocomplete="new-password">
    </div>
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Potwierdź hasło</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required autocomplete="new-password">
    </div>
    <button type="submit" class="btn btn-primary w-100">Zarejestruj się</button>
</form>
