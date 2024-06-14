### A Fresh Start with the Rewritten LaraGram

**Some changes include:**

- Addition of a container for dependency management
- Addition of service providers
- Addition of facades for easy access to methods
- Addition of commands for simple usage of the framework


From now on, LaraGram is truly a **Framework**!

```php 
# App/Resources/bot.php

use LaraGram\Request\Request;
use LaraGram\Support\Facades\Bot;

Bot::onText('hello', function (Request $request) {
    $request->sendMessage($request->message->chat->id, 'hi');
});
```


> **Wait for the document ...**

![LaraGram](Assets/Image/LaraGram.png)

---

#### Report bugs, help and support, suggestions and criticisms
> [Email](mailto:laraxgram@gmail.com) - [Telegram](https://telegram.me/amirh_krgr) - [Issues](https://github.com/laraXgram/LaraGram/issues) - [Telegram Group](https://telegram.me/LaraGramChat)
---
###### Version 2.0.0

---