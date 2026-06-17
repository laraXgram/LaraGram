From now on, LaraGram is truly a ***Framework***! 🚀

```php 
# listens/bot.php

use LaraGram\Request\Request;
use LaraGram\Support\Facades\Bot;

Bot::onText('say {text}', function (Request $request, $text) {
    $request->sendMessage(chat()->id, $text);
});
```
---
### 📚 Official Documentation

LaraGram now ships with complete documentation covering every major feature of the framework.

👉 [Documentation](https://laraxgram.github.io)

👉 [Telegram support group](https://telegram.me/LaraGramChat)

---
# ✳️ Installation :
```bash
composer global require laraxgram/installer

laragram new my-bot
```
---
# ✨ Key Features at a Glance

- 🔐 Permission system (Gate & Policy)
- 🧠 Caching (7 drivers) + Step Manager
- 🔁 Fluent Collections
- ⚙️ Concurrency system
- 💻 Console commands & task scheduling
- 📦 Rewritten Eloquent ORM with multi-DB support
- 📐 Migrations, Seeders, Factories
- 🔒 Crypt & Hash systems
- 📢 Event Dispatcher
- 📁 File system
- 🧭 Listener system (routing-style)
- 📝 Logging, Queues, Jobs, Redis, Validation, i18n
- 🤖 Multi-bot support + config/cache optimization

---

#### Report bugs, help and support, suggestions and criticisms
> [Email](mailto:laraxgram@gmail.com) - [Issues](https://github.com/laraXgram/LaraGram/issues) - [Telegram Group](https://telegram.me/LaraGramChat)
