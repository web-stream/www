![logo webstream](https://logo.webstream.dev/3/cover.png)

<img alt="open collective badge" src="https://opencollective.com/webstream/tiers/backer/badge.svg?label=backer&color=brightgreen" />
<img alt="open collective badge" src="https://opencollective.com/webstream/tiers/sponsor/badge.svg?label=sponsor&color=brightgreen" />
<object type="image/svg+xml" data="https://opencollective.com/webstream/tiers/backer.svg?avatarHeight=36&width=600"></object>

---

# [WebStream](https://www.webstream.dev/)
Streaming application/interface directly on frontend, without building backend side
is part of [wapka ecosystem](https://docs.wapka.pl/) to build Application based on PaaS infrastructure


+ jest modularnym standardem ładowania mediów na stronę  www, umożliwiającym implementację streamowania poprzez protokół HTTP

+ [Hosted Projects - OpenJS Foundation](https://openjsf.org/projects/)

+ [Wapka, Softreck’s OpenSource Deployment Ecosystem - docs](https://docs.wapka.pl/)

+ [JavaScript End to End Testing Framework - cypress.io](https://www.cypress.io/)

# microfrontend.org
+ [www.microfrontend.org](https://www.microfrontend.org/)  
  
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



### Rozwiązania
    
pobieranie pliku json z URL możliwość kontroli procesu poprzez funkcję succes w przypadku poprawnego pobrania oraz error, gdy plik nie istnieje, lub nie ma odpowiedniego formatu

#### Osobne callback-i do pozytywnego i negatywnego przypadku

```php 
letJson( String  url, Function  success, Function  error)     
```

#### Metoda try - catch, bez callback, do error
    
```php
try{
    letJson( String  url, Function  json, Function  item)     
}catch(){

}
```   

### Przykłady użycia

#### 1. użycie z adresem url, callback: success, error
    
```js
letJson(
    "get.domain.com/file.json",
    function(name, value, json) {

    },
    function(error) {

    }
);
```
    
#### 2. użycie z adresem url, bez callback do error, ale throw exception
    
```js
letJson(
    "get.domain.com/file.json",
    function(json) {
        // zwraca całość pliku JSON
    },
    function(item) {
        // zwraca każdorazowo element lub parę klucz, wartość
    }
);
```

#### 3. użycie z adresem url, oddzielne parametry jako funkcje, 

+ zwiększa przejrzystosć kodu, 
+ pozwala na łatwą rozbudowę

##### asynchronicznie

```js
letJson(
    "get.domain.com/file.json"       
).
json(
    function(json) {
        // zwraca całość pliku JSON
    }
).
item(
    function(item) {
        // zwraca każdorazowo element lub parę klucz, wartość
    }
);
```
    
##### synchronicznie

        var json = letJson("get.domain.com/file.json");
        


## [json def](https://www.jsondef.com)
![json def](https://logo.jsondef.com/2/cover.png)


okreslanie oczekiwanej struktury oraz podłączenie każdego elementu JSON pod konrketną funkcję

### def.json

```json    
{
    "xpath/name":"function1",
    "xpath/name":"function1"
    "xpath/name":"function1"
}
```

### jsonDef(json, success, error)    

```js
    jsonDef(
        "get.domain.com/def.json",
        function(name, value, json) {

        }
    );
```    

### Pobranie definicji dla pliku JSON

```js
letJson(
    "get.domain.com/def.json",
    function(json) {
        letJson(
                "get.domain.com/file.json",
                function(name, value, json) {



                }
        )
   }
);
```    





## [jBodys](https://www.jbodys.com)
![jBodys](https://logo.jbodys.com/2/cover.png)


+ jBodys()

Definicja moułu, poprzez określenie zalezności ładowania 
W anstaepnej wersji również określanie wersji

```json
{
  "/form/field/text.css",
  "/form/field/email.css",
  "/form/field/submit.css",
  "newsletter.html": [
      "submit.js"
  ]
}
```

Wielopoziomiowe pobieranie plikó JSON
Budowanie struktury pliku JSON z wielu plików

```json
{
  "/form/field/submit.json": {
      "newsletter.json": [
          "submit.json",
          "/form/field/text.json",
          "/form/field/email.json",        
      ]
  }
}
```

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

Sczytujemy kolejno karty od góry do dołu poprzez czytnik NFC (poprzez smartfon'a) i kolejno są otwierane adresy, które są identyfikowane jako kolejne elementy (identyfikacja adresu IP), równocześnie powstaje strona www oparta o te moduły. Lista modułów jest zapisana w JSON, ładowane są za pomocą rozwiązania WebStream .dev , wcześniej biblioteka jLoads, teraz kilka modularnych funkcji docelowo na kilka jezyków, dzięki czemu nie będzie problemu z implementacją w python, php, itd

![modules](modules.png)


## Więcej info

###  Web Monetization

Z pomocą Web Monetization API będziemy w stanie zarabiać pieniądze bezpośrednio i natychmiastowo - bez poświęcania wrażliwych danych użytkowników, i na dobre pozbyć się reklam. Najlepsze jest to, że nowe API już teraz działa w przeglądarce!

### FaaS

Forge to FaaS od Atlassiana do tworzenia rozszerzeń do Jiry czy Confluence. Spoiler alert - kod JavaScript który jest tam uruchamiany również działa w sandbox'ie.

Podczas tej prezentacji przyjrzymy się na przykładzie Forge'a jak możemy stworzyć bezpieczny sandbox w V8.


# Interesujące linki


## [Highland.js](https://caolan.github.io/highland/)


[Node.js streams 101 - slides.com/michalczukm/nodejs-streams-101#/9/1](https://slides.com/michalczukm/nodejs-streams-101#/9/1)

[caolan/highland: High-level streams library for Node.js and the browser](https://github.com/caolan/highland)

With Highland, we really can have one language to work with both synchronous and asynchronous data, whether it's from a Node Stream, an EventEmitter, a callback or an Array. You can even wrap ES6 or jQuery promises:

```js
var foo = _($.getJSON('/api/foo'));
```

Piping in data from Node Streams

```js    
function isBlogPost(doc) {
    return doc.type === 'blogpost';
}

var output = fs.createWriteStream('output');
var docs = new db.createReadStream();

// Wrap a node stream and pipe to file
_(docs).filter(isBlogpost).pipe(output);

// or, pipe in a node stream directly:
// useful if you need a TransformStream-like object for external APIs.
var transformStream = _.pipeline(_.filter(isBlogpost));
docs.pipe(transformStream).pipe(output);
```

---
+ [edit](https://github.com/web-stream/www/edit/main/README.md)
+ [web-stream/www: Website about Webstreaming - WebStream.dev](https://github.com/web-stream/www)
```
https://github.com/web-stream/www.git
```   
