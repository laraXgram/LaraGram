# LaraGram

LaraGram, an advanced framework for Telegram Bot development

# Feature

- sync & Async
    - Curl
    - Parallel Curl
    - AMPHP
    - OpenSwoole
- Webserver
- Support Bot Api Server
- Laravel Eloquent
    - Model
    - Migration
- Database
    - MySql
    - Redis
    - Json

# Installation

```
composer create-project laraxgram/laragram:dev-master@dev my-bot
```

---

# Get Start ...

### Terminal Command :

###### make and remove resource

```
php bot make:resource my-resource

php bot remove:resource my-resource
```

###### model and migration

```
php bot make:model User

php bot make:migration create_users_table
```

###### Server

* start Web server

If you are working on a local host, it is better to use this web server
Otherwise, Apache, Nginx, etc. web servers are a better option
```
php bot serve
```

* start Web server and Bot Api Server

```
php bot serve --api-server
```

* start Bot OpenSwoole Server

```
php bot serve --openswoole
```
Or
```
php bot start:openswoole
```
* Start Openswoole server and bot api server
```
php bot serve --openswoole --api-server
```

* start Bot Api Server

```
php bot start:apiserver
```

###### Webhook

* manage Webhook

```
php bot setWebhook

php bot deleteWebhook
```

###### Manage Dependency

* Database Eloquent

```
php bot get:eloqunet

php bot remove:eloqunet
```

* AMPHP

```
php bot get:amphp

php bot remove:amphp
```

* OpenSwoole

```
php bot get:openswoole

php bot remove:openswoole
```

---

### Handler :

- `on(array|string $message, callable $action)`
- `onText(array|string $message, callable $action)`
- `onCommand(array|string $command, callable $action)`
- `onAnimation(callable $action, array|string $file_id = null)`
- `onAudio(callable $action, array|string $file_id = null)`
- `onDocument(callable $action, array|string $file_id = null)`
- `onPhoto(callable $action, array|string $file_id = null)`
- `onSticker(callable $action, array|string $file_id = null)`
- `onVideo(callable $action, array|string $file_id = null)`
- `onVideoNote(callable $action, array|string $file_id = null)`
- `onVoice(callable $action, array|string $file_id = null)`
- `onContact(callable $action)`
- `onDice(callable $action, string|null $emoji = null, string|int|null $value = null)`
- `onGame(callable $action)`
- `onPoll(callable $action)`
- `onVenue(callable $action)`
- `onLocation(callable $action)`
- `onNewChatMembers(callable $action)`
- `onLeftChatMember(callable $action)`
- `onNewChatTitle(callable $action)`
- `onNewChatPhoto(callable $action)`
- `onDeleteChatPhoto(callable $action)`
- `onGroupChatCreated(callable $action)`
- `onSuperGroupChatCreated(callable $action)`
- `onMessageAutoDeleteTimerChanged(callable $action)`
- `onMigrateToChatId(callable $action)`
- `onMigrateFromChatId(callable $action)`
- `onPinnedMessage(callable $action)`
- `onInvoice(callable $action)`
- `onSuccessfulPayment(callable $action)`
- `onConnectedWebsite(callable $action)`
- `onPassportData(callable $action)`
- `onProximityAlertTriggered(callable $action)`
- `onForumTopicCreated(callable $action)`
- `onForumTopicEdited(callable $action)`
- `onForumTopicClosed(callable $action)`
- `onForumTopicReopened(callable $action)`
- `onVideoChatScheduled(callable $action)`
- `onVideoChatStarted(callable $action)`
- `onVideoChatEnded(callable $action)`
- `onVideoChatParticipantsInvited(callable $action)`
- `onWebAppData(callable $action)`

---

### Usage:

1. make a resource and open it
2. Create an instance of Bot()

```php
$bot = new Bot();
```

3. Start Coding

```php
$bot->onText('hello', function(Request $request){
  $request->sendMessage([
    'chat_id' => $request->ChatID(),
    'text'    => 'hi'
  ]);
});
```

* Use Variable

```php
$bot->onText('say {text}', function(Request $request, $text){
  $request->sendMessage([
    'chat_id' => $request->ChatID(),
    'text'    => $text
  ]);
});
```

* Pass Multiple Pattern

```php
$bot->onText(['hello', 'hay'], function(Request $request){
  $request->sendMessage([
    'chat_id' => $request->ChatID(),
    'text'    => 'hi'
  ]);
});
```

* Change Request Mode

##### Constant
| Type          | Name | Int |
|---------------|------|-----|
| Curl (defult) | `REQUEST_METHODE_CURL` | `32` |
| Parallel curl | `REQUEST_METHODE_PARALLEL_CURL` | `64` |
| AMPHP         | `REQUEST_METHODE_AMPHP` | `128` |
| OpenSwoole    | `REQUEST_METHODE_OPENSWOOLE` | `256` |


```php
$bot->onText(['hello', 'hay'], function(Request $request){
  $request->sendMessage([
    'chat_id' => $request->ChatID(),
    'text'    => 'hi'
  ], REQUEST_METHODE_PARALLEL_CURL);
});
```

### Use Redis :

* Simple Use :

```php
// init Redis Server
$redis = PhpRedis::connect();

// set
$redis->set('foo', 'bar');

//get
$data = $redis->get('foo'));
echo $data;
// Result : var
```

* Pass Db name:
```php
// init Redis Server with db name
$redis = PhpRedis::connect('dbname');
```

# Support & Contact:
* [Email](mailto:amirh.kargar895@gmail.com)
* [Telegram](https://telegram.me/Amirh_krgr)

# Updating ...
###### Version 1.4