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
  - Migrations
- Database
  - MySql
  - Redis
  - Json
  -

---

# Installation

```
composer create-project laraxgram/laragram:dev-master@dev my-bot
```

---

# Get Start ...

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

| Type                             | Name                            | Int   |
|----------------------------------|---------------------------------|-------|
| Curl (Default)                   | `REQUEST_METHODE_CURL`          | `32`  |
| Parallel curl                    | `REQUEST_METHODE_PARALLEL_CURL` | `64`  |
| AMPHP                            | `REQUEST_METHODE_AMPHP`         | `128` |
| OpenSwoole ( Not available yet ) | `REQUEST_METHODE_OPENSWOOLE`    | `256` |

```php
$bot->onText(['hello', 'hay'], function(Request $request){
  $request->sendMessage([
    'chat_id' => $request->ChatID(),
    'text'    => 'hi'
  ], REQUEST_METHODE_PARALLEL_CURL);
});
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
// Result : bar
```

* Pass Db name:

```php
// init Redis Server with db name
$redis = PhpRedis::connect('dbname');
```

---

### Terminal Command :

###### make and remove resource

```
php laragram make:resource my-resource

php laragram remove:resource my-resource
```

###### Server

* start Web server

If you are working on a local host, it is better to use this web server
Otherwise, Apache, Nginx, etc. web servers are a better option ( For `php laragram serve` command only )

```
php laragram serve
```

* start Web server and Bot Api Server

```
php laragram serve --api-server
```

* start Bot OpenSwoole Server

```
php laragram serve --openswoole
```

Or

```
php laragram start:openswoole
```

* Start Openswoole server and bot api server

```
php laragram serve --openswoole --api-server
```

* start Bot Api Server

```
php laragram start:apiserver
```

###### Webhook

* manage Webhook

```
php laragram setWebhook

php laragram deleteWebhook
```

###### Manage Dependency

* Database Eloquent

```
php laragram get:eloqunet

php laragram remove:eloqunet
```

* AMPHP

```
php laragram get:amphp

php laragram remove:amphp
```

* OpenSwoole

```
php laragram get:openswoole

php laragram remove:openswoole
```

* Ext-Redis

```
php laragram get:redis

php laragram remove:redis
```

* Clean Vendor

Remove all extra dependencies

```
php laragram clear:vendor
```
* Make Api Controller
```
php laragram make:api ApiName

php laragram remove:api ApiName
```
1. Build an api controller
2. Open the created file ( path: App/Controller/Api )
3. Start writing ( a sample method has been created for you )

* Use Api In Resource File :
```php
$api = new Api();
$api->api('ApiName@MetodeName', $parameters);

// Helper 
api('ApiName@MetodeName', $parameters)
```
* Male Model

```
php laragram make:model User
```

* Make Migration

```
// Create table
php laragram make:migration create_users_table --create=users

// Edit table
php laragram make:migration edit_users_table --table=users
```

Note:
 * Note that the names of the migrations should be similar to the example above
   `create_{table_name}_table`
   `edit_{table_name}_table`
 * The table_name must be plural

1. Build an migration
2. Open the created file ( path: Database/Mysql/Migrations/ )
3. Start writing ( An example has been created for you )

 * It is better to learn to work with Eloquent and Laravel query builder
   Use the following links:

   [Eloquent](https://laravel.com/docs/master/eloquent) -- [Queries](https://laravel.com/docs/master/queries)

# Support & Contact:

* [Email](mailto:amirh.kargar895@gmail.com)
* [Telegram](https://telegram.me/Amirh_krgr)

# Updating ...

###### Version 1.6.1
