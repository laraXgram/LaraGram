From now on, LaraGram is truly a **Framework**!

```php 
# listens/bot.php

use LaraGram\Request\Request;
use LaraGram\Support\Facades\Bot;

Bot::onText('hello', function (Request $request) {
    $request->sendMessage(chat()->id, 'hi');
});
```
---
### 📢 Notice: Documentation in Progress

Our official documentation is currently under development.
In the meantime, you can temporarily refer to the [Laravel documentation](https://laravel.com/docs/12.x) or reach out to our [Telegram support group](https://telegram.me/LaraGramChat) for assistance and updates.

##### Thank you for your patience and support!

---
# ✳️ Installation :
```bash
composer create-project laraxgram/laragram my-bot
```
---

#### Report bugs, help and support, suggestions and criticisms
> [Email](mailto:laraxgram@gmail.com) - [Issues](https://github.com/laraXgram/LaraGram/issues) - [Telegram Group](https://telegram.me/LaraGramChat)
