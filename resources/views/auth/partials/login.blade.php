<form id="login-form">
    <div class="error-container mb-2"></div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Hasło</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" name="remember" class="form-check-input" id="remember">
        <label class="form-check-label" for="remember">Zapamiętaj mnie</label>
    </div>

    <div class="d-grid">
        <button type="submit" class="btn btn-primary">Zaloguj się</button>
    </div>

    <div class="mt-3 text-center">
        <a href="#" id="show-reset">Zapomniałeś hasła?</a>
    </div>
</form>
