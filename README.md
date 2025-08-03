
Polecam skorzystać z wersji demonstracyjnej aplikacji pod adresem:
👉 https://worktrip.pl/todolist

dane logowania 

email : demo@demo.pl
hasło : demo123

(Worktrip to moja autorska platforma – zbudowana praktycznie w całości na telefonie, w dużej mierze... w samochodzie, podczas dojazdów do pracy.)

Oczywiście kod źródłowy można znaleźć na GitHubie, ale demo jest już w pełni skonfigurowane i w 100% funkcjonalne – nie trzeba niczego pobierać, instalować ani uruchamiać lokalnie. Demo korzysta dokładnie z tych samych plików, które są dostępne w repozytorium.


---

Jeśli chcesz odpalić projekt lokalnie:

W katalogu projektu wykonaj:

composer install
npm install
npm run dev
php artisan migrate --seed

dane logowania 

email : demo@demo.pl
hasło : demo123

Aby ręcznie uruchomić wysyłkę powiadomień e-mail (np. przypomnienie o zadaniu z deadlinem na jutro):

php artisan schedule:run

Uwaga: nalezy stworzyć użytkownika z prawodłowym emailem na który chcemy
otwrzymać powiadomienie i użytkownik musi mieć dodane zadanie z terminem na jutro aby
powiadomienie się wysłało!

Powiadomienie e-mail wysyłane jest także automatycznie po rejestracji konta.


---

Konfiguracja .env

Aby linki z e-maili działały poprawnie:

APP_URL=http://localhost:8000

Aby komunikaty autoryzacyjne były po polsku:

APP_LOCALE=pl


---

Jak powstawała ta aplikacja?

Większość kodu napisałem... w samochodzie, na tylnym siedzeniu, podczas godzinnych dojazdów do pracy – i jeszcze po pracy, zwykle ok. 2h dziennie. Pracowałem głównie na telefonie (i trochę na Chromebooku z linuksowym trybem demo), więc miałem ograniczone zasoby i czas.

Żeby nie tracić godzin na rzeczy, które można było przyspieszyć, intensywnie korzystałem ze sztucznej inteligencji – ale o tym opowiem jeszcze więcej dalej. Mimo to każdy fragment kodu musiałem sam połączyć, dostosować i rozbudować – nic nie powstało „na gotowo”.


