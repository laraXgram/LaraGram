# LaraGram

### Telegram Bot API + MTProto + TMAs + Web Pages

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

LaraGram ships with complete documentation covering every major feature of the framework.

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

- 🚀 MTProto
- 🤖 Telegram Mini Apps (TMA) Development
- 🌐 Web Routing
- 🔐 Permission System (Gate & Policy)
- 🧠 Caching (7 Drivers) + Step Manager
- 🔁 Fluent Collections
- 💬 Conversations
- ⚙️ Concurrency System
- 💻 Console Commands & Task Scheduling
- 📦 Rewritten Eloquent ORM with Multi-DB Support
- 📐 Migrations, Seeders & Factories
- 🔒 Crypt & Hash Systems
- 📢 Event Dispatcher
- 📁 File System
- 🧭 Listener System (Routing-style)
- 📝 Logging, Queues, Jobs, Redis, Validation & i18n
- 🤖 Multi-bot Support + Config/Cache Optimization

---

#### Report bugs, help and support, suggestions and criticisms
> [Email](mailto:laraxgram@gmail.com) - [Issues](https://github.com/laraXgram/LaraGram/issues) - [Telegram Group](https://telegram.me/LaraGramChat)
