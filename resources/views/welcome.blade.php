<!DOCTYPE html>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo list by Mateusz Bartków</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        footer a {
            color: white;
            margin: 0 10px;
            font-size: 1.5rem;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

    <!-- TWÓJ NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 40px;">
            <div class="ms-auto">
                <button class="btn btn-outline-primary" id="open-auth">Logowanie</button>
            </div>
        </div>
    </nav>

    <!-- HEADER / HERO -->
    <header class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1 class="display-4">Todo list by Mateusz Bartków</h1>
            
            <p>Dane logowania do uzupełnionego konta: </p>
            
            <b>
email : demo@demo.pl</br>
hasło : demo123 </b>
            
            <p class="lead">
                Polecam skorzystać z demo pod adresem
                <b><a
                style="color:white"href="https://worktrip.pl/todolist">https://worktrip.pl/todolist</a></b>
                </br>(Worktrip to również moja autorska platforma, którą stworzyłem
                niemal w całości, korzystając tylko z telefonu – w dużej części
                w samochodzie, podczas dojazdów do pracy).  </br>
                          <p><b>Na telefonie tez fajnie wygląda ;)</b></p>
               </br> Oczywiście warto również zerknąć na pliki dostępne na GitHubie, ale demo jest już w pełni skonfigurowane i gotowe do użycia – nie trzeba nic pobierać ani uruchamiać lokalnie. Co ważne, demo korzysta dokładnie z tych samych plików, które znajdziesz w repozytorium.
            </p>

        </div>
    </header>

    <!-- O NAS -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <p>
                        To aplikacja, która jest już w dużej mierze funkcjonalna – choć nadal wiele można dodać i poprawić.  </br>
                        Najważniejsze jest to, że działa bardzo dobrze i płynnie – na całej stronie występuje tylko kilka przeładowań (głównie podczas autoryzacji), natomiast sama aplikacja działa w pełni w oparciu o AJAX.  </br>
                        Większość kodu napisałem na telefonie (udało mi się tam uruchomić Laravela), a częściowo na Chromebooku w trybie demo Linuksa. To dość słabe sprzęty, więc musiałem zrezygnować z Dockera i skupiłem się na funkcjonalności i wyglądzie.  
                        Dużą pomocą była dla mnie sztuczna inteligencja. Jasne – poradziłbym sobie bez niej, ale zajęłoby mi to znacznie więcej czasu. I tak musiałbym korzystać z forów, wyszukiwarek, poradników czy filmów (jak każdy). AI pozwalało mi działać szybciej, mając wszystko w jednym miejscu.  
                        Oczywiście AI nie wygenerowała za mnie całej aplikacji – dostarczała tylko fragmenty, które musiałem edytować, połączyć w całość i dostosować do własnych potrzeb.  
                        Moim zdaniem nie chodzi o to, by wiedzieć wszystko i być chodzącą encyklopedią, tylko by wiedzieć wystarczająco dużo, potrafić szukać informacji, wykorzystywać dostępne źródła i łączyć elementy w działającą całość.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- HEADER / HERO -->
    <header class="bg-primary text-white text-center py-5">
        <div class="container">
            <p class="lead">
                Kilka słów o tym, jak powstawała ta strona:  
                Tworzyłem ją głównie na telefonie, podczas codziennych dojazdów do pracy – kodując na tylnym siedzeniu auta (a dojazd w jedną stronę trwa u mnie godzinę).  </br>
                Po pracy poświęcałem na nią około 2 godzin dziennie. Czasu nie miałem zbyt wiele, dlatego intensywnie korzystałem ze sztucznej inteligencji, by usprawnić i przyspieszyć pracę.
            </p>
        </div>
    </header>

    <!-- CENNIK / OFERTA -->
    <section class="bg-light py-5">
        <div class="container">
            <div class="row text-center">
                @foreach ([
                    ['title' => 'Darmowy', 'desc' => 'Podstawowe funkcje', 'price' => '0 zł'],
                    ['title' => 'Standard', 'desc' => 'Więcej możliwości i wsparcie', 'price' => '49 zł'],
                    ['title' => 'Premium', 'desc' => 'Pełen pakiet + priorytet', 'price' => '99 zł']
                ] as $plan)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $plan['title'] }}</h5>
                            <p class="card-text">{{ $plan['desc'] }}</p>
                            <h3>{{ $plan['price'] }}</h3>
                            <a href="#" class="btn btn-outline-primary mt-3">Wybierz</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- OPINIE -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                @foreach ([1, 2, 3] as $i)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border shadow-sm">
                        <div class="card-body">
                            <p class="card-text">„Świetna aplikacja! Dzięki niej ogarnąłem w końcu swoją pracę i czas wolny.”</p>
                            <h6 class="card-subtitle text-muted">Jan Kowalski</h6>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="bg-light py-5">
        <div class="container">
            <div class="accordion" id="faqAccordion">
                @foreach ([
                    ['q' => 'Czy aplikacja jest darmowa?', 'a' => 'Tak, podstawowa wersja jest całkowicie darmowa.'],
                    ['q' => 'Czy mogę korzystać na telefonie?', 'a' => 'Tak, aplikacja działa na wszystkich urządzeniach.'],
                    ['q' => 'Czy mogę anulować plan?', 'a' => 'Oczywiście. Możesz anulować w dowolnym momencie.']
                ] as $index => $faq)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $index }}">
                        <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}">
                            {{ $faq['q'] }}
                        </button>
                    </h2>
                    <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">{{ $faq['a'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- KONTAKT -->
    <section class="py-5">
        <div class="container">
            <form class="mx-auto" style="max-width: 600px;">
                <div class="mb-3">
                    <label class="form-label">Imię</label>
                    <input type="text" class="form-control" placeholder="Twoje imię">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="Twój email">
                </div>
                <div class="mb-3">
                    <label class="form-label">Wiadomość</label>
                    <textarea class="form-control" rows="4" placeholder="Napisz wiadomość..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Wyślij</button>
            </form>
        </div>
    </section>

    <!-- STOPKA -->
    <footer class="bg-dark text-white text-center py-4">
        <div class="container">
            <p class="mb-2">© 2025 Twoja Firma. Wszelkie prawa zastrzeżone.</p>
            <div>
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-twitter"></i></a>
                <a href="#"><i class="bi bi-youtube"></i></a>
            </div>
        </div>
    </footer>

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