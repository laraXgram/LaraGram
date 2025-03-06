### Version 3 tasks

- [x] Add Console kernel
- [ ] Add HTTP Kernel
- [ ] Add AMPHP and Fiber request method
- [ ] Add Middlewares
- [ ] Add Multi Bot development capability
- [ ] Add Broadcasting
- [x] Add Queue and Job
- [x] Add RateLimiter
- [x] Add Command Scheduling
- [x] Add Concurrency
- [x] Add Multilingual capability
- [x] Add Logging
- [x] Custom rewrite of Eloquent ORM
- [x] Structural changes in project files
- [ ] Optimization and development of the caching system
- [ ] Rewrite documentation -> Under construction
- [ ] ???

From now on, LaraGram is truly a **Framework**!

```php 
# App/Resources/bot.php

use LaraGram\Request\Request;
use LaraGram\Support\Facades\Bot;

Bot::onText('hello', function (Request $request) {
    $request->sendMessage($request->message->chat->id, 'hi');
});
```
---

# ✳️ Installation :
```bash
composer create-project laraxgram/laragram my-bot
```
---

# ⭐ Features & 📙 Document :
Some of the following features have not yet been added to version 2 and are being rewritten. They are marked with `*`. All of them will be added in the next few steps.
### [Config](https://github.com/laraXgram/Document/blob/v1.10/config.md)
- [Config files](https://github.com/laraXgram/Document/blob/v1.10/config.md#config-files)
- [SetWebhook](https://github.com/laraXgram/Document/blob/v1.10/config.md#setwebhook)
---
- Support Local Bot Api Server

---
### Terminal Commands
- [Manage Resources](https://github.com/laraXgram/Document/blob/v1.10/commands.md#manage-resource)
- [Manage Webhook](https://github.com/laraXgram/Document/blob/v1.10/commands.md#manage-webhook)
- [Manage Dependency](https://github.com/laraXgram/Document/blob/v1.10/commands.md#manage-dependency)*
- [Manage Api Controller](https://github.com/laraXgram/Document/blob/v1.10/commands.md#manage-api-controller)*
- [Manage Models](https://github.com/laraXgram/Document/blob/v1.10/commands.md#manage-model)
- [Manage Migrations](https://github.com/laraXgram/Document/blob/v1.10/commands.md#manage-migrations)
- [Manage Factories](https://github.com/laraXgram/Document/blob/v1.10/commands.md#manage-factories)
- [Manage Seeders](https://github.com/laraXgram/Document/blob/v1.10/commands.md#manage-seeder)
- [Manage WebServer](https://github.com/laraXgram/Document/blob/v1.10/commands.md#webserver)
- [Manage Service Provider](https://github.com/laraXgram/Document/blob/v1.10/commands.md#service-provider)
---
### [Request Methods](https://github.com/laraXgram/Document/blob/v1.10/methods.md#change-request-method)
- Curl
- Non-Response Curl
---
### Method
- [Listeners](https://github.com/laraXgram/Document/blob/v1.10/methods.md#listeners)
- [Methods](https://github.com/laraXgram/Document/blob/v1.10/methods.md#methods)
- [Updates](https://github.com/laraXgram/Document/blob/v1.10/methods.md#updates)
---
### [Databases](https://github.com/laraXgram/Document/blob/v1.10/databases.md)
- [Laravel Eloquent (recommended & default)](https://github.com/laraXgram/Document/blob/v1.10/eloquent.md)
    - Model
    - Migrations
    - Factories
    - Seeders
- [Redis](https://github.com/laraXgram/Document/blob/v1.10/redis.md)*
- [Json (exclusive)](https://github.com/laraXgram/Document/blob/v1.10/json.md)
    - Model
    - Migrations
---
### [Authentication & Accessibility](https://github.com/laraXgram/Document/blob/v1.10/authentication.md)
- [Auth](https://github.com/laraXgram/Document/blob/v1.10/authentication.md#check-status)
- [Role](https://github.com/laraXgram/Document/blob/v1.10/authentication.md#role)
- [Level](https://github.com/laraXgram/Document/blob/v1.10/authentication.md#level)
---
- [API Controller](https://github.com/laraXgram/Document/blob/v1.10/api.md#api-controller)*
---
- [Keyboard Builder](https://github.com/laraXgram/Document/blob/v1.10/keyboard.md)
---
### [Helpers](https://github.com/laraXgram/Document/blob/v1.10/helpers.md)
- [Messages Style](https://github.com/laraXgram/Document/blob/v1.10/helpers.md#style)
- [Date Timer](https://github.com/laraXgram/Document/blob/v1.10/helpers.md#timer)
- [Keyboard Builder](https://github.com/laraXgram/Document/blob/v1.10/helpers.md#keyboard)
- [Methods](https://github.com/laraXgram/Document/blob/v1.10/helpers.md#methods)
- [Updates](https://github.com/laraXgram/Document/blob/v1.10/helpers.md#updates)
---

![LaraGram](Assets/Image/LaraGram.png)

---

#### Report bugs, help and support, suggestions and criticisms
> [Email](mailto:laraxgram@gmail.com) - [Telegram](https://telegram.me/amirh_krgr) - [Issues](https://github.com/laraXgram/LaraGram/issues) - [Telegram Group](https://telegram.me/LaraGramChat)
---
###### Version 2.0.0

---
