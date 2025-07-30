$(function () {
    $('#openAuthModal').on('click', function () {
        $('#authModal').fadeIn();
        loadForm('login');
    });

    $(document).on('click', '#showRegister', function (e) {
        e.preventDefault();
        loadForm('register');
    });

    $(document).on('click', '#showLogin', function (e) {
        e.preventDefault();
        loadForm('login');
    });

    $(document).on('click', '#showLoginFromReset', function (e) {
        e.preventDefault();
        loadForm('login');
    });

    $(document).on('click', '#showReset', function (e) {
        e.preventDefault();
        loadForm('reset');
    });

    function loadForm(view) {
        $.get(`/auth/view/${view}`, function (html) {
            $('#authForms').html(html);
        });
    }

    $('#authForms').on('submit', '#loginForm', function (e) {
        e.preventDefault();
        $.post('/login', $(this).serialize(), function () {
            location.reload();
        }).fail(function (xhr) {
            alert('Błąd logowania');
        });
    });

    $('#authForms').on('submit', '#registerForm', function (e) {
        e.preventDefault();
        $.post('/register', $(this).serialize(), function () {
            location.reload();
        }).fail(function (xhr) {
            alert('Błąd rejestracji');
        });
    });

    $('#authForms').on('submit', '#resetForm', function (e) {
        e.preventDefault();
        $.post('/forgot-password', $(this).serialize(), function () {
            alert('Wysłano link resetujący');
        }).fail(function () {
            alert('Błąd wysyłania');
        });
    });
});
