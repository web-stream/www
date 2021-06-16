![logo webstream](https://logo.webstream.dev/3/cover.png)

<img alt="open collective badge" src="https://opencollective.com/webstream/tiers/backer/badge.svg?label=backer&color=brightgreen" />
<img alt="open collective badge" src="https://opencollective.com/webstream/tiers/sponsor/badge.svg?label=sponsor&color=brightgreen" />
<object type="image/svg+xml" data="https://opencollective.com/webstream/tiers/backer.svg?avatarHeight=36&width=600"></object>

---

# [WebStream](https://www.webstream.dev/)
Streaming application/interface directly on frontend, without building backend side
is part of [wapka ecosystem](https://docs.wapka.pl/) to build Application based on PaaS infrastructure



## Streaming server rendering and Progressive Rehydration

Server rendering has had a number of developments over the last few years.

[Streaming server rendering](https://zeit.co/blog/streaming-server-rendering-at-spectrum) allows you to send HTML in chunks that the browser can progressively render as it's received. This can provide a fast First Paint and First Contentful Paint as markup arrives to users faster.
In React, streams being asynchronous in [renderToNodeStream()](https://reactjs.org/docs/react-dom-server.html#rendertonodestream) - compared to synchronous renderToString - means backpressure is handled well.

Progressive rehydration is also worth keeping an eye on, and something React has been [exploring](https://github.com/facebook/react/pull/14717). With this approach, individual pieces of a server-rendered application are "booted up” over time, rather than the current common approach of initializing the entire application at once. This can help reduce the amount of JavaScript required to make pages interactive, since client-side upgrading of low priority parts of the page can be deferred to prevent blocking the main thread. It can also help avoid one of the most common SSR Rehydration pitfalls, where a server-rendered DOM tree gets destroyed and then immediately rebuilt - most often because the initial synchronous client-side render required data that wasn’t quite ready, perhaps awaiting Promise resolution.


[ReactDOMServer – React](https://reactjs.org/docs/react-dom-server.html#rendertonodestream)

### `renderToNodeStream()`

    ReactDOMServer.renderToNodeStream(element)

Render a React element to its initial HTML. Returns a [Readable stream](https://nodejs.org/api/stream.html#stream_readable_streams) that outputs an HTML string. The HTML output by this stream is exactly equal to what [`ReactDOMServer.renderToString`](https://reactjs.org/docs/react-dom-server.html#rendertostring) would return. You can use this method to generate HTML on the server and send the markup down on the initial request for faster page loads and to allow search engines to crawl your pages for SEO purposes.

If you call [`ReactDOM.hydrate()`](https://reactjs.org/docs/react-dom.html#hydrate) on a node that already has this server-rendered markup, React will preserve it and only attach event handlers, allowing you to have a very performant first-load experience.

Note:

Server-only. This API is not available in the browser.

The stream returned from this method will return a byte stream encoded in utf-8. If you need a stream in another encoding, take a look at a project like [iconv-lite](https://www.npmjs.com/package/iconv-lite), which provides transform streams for transcoding text.

* * *

### `renderToStaticNodeStream()`

    ReactDOMServer.renderToStaticNodeStream(element)

Similar to [`renderToNodeStream`](https://reactjs.org/docs/react-dom-server.html#rendertonodestream), except this doesn’t create extra DOM attributes that React uses internally, such as `data-reactroot`. This is useful if you want to use React as a simple static page generator, as stripping away the extra attributes can save some bytes.

The HTML output by this stream is exactly equal to what [`ReactDOMServer.renderToStaticMarkup`](https://reactjs.org/docs/react-dom-server.html#rendertostaticmarkup) would return.

If you plan to use React on the client to make the markup interactive, do not use this method. Instead, use [`renderToNodeStream`](https://reactjs.org/docs/react-dom-server.html#rendertonodestream) on the server and [`ReactDOM.hydrate()`](https://reactjs.org/docs/react-dom.html#hydrate) on the client.



# Streaming server-side rendering

[Streaming server-side rendering](https://hackernoon.com/whats-new-with-server-side-rendering-in-react-16-9b0d78585d67) was introduced in React v16. It allows the application server to send HTML as it becomes available while React is still rendering, which makes for **a faster Time-To-First-Byte (TTFB)** and **allows your Node server to handle** [**back-pressure**](https://nodejs.org/en/docs/guides/backpressuring-in-streams/) **more easily**.

That doesn’t play well with CSS-in-JS: Traditionally, we inject a `<style` tag with all your components’ styles into the `<head` _after_ React finishes rendering. However, in the case of streaming, the `<head` is sent to the user _before_ any components have been rendered, so we can’t inject into it anymore.

**The solution is to interleave the HTML with** `**<style>**` **blocks as components are rendered**, rather than waiting until the very end and injecting all the components at once. Because that messes with ReactDOM on the client (HTML being present that React wasn’t responsible for), we have to consolidate all those `style` tags back into the `<head>` before rehydration.

We’ve implemented exactly that; **you can now use streaming server-side rendering with styled-components!** Here’s how:
```js
import { renderToNodeStream } from 'react-dom/server'
import styled, { ServerStyleSheet } from 'styled-components'res.write('<!DOCTYPE html><html><head><title>My Title</title></head><body><div id="root">')const sheet = new ServerStyleSheet()
const jsx = sheet.collectStyles(<App />)// Interleave the HTML stream with <styletags
const stream = sheet.interleaveWithNodeStream(
  renderToNodeStream(jsx)
)stream.pipe(res, { end: false })stream.on('end', () =res.end('</div></body></html>'))
```

Later on client-side, the `consolidateStreamedStyles()` API must be called to prepare for React’s rehydration phase:
```js
import ReactDOM from 'react-dom'
import { consolidateStreamedStyles } from 'styled-components'/\* Make sure you call this before ReactDOM.hydrate! \*/
consolidateStreamedStyles()ReactDOM.hydrate(<App />, rootElem)
```

### Referring to other components


	This is a web-specific API and you won't be able to use it in react-native.

There are many ways to apply contextual overrides to a component's styling. That being said, it rarely is easy without rigging up a well-known targeting CSS selector paradigm and then making them accessible for use in interpolations.

styled-components solves this use case cleanly via the "component selector" pattern. Whenever a component is created or wrapped by the styled() factory function, it is also assigned a stable CSS class for use in targeting. This allows for extremely powerful composition patterns without having to fuss around with naming and avoiding selector collisions.




styled-components optionally supports writing CSS as JavaScript objects instead of strings. This is particularly useful when you have existing style objects and want to gradually move to styled-components.

```js
// Static object
const Box = styled.div({
background: 'palevioletred',
height: '50px',
width: '50px'
});

// Adapting based on props
const PropsBox = styled.div(props => ({
background: props.background,
height: '50px',
width: '50px'
}));

render(
  <div>
    <Box />
    <PropsBox background="blue" />
  </div>
);
```

### Partial Rehydration

Partial rehydration has proven difficult to implement. This approach is an extension of the idea of progressive rehydration, where the individual pieces (components / views / trees) to be progressively rehydrated are analyzed and those with little interactivity or no reactivity are identified. For each of these mostly-static parts, the corresponding JavaScript code is then transformed into inert references and decorative functionality, reducing their client-side footprint to near-zero. The partial hydration approach comes with its own issues and compromises. It poses some interesting challenges for caching, and client-side navigation means we can't assume server-rendered HTML for inert parts of the application will be available without a full page load.


### Trisomorphic Rendering

If [service workers](https://developers.google.com/web/fundamentals/primers/service-workers/) are an option for you, "trisomorphic” rendering may also be of interest. It's a technique where you can use streaming server rendering for initial/non-JS navigations, and then have your service worker take on rendering of HTML for navigations after it has been installed. This can keep cached components and templates up to date and enables SPA-style navigations for rendering new views in the same session. This approach works best when you can share the same templating and routing code between the server, client page, and service worker.



## Project Status

⚠️ WebStream is still an early beta, missing features and bugs are to be expected! If you can stomach it,
then WebStream-built sites are production ready and several production websites built with WebStream already exist in the wild.
We will update this note once we get closer to a stable, v1.0 release.



## 🔧 Quick Start

__Important__: WebStream is built with [ESM modules](https://nodejs.org/api/esm.html) which are not supported in older version of Node.js. The minimum supported version is __14.15.1__.

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


[.apicra](https://www.apicra.com) - bash scripts to prepare environment


[.apifunc](https://www.apifunc.com) - funkcje, implementacja apiunit


[.apiunit](https://www.apiunit.com) - metadane potrzebne do stworzenia aplikacji


[.apibuild](https://www.apibuild.com) - budowanie plaikacji, deployment


[.apiterminal](https://www.apiterminal.com) - devops terminal by web


## WebStream, what it is?


+ jest modularnym standardem ładowania mediów na stronę  www, umożliwiającym implementację streamowania poprzez protokół HTTP

WebStream is a rapid prototyping, playing and learning environment for web development.
Extends the JavaScripts language with Stream Thinking and libraries for building asyncron, decentralized, modular applications.

Web Stream a continuous improving by a flowing stream; a continuous succession of changes


### AaaS - Application as a Stream

AaaS is supported by WebStream.

+ WebStream is an ecosystem for web-development

### How WebStream work's?

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


### Features

+ Use a declarative model to render HTML on the server over WebSockets with optional LongPolling fallback
+ Smart templating and change tracking - after connected, LiveView sends only what changed to the client, skipping the template markup and reducing the payload
+ Live form validation with file upload support
+ A rich integration API with the client with `phx-click`, `phx-focus`, `phx-blur`, `phx-submit`, etc. `phx-hook` is included for the cases where you have to write JavaScript
+ Code reuse via components, which break templates, state, and event handling into reusable bits, which is essential in large applications
+ Live navigation to enrich links and redirects to only load the minimum amount of content as users navigate between pages
+ A latency simulator so you can emulate how slow clients will interact with your application
+ Testing tools that allow you to write a confident test suite without the complexity of running a whole browser alongside your tests


## A WebStream API

+ [API Platform: Getting Started With API Platform: Create Your API and Your Jamstack Site](https://api-platform.com/docs/distribution/)

+ a [Helm](https://helm.sh/) chart to deploy the API in any [Kubernetes](https://api-platform.com/docs/deployment/kubernetes/) cluster


To create a fully featured API, an admin interface and a Progressive Web App using WebStream all you need is to design **the stream data model of our application**

API Platform uses these model classes to expose and document a web API having a bunch of built-in features:

+ creating, retrieving, updating and deleting (CRUD) resources
+ data validation
+ pagination
+ filtering
+ sorting
+ hypermedia/[HATEOAS](https://en.wikipedia.org/wiki/HATEOAS) and content negotiation support ([JSON-LD](https://json-ld.org) and [Hydra](https://www.hydra-cg.com/), [JSON:API](https://jsonapi.org/), [HAL](https://tools.ietf.org/html/draft-kelly-json-hal-08)
+ [GraphQL support](https://api-platform.com/docs/core/graphql/)
+ Nice UI and machine-readable documentations ([Swagger UI/OpenAPI](https://swagger.io), [GraphiQL](https://github.com/graphql/graphiql)...)
+ authentication ([Basic HTTP](https://en.wikipedia.org/wiki/Basic_access_authentication), cookies as well as [JWT](https://jwt.io/) and [OAuth](https://oauth.net/) through extensions)
+ [CORS headers](https://developer.mozilla.org/en-US/docs/Web/HTTP/Access_control_CORS)
+ security checks and headers (tested against [OWASP recommendations](https://www.owasp.org/index.php/REST_Security_Cheat_Sheet))
+ [invalidation-based HTTP caching](https://api-platform.com/docs/core/performance/)
+ and basically everything needed to build modern APIs.

One more thing, before we start: as the API Platform distribution includes [the Symfony framework](https://symfony.com), it is compatible with most [Symfony bundles](https://flex.symfony.com) (plugins) and benefits from [the numerous extensions points](https://api-platform.com/docs/core/extending/) provided by this rock-solid foundation (events, Dependency Injection Container...). Adding features like custom or service-oriented API endpoints, JWT or OAuth authentication, HTTP caching, mail sending or asynchronous jobs to your APIs is straightforward.


---

## why should we use webstream?

Because we can improve our stack without clouds


### Cloud Stack Problem

I warned people many years ago to not base their entire stack on a single cloud provider.
They didn't listen, made fun of me, and I actually nodded for some time - it's more efficient, right?

What could go wrong.

Now, Parler's case proved me right


because it's limiting. You base your entire system around proprietary software/services, and then you're stuck - you can't migrate anywhere else,
without re-writing huge chunks of your code. The code that happened to be yours, is still dependent on cloud solutions, so it goes to waste as well - you end up doubling hours spent on achieving the same outcome, if you decide it's time to move. And that's the best case scenario, if you're unlucky, you're getting kicked out like @Parler was with 72hr notice.
That's the rational explanation. I also don't trust Amazon, Google or Microsoft. tldr; out of principles.




## story

Gdy korzystamy z własnej implementacji frontend <-mikroserwisy możemy napotkać niektóre z tych problemów:

+ wiele wersji tej samej biblioteki ładujących się z losową kolejnością i nadpisujących się,
+ style z jednej aplikacji nadpisywały drugą,
+ brak prostego sposobu na dodanie kolejnej aplikacji utworzonej w innym frameworku,
+ problemy z routingiem,
+ brak lazy loading.


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


# Ekosystem do streamowania

Poniższe funkcje pozwalają na implementację tych rozwiazań w kilku językach programowania


## Moduły WebStream

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

**Deliver in small pieces*+

+ Do not bury your work on the long-living branch.
+ There is a high risk that you will never finish that.
+ Break it up into smaller pieces and deliver on each piece, one by one.
  + extend the functionality by modularisation

**Take care of the documentation*+

+ without documentation, no one will use your code.
+ Make a README one file documentation


**Create a CI / CD flow*+

+ Many tools allow you to configure a free CI process for Open Source projects expressly:
  + DevOps, Github Actions, Travis, etc.
+ User should started the code-base without failure.
  + The repository should be builded and tested.
+ This is crucial for potential contributors.


**Join the community*+

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



# Webstream

Terminology

## Rendering

### SSR: Server-Side Rendering
rendering a client-side or universal app to HTML on the server.

### CSR: Client-Side Rendering
rendering an app in a browser, generally using the DOM.

### Rehydration:
"booting up” JavaScript views on the client such that they reuse the server-rendered HTML’s DOM tree and data.

### Prerendering:
 running a client-side application at build time to capture its initial state as static HTML.

## Performance

### TTFB:
Time to First Byte - seen as the time between clicking a link and the first bit of content coming in.

### FP:
 First Paint - the first time any pixel gets becomes visible to the user.

### FCP:
 First Contentful Paint - the time when requested content (article body, etc) becomes visible.

### TTI:
Time To Interactive - the time at which a page becomes interactive (events wired up, etc).


## Server Rendering

Server rendering generates the full HTML for a page on the server in response to navigation. This avoids additional round-trips for data fetching and templating on the client, since it’s handled before the browser gets a response._

Server rendering generally produces a fast [First Paint](https://developers.google.com/web/fundamentals/performance/user-centric-performance-metrics#first_paint_and_first_contentful_paint) (FP) and [First Contentful Paint](https://developers.google.com/web/fundamentals/performance/user-centric-performance-metrics#first_paint_and_first_contentful_paint) (FCP). Running page logic and rendering on the server makes it possible to avoid sending lots of JavaScript to the client, which helps achieve a fast [Time to Interactive](https://developers.google.com/web/tools/lighthouse/audits/time-to-interactive) (TTI). This makes sense, since with server rendering you’re really just sending text and links to the user’s browser. This approach can work well for a large spectrum of device and network conditions, and opens up interesting browser optimizations like streaming document parsing.

![Diagram showing server rendering and JS execution affecting FCP and TTI](https://developers.google.com/web/updates/images/2019/02/rendering-on-the-web/server-rendering-tti.png)

With server rendering, users are unlikely to be left waiting for CPU-bound JavaScript to process before they can use your site. Even when [third-party JS](https://developers.google.com/web/fundamentals/performance/optimizing-content-efficiency/loading-third-party-javascript/) can’t be avoided, using server rendering to reduce your own first-party [JS costs](https://medium.com/@addyosmani/the-cost-of-javascript-in-2018-7d8950fbb5d4) can give you more "[budget](https://medium.com/@addyosmani/start-performance-budgeting-dabde04cf6a3)" for the rest. However, there is one primary drawback to this approach: generating pages on the server takes time, which can often result in a slower [Time to First Byte](https://en.wikipedia.org/wiki/Time_to_first_byte) (TTFB).

Whether server rendering is enough for your application largely depends on what type of experience you are building. There is a longstanding debate over the correct applications of server rendering versus client-side rendering, but it’s important to remember that you can opt to use server rendering for some pages and not others. Some sites have adopted hybrid rendering techniques with success. [Netflix](https://medium.com/dev-channel/a-netflix-web-performance-case-study-c0bcde26a9d9) server-renders its relatively static landing pages, while [prefetching](https://dev.to/addyosmani/speed-up-next-page-navigations-with-prefetching-4285) the JS for interaction-heavy pages, giving these heavier client-rendered pages a better chance of loading quickly.

Many modern frameworks, libraries and architectures make it possible to render the same application on both the client and the server. These techniques can be used for Server Rendering, however it’s important to note that architectures where rendering happens both on the server _**and**_ on the client are their own class of solution with very different performance characteristics and tradeoffs. React users can use [renderToString()](https://reactjs.org/docs/react-dom-server.html) or solutions built atop it like [Next.js](https://nextjs.org) for server rendering. Vue users can look at Vue’s [server rendering guide](https://ssr.vuejs.org) or [Nuxt](https://nuxtjs.org). Angular has [Universal](https://angular.io/guide/universal). Most popular solutions employ some form of hydration though, so be aware of the approach in use before selecting a tool.


## Static Rendering

[Static rendering](https://frontarm.com/articles/static-vs-server-rendering/) happens at build-time and offers a fast First Paint, First Contentful Paint and Time To Interactive - assuming the amount of client-side JS is limited. Unlike Server Rendering, it also manages to achieve a consistently fast Time To First Byte, since the HTML for a page doesn’t have to be generated on the fly. Generally, static rendering means producing a separate HTML file for each URL ahead of time. With HTML responses being generated in advance, static renders can be deployed to multiple CDNs to take advantage of edge-caching.

![Diagram showing static rendering and optional JS execution affecting FCP
and TTI](https://developers.google.com/web/updates/images/2019/02/rendering-on-the-web/static-rendering-tti.png)

Solutions for static rendering come in all shapes and sizes. Tools like [Gatsby](https://www.gatsbyjs.org) are designed to make developers feel like their application is being rendered dynamically rather than generated as a build step. Others like [Jekyll](https://jekyllrb.com) and [Metalsmith](https://metalsmith.io) embrace their static nature, providing a more template-driven approach.

One of the downsides to static rendering is that individual HTML files must be generated for every possible URL. This can be challenging or even infeasible when you can't predict what those URLs will be ahead of time, or for sites with a large number of unique pages.

React users may be familiar with [Gatsby](https://www.gatsbyjs.org), [Next.js static export](https://nextjs.org/learn/excel/static-html-export/) or [Navi](https://frontarm.com/navi/) - all of these make it convenient to author using components. However, it’s important to understand the difference between static rendering and prerendering: static rendered pages are interactive without the need to execute much client-side JS, whereas prerendering improves the First Paint or First Contentful Paint of a Single Page Application that must be booted on the client in order for pages to be truly interactive.

If you’re unsure whether a given solution is static rendering or prerendering, try this test: disable JavaScript and load the created web pages. For statically rendered pages, most of the functionality will still exist without JavaScript enabled. For prerendered pages, there may still be some basic functionality like links, but most of the page will be inert.

Another useful test is to slow your network down using Chrome DevTools, and observe how much JavaScript has been downloaded before a page becomes interactive. Prerendering generally requires more JavaScript to get interactive, and that JavaScript tends to be more complex than the [Progressive Enhancement](https://developer.mozilla.org/en-US/docs/Glossary/Progressive_Enhancement) approach used by static rendering.

## Server Rendering vs Static Rendering

Server rendering is not a silver bullet - its dynamic nature can come with [significant compute overhead](https://medium.com/airbnb-engineering/operationalizing-node-js-for-server-side-rendering-c5ba718acfc9) costs. Many server rendering solutions don't flush early, can delay TTFB or double the data being sent (e.g. inlined state used by JS on the client). In React, renderToString() can be slow as it's synchronous and single-threaded. Getting server rendering "right" can involve finding or building a solution for [component caching](https://medium.com/@reactcomponentcaching/speedier-server-side-rendering-in-react-16-with-component-caching-e8aa677929b1), managing memory consumption, applying [memoization](https://speakerdeck.com/maxnajim/hastening-react-ssr-with-component-memoization-and-templatization) techniques, and many other concerns. You're generally processing/rebuilding the same application multiple times - once on the client and once in the server. Just because server rendering can make something show up sooner doesn't suddenly mean you have less work to do.

Server rendering produces HTML on-demand for each URL but can be slower than just serving static rendered content. If you can put in the additional leg-work, server rendering + [HTML caching](https://freecontent.manning.com/caching-in-react/) can massively reduce server render time. The upside to server rendering is the ability to pull more "live" data and respond to a more complete set of requests than is possible with static rendering. Pages requiring personalization are a concrete example of the type of request that would not work well with static rendering.

Server rendering can also present interesting decisions when building a [PWA](https://developers.google.com/web/progressive-web-apps/). Is it better to use full-page [service worker](https://developers.google.com/web/fundamentals/primers/service-workers/) caching, or just server-render individual pieces of content?

## Client-Side Rendering (CSR)

Client-side rendering (CSR) means rendering pages directly in the browser using JavaScript. All logic, data fetching, templating and routing are handled on the client rather than the server._

Client-side rendering can be difficult to get and keep fast for mobile. It can approach the performance of pure server-rendering if doing minimal work, keeping a [tight JavaScript budget](https://mobile.twitter.com/HenrikJoreteg/status/1039744716210950144) and delivering value in as few [RTTs](https://en.wikipedia.org/wiki/Round-trip_delay_time) as possible. Critical scripts and data can be delivered sooner using [HTTP/2 Server Push](https://www.smashingmagazine.com/2017/04/guide-http2-server-push/) or `<link rel=preload`, which gets the parser working for you sooner. Patterns like [PRPL](https://developers.google.com/web/fundamentals/performance/prpl-pattern/) are worth evaluating in order to ensure initial and subsequent navigations feel instant.

![Diagram showing client-side rendering affecting FCP and TTI](https://developers.google.com/web/updates/images/2019/02/rendering-on-the-web/client-rendering-tti.png)

The primary downside to Client-Side Rendering is that the amount of JavaScript required tends to grow as an application grows. This becomes especially difficult with the addition of new JavaScript libraries, polyfills and third-party code, which compete for processing power and must often be processed before a page’s content can be rendered. Experiences built with CSR that rely on large JavaScript bundles should consider [aggressive code-splitting](https://developers.google.com/web/fundamentals/performance/optimizing-javascript/code-splitting/), and be sure to lazy-load JavaScript - "serve only what you need, when you need it". For experiences with little or no interactivity, server rendering can represent a more scalable solution to these issues.

For folks building a Single Page Application, identifying core parts of the User Interface shared by most pages means you can apply the [Application Shell caching](https://developers.google.com/web/updates/2015/11/app-shell) technique. Combined with service workers, this can dramatically improve perceived performance on repeat visits.

## Combining server rendering and CSR via rehydration

Often referred to as Universal Rendering or simply "SSR”, this approach attempts to smooth over the trade-offs between Client-Side Rendering and Server Rendering by doing both. Navigation requests like full page loads or reloads are handled by a server that renders the application to HTML, then the JavaScript and data used for rendering is embedded into the resulting document. When implemented carefully, this achieves a fast First Contentful Paint just like Server Rendering, then "picks up” by rendering again on the client using a technique called [(re)hydration](https://docs.electrode.io/guides/general/server-side-data-hydration). This is a novel solution, but it can have some considerable performance drawbacks.

The primary downside of SSR with rehydration is that it can have a significant negative impact on Time To Interactive, even if it improves First Paint. SSR’d pages often look deceptively loaded and interactive, but can’t actually respond to input until the client-side JS is executed and event handlers have been attached. This can take seconds or even minutes on mobile.
"
Perhaps you’ve experienced this yourself - for a period of time after it looks like a page has loaded, clicking or tapping does nothing. This quickly becoming frustrating... _"Why is nothing happening? Why can’t I scroll?”_

### A Rehydration Problem: One App for the Price of Two

Rehydration issues can often be worse than delayed interactivity due to JS. In order for the client-side JavaScript to be able to accurately "pick up” where the server left off without having to re-request all of the data the server used to render its HTML, current SSR solutions generally serialize the response from a UI’s data dependencies into the document as script tags. The resulting HTML document contains a high level of duplication:

![HTML document
containing serialized UI, inlined data and a bundle.js script](https://developers.google.com/web/updates/images/2019/02/rendering-on-the-web/html.png)

As you can see, the server is returning a description of the application’s UI in response to a navigation request, but it’s also returning the source data used to compose that UI, and a complete copy of the UI’s implementation which then boots up on the client. Only after bundle.js has finished loading and executing does this UI become interactive.

Performance metrics collected from real websites using SSR rehydration indicate its use should be heavily discouraged. Ultimately, the reason comes down to User Experience: it's extremely easy to end up leaving users in an "uncanny valley”.

![Diagram showing client rendering negatively affecting TTI](https://developers.google.com/web/updates/images/2019/02/rendering-on-the-web/rehydration-tti.png)

There’s hope for SSR with rehydration, though. In the short term, only using SSR for highly cacheable content can reduce the TTFB delay, producing similar results to prerendering. Rehydrating [incrementally](https://www.emberjs.com/blog/2017/10/10/glimmer-progress-report.html), progressively, or partially may be the key to making this technique more viable in the future.



---
+ [edit](https://github.com/web-stream/www/edit/main/README.md)
+ [web-stream/www: Website about Webstreaming - WebStream.dev](https://github.com/web-stream/www)
```
https://github.com/web-stream/www.git
```
