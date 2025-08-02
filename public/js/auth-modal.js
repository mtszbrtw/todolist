$(document).ready(function () {
  
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    let modal = new bootstrap.Modal($('#authModal'));

    $('#open-auth').on('click', function () {
        $('#auth-forms').load('/auth/partial/login', function () {
            attachLoginHandler();
        });
        $('#authModalLabel').text('Logowanie');
        $('#toggle-links').html(`Nie masz konta? <a href="#" id="show-register">Zarejestruj się!</a>`);
        modal.show();
    });

    $(document).on('click', '[id^=show-]', function (e) {
        e.preventDefault();
        console.log('Kliknięto link:', this.id);

        if (this.id === 'show-register') {
            $('#auth-forms').load('/auth/partial/register', function () {
                attachRegisterHandler();
            });
            $('#authModalLabel').text('Rejestracja');
            $('#toggle-links').html(`Masz konto? <a href="#" id="show-login">Zaloguj się!</a>`);
        } else if (this.id === 'show-login') {
            $('#auth-forms').load('/auth/partial/login', function () {
                attachLoginHandler();
            });
            $('#authModalLabel').text('Logowanie');
            $('#toggle-links').html(`Nie masz konta? <a href="#" id="show-register">Zarejestruj się!</a>`);
        } else if (this.id === 'show-reset') {
            $('#auth-forms').load('/auth/partial/reset', function () {
                attachResetHandler();
            });
            $('#authModalLabel').text('Resetowanie hasła');
            $('#toggle-links').html(`<a href="#" id="show-login">Powrót do logowania</a>`);
        }
    });

    function attachLoginHandler() {
        $('#login-form').on('submit', function (e) {
            e.preventDefault();
            const $form = $(this);
            const formData = $form.serialize();

            $.ajax({
                url: '/login',
                method: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function () {
                    location.reload();
                },
                error: function (xhr) {
                    let html = '<div class="text-danger text-sm mb-2">';
                    if (xhr.status === 422 && xhr.responseJSON.errors) {
                        $.each(xhr.responseJSON.errors, function (key, messages) {
                            html += messages[0] + '<br>';
                        });
                    } else {
                        html += 'Wystąpił błąd. Spróbuj ponownie.';
                    }
                    html += '</div>';
                    $form.find('.error-container').html(html);
                }
            });
        });
    }

   function attachRegisterHandler() {
        $('#register-form').on('submit', function (e) {
            e.preventDefault();
            const $form = $(this);
            const formData = $form.serialize();

            $.ajax({
                url: '/register',
                method: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function () {
                    // Po rejestracji możesz np. przeładować stronę lub automatycznie zalogować użytkownika
                    location.reload();
                },
                error: function (xhr) {
                    let html = '<div class="text-danger text-sm mb-2">';
                    if (xhr.status === 422 && xhr.responseJSON.errors) {
                        $.each(xhr.responseJSON.errors, function (key, messages) {
                            html += messages[0] + '<br>';
                        });
                    } else {
                        html += 'Wystąpił błąd. Spróbuj ponownie.';
                    }
                    html += '</div>';
                    $form.find('.error-container').html(html);
                }
            });
        });
    }


    function attachResetHandler() {
        $('#reset-form').on('submit', function (e) {
            e.preventDefault();
            const $form = $(this);
            const formData = $form.serialize();

            $.ajax({
                url: '/forgot-password',
                method: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function () {
                    $form.find('.error-container').html('<div class="text-success text-sm mb-2">Sprawdź swój e-mail — link został wysłany.</div>');
                    $form.trigger('reset');
                },
                error: function (xhr) {
                    let html = '<div class="text-danger text-sm mb-2">';
                    if (xhr.status === 422 && xhr.responseJSON.errors) {
                        $.each(xhr.responseJSON.errors, function (key, messages) {
                            html += messages[0] + '<br>';
                        });
                    } else {
                        html += 'Wystąpił błąd. Spróbuj ponownie.';
                    }
                    html += '</div>';
                    $form.find('.error-container').html(html);
                }
            });
        });
    }
});
