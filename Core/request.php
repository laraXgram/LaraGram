<?php

namespace Bot\Core;

use Amp\Loop;
use Bot\Core\Connect\Amphp;
use Bot\Core\Connect\Openswoole;

/**
 * Telegram Bot Class.
 *
 * @author Gabriele Grillo <gabry.grillo@alice.it>
 */
class Request
{
    /**
     * Constant for type Inline Query.
     */
    const INLINE_QUERY = 'inline_query';
    /**
     * Constant for type Callback Query.
     */
    const CALLBACK_QUERY = 'callback_query';
    /**
     * Constant for type Edited Message.
     */
    const EDITED_MESSAGE = 'edited_message';
    /**
     * Constant for type Reply.
     */
    const REPLY = 'reply';
    /**
     * Constant for type Message.
     */
    const MESSAGE = 'message';
    /**
     * Constant for type Photo.
     */
    const PHOTO = 'photo';
    /**
     * Constant for type Video.
     */
    const VIDEO = 'video';
    /**
     * Constant for type Audio.
     */
    const AUDIO = 'audio';
    /**
     * Constant for type Voice.
     */
    const VOICE = 'voice';
    /**
     * Constant for type animation.
     */
    const ANIMATION = 'animation';
    /**
     * Constant for type sticker.
     */
    const STICKER = 'sticker';
    /**
     * Constant for type Document.
     */
    const DOCUMENT = 'document';
    /**
     * Constant for type Location.
     */
    const LOCATION = 'location';
    /**
     * Constant for type Contact.
     */
    const CONTACT = 'contact';
    /**
     * Constant for type Channel Post.
     */
    const CHANNEL_POST = 'channel_post';
    /**
     * Constant for type New Chat Member.
     */
    const NEW_CHAT_MEMBER = 'new_chat_member';
    /**
     * Constant for type Left Chat Member.
     */
    const LEFT_CHAT_MEMBER = 'left_chat_member';
    /**
     * Constant for type My Chat Member.
     */
    const MY_CHAT_MEMBER = 'my_chat_member';

    private $bot_token = '';
    private $data = [];
    private $updates = [];
    private $proxy;
    private $update_type;
    private $request_mode = 'curl_sendAPIRequest';

    private static $instance;

    /// Class constructor

    /**
     * Create a Telegram instance from the bot token
     * \param $bot_token the bot token
     * \param $log_errors enable or disable the logging
     * \param $proxy array with the proxy configuration (url, port, type, auth)
     * \return an instance of the class.
     */
    public function __construct($bot_token = null, array $proxy = [])
    {
        if (is_null($bot_token)) {
            $this->bot_token = $_ENV['BOT_TOKEN'];
        } else {
            $this->bot_token = $bot_token;
        }
        $this->data = $this->getData();
        $this->proxy = $proxy;
    }

    public static function getInstance(): Request
    {
        if (self::$instance === null){
            self::$instance = new Request();
        }
        return self::$instance;
    }

    /// Do requests to Telegram Bot API

    /**
     * Contacts the various API's endpoints
     * \param $api the API endpoint
     * \param $content the request parameters as array
     * \param $post boolean tells if $content needs to be sends
     * \return the JSON Telegram's reply.
     */
    public function endpoint($methode, array $content, $post = true, $mode = REQUEST_METHODE_CURL)
    {
        if ($mode === 32 || is_null($mode)) {
            $this->request_mode = 'curl_sendAPIRequest';
        } elseif ($mode === 64) {
            $this->request_mode = 'noResponseCurl_sendAPIRequest';
        } elseif ($mode === 128) {
            $this->request_mode = 'amphp_sendAPIRequest';
        } elseif ($mode === 256) {
            $this->request_mode = 'openswoole_sendAPIRequest';
        }

        if (str_ends_with('/', $_ENV['BOT_API_SERVER'])){
            $url = $_ENV['BOT_API_SERVER'] . 'bot' . $this->bot_token . '/' . $methode;
        }else{
            $url = $_ENV['BOT_API_SERVER'] . '/bot' . $this->bot_token . '/' . $methode;
        }

        if ($post) {
            $reply = $this->{$this->request_mode}($url, $content);
        } else {
            $reply = $this->{$this->request_mode}($url, [], false);
        }

        return json_decode($reply, true);
    }

    /// A method for testing your bot.

    /**
     * See <a href="https://core.telegram.org/bots/api#getme">getMe</a>
     * \return the JSON Telegram's reply.
     */
    public function getMe()
    {
        return $this->endpoint('getMe', [], false);
    }

    /**
     * See <a href="https://core.telegram.org/bots/api#logout">logOut</a>
     * \return the JSON Telegram's reply.
     */
    public function logOut()
    {
        return $this->endpoint('logOut', [], false);
    }

    /**
     * See <a href="https://core.telegram.org/bots/api#close">close</a>
     * \return the JSON Telegram's reply.
     */
    public function close()
    {
        return $this->endpoint('close', [], false);
    }

    /// A method for responding http to Telegram.

    /**
     * \return the HTTP 200 to Telegram.
     */
    public function respondSuccess(): false|string
    {
        http_response_code(200);

        return json_encode(['status' => 'success']);
    }

    /// Send a message

    /**
     * @param array $content array of <a href="https://core.telegram.org/bots/api#sendmessage">sendMessage</a> content
     * @param int $mode REQUEST_METHODE_CURL
     * @return Json the JSON Telegram's reply.
     */
    public function sendMessage(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('sendMessage', $content, true, $mode);
    }

    /// Copy a message

    /**
     * See <a href="https://core.telegram.org/bots/api#copymessage">copyMessage</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function copyMessage(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('copyMessage', $content, true, $mode);
    }

    /// Forward a message

    /**
     * See <a href="https://core.telegram.org/bots/api#forwardmessage">forwardMessage</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function forwardMessage(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('forwardMessage', $content, true, $mode);
    }

    /// Send a photo

    /**
     * See <a href="https://core.telegram.org/bots/api#sendphoto">sendPhoto</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function sendPhoto(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('sendPhoto', $content, true, $mode);
    }

    /// Send an audio

    /**
     * See <a href="https://core.telegram.org/bots/api#sendaudio">sendAudio</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function sendAudio(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('sendAudio', $content, true, $mode);
    }

    /// Send a document

    /**
     * See <a href="https://core.telegram.org/bots/api#senddocument">sendDocument</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function sendDocument(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('sendDocument', $content, true, $mode);
    }

    /// Send an animation

    /**
     * See <a href="https://core.telegram.org/bots/api#sendanimation">sendAnimation</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function sendAnimation(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('sendAnimation', $content, true, $mode);
    }

    /// Send a sticker

    /**
     * See <a href="https://core.telegram.org/bots/api#sendsticker">sendSticker</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function sendSticker(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('sendSticker', $content, true, $mode);
    }

    /// Send a video

    /**
     * See <a href="https://core.telegram.org/bots/api#sendvideo">sendVideo</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function sendVideo(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('sendVideo', $content, true, $mode);
    }

    /// Send a voice message

    /**
     * See <a href="https://core.telegram.org/bots/api#sendvoice">sendVoice</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function sendVoice(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('sendVoice', $content, true, $mode);
    }

    /// Send a location

    /**
     * See <a href="https://core.telegram.org/bots/api#sendlocation">sendLocation</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function sendLocation(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('sendLocation', $content, true, $mode);
    }

    /// Edit Message Live Location

    /**
     * See <a href="https://core.telegram.org/bots/api#editmessageliveLocation">editMessageLiveLocation</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function editMessageLiveLocation(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('editMessageLiveLocation', $content, true, $mode);
    }

    /// Stop Message Live Location

    /**
     * See <a href="https://core.telegram.org/bots/api#stopmessagelivelocation">stopMessageLiveLocation</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function stopMessageLiveLocation(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('stopMessageLiveLocation', $content, true, $mode);
    }

    /// Set Chat Sticker Set

    /**
     * See <a href="https://core.telegram.org/bots/api#setchatstickerset">setChatStickerSet</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function setChatStickerSet(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('setChatStickerSet', $content, true, $mode);
    }

    /// Delete Chat Sticker Set

    /**
     * See <a href="https://core.telegram.org/bots/api#deletechatstickerset">deleteChatStickerSet</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function deleteChatStickerSet(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('deleteChatStickerSet', $content, true, $mode);
    }

    /// Send Media Group

    /**
     * See <a href="https://core.telegram.org/bots/api#sendmediagroup">sendMediaGroup</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function sendMediaGroup(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('sendMediaGroup', $content, true, $mode);
    }

    /// Send Venue

    /**
     * See <a href="https://core.telegram.org/bots/api#sendvenue">sendVenue</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function sendVenue(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('sendVenue', $content, true, $mode);
    }

    //Send contact

    /**
     * See <a href="https://core.telegram.org/bots/api#sendcontact">sendContact</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function sendContact(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('sendContact', $content, true, $mode);
    }

    //Send a poll

    /**
     * See <a href="https://core.telegram.org/bots/api#sendpoll">sendPoll</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function sendPoll(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('sendPoll', $content, true, $mode);
    }

    //Send a dice

    /**
     * See <a href="https://core.telegram.org/bots/api#senddice">sendDice</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function sendDice(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('sendDice', $content, true, $mode);
    }

    /// Send a chat action

    /**
     * See <a href="https://core.telegram.org/bots/api#sendchataction">sendChatAction</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function sendChatAction(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('sendChatAction', $content, true, $mode);
    }

    /// Get a list of profile pictures for a user

    /**
     * See <a href="https://core.telegram.org/bots/api#getuserprofilephotos">getUserProfilePhotos</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function getUserProfilePhotos(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('getUserProfilePhotos', $content, true, $mode);
    }

    /// Use this method to get basic info about a file and prepare it for downloading

    /**
     *  Use this method to get basic info about a file and prepare it for downloading. For the moment, bots can download files of up to 20MB in size. On success, a File object is returned. The file can then be downloaded via the link https://api.telegram.org/file/bot<token>/<file_path>, where <file_path> is taken from the response. It is guaranteed that the link will be valid for at least 1 hour. When the link expires, a new one can be requested by calling getFile again.
     * \param $file_id String File identifier to get info about
     * \return the JSON Telegram's reply.
     */
    public function getFile($file_id, int $mode = REQUEST_METHODE_CURL)
    {
        $content = ['file_id' => $file_id];

        return $this->endpoint('getFile', $content, true, $mode);
    }

    /// Kick Chat Member

    /**
     * Deprecated
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function kickChatMember(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('kickChatMember', $content, true, $mode);
    }

    /// Leave Chat

    /**
     * See <a href="https://core.telegram.org/bots/api#leavechat">leaveChat</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function leaveChat(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('leaveChat', $content, true, $mode);
    }

    /// Ban Chat Member

    /**
     * See <a href="https://core.telegram.org/bots/api#banchatmember">banChatMember</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function banChatMember(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('banChatMember', $content, true, $mode);
    }

    /// Unban Chat Member

    /**
     * See <a href="https://core.telegram.org/bots/api#unbanchatmember">unbanChatMember</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function unbanChatMember(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('unbanChatMember', $content, true, $mode);
    }

    /// Get Chat Information

    /**
     * See <a href="https://core.telegram.org/bots/api#getchat">getChat</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function getChat(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('getChat', $content, true, $mode);
    }

    /// Get chat Administrators

    /**
     * See <a href="https://core.telegram.org/bots/api#getchatadministrators">getChatAdministrators</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function getChatAdministrators(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('getChatAdministrators', $content, true, $mode);
    }

    /// Get chat member count

    /**
     * See <a href="https://core.telegram.org/bots/api#getchatmembercount">getChatMemberCount</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function getChatMemberCount(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('getChatMemberCount', $content, true, $mode);
    }

    /**
     * For retrocompatibility
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function getChatMembersCount(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('getChatMemberCount', $content, true, $mode);
    }

    /**
     * See <a href="https://core.telegram.org/bots/api#getchatmember">getChatMember</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function getChatMember(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('getChatMember', $content, true, $mode);
    }

    /**
     * See <a href="https://core.telegram.org/bots/api#answerinlinequery">answerInlineQuery</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function answerInlineQuery(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('answerInlineQuery', $content, true, $mode);
    }

    /// Set Game Score

    /**
     * See <a href="https://core.telegram.org/bots/api#setgamescore">setGameScore</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function setGameScore(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('setGameScore', $content, true, $mode);
    }

    /// Get Game Hi Scores

    /**
     * See <a href="https://core.telegram.org/bots/api#getgamehighscores">getGameHighScores</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function getGameHighScores(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('getGameHighScores', $content, true, $mode);
    }

    /// Answer a callback Query

    /**
     * See <a href="https://core.telegram.org/bots/api#answercallbackquery">answerCallbackQuery</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function answerCallbackQuery(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('answerCallbackQuery', $content, true, $mode);
    }

    /// Set the list of the bot commands

    /**
     * See <a href="https://core.telegram.org/bots/api#setmycommands">setMyCommands</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function setMyCommands(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('setMyCommands', $content, true, $mode);
    }

    /// Delete the list of the bot commands

    /**
     * See <a href="https://core.telegram.org/bots/api#deletemycommands">deleteMyCommands</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function deleteMyCommands(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('deleteMyCommands', $content, true, $mode);
    }

    /// Get the list of the bot commands

    /**
     * See <a href="https://core.telegram.org/bots/api#getmycommands">getMyCommands</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function getMyCommands(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('getMyCommands', $content, true, $mode);
    }

    /// Set the chat menu button

    /**
     * See <a href="https://core.telegram.org/bots/api#setchatmenubutton">setChatMenuButton</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function setChatMenuButton(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('setChatMenuButton', $content, true, $mode);
    }

    /// Get the chat menu button

    /**
     * See <a href="https://core.telegram.org/bots/api#getchatmenubutton">getChatMenuButton</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function getChatMenuButton(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('getChatMenuButton', $content, true, $mode);
    }

    /// Set the default aministrator rights

    /**
     * See <a href="https://core.telegram.org/bots/api#setmydefaultadministratorrights">setMyDefaultAdministratorRights</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function setMyDefaultAdministratorRights(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('setMyDefaultAdministratorRights', $content, true, $mode);
    }

    /// Get the default aministrator rights

    /**
     * See <a href="https://core.telegram.org/bots/api#getmydefaultadministratorrights">getMyDefaultAdministratorRights</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function getMyDefaultAdministratorRights(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('getMyDefaultAdministratorRights', $content, true, $mode);
    }

    /**
     * See <a href="https://core.telegram.org/bots/api#editmessagetext">editMessageText</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function editMessageText(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('editMessageText', $content, true, $mode);
    }

    /**
     * See <a href="https://core.telegram.org/bots/api#editmessagecaption">editMessageCaption</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function editMessageCaption(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('editMessageCaption', $content, true, $mode);
    }

    /**
     * See <a href="https://core.telegram.org/bots/api#editmessagemedia">editMessageMedia</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function editMessageMedia(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('editMessageMedia', $content, true, $mode);
    }

    /**
     * See <a href="https://core.telegram.org/bots/api#editmessagereplymarkup">editMessageReplyMarkup</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function editMessageReplyMarkup(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('editMessageReplyMarkup', $content, true, $mode);
    }

    /**
     * See <a href="https://core.telegram.org/bots/api#stoppoll">stopPoll</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function stopPoll(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('stopPoll', $content, true, $mode);
    }

    /// Use this method to download a file

    /**
     *  Use this method to to download a file from the Telegram servers.
     * \param $telegram_file_path String File path on Telegram servers
     * \param $local_file_path String File path where save the file.
     */
    public function downloadFile($telegram_file_path, $local_file_path): void
    {
        $file_url = 'https://api.telegram.org/file/bot' . $this->bot_token . '/' . $telegram_file_path;
        $in = fopen($file_url, 'rb');
        $out = fopen($local_file_path, 'wb');

        while ($chunk = fread($in, 8192)) {
            fwrite($out, $chunk, 8192);
        }
        fclose($in);
        fclose($out);
    }

    /// Set a WebHook for the bot

    /**
     *  Use this method to specify a url and receive incoming updates via an outgoing webhook. Whenever there is an update for the bot, we will send an HTTPS POST request to the specified url, containing a JSON-serialized Update. In case of an unsuccessful request, we will give up after a reasonable amount of attempts.
     *
     * If you'd like to make sure that the Webhook request comes from Telegram, we recommend using a secret path in the URL, e.g. https://www.example.com/<token>. Since nobody else knows your botâ€˜s token, you can be pretty sure itâ€™s us.
     * \param $url String HTTPS url to send updates to. Use an empty string to remove webhook integration
     * \param $certificate InputFile Upload your public key certificate so that the root certificate in use can be checked
     * \return the JSON Telegram's reply.
     */
    public function setWebhook($url, $certificate = '')
    {
        if ($certificate == '') {
            $requestBody = ['url' => $url];
        } else {
            $requestBody = ['url' => $url, 'certificate' => "@$certificate"];
        }

        return $this->endpoint('setWebhook', $requestBody);
    }

    /// Delete the WebHook for the bot

    /**
     *  Use this method to remove webhook integration if you decide to switch back to <a href="https://core.telegram.org/bots/api#getupdates">getUpdates</a>. Returns True on success. Requires no parameters.
     * \return the JSON Telegram's reply.
     */
    public function deleteWebhook()
    {
        return $this->endpoint('deleteWebhook', [], false);
    }

    /// Get the data of the current message

    /** Get the POST request of a user in a Webhook or the message actually processed in a getUpdates() enviroment.
     * \return the JSON users's message.
     */
    public function getData()
    {

        if (!isset(Openswoole::$openswoole) && Openswoole::$openswooleStatus === 0) {
            if (empty($this->data)) {
                global $datas;
                $rawData = $datas['argv'][1];

                return json_decode($rawData, true);
            } else {
                return $this->data;
            }
        } else if (isset(Openswoole::$openswoole) && Openswoole::$openswooleStatus === 1) {
            if (empty($this->data)) {
                return Openswoole::$openswoole;
            } else {
                return $this->data;
            }
        }

    }

    /// Set the data currently used
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /// Get the text of the current message

    /**
     * \return the String users's text.
     */

    public function Entities()
    {
        return $this->data['message']['entities'];
    }

    public function Message()
    {
        return $this->data['message'];
    }

    public function Dice()
    {
        return $this->data['message']['dice'] ?? null;
    }

    public function DiceEmoji()
    {
        return $this->data['message']['dice']['emoji'];
    }

    public function DiceValue()
    {
        return $this->data['message']['dice']['value'];
    }

    public function Text()
    {
        $type = $this->getUpdateType();
        if ($type == self::CALLBACK_QUERY) {
            return @$this->data['callback_query']['data'];
        }
        if ($type == self::CHANNEL_POST) {
            return @$this->data['channel_post']['text'];
        }
        if ($type == self::EDITED_MESSAGE) {
            return @$this->data['edited_message']['text'];
        }

        return @$this->data['message']['text'];
    }

    public function Caption()
    {
        $type = $this->getUpdateType();
        if ($type == self::CHANNEL_POST) {
            return @$this->data['channel_post']['caption'];
        }

        return @$this->data['message']['caption'];
    }

    /// Get the chat_id of the current message

    /**
     * \return the String users's chat_id.
     */
    public function ChatID()
    {
        $chat = $this->Chat();

        return $chat['id'];
    }

    /**
     * \return the Array chat.
     */
    public function Chat()
    {
        $type = $this->getUpdateType();
        if ($type == self::CALLBACK_QUERY) {
            return @$this->data['callback_query']['message']['chat'];
        }
        if ($type == self::CHANNEL_POST) {
            return @$this->data['channel_post']['chat'];
        }
        if ($type == self::EDITED_MESSAGE) {
            return @$this->data['edited_message']['chat'];
        }
        if ($type == self::INLINE_QUERY) {
            return @$this->data['inline_query']['from'];
        }
        if ($type == self::MY_CHAT_MEMBER) {
            return @$this->data['my_chat_member']['chat'];
        }

        return $this->data['message']['chat'];
    }

    /// Get the message_id of the current message

    /**
     * \return the String message_id.
     */
    public function MessageID()
    {
        $type = $this->getUpdateType();
        if ($type == self::CALLBACK_QUERY) {
            return @$this->data['callback_query']['message']['message_id'];
        }
        if ($type == self::CHANNEL_POST) {
            return @$this->data['channel_post']['message_id'];
        }
        if ($type == self::EDITED_MESSAGE) {
            return @$this->data['edited_message']['message_id'];
        }

        return $this->data['message']['message_id'];
    }

    /// Get the reply_to_message message_id of the current message

    /**
     * \return the String reply_to_message message_id.
     */
    public function ReplyToMessageID()
    {
        return $this->data['message']['reply_to_message']['message_id'];
    }

    /// Get the reply_to_message forward_from user_id of the current message

    /**
     * \return the String reply_to_message forward_from user_id.
     */
    public function ReplyToMessageFromUserID()
    {
        return $this->data['message']['reply_to_message']['forward_from']['id'];
    }

    /// Get the inline_query of the current update

    /**
     * \return the Array inline_query.
     */
    public function Inline_Query()
    {
        return $this->data['inline_query'];
    }

    /// Get the callback_query of the current update

    /**
     * \return the String callback_query.
     */
    public function Callback_Query()
    {
        return $this->data['callback_query'];
    }

    /// Get the callback_query id of the current update

    /**
     * \return the String callback_query id.
     */
    public function Callback_ID()
    {
        return $this->data['callback_query']['id'];
    }

    /// Get the Get the data of the current callback

    /**
     * \deprecated Use Text() instead
     * \return the String callback_data.
     */
    public function Callback_Data()
    {
        return $this->data['callback_query']['data'];
    }

    /// Get the Get the message of the current callback

    /**
     * \return the Message.
     */
    public function Callback_Message()
    {
        return $this->data['callback_query']['message'];
    }

    /// Get the Get the chat_id of the current callback

    /**
     * \deprecated Use ChatId() instead
     * \return the String callback_query.
     */
    public function Callback_ChatID()
    {
        return $this->data['callback_query']['message']['chat']['id'];
    }

    /// Get the Get the from_id of the current callback

    /**
     * \return the String callback_query from_id.
     */
    public function Callback_FromID()
    {
        return $this->data['callback_query']['from']['id'];
    }

    /// Get the date of the current message

    /**
     * \return the String message's date.
     */
    public function Date()
    {
        return $this->data['message']['date'];
    }

    /// Get the first name of the user
    public function FirstName()
    {
        $type = $this->getUpdateType();
        if ($type == self::CALLBACK_QUERY) {
            return @$this->data['callback_query']['from']['first_name'];
        }
        if ($type == self::CHANNEL_POST) {
            return @$this->data['channel_post']['from']['first_name'];
        }
        if ($type == self::EDITED_MESSAGE) {
            return @$this->data['edited_message']['from']['first_name'];
        }

        return @$this->data['message']['from']['first_name'];
    }

    /// Get the last name of the user
    public function LastName()
    {
        $type = $this->getUpdateType();
        if ($type == self::CALLBACK_QUERY) {
            return @$this->data['callback_query']['from']['last_name'];
        }
        if ($type == self::CHANNEL_POST) {
            return @$this->data['channel_post']['from']['last_name'];
        }
        if ($type == self::EDITED_MESSAGE) {
            return @$this->data['edited_message']['from']['last_name'];
        }
        if ($type == self::MESSAGE) {
            return @$this->data['message']['from']['last_name'];
        }

        return '';
    }

    /// Get the username of the user
    public function Username()
    {
        $type = $this->getUpdateType();
        if ($type == self::CALLBACK_QUERY) {
            return @$this->data['callback_query']['from']['username'];
        }
        if ($type == self::CHANNEL_POST) {
            return @$this->data['channel_post']['from']['username'];
        }
        if ($type == self::EDITED_MESSAGE) {
            return @$this->data['edited_message']['from']['username'];
        }

        return @$this->data['message']['from']['username'];
    }

    public function BotUsername()
    {
        $me = $this->getMe();
        return $me['result']['username'];
    }

    /// Get the location in the message
    public function Location()
    {
        return $this->data['message']['location'];
    }

    /// Get the contact in the message
    public function Contact()
    {
        return $this->data['message']['contact'];
    }

    /// Get the game in the message
    public function Game()
    {
        return $this->data['message']['game'];
    }

    /// Get the poll in the message
    public function Poll()
    {
        return $this->data['message']['poll'];
    }

    /// Get the venue in the message
    public function Venue()
    {
        return $this->data['message']['venue'];
    }

    /// Get the new_chat_members in the message
    public function NewChatMembers()
    {
        return $this->data['message']['new_chat_members'];
    }

    /// Get the left_chat_member in the message
    public function LeftChatMember()
    {
        return $this->data['message']['left_chat_member'];
    }

    /// Get the update_id of the message
    public function UpdateID()
    {
        return $this->data['update_id'];
    }

    /// Get the number of updates
    public function UpdateCount()
    {
        return count($this->updates['result']);
    }

    /// Get user's id of current message
    public function UserID()
    {
        $type = $this->getUpdateType();
        if ($type == self::CALLBACK_QUERY) {
            return $this->data['callback_query']['from']['id'];
        }
        if ($type == self::CHANNEL_POST) {
            return $this->data['channel_post']['from']['id'];
        }
        if ($type == self::EDITED_MESSAGE) {
            return @$this->data['edited_message']['from']['id'];
        }
        if ($type == self::INLINE_QUERY) {
            return @$this->data['inline_query']['from']['id'];
        }

        return $this->data['message']['from']['id'];
    }

    public function ReplyToUserID()
    {
        return $this->data['message']['reply_to_message']['from']['id'];
    }

    /// Get user's id of current forwarded message
    public function FromID()
    {
        return $this->data['message']['forward_from']['id'];
    }

    /// Get chat's id where current message forwarded from
    public function FromChatID()
    {
        return $this->data['message']['forward_from_chat']['id'];
    }

    /// Tell if a message is from a group or user chat

    /**
     *  \return BOOLEAN true if the message is from a Group chat, false otherwise.
     */
    public function MessageFromGroup(): bool
    {
        if ($this->data['message']['chat']['type'] == 'private') {
            return false;
        }

        return true;
    }

    /// Get the contact phone number

    /**
     *  \return a String of the contact phone number.
     */
    public function GetContactPhoneNumber()
    {
        if ($this->getUpdateType() == self::CONTACT) {
            return $this->data['message']['contact']['phone_number'];
        }

        return '';
    }

    /// Get the title of the group chat

    /**
     *  \return a String of the title chat.
     */
    public function MessageFromGroupTitle()
    {
        if ($this->data['message']['chat']['type'] != 'private') {
            return $this->data['message']['chat']['title'];
        }

        return '';
    }

    /// Set a custom keyboard

    /** This object represents a custom keyboard with reply options
     * \param $options Array of Array of String; Array of button rows, each represented by an Array of Strings
     * \param $onetime Boolean Requests clients to hide the keyboard as soon as it's been used. Defaults to false.
     * \param $resize Boolean Requests clients to resize the keyboard vertically for optimal fit (e.g., make the keyboard smaller if there are just two rows of buttons). Defaults to false, in which case the custom keyboard is always of the same height as the app's standard keyboard.
     * \param $selective Boolean Use this parameter if you want to show the keyboard to specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
     * \return the requested keyboard as Json.
     */
    public function buildKeyBoard(array $options, $onetime = false, $resize = false, $selective = true)
    {
        $replyMarkup = [
            'keyboard' => $options,
            'one_time_keyboard' => $onetime,
            'resize_keyboard' => $resize,
            'selective' => $selective,
        ];
        $encodedMarkup = json_encode($replyMarkup, true);

        return $encodedMarkup;
    }

    /// Set an InlineKeyBoard

    /** This object represents an inline keyboard that appears right next to the message it belongs to.
     * \param $options Array of Array of InlineKeyboardButton; Array of button rows, each represented by an Array of InlineKeyboardButton
     * \return the requested keyboard as Json.
     */
    public function buildInlineKeyBoard(array $options)
    {
        $replyMarkup = [
            'inline_keyboard' => $options,
        ];
        $encodedMarkup = json_encode($replyMarkup, true);

        return $encodedMarkup;
    }

    /// Create an InlineKeyboardButton

    /** This object represents one button of an inline keyboard. You must use exactly one of the optional fields.
     * \param $text String; Array of button rows, each represented by an Array of Strings
     * \param $url String Optional. HTTP url to be opened when button is pressed
     * \param $callback_data String Optional. Data to be sent in a callback query to the bot when button is pressed
     * \param $switch_inline_query String Optional. If set, pressing the button will prompt the user to select one of their chats, open that chat and insert the bot‘s username and the specified inline query in the input field. Can be empty, in which case just the bot’s username will be inserted.
     * \param $switch_inline_query_current_chat String Optional. Optional. If set, pressing the button will insert the bot‘s username and the specified inline query in the current chat's input field. Can be empty, in which case only the bot’s username will be inserted.
     * \param $callback_game  String Optional. Description of the game that will be launched when the user presses the button.
     * \param $pay  Boolean Optional. Specify True, to send a <a href="https://core.telegram.org/bots/api#payments">Pay button</a>.
     * \return the requested button as Array.
     */
    public function buildInlineKeyboardButton(
        $text,
        $url = '',
        $callback_data = '',
        $switch_inline_query = null,
        $switch_inline_query_current_chat = null,
        $callback_game = '',
        $pay = ''
    )
    {
        $replyMarkup = [
            'text' => $text,
        ];
        if ($url != '') {
            $replyMarkup['url'] = $url;
        } elseif ($callback_data != '') {
            $replyMarkup['callback_data'] = $callback_data;
        } elseif (!is_null($switch_inline_query)) {
            $replyMarkup['switch_inline_query'] = $switch_inline_query;
        } elseif (!is_null($switch_inline_query_current_chat)) {
            $replyMarkup['switch_inline_query_current_chat'] = $switch_inline_query_current_chat;
        } elseif ($callback_game != '') {
            $replyMarkup['callback_game'] = $callback_game;
        } elseif ($pay != '') {
            $replyMarkup['pay'] = $pay;
        }

        return $replyMarkup;
    }

    /// Create a KeyboardButton

    /** This object represents one button of an inline keyboard. You must use exactly one of the optional fields.
     * \param $text String; Array of button rows, each represented by an Array of Strings
     * \param $request_contact Boolean Optional. If True, the user's phone number will be sent as a contact when the button is pressed. Available in private chats only
     * \param $request_location Boolean Optional. If True, the user's current location will be sent when the button is pressed. Available in private chats only
     * \return the requested button as Array.
     */
    public function buildKeyboardButton($text, $request_contact = false, $request_location = false)
    {
        $replyMarkup = [
            'text' => $text,
            'request_contact' => $request_contact,
            'request_location' => $request_location,
        ];

        return $replyMarkup;
    }

    /// Hide a custom keyboard

    /** Upon receiving a message with this object, Telegram clients will hide the current custom keyboard and display the default letter-keyboard. By default, custom keyboards are displayed until a new keyboard is sent by a bot. An exception is made for one-time keyboards that are hidden immediately after the user presses a button.
     * \param $selective Boolean Use this parameter if you want to show the keyboard to specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
     * \return the requested keyboard hide as Array.
     */
    public function buildKeyBoardHide($selective = true)
    {
        $replyMarkup = [
            'remove_keyboard' => true,
            'selective' => $selective,
        ];
        $encodedMarkup = json_encode($replyMarkup, true);

        return $encodedMarkup;
    }

    /// Display a reply interface to the user
    /* Upon receiving a message with this object, Telegram clients will display a reply interface to the user (act as if the user has selected the bot‘s message and tapped ’Reply'). This can be extremely useful if you want to create user-friendly step-by-step interfaces without having to sacrifice privacy mode.
     * \param $selective Boolean Use this parameter if you want to show the keyboard to specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
     * \return the requested force reply as Array
     */
    public function buildForceReply($selective = true)
    {
        $replyMarkup = [
            'force_reply' => true,
            'selective' => $selective,
        ];
        $encodedMarkup = json_encode($replyMarkup, true);

        return $encodedMarkup;
    }

    // Payments
    /// Send an invoice

    /**
     * See <a href="https://core.telegram.org/bots/api#sendinvoice">sendInvoice</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function sendInvoice(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('sendInvoice', $content, true, $mode);
    }

    /// Answer a shipping query

    /**
     * See <a href="https://core.telegram.org/bots/api#answershippingquery">answerShippingQuery</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function answerShippingQuery(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('answerShippingQuery', $content, true, $mode);
    }

    /// Answer a PreCheckout query

    /**
     * See <a href="https://core.telegram.org/bots/api#answerprecheckoutquery">answerPreCheckoutQuery</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function answerPreCheckoutQuery(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('answerPreCheckoutQuery', $content, true, $mode);
    }

    /// Set Passport data errors

    /**
     * See <a href="https://core.telegram.org/bots/api#setpassportdataerrors">setPassportDataErrors</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function setPassportDataErrors(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('setPassportDataErrors', $content, true, $mode);
    }

    /// Send a Game

    /**
     * See <a href="https://core.telegram.org/bots/api#sendgame">sendGame</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function sendGame(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('sendGame', $content, true, $mode);
    }

    /// Send a video note

    /**
     * See <a href="https://core.telegram.org/bots/api#sendvideonote">sendVideoNote</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function sendVideoNote(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('sendVideoNote', $content, true, $mode);
    }

    /// Restrict Chat Member

    /**
     * See <a href="https://core.telegram.org/bots/api#restrictchatmember">restrictChatMember</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function restrictChatMember(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('restrictChatMember', $content, true, $mode);
    }

    /// Promote Chat Member

    /**
     * See <a href="https://core.telegram.org/bots/api#promotechatmember">promoteChatMember</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function promoteChatMember(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('promoteChatMember', $content, true, $mode);
    }

    /// Set chat Administrator custom title

    /**
     * See <a href="https://core.telegram.org/bots/api#setchatadministratorcustomtitle">setChatAdministratorCustomTitle</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function setChatAdministratorCustomTitle(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('setChatAdministratorCustomTitle', $content, true, $mode);
    }

    /// Ban a channel chat in a super group or channel

    /**
     * See <a href="https://core.telegram.org/bots/api#banchatsenderchat">banChatSenderChat</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function banChatSenderChat(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('banChatSenderChat', $content, true, $mode);
    }

    /// Unban a channel chat in a super group or channel

    /**
     * See <a href="https://core.telegram.org/bots/api#unbanchatsenderchat">unbanChatSenderChat</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function unbanChatSenderChat(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('unbanChatSenderChat', $content, true, $mode);
    }

    /// Set default chat permission for all members

    /**
     * See <a href="https://core.telegram.org/bots/api#setchatpermissions">setChatPermissions</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function setChatPermissions(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('setChatPermissions', $content, true, $mode);
    }

    //// Export Chat Invite Link

    /**
     * See <a href="https://core.telegram.org/bots/api#exportchatinvitelink">exportChatInviteLink</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function exportChatInviteLink(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('exportChatInviteLink', $content, true, $mode);
    }

    //// Create Chat Invite Link

    /**
     * See <a href="https://core.telegram.org/bots/api#createchatinvitelink">createChatInviteLink</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function createChatInviteLink(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('createChatInviteLink', $content, true, $mode);
    }

    //// Edit Chat Invite Link

    /**
     * See <a href="https://core.telegram.org/bots/api#editchatinvitelink">editChatInviteLink</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function editChatInviteLink(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('editChatInviteLink', $content, true, $mode);
    }

    //// Revoke Chat Invite Link

    /**
     * See <a href="https://core.telegram.org/bots/api#revokechatinvitelink">revokeChatInviteLink</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function revokeChatInviteLink(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('revokeChatInviteLink', $content, true, $mode);
    }

    //// Approve chat join request

    /**
     * See <a href="https://core.telegram.org/bots/api#approvechatjoinrequest">approveChatJoinRequest</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function approveChatJoinRequest(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('approveChatJoinRequest', $content);
    }

    //// Decline chat join request

    /**
     * See <a href="https://core.telegram.org/bots/api#declinechatjoinrequest">declineChatJoinRequest</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function declineChatJoinRequest(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('declineChatJoinRequest', $content, true, $mode);
    }

    /// Set Chat Photo

    /**
     * See <a href="https://core.telegram.org/bots/api#setchatphoto">setChatPhoto</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function setChatPhoto(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('setChatPhoto', $content, true, $mode);
    }

    /// Delete Chat Photo

    /**
     * See <a href="https://core.telegram.org/bots/api#deletechatphoto">deleteChatPhoto</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function deleteChatPhoto(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('deleteChatPhoto', $content, true, $mode);
    }

    /// Set Chat Title

    /**
     * See <a href="https://core.telegram.org/bots/api#setchattitle">setChatTitle</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function setChatTitle(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('setChatTitle', $content, true, $mode);
    }

    /// Set Chat Description

    /**
     * See <a href="https://core.telegram.org/bots/api#setchatdescription">setChatDescription</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function setChatDescription(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('setChatDescription', $content, true, $mode);
    }

    /// Pin Chat Message

    /**
     * See <a href="https://core.telegram.org/bots/api#pinchatmessage">pinChatMessage</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function pinChatMessage(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('pinChatMessage', $content, true, $mode);
    }

    /// Unpin Chat Message

    /**
     * See <a href="https://core.telegram.org/bots/api#unpinchatmessage">unpinChatMessage</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function unpinChatMessage(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('unpinChatMessage', $content, true, $mode);
    }

    /// Unpin All Chat Messages

    /**
     * See <a href="https://core.telegram.org/bots/api#unpinallchatmessages">unpinAllChatMessages</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function unpinAllChatMessages(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('unpinAllChatMessages', $content, true, $mode);
    }

    /// Get Sticker Set

    /**
     * See <a href="https://core.telegram.org/bots/api#getstickerset">getStickerSet</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function getStickerSet(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('getStickerSet', $content, true, $mode);
    }

    /// Upload Sticker File

    /**
     * See <a href="https://core.telegram.org/bots/api#uploadstickerfile">uploadStickerFile</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function uploadStickerFile(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('uploadStickerFile', $content, true, $mode);
    }

    /// Create New Sticker Set

    /**
     * See <a href="https://core.telegram.org/bots/api#createnewstickerset">createNewStickerSet</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function createNewStickerSet(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('createNewStickerSet', $content, true, $mode);
    }

    /// Add Sticker To Set

    /**
     * See <a href="https://core.telegram.org/bots/api#addstickertoset">addStickerToSet</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function addStickerToSet(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('addStickerToSet', $content, true, $mode);
    }

    /// Set Sticker Position In Set

    /**
     * See <a href="https://core.telegram.org/bots/api#setstickerpositioninset">setStickerPositionInSet</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function setStickerPositionInSet(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('setStickerPositionInSet', $content, true, $mode);
    }

    /// Delete Sticker From Set

    /**
     * See <a href="https://core.telegram.org/bots/api#deletestickerfromset">deleteStickerFromSet</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function deleteStickerFromSet(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('deleteStickerFromSet', $content, true, $mode);
    }

    /// Set Sticker Thumb From Set

    /**
     * See <a href="https://core.telegram.org/bots/api#setstickersetthumb">setStickerSetThumb</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function setStickerSetThumb(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('setStickerSetThumb', $content, true, $mode);
    }

    /// Delete a message

    /**
     * See <a href="https://core.telegram.org/bots/api#deletemessage">deleteMessage</a> for the input values
     * \param $content the request parameters as array
     * \return the JSON Telegram's reply.
     */
    public function deleteMessage(array $content, int $mode = REQUEST_METHODE_CURL)
    {
        return $this->endpoint('deleteMessage', $content, true, $mode);
    }

    /// Receive incoming messages using polling

    /** Use this method to receive incoming updates using long polling.
     * \param $offset Integer Identifier of the first update to be returned. Must be greater by one than the highest among the identifiers of previously received updates. By default, updates starting with the earliest unconfirmed update are returned. An update is considered confirmed as soon as getUpdates is called with an offset higher than its update_id.
     * \param $limit Integer Limits the number of updates to be retrieved. Values between 1—100 are accepted. Defaults to 100
     * \param $timeout Integer Timeout in seconds for long polling. Defaults to 0, i.e. usual short polling
     * \param $update Boolean If true updates the pending message list to the last update received. Default to true.
     * \return the updates as Array.
     */
    public function getUpdates($offset = 0, $limit = 100, $timeout = 0, $update = true)
    {
        $content = ['offset' => $offset, 'limit' => $limit, 'timeout' => $timeout];
        $this->updates = $this->endpoint('getUpdates', $content);
        if ($update) {
            if (array_key_exists('result', $this->updates) && is_array($this->updates['result']) && count($this->updates['result']) >= 1) { //for CLI working.
                $last_element_id = $this->updates['result'][count($this->updates['result']) - 1]['update_id'] + 1;
                $content = ['offset' => $last_element_id, 'limit' => '1', 'timeout' => $timeout];
                $this->endpoint('getUpdates', $content);
            }
        }

        return $this->updates;
    }

    /// Serve an update

    /** Use this method to use the bultin function like Text() or Username() on a specific update.
     * \param $update Integer The index of the update in the updates array.
     */
    public function serveUpdate($update)
    {
        $this->data = $this->updates['result'][$update];
    }

    /// Return current update type

    /**
     * Return current update type `False` on failure.
     *
     * @return bool|string
     */
    public function getUpdateType()
    {
        if ($this->update_type) {
            return $this->update_type;
        }

        $update = $this->data;
        if (isset($update['inline_query'])) {
            $this->update_type = self::INLINE_QUERY;

            return $this->update_type;
        }
        if (isset($update['callback_query'])) {
            $this->update_type = self::CALLBACK_QUERY;

            return $this->update_type;
        }
        if (isset($update['edited_message'])) {
            $this->update_type = self::EDITED_MESSAGE;

            return $this->update_type;
        }
        if (isset($update['message']['text'])) {
            $this->update_type = self::MESSAGE;

            return $this->update_type;
        }
        if (isset($update['message']['photo'])) {
            $this->update_type = self::PHOTO;

            return $this->update_type;
        }
        if (isset($update['message']['video'])) {
            $this->update_type = self::VIDEO;

            return $this->update_type;
        }
        if (isset($update['message']['audio'])) {
            $this->update_type = self::AUDIO;

            return $this->update_type;
        }
        if (isset($update['message']['voice'])) {
            $this->update_type = self::VOICE;

            return $this->update_type;
        }
        if (isset($update['message']['contact'])) {
            $this->update_type = self::CONTACT;

            return $this->update_type;
        }
        if (isset($update['message']['location'])) {
            $this->update_type = self::LOCATION;

            return $this->update_type;
        }
        if (isset($update['message']['reply_to_message'])) {
            $this->update_type = self::REPLY;

            return $this->update_type;
        }
        if (isset($update['message']['animation'])) {
            $this->update_type = self::ANIMATION;

            return $this->update_type;
        }
        if (isset($update['message']['sticker'])) {
            $this->update_type = self::STICKER;

            return $this->update_type;
        }
        if (isset($update['message']['document'])) {
            $this->update_type = self::DOCUMENT;

            return $this->update_type;
        }
        if (isset($update['message']['new_chat_member'])) {
            $this->update_type = self::NEW_CHAT_MEMBER;

            return $this->update_type;
        }
        if (isset($update['message']['left_chat_member'])) {
            $this->update_type = self::LEFT_CHAT_MEMBER;

            return $this->update_type;
        }
        if (isset($update['my_chat_member'])) {
            $this->update_type = self::MY_CHAT_MEMBER;

            return $this->update_type;
        }
        if (isset($update['channel_post'])) {
            $this->update_type = self::CHANNEL_POST;

            return $this->update_type;
        }

        return false;
    }

    private function curl_sendAPIRequest($url, array $content, $post = true): bool|string
    {
        if (isset($content['chat_id'])) {
            $url = $url . '?chat_id=' . $content['chat_id'];
            unset($content['chat_id']);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TCP_FASTOPEN, true);
        curl_setopt($ch, CURLOPT_TCP_NODELAY, true);

        if ($post) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        }
        if (!empty($this->proxy)) {
            if (array_key_exists('type', $this->proxy)) {
                curl_setopt($ch, CURLOPT_PROXYTYPE, $this->proxy['type']);
            }

            if (array_key_exists('auth', $this->proxy)) {
                curl_setopt($ch, CURLOPT_PROXYUSERPWD, $this->proxy['auth']);
            }

            if (array_key_exists('url', $this->proxy)) {
                curl_setopt($ch, CURLOPT_PROXY, $this->proxy['url']);
            }

            if (array_key_exists('port', $this->proxy)) {
                curl_setopt($ch, CURLOPT_PROXYPORT, $this->proxy['port']);
            }
        }
        $result = curl_exec($ch);
        if ($result === false) {
            $result = json_encode(
                ['ok' => false, 'curl_error_code' => curl_errno($ch), 'curl_error' => curl_error($ch)]
            );
        }
        curl_close($ch);

        return $result;
    }

    public function noResponseCurl_sendAPIRequest($url, array $content, $post = true): false|string
    {
        if (isset($content['chat_id'])) {
            $url = $url . '?chat_id=' . $content['chat_id'];
            unset($content['chat_id']);
        }

        if ($post) {
            $http_methode = 'POST';
        } else {
            $http_methode = 'GET';
        }

        $command = "curl --parallel --parallel-immediate --parallel-max 100 --tcp-fastopen --tcp-nodelay -X {$http_methode} -H 'Content-type: application/json' -d " . escapeshellarg(json_encode($content)) . " '{$url}'";

        if (!empty($this->proxy)) {
            if (array_key_exists('type', $this->proxy)) {
                $command .= " --proxy-type " . $this->proxy['type'];
            }

            if (array_key_exists('auth', $this->proxy)) {
                $command .= " --proxy-user " . $this->proxy['auth'];
            }

            if (array_key_exists('url', $this->proxy)) {
                $command .= " --proxy " . $this->proxy['url'];
            }

            if (array_key_exists('port', $this->proxy)) {
                $command .= " --proxy-port " . $this->proxy['port'];
            }
        }

        $command .= " -o /dev/null >> /dev/null 2>&1 &";

        $handle = popen($command, 'r');
        $result = stream_get_contents($handle);
        pclose($handle);

        return $result;
    }

    public function amphp_sendAPIRequest($url, array $content, $post = true): bool|string|array
    {
        Loop::run(function () use ($url, $post, $content) {
            $apiClient = new Amphp($url);

            if ($post) {
                $response = yield $apiClient->post($content);
            } else {
                $response = yield $apiClient->get();
            }

            return yield $response->getBody()->buffer();
        });
        return false;
    }
//
//    public function openswoole_sendAPIRequest($url, array $content, $post = true): bool|string
//    {
//
//    }
}

// Helper for Uploading file using CURL
if (!function_exists('curl_file_create')) {
    function curl_file_create($filename, $mimetype = '', $postname = ''): string
    {
        return "@$filename;filename="
            . ($postname ?: basename($filename))
            . ($mimetype ? ";type=$mimetype" : '');
    }
}