# LaraGram

> LaraGram, an advanced framework for Telegram Bot development

#### Report bugs, help and support, suggestions and criticisms

> [Email](mailto:laraxgram@gmail.com) - [Telegram](https://telegram.me/amirh_krgr) - [Issues](https://github.com/laraXgram/LaraGram/issues) - [Telegram Group](https://telegram.me/LaraGramChat)

# Feature

> - sync & Async
    >

- Curl

> - Parallel Curl
>    - AMPHP
>    - OpenSwoole
>- Development server
>- Support Local Bot Api Server
>- Laravel Eloquent
>

- Model

> - Migrations
>- Database
>

- MySql

> - Redis
>    - Json
>- Authentication
>

- Role

> - Auth
>    - Level
>- Controller
>

- Api

---

# Installation

```
composer create-project laraxgram/laragram:v1.9.x-dev@dev my-bot
```

---

### Handler :

> - `on(array|string $message, callable $action)`
>- `onText(array|string $message, callable $action)`
>- `onCommand(array|string $command, callable $action)`
>- `onAnimation(callable $action, array|string $file_id = null)`
>- `onAudio(callable $action, array|string $file_id = null)`
>- `onDocument(callable $action, array|string $file_id = null)`
>- `onPhoto(callable $action, array|string $file_id = null)`
>- `onSticker(callable $action, array|string $file_id = null)`
>- `onVideo(callable $action, array|string $file_id = null)`
>- `onVideoNote(callable $action, array|string $file_id = null)`
>- `onVoice(callable $action, array|string $file_id = null)`
>- `onContact(callable $action)`
>- `onDice(callable $action, string|null $emoji = null, string|int|null $value = null)`
>- `onGame(callable $action)`
>- `onPoll(callable $action)`
>- `onVenue(callable $action)`
>- `onLocation(callable $action)`
>- `onNewChatMembers(callable $action)`
>- `onLeftChatMember(callable $action)`
>- `onNewChatTitle(callable $action)`
>- `onNewChatPhoto(callable $action)`
>- `onDeleteChatPhoto(callable $action)`
>- `onGroupChatCreated(callable $action)`
>- `onSuperGroupChatCreated(callable $action)`
>- `onMessageAutoDeleteTimerChanged(callable $action)`
>- `onMigrateToChatId(callable $action)`
>- `onMigrateFromChatId(callable $action)`
>- `onPinnedMessage(callable $action)`
>- `onInvoice(callable $action)`
>- `onSuccessfulPayment(callable $action)`
>- `onConnectedWebsite(callable $action)`
>- `onPassportData(callable $action)`
>- `onProximityAlertTriggered(callable $action)`
>- `onForumTopicCreated(callable $action)`
>- `onForumTopicEdited(callable $action)`
>- `onForumTopicClosed(callable $action)`
>- `onForumTopicReopened(callable $action)`
>- `onVideoChatScheduled(callable $action)`
>- `onVideoChatStarted(callable $action)`
>- `onVideoChatEnded(callable $action)`
>- `onVideoChatParticipantsInvited(callable $action)`
>- `onWebAppData(callable $action)`
>- `onMessage(callable $action);`
>- `onMessageType(string|array $type, callable $action);`
>- `onEditedMessage(callable $action);`
>- `onChannelPost(callable $action);`
>- `onEditedChannelPost(callable $action);`
>- `onInlineQuery(callable $action);`
>- `onChosenInlineResult(callable $action);`
>- `onCallbackQuery(callable $action);`
>- `onCallbackQueryData(string|array $pattern, callable $action);`
>- `onShippingQuery(callable $action);`
>- `onPreCheckoutQuery(callable $action);`
>- `onPollAnswer(callable $action);`
>- `onMyChatMember(callable $action);`
>- `onChatMember(callable $action);`
>- `onChatJoinRequest(callable $action);`
>- `onAny(callable $action);`

---

# Get Start ...

* make and remove resource

```
php laragram make:resource my-resource

php laragram remove:resource my-resource
```

### Usage:

1. make a resource and open it --- **Path: `App/Resources`**
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

* Use Helper

```php
$bot->onText(['hello', 'hay'], function(){
  sendMessage([
    'chat_id' => ChatID(),
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

###### Server

* start Web server

> If you are working on a local host, it is better to use this web server
> Otherwise, Apache, Nginx, etc. web servers are a better option ( For `php laragram serve` command only )

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

**Or**

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

> 1. Build an api controller
>2. Open the created file ( path: App/Controller/Api )
>3. Start writing ( a sample method has been created for you )

* Use Api In Resource File :

```php
$api = new Api();
$api->api('ApiName@MetodeName', $parameters);

// Helper 
api('ApiName@MetodeName', $parameters)
```

---

* Make Model

```
php laragram make:model User
```

* Make Json Model

```
php laragram make:jsonModel User
```

* Make Migration

```
// Create table
php laragram make:migration create_users_table --create=users

// Edit table
php laragram make:migration edit_users_table --table=users

```

* Make Json Migration

```
// Create table
php laragram make:jsonMigration create_users_table --create=users

// Edit table
php laragram make:jsonMigration edit_users_table --table=users

```

> Note:
> * Note that the names of the migrations should be similar to the example above
    >   `create_{table_name}_table`
    >   `edit_{table_name}_table`
> * The table_name must be plural (`users`, `addresses`)
>
>
>1. Build an migration
>2. Open the created file ( path: Database/Mysql/Migrations/ for Mysql | path: Database/Json/Migrations/ for Json)
>3. Start writing ( An example has been created for you )
>
>* It is better to learn to work with Eloquent and Laravel query builder
   > Use the following links:
   >
   >  [Eloquent](https://laravel.com/docs/master/eloquent) -- [Queries](https://laravel.com/docs/master/queries)

* Migrate

```
// Mysql Migrate
php laragram migrate

// Json Migrate
php laragram migrate:json

```
---

### Authentication

> * Bot administrators and bot owners are those who are not admins or group owners, but have specific access to use the
    bot.

* Check Status

> - If the specified person is the admin of the group, it returns true

```php
Auth::isChatAdmin(int|string|null $user_id, int|string|null $chat_id)

// Helper
isChatAdmin()
```

---
> - If the specified person is the creator of the group, it returns true

```php
Auth::isChatCreator(int|string|null $user_id, int|string|null $chat_id)

// Helper
isChatCreator()
```

---
> - If the specified person is the member of the group, it returns true

```php
Auth::isChatMember(int|string|null $user_id, int|string|null $chat_id)

// Helper
isChatMember()
```

---
> - If the specified person is the kicked of the group, it returns true

```php
Auth::iskicked(int|string|null $user_id, int|string|null $chat_id)

// Helper
iskicked()
```

---
> - If the specified person is the restricted of the group, it returns true

```php
Auth::isRestricted(int|string|null $user_id, int|string|null $chat_id)

// Helper
isRestricted()
```

---
> - If the specified person is the left of the group, it returns true

```php
Auth::isLeft(int|string|null $user_id, int|string|null $chat_id)

// Helper
isLeft()
```

---
> - If the specified person is the admin of the bot, it returns true

```php
Auth::isBotAdmin(int|string|null $user_id, int|string|null $chat_id)

// Helper
isBotAdmin()
```

---
> - If the specified person is the owner of the bot, it returns true

```php
Auth::isBotOwner(int|string|null $user_id, int|string|null $chat_id)

// Helper
isBotOwner()
```

---
> If the entries are null, the sender of the message is considered to be in the current group.

> **Note:**
>1. **The admin and owner of the bot are authenticate based on the default database structure, whose migration is
    present in the project by default.**
>2. **Follow Laragram rules for proper functioning, otherwise you must use personal authentication system.**
>3. **In the future, we will try to make this dynamic.**

> - After you make a group member the bot admin or bot owner, you must save it in the database
    > You can do this easily with the following functions:
---

### Role

* Add new BotAdmin

```php
Role::addBotAdmin(int|string|null $user_id, int|string|null $chat_id)

// Helper
addBotAdmin()
```

---

* Add new BotOwner

```php
Role::addBotOwner(int|string|null $user_id, int|string|null $chat_id)

// Helper
addBotOwner()
```

---

* Remove BotAdmin or BotOwner

```php
Role::removeRole(int|string|null $user_id, int|string|null $chat_id)

// Helper
removeRole()
```

---

### Level

* Set User Level

```php
Role::setLevel(string|int $level, int|string|null $user_id, int|string|null $chat_id)

// Helper
setLevel()
```

---

* Remove User Level

```php
Role::removeLevel(int|string|null $user_id, int|string|null $chat_id)

// Helper
removeLevel()
```

---

### Assets Folder

* This folder is for storing photos, audio, videos, etc.
* It is available through the `assets()` function.
* For the calling address of `.` Use

```php
echo assets('path.to.image');

// Result:
// 'Assets/path/to/image.png'
```

---

### Common Helper

| Name                | Input                           | Description                        |
|---------------------|---------------------------------|------------------------------------|
| `mentionUserById()` | `user_id`, `text`, `parse_mode` | Mention the user with a numeric ID |
| `bold()`            | `text`, `parse_mode`            | Bold text                          |
| `italic()`          | `text`, `parse_mode`            | Italic text                        |
| `underline()`       | `text`                          | Underline text                     |
| `strikethrough()`   | `text`, `parse_mode`            | Strikethrough text                 |
| `spoiler()`         | `text`                          | Spoiler text                       |
| `pre()`             | `text`, `lang`, `parse_mode`    | Pre text                           |
| `code()`            | `text`, `parse_mode`            | Code text                          |
| `inlineurl()`       | `text`, `url`, `parse_mode`     | Creating linked text               |

---

### KeyBoard Builder

```php
$keyboard = Keyboard::inlineKeyboardMarkup(
    Make::row(
        Make::col('btn1', callback_data: '1'),
        Make::col('btn2', url: 'https://google.com')
    ),
    Make::row(
        Make::col('btn3', web_app: []),
        Make::col('btn4', switch_inline_query_current_chat: 'test')
    )
    // etc...
);
```

* With Helper:

```php
 $keyboard = inlineKeyboardMarkup(
    row(
        col('btn1', callback_data: '1'),
        col('btn2', url: 'https://google.com')
    ),
    row(
        col('btn3', web_app: []),
        col('btn4', switch_inline_query_current_chat: 'test')
    )
    // etc...
);
```

---

### Json Eloquent

* Create an instance of Database Model:

```php
$message = new Message();
```

> Insert new data :
```php
$message->create([
    "id"     => 1,
    "status" => "active"
]);
```

> Conditional methode (where & orWhere) and get :
```php
// And
$message
    ->where('id', '=', '1')
    ->where('status', '=', 'active')
    // ...
    ->get();
```

```php
// Or
$message
    ->where('id', '=', '1')
    ->orWhere('status', '=', 'active')
    // ...
    ->get();
```

| Operator         | Operator |
|------------------|--------|
| =                | !=     |
| ==               | ===    |
| !==              | \>     |
| \>=               | <      |
| <=                |        |
**Note: = & == is same!** 


> Update data :
```php
$message
    ->where('id', '=', '1')
    ->update('status', 'not active');
```

> Delete data :
```php
$message
    ->where('id', '=', '1')
    ->delete();
```

> Select first row of data:
```php
$message
    ->where('id', '=', '1')
    ->first();
```

> Select all data :
```php
$message->all();
```

> Count all data :
```php
$message->rowCount();
```

> Count selected data :
```php
$message
    ->where('id', '=', '1')
    ->count();
```

> Empty column :
```php
$message
    ->where('id', '=', '1')
    ->empty('status');
```

> Truncate all data :
```php
$message->truncate();
```
---
### Model property

```php
// If the model name and json name are not the same, set the database name
protected string $database = 'Message';

// set fillable keys
protected array $fillable = ['status'];

// set guarded keys
protected array $guarded = ['id'];
```
---
### Json Migrations

* create table :
```php
JsonSchema::create('column_name', function (JsonBlueprint $table) {
    // create column with string type
    $table->string('name');
    
    // create column with integer type
    $table->integer('name');
    
    // create column with array type
    $table->array('name');
    
    // create column with boolean type
    $table->boolean('name');
    
    // create column with double type
    $table->double('name');
    
    // create column with object type
    $table->object('name');
    
    // create column with any type
    $table->any('name');
    
    // make nullable column 
    $table->string('name')->nullable();
    
    // set default value for column
    $table->string('name')->default('default value');
    
    // make unique column
    $table->string('name')->unique();
    
    // make auto increment column
    $table->integer('id')->autoIncrement();
    
    // make auto increment column with start number
    $table->integer('id')->autoIncrement(100);
    
    // Note: autoIncrement must be an integer
});
```
* edit table :
```php
JsonSchema::table('column_name', function (JsonBlueprint $table) {
    // Code ...
});
```
---

# Support & Contact:

> * [Email](mailto:laraxgram@gmail.com)
>* [Telegram](https://telegram.me/Amirh_krgr)
---

# Updating ...

---

> ###### Version 1.10.0
