# LaraGram

### The full-stack framework for Telegram bots — AI-ready

LaraGram is a PHP framework for building Telegram bots with an expressive, elegant syntax. Listen to updates the way you define routes, reply with templates and keyboards, guide users through conversations, and broadcast to every chat — and when your bot grows, add AI agents, MTProto userbots, Telegram Mini Apps, APIs and admin panels to the same codebase.

```php
# listens/bot.php

use LaraGram\Request\Request;
use LaraGram\Support\Facades\Bot;

Bot::onCommand('start', function (Request $request) {
    $request->sendMessage(chat()->id, 'Hello LaraGram!');
});

Bot::onText('say {text}', function (Request $request, string $text) {
    $request->sendMessage(chat()->id, $text);
});
```
---
### 📚 Official Documentation

LaraGram ships with complete documentation covering every major feature of the framework.

👉 [Documentation](https://laraxgram.github.io/v4/installation)

👉 [What's new in LaraGram 4](https://laraxgram.github.io/v4/releases#laragram-4)

👉 [Telegram support group](https://telegram.me/LaraGramChat)

---
# ✳️ Installation :

LaraGram 4 requires PHP 8.3 or later and Composer.

```bash
composer global require laraxgram/installer

laragram new my-bot
```

The installer configures your bot token and webhook, and optionally a local Bot API server, MTProto, a Mini App starter kit (React, Vue or Svelte), API routes, LaraGram Brain, Surge and your database. Then start everything you need for local development with:

```bash
php laragram dev
```
---
# ✨ What You Can Build

### 🤖 Telegram Bots
Everything a bot needs, built in.
- 🧭 **Listening system** modeled on routing — commands, text patterns, callback queries, payments, chat members and every other update type, with middleware, controllers, validation and rate limiting
- 📡 **Typed Bot API client** generated from the Bot API itself — responses as objects, failures such as flood waits or blocked bots as typed exceptions
- ⌨️ **Keyboard builder** for inline and reply keyboards
- 🧩 **Temple8 templates** with a Blade-like syntax, plus Telegram **rich messages** with tables, lists and checklists
- 💬 **Conversations & Step Manager** for multi-step flows that validate every answer
- 📢 **Broadcasting** to all users, groups or channels — queued, paced against flood limits, filterable, schedulable and trackable
- 🔁 **Multi-bot support**, webhook or long polling, and an optional local Bot API server

```php
use LaraGram\Keyboard\Make;
use LaraGram\Request\Request;
use LaraGram\Support\Facades\Bot;
use LaraGram\Support\Facades\Keyboard;

Bot::onCommand('menu', function (Request $request) {
    $keyboard = Keyboard::inlineKeyboardMarkup(
        Make::row(
            Make::callbackData('👋 Say hello', 'hello'),
        )
    )->get();

    $request->sendMessage(chat()->id, 'What would you like to do?', reply_markup: $keyboard);
});

Bot::onCallbackQueryData('hello', function (Request $request) {
    $request->answerCallbackQuery();
    $request->sendMessage(user()->id, 'Hello '.user()->first_name.'!');
});
```

```php
use LaraGram\Conversation\AnswersBag;
use LaraGram\Conversation\Questioner;
use LaraGram\Request\Request;
use LaraGram\Support\Facades\Bot;
use LaraGram\Support\Facades\Conversation;

Bot::onCommand('feedback', function () {
    Conversation::inline(function (Questioner $q) {
        $q->ask('What went wrong?')->name('issue');
        $q->ask('How can we reach you?')->name('contact');
    })
    ->onComplete(function (Request $request, AnswersBag $answers) {
        $request->sendMessage(user()->id, 'Thanks for your feedback!');
    })
    ->start();
});
```

```php
Broadcast::users()->sendMessage('We just shipped a new feature! 🎉')->queue();
```

### 🧠 AI-Ready
Build AI features into your bot — and let AI help you build it.
- **AI SDK** — agents with tools and structured output for OpenAI, Anthropic, Gemini and more. Answers stream into the chat, photos, documents and voice messages become input, and an agent may reply with a quiz, a poll, a keyboard or an invoice. Tool calls can be approved with inline buttons — over the Bot API and MTProto alike.
- **MCP** — expose your application to AI clients with your own tools, resources and prompts, plus ready-made Telegram tool sets for the Bot API and MTProto.
- **Brain** — gives your coding agent LaraGram's conventions, offline documentation search, and tools to run your bot locally (list listens, simulate updates, render templates) without a single call reaching Telegram.

```php
// An AI assistant that answers every message, in one line
Bot::agent(SupportAgent::class);

Bot::onText('/draw {prompt}', fn (string $prompt) => Image::of($prompt)->generate());

Bot::onVoice(fn (Request $request) => Transcription::fromUpload($request->file())->generate());
```

### 🚀 MTProto & Userbots
Go beyond the Bot API and act as a real Telegram client.
- Log in as a user (phone + 2FA or QR) or as a bot over MTProto
- Read full chat history, list every dialog, download files of any size
- Receive hundreds of update types: typing, read receipts, reactions, stories…
- Run many user and bot accounts in one process
- **LaraGram API Server** — your own Bot API server written in PHP on top of MTProto, a drop-in replacement for the official `telegram-bot-api`

```php
# listens/client.php

use LaraGram\MTProto\Facades\Client;
use LaraGram\MTProto\Foundation\ClientRequest;

Client::onText('hello', function (ClientRequest $request) {
    $request->sendMessage(peer: $request->chatId(), message: 'hi 👋');
});
```

### 📱 Telegram Mini Apps
Build Mini Apps with React, Vue or Svelte through **Luna** — no separate API to write.
- Init data validated on every request, the Telegram user available on the server and in the frontend
- Telegram theme, MainButton, back button and closing confirmation
- CloudStorage, biometrics, location, sensors, popups, sharing and payments
- Starter kits to scaffold a Mini App in minutes

```php
# routes/web.php

Route::middleware('telegram')->group(function () {
    Route::get('/', [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update']);
});
```

### 🔌 APIs
- API routes, API resources and pagination
- **Citadel** — personal access tokens with abilities, a complete OAuth2 server, SPA sessions and Telegram Mini App authentication behind one guard
- An expressive HTTP client for calling other services

```php
# routes/api.php

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:citadel');
```

### 🖥️ Web Pages & Admin Panels
Build the website, dashboard or admin panel of your bot in the same project.
- Web routing, controllers, middleware, HTTP requests & responses
- Blade views and Luna SPAs (React, Vue, Svelte) with Vite asset bundling
- Sessions, CSRF protection, authentication and authorization (Gate & Policy)
- Pagination with Tailwind and Bootstrap views, and live Precognition validation

```php
# routes/web.php

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/users', fn () => Luna::render('Admin/Users', [
        'users' => User::latest()->paginate(20),
    ]));
});
```

### 🧱 Foundation
- 📦 Eloquent ORM for MySQL, MariaDB, PostgreSQL, SQLite & SQL Server (+ MongoDB)
- 📐 Migrations, seeders & factories
- ⏱️ Queues, jobs, task scheduling & concurrency
- 🧠 Cache, Redis, events, file storage & image manipulation
- 📝 Logging, validation & localization
- 🔒 Encryption & hashing
- 💻 Commander console & Probe REPL

### 🛠️ Ecosystem
- ⚡ **Surge** — serve bot updates and web requests from memory (Swoole, Open Swoole, RoadRunner, FrankenPHP)
- 🛡️ **Sentinel** — update debugger, metrics monitor & Redis queue supervisor in one web dashboard
- 🐕 **Watchdog** — real-time logs in your terminal and in Telegram

---

#### Report bugs, help and support, suggestions and criticisms
> [Email](mailto:laraxgram@gmail.com) - [Issues](https://github.com/laraXgram/LaraGram/issues) - [Telegram Group](https://telegram.me/LaraGramChat)
