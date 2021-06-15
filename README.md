![logo webstream](https://logo.webstream.dev/3/cover.png)

<img alt="open collective badge" src="https://opencollective.com/webstream/tiers/backer/badge.svg?label=backer&color=brightgreen" />
<img alt="open collective badge" src="https://opencollective.com/webstream/tiers/sponsor/badge.svg?label=sponsor&color=brightgreen" />
<object type="image/svg+xml" data="https://opencollective.com/webstream/tiers/backer.svg?avatarHeight=36&width=600"></object>

---

# [WebStream](https://www.webstream.dev/)
Streaming application/interface directly on frontend, without building backend side
is part of [wapka ecosystem](https://docs.wapka.pl/) to build Application based on PaaS infrastructure


Project Status

⚠️ WebStream is still an early beta, missing features and bugs are to be expected! If you can stomach it,
then WebStream-built sites are production ready and several production websites built with WebStream already exist in the wild. 
We will update this note once we get closer to a stable, v1.0 release.



## 🔧 Quick Start

> __Important__: WebStream is built with [ESM modules](https://nodejs.org/api/esm.html) which are not supported in older version of Node.js. The minimum supported version is __14.15.1__.

```bash
# create your project
mkdir new-project-directory
cd new-project-directory
npm init webstream

# install your dependencies
npm install

# start the dev server and open your browser
npm start
```

### 🚀 Build & Deployment

The default WebStream project has the following `scripts` in the `/package.json` file:

```json
{
  "scripts": {
    "start": "WebStream dev",
    "build": "WebStream build"
  }
}
```

For local development, run:

```
npm run start
```

To build for production, run the following command:

```
npm run build
```

To deploy your WebStream site to production, upload the contents of `/dist` to your favorite static site host.



## More
+ [Hosted Projects - OpenJS Foundation](https://openjsf.org/projects/)

+ [Wapka, Softreck’s OpenSource Deployment Ecosystem - docs](https://docs.wapka.pl/)

+ [JavaScript End to End Testing Framework - cypress.io](https://www.cypress.io/)

# microfrontend.org
+ [www.microfrontend.org](https://www.microfrontend.org/)
 
## API foundation

## abstraction and AI

abstraction is depends context, so it can be good in some context, not ewerywhere, that's why I support personally Native Technologies, Microsoftsolutions are full of abstractions, but AI don't need it, so what is the future? AI or Microsoft?

### for abstraction friends

There is nothing wrong if abstraction is describing business logic for a human.
We need it till AI is not used to create hypermodular application by itself.
If AI is responsible for streaming application there si no more necessary to create abstraction.

What AI need?
native modular code written in native technologies.
AI is build the businnes logic over personalisation based on BIG DATA
It works such Black BOX with:
+ input
+ output
+ config

### TAGS:

NO CONTEXT
NO DEPENDENCY
ONLY CODE
NATIVE TECHNOLOGIES AND LANGUAGES
LEGACY CODE SUPOPRTED
OS FRIENDLY (LINUX/IOS/WINDOWS)
LOCAL, DECENTRALIZED, AUTONOMOUS


.apicra - bash scripts to prepare environment
https://www.apicra.com

.apifunc - funkcje, implementacja apiunit
https://www.apifunc.com

.apiunit - metadane potrzebne do stworzenia aplikacji
https://www.apiunit.com

.apibuild - budowanie plaikacji, deployment
https://www.apibuild.com

.apiterminal - devops terminal by web
https://www.apiterminal.com

## WebStream, what it is?


+ jest modularnym standardem ładowania mediów na stronę  www, umożliwiającym implementację streamowania poprzez protokół HTTP

WebStream is a rapid prototyping, playing and learning environment for web development.
Extends the JavaScripts language with Stream Thinking and libraries for building asyncron, decentralized, modular applications.

Web Stream a continuous improving by a flowing stream; a continuous succession of changes


## Current Technologies at 2021

+ Single Page Application (SPA)
+ Progressive Web App (PWA)
+ Application as a Stream (AaaS)
    + javascript    
    + native
    + json based communication
    

## The Stack

How your stack looks will depend on how you want to render your application. Here is a comprehensive discussion about that, but in a nutshell:

    Client-side rendering(CSR); SPA; JSON APIs —
    This is perhaps the most popular approach. It's great for building interactive web applications. But be aware of its downsides and steps to mitigate them. This is the approach I took, so we will talk about it in a lot of detail.

    Hybrid CSR; Both client-side and server-side rendering(SSR) —
    With this approach, you still build your SPA. But when a user requests your app, for example, the homepage, you render the homepage's component into its static HTML in your server and serve it to the user. Then at the user's browser, hydration will happen so the whole thing becomes the intended SPA.

The main benefits of this approach are that you get good SEO and users can see your stuff sooner (faster 'First Meaningful Paint').

But there are downsides too. Apart from the extra maintenance costs, we will have to download the same payload twice—First, the HTML, and second, its Javascript counterpart for the 'hydration' which will exert significant work on the browser's main thread. This prolongs the 'First time to interactive', and hence diminishes the benefits gained from a faster 'First meaningful paint'.

The technologies that are adopted for this approach are NextJs, NuxtJs, and GatsbyJs.



### Turbolinks
https://github.com/turbolinks/turbolinks
Turbolinks® makes navigating your web application faster. Get the performance benefits of a single-page application without the added complexity of a client-side JavaScript framework. Use HTML to render your views on the server side and link to pages as usual. When you follow a link, Turbolinks automatically fetches the page, swaps in its <body>, and merges its <head>, all without incurring the cost of a full page load.




### Phoenix LiveView
https://github.com/phoenixframework/phoenix_live_view

Phoenix LiveView enables rich, real-time user experiences with server-rendered HTML.

After you [install Elixir](https://elixir-lang.org/install.html)
in your machine, you can create your first LiveView app in two
steps:

    $ mix archive.install hex phx_new
    $ mix phx.new demo --live

#### Features

* Use a declarative model to render HTML on the server over WebSockets with optional LongPolling fallback

* Smart templating and change tracking - after connected, LiveView sends only what changed to the client, skipping the template markup and reducing the payload

* Live form validation with file upload support

* A rich integration API with the client with `phx-click`, `phx-focus`, `phx-blur`, `phx-submit`, etc. `phx-hook` is included for the cases where you have to write JavaScript

* Code reuse via components, which break templates, state, and event handling into reusable bits, which is essential in large applications

* Live navigation to enrich links and redirects to only load the minimum amount of content as users navigate between pages

* A latency simulator so you can emulate how slow clients will interact with your application

* Testing tools that allow you to write a confident test suite without the complexity of running a whole browser alongside your tests


# [API Platform: Getting Started With API Platform: Create Your API and Your Jamstack Site](https://api-platform.com/docs/distribution/)

> -   a [Helm](https://helm.sh/) chart to deploy the API in any [Kubernetes](https://api-platform.com/docs/deployment/kubernetes/) cluster
> 
> ## A Bookshop API
> 
> To discover how the framework works, we will create an API to manage a bookshop.
> 
> To create a fully featured API, an admin interface and a Progressive Web App using Next.js, all you need is to design **the public data model of our API** and handcraft it as _Plain Old PHP Objects_.
> 
> API Platform uses these model classes to expose and document a web API having a bunch of built-in features:
> 
> -   creating, retrieving, updating and deleting (CRUD) resources
> -   data validation
> -   pagination
> -   filtering
> -   sorting
> -   hypermedia/[HATEOAS](https://en.wikipedia.org/wiki/HATEOAS) and content negotiation support ([JSON-LD](https://json-ld.org) and [Hydra](https://www.hydra-cg.com/), [JSON:API](https://jsonapi.org/), [HAL](https://tools.ietf.org/html/draft-kelly-json-hal-08)...)
> -   [GraphQL support](https://api-platform.com/docs/core/graphql/)
> -   Nice UI and machine-readable documentations ([Swagger UI/OpenAPI](https://swagger.io), [GraphiQL](https://github.com/graphql/graphiql)...)
> -   authentication ([Basic HTTP](https://en.wikipedia.org/wiki/Basic_access_authentication), cookies as well as [JWT](https://jwt.io/) and [OAuth](https://oauth.net/) through extensions)
> -   [CORS headers](https://developer.mozilla.org/en-US/docs/Web/HTTP/Access_control_CORS)
> -   security checks and headers (tested against [OWASP recommendations](https://www.owasp.org/index.php/REST_Security_Cheat_Sheet))
> -   [invalidation-based HTTP caching](https://api-platform.com/docs/core/performance/)
> -   and basically everything needed to build modern APIs.
> 
> One more thing, before we start: as the API Platform distribution includes [the Symfony framework](https://symfony.com), it is compatible with most [Symfony bundles](https://flex.symfony.com) (plugins) and benefits from [the numerous extensions points](https://api-platform.com/docs/core/extending/) provided by this rock-solid foundation (events, Dependency Injection Container...). Adding features like custom or service-oriented API endpoints, JWT or OAuth authentication, HTTP caching, mail sending or asynchronous jobs to your APIs is straightforward.
 
## AaaS - Application as a Stream

AaaS is supported by WebStream.

+ WebStream is an ecosystem for web-development

## How WebStream work's?

Load any media on website without reload page, now stream each website without reload.
Over modularity each website can talk to another without barrier...

### Unikatowe ID

Id elementów DOM muszą być unikatowe dla aplikacji i jej elementów gdy są wyświetlane razem.
Rozwiązaliśmy ten problem poprzez dodanie nazwy aplikacji przed każdym id np. web-chat-header, web-admin-header, ...

    
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

[more about limitations of CLOUDS](CLOUDS.md)

## story
    
Gdy korzystamy z własnej implementacji frontend <-> mikroserwisy możemy napotkać niektóre z tych problemów:

+ wiele wersji tej samej biblioteki ładujących się z losową kolejnością i nadpisujących się,
+ style z jednej aplikacji nadpisywały drugą,
+ brak prostego sposobu na dodanie kolejnej aplikacji utworzonej w innym frameworku,
+ problemy z routingiem,
+ brak lazy loading.

### iframe
Wykorzystanie iframe, pozwala na łatwe wdrożeni, niestety ostylowanie jest trudne i niewygodne a dostępność dla ludzi korzystających z czytników ekranowych jest jeszcze gorzej. 

Najprostszy sposób, aby zacząć: możemy użyć okna postMessage() do komunikacji między aplikacjami.

   
###  Single SPA


Jest to framework do komponowania ze sobą aplikacji frontendowych. Jeśli chcesz rozpocząć prawdziwy projekt, wybierz ten poniżej:

Mikrofrontend pozwala nam łączyć kilka aplikacji napisanych nawet w różnych frameworkach
Frameworki są tylko narzędziem, najważniejsza natomiast dla nas jest możliwość podzielenia aplikacji funkcjonalnie i przydzielenia tych części zespołom.

https://single-spa.js.org
    
    

### Frint

To kolejny framework do komponowania ze sobą aplikacji frontendowych. Bardziej elastyczny niż Single SPA, ale nowszy i mniej popularny:

https://frint.js.org

    
    
### Komponenty webowe

Nie jest to framework, ale funkcja przeglądarki i być może przyszłość Internetu. Oto artykuł na ten temat:

https://www.webcomponents.org/introduction
    
    

### Taylor

Framework ten wykorzystuje inne podejście, tworząc stronę routingu na backendzie za pomocą node.js. Jeśli pomysł Ci się podoba, warto zobaczyć:

https://github.com/zalando/tailor
    
    
    
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
  

jRuns is an executor that allows you to execute builds on a remote machine by executing commands over SSH.
it's usefull to nodejs/deno environment as backend application


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



# First Steps with .apicra

## on linux

### install
    sh .apicra/install

install promagen

    sh .apicra/promagen

### start
    sh .apicra/start

### open in browser
    sh .apicra/browser

## on windows

### install
    .apicra\install.bat

### start
    .apicra\start.bat


### open in browser
    .apicra\browser.bat



## FLOW of creation with webstream 
focus on small defined problem in some context and make the context smaller by the iteration

**Create just one function**

+ Don’t create all in one class.
+ Think about your problem and solve it by many functions, but make it more generic to extend with another functions
  
**Deliver in small pieces** 

+ Do not bury your work on the long-living branch. 
+ There is a high risk that you will never finish that. 
+ Break it up into smaller pieces and deliver on each piece, one by one.    
  + extend the functionality by modularisation
  
**Take care of the documentation** 

+ without documentation, no one will use your code. 
+ Make a README one file documentation
  

**Create a CI / CD flow** 

+ Many tools allow you to configure a free CI process for Open Source projects expressly:
  + DevOps, Github Actions, Travis, etc.
+ User should started the code-base without failure. 
  + The repository should be builded and tested.
+ This is crucial for potential contributors.
 

**Join the community** 

**communication channel**
Every popular library has its communication channel, be it Slack, Gitter, Discourse or a mailing list.

Join it, check how people communicate with each other and how they help on issues.
Verify if this is the place you want to be. 

From such a channel, you can also assess whether the community is alive. 
If there are active discussions, there is a greater chance that the library is maintained.


**Help others**

Open Source, as the name suggests, is about being OPEN.

Even if you do not consider yourself an expert, your advice may be valuable to someone. 
Don’t be afraid that someone will tell that: you’re wrong. 
Even if someone criticizes your work, you will at least learn something new. 
You will confront your thinking.


---
+ [edit](https://github.com/web-stream/www/edit/main/README.md)
+ [web-stream/www: Website about Webstreaming - WebStream.dev](https://github.com/web-stream/www)
```
https://github.com/web-stream/www.git
```   
