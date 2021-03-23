![logo webstream](https://logo.webstream.dev/3/cover.png)

# [WebStream](https://www.webstream.dev/)
Streaming application/interface directly on frontend, without building backend side
+ jest modularnym standardem ładowania mediów na stronę  www, umożliwjaącym implementację streamowania poprzez protokół HTTP

+ [Hosted Projects - OpenJS Foundation](https://openjsf.org/projects/)

+ [Wapka, Softreck’s OpenSource Deployment Ecosystem - docs](https://docs.wapka.pl/)

+ [JavaScript End to End Testing Framework - cypress.io](https://www.cypress.io/)

## Current Technologies at 2021
+ Single Page Application (SPA)
+ Progressive Web App (PWA)
+ Application as a Stream (AaaS)
    + javascript    
    + native
    + json based communication
    
## AaaS - Application as a Stream

AaaS is supported by WebStream.

+ WebStream is an ecosystem for web-development

## How WebStream work's?

Load any media on website without reload page, now stream each website without reload.
Over modularity each website can talk to another without barrier...

### Supported media

Ładowanie mediów tekstowych, kodu aplikacji, filmów, głosu, itp.

+ html
+ txt
+ markdown
+ mp3
+ wav
+ js
+ php
+ python


# why?
Because we can improve our stack without clouds

[more about limitations of CLOUD](CLOUD.md)

# Powstanie

pierwsze kroki:
+ jLoads
+ WebStream


Projekt obecnie nazywa się WebStream, jest zbiorem kilku modularnych funkcji, pozwalających na wykorzystanie potencjału jaki leży w protokole http
i naturalnej predyspozycji jezyka JavaScript do prototypowania.


[Strona projektu WebStream](https://www.webstream.dev/)
## jLoads

Biblioteka jLoads była jednym z pierwszym implementacji podejścia modułowego w sofwtare developmencie, miała za zadanie załadowanie wszystkich potrzebnych mediów na stronę www.


w związku z rozwojem bilbioteki i modularyzacją samej biblioteki potrzebny był wspólny mianownik do połączenia narzędzi tworzących ekosystem do streamowania interface-ów aplikacji webowej.


Po wykonaniu prototypu jLoads udało się określić strukturę biblioteki w kontekście użycia, czyli zmodularyzować.

Wydzieliłem nawet biblioteki do ładowania, definicji JSON oraz do Ładowania i routowania mediów


# Moduły WebStream


+ letJson
+ jsondef
+ jBodys
+ jLoads
+ jRoutes



## [let json](https://www.letjson.com)
![let json](https://logo.letjson.com/1/cover.png)

### 

1. osobne callback-i do pozytywnego i negatywnego przypadku

        letJson( String  url, Function  success, Function  error)     

2. Metoda try - catch

        try{
            letJson( String  url, Function  json, Function  item)     
        }catch(){

        }
        
        


pobieranie pliku json z URL
możliwość kontroli procesu poprzez funkcję succes w przypadku poprawnego pobrania
oraz error, gdy plik nie istnieje, lub nie ma odpowiedniego formatu

### 1. użycie z adresem url, callback: success, error

    letJson(
        "get.domain.com/file.json",
        function(name, value, json) {

        },
        function(error) {

        }
    );

### 2. użycie z adresem url, bez callback do error, ale throw exception
     
    letJson(
        "get.domain.com/file.json",
        function(json) {

        },
        function(item) {

        }
    );



## [json def](https://www.jsondef.com)
![json def](https://logo.jsondef.com/2/cover.png)


+ jsonDef()
okreslanie oczekiwanej struktury oraz podłączenie każdego elementu JSON pod konrketną funkcję

### def.json
    
        {
            "xpath/name":"function1",
            "xpath/name":"function1"
            "xpath/name":"function1"
        }
        
### jsonDef(json, success, error)       

    jsonDef(
        "get.domain.com/def.json",
        function(name, value, json) {

        }
    );
    

### Pobranie definicji dla pliku JSON

    letJson(
        "get.domain.com/def.json",
        function(name, value, json) {
        letJson(
                "get.domain.com/file.json",
                function(name, value, json) {



                }
        )
    );
    





## [jBodys](https://www.jbodys.com)
![jBodys](https://logo.jbodys.com/2/cover.png)


+ jBodys()

Definicja moułu, poprzez określenie zalezności ładowania 
W anstaepnej wersji również określanie wersji


      {
        "/form/field/text.css",
        "/form/field/email.css",
        "/form/field/submit.css",
        "newsletter.html": [
            "submit.js"
        ]
      }
      


## [jLoads](https://www.jloads.com)
![jLoads](https://logo.jloads.com/2/cover.png)

+ jLoads()

Działanie na drzewie DOM, ładowanie stron do konrketnych tagów przy ładowaniu strony
Ładowanie konkretnych zasobów/mediów poprz ich adres url do formatu wyświetlanego w HTML bez okreslenia miejsca gdzie ma być załadowane,
pliki będą tylko definiowały same zależnosci:


## [jRoutes](https://www.jroutes.com)
![jRoutes](https://logo.jroutes.com/2/cover.png)


+ jRoutes()
pipelines (event, from, to) definicja miejsc, gdzie i co ma być z czym połączone z jLoads na HTML



## [jPaths](https://www.jpaths.com)
![jRoutes](https://logo.jpaths.com/2/cover.png)

+ jPaths()

routing dla url
+ praca z adresami url
+ event listener




## [jRuns](https://www.jruns.com)
![jRoutes](https://logo.jruns.com/2/cover.png)
+ jRuns()

devops part
+ deployment
+ monitoring




## Ekosystem do streamowania

Poniższe funkcje pozwalają na implementację tych rozwiazań w kilku językach programowania

## Funkcja

+ letJson
+ jsondef
+ jBodys
+ jLoads
+ jRoutes

## język programowania:

#### JavaScript
+ domena: js.[funkcja].com

#### PHP
+ domena: php.[funkcja].com

#### Python
+ domena: py.[funkcja].com



# Modularyzacja
[Modularyzacja przy wytwarzaniu oprogramowania.](https://www.hipermodularyzacja.pl/)

## Ogólne Dane

### Logo
+ logo.[funkcja].com

### Dokumentacja
+ docs.[funkcja].com


## per Moduł

### Pobranie, paczka
+ get.[język].[funkcja].com

### Edycja, repozytorium git
+ git.[język].[funkcja].com



# Examples

![hypermodularity](hypermodularity.png)

## Tworzenie aplikacji offline poprzez karty (NFC)
![kids_cards](kids_cards.png)
It works online but You can create it offline, by NFC cards with your handy, without any application.

## Przykładowa aplikacja

sczytujemy kolejno karty od góry do dołu poprzez czytnik NFC (poprzez smartfon'a) i kolejno są otwierane adresy, które są identyfikowane jako kolejne elementy (identyfikacja adresu IP), równocześnie powstaje strona www oparta o te moduły. Lista modułów jest zapisana w JSON, ładowane są za pomocą rozwiązania WebStream .dev , wcześniej biblioteka jLoads, teraz kilka modularnych funkcji docelowo na kilka jezyków, dzięki czemu nie będzie problemu z implementacją w python, php, itd

![modules](modules.png)


## Więcej info

###  Web Monetization
Z pomocą Web Monetization API będziemy w stanie zarabiać pieniądze bezpośrednio i natychmiastowo - bez poświęcania wrażliwych danych użytkowników, i na dobre pozbyć się reklam. Najlepsze jest to, że nowe API już teraz działa w przeglądarce!

### FaaS
Forge to FaaS od Atlassiana do tworzenia rozszerzeń do Jiry czy Confluence. Spoiler alert - kod JavaScript który jest tam uruchamiany również działa w sandbox'ie.

Podczas tej prezentacji przyjrzymy się na przykładzie Forge'a jak możemy stworzyć bezpieczny sandbox w V8.


