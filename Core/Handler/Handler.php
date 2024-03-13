<?php

namespace Bot\Core\Handler;

use Bot\Core\Matching;

class Handler extends Matching
{
    public function on(array|string $message, callable $action): void
    {
        $this->action('text', $message, $action);
    }

    public function onText(array|string $message, callable $action): void
    {
        $this->action('text', $message, $action);
    }

    public function onCommand(array|string $command, callable $action): void
    {
        $this->action('command', $command, $action);
    }

    public function onAnimation(callable $action, array|string|null $file_id = null): void
    {
        $this->action('animation', $file_id, $action);
    }

    public function onAudio(callable $action, array|string|null $file_id = null): void
    {
        $this->action('audio', $file_id, $action);
    }

    public function onDocument(callable $action, array|string|null $file_id = null): void
    {
        $this->action('document', $file_id, $action);
    }

    public function onPhoto(callable $action, array|string|null $file_id = null): void
    {
        $this->action('photo', $file_id, $action);
    }

    public function onSticker(callable $action, array|string|null $file_id = null): void
    {
        $this->action('sticker', $file_id, $action);
    }

    public function onVideo(callable $action, array|string|null $file_id = null): void
    {
        $this->action('video', $file_id, $action);
    }

    public function onVideoNote(callable $action, array|string|null $file_id = null): void
    {
        $this->action('video_note', $file_id, $action);
    }

    public function onVoice(callable $action, array|string|null $file_id = null): void
    {
        $this->action('voice', $file_id, $action);
    }

    public function onContact(callable $action): void
    {
        $this->action('contact', null, $action);
    }

    public function onDice(callable $action, string|null $emoji = null, string|int|null $value = null): void
    {
        $this->action('dice', [$emoji, $value], $action);
    }

    public function onGame(callable $action): void
    {
        $this->action('game', null, $action);
    }

    public function onPoll(callable $action): void
    {
        $this->action('poll', null, $action);
    }

    public function onVenue(callable $action): void
    {
        $this->action('venue', null, $action);
    }

    public function onLocation(callable $action): void
    {
        $this->action('location', null, $action);
    }

    public function onNewChatMembers(callable $action): void
    {
        $this->action('new_chat_members', null, $action);
    }

    public function onLeftChatMember(callable $action): void
    {
        $this->action('left_chat_member', null, $action);
    }

    public function onNewChatTitle(callable $action): void
    {
        $this->action('new_chat_title', null, $action);
    }

    public function onNewChatPhoto(callable $action): void
    {
        $this->action('new_chat_photo', null, $action);
    }

    public function onDeleteChatPhoto(callable $action): void
    {
        $this->action('delete_chat_photo', null, $action);
    }

    public function onGroupChatCreated(callable $action): void
    {
        $this->action('group_chat_created', null, $action);
    }

    public function onSuperGroupChatCreated(callable $action): void
    {
        $this->action('supergroup_chat_created', null, $action);

    }

    public function onMessageAutoDeleteTimerChanged(callable $action): void
    {
        $this->action('message_auto_delete_timer_changed', null, $action);
    }

    public function onMigrateToChatId(callable $action): void
    {
        $this->action('migrate_to_chat_id', null, $action);
    }

    public function onMigrateFromChatId(callable $action): void
    {
        $this->action('migrate_from_chat_id', null, $action);
    }

    public function onPinnedMessage(callable $action): void
    {
        $this->action('pinned_message', null, $action);
    }

    public function onInvoice(callable $action): void
    {
        $this->action('invoice', null, $action);
    }

    public function onSuccessfulPayment(callable $action): void
    {
        $this->action('successful_payment', null, $action);
    }

    public function onConnectedWebsite(callable $action): void
    {
        $this->action('connected_website', null, $action);
    }

    public function onPassportData(callable $action): void
    {
        $this->action('passport_data', null, $action);
    }

    public function onProximityAlertTriggered(callable $action): void
    {
        $this->action('proximity_alert_triggered', null, $action);
    }

    public function onForumTopicCreated(callable $action): void
    {
        $this->action('forum_topic_created', null, $action);
    }

    public function onForumTopicEdited(callable $action): void
    {
        $this->action('forum_topic_edited', null, $action);
    }

    public function onForumTopicClosed(callable $action): void
    {
        $this->action('forum_topic_closed', null, $action);
    }

    public function onForumTopicReopened(callable $action): void
    {
        $this->action('forum_topic_reopened', null, $action);
    }

    public function onVideoChatScheduled(callable $action): void
    {
        $this->action('video_chat_scheduled', null, $action);
    }

    public function onVideoChatStarted(callable $action): void
    {
        $this->action('video_chat_started', null, $action);
    }

    public function onVideoChatEnded(callable $action): void
    {
        $this->action('video_chat_ended', null, $action);
    }

    public function onVideoChatParticipantsInvited(callable $action): void
    {
        $this->action('video_chat_participants_invited', null, $action);
    }

    public function onWebAppData(callable $action): void
    {
        $this->action('web_app_data', null, $action);
    }

    public function onMessage(callable $action): void
    {
        $this->action('message', null, $action);
    }

    public function onMessageType(array|string $type, callable $action): void
    {
        $this->action('message_type', $type, $action);
    }

    public function onEditedMessage(callable $action): void
    {
        $this->action('edited_message', null, $action);
    }

    public function onChannelPost(callable $action): void
    {
        $this->action('channel_post', null, $action);
    }

    public function onEditedChannelPost(callable $action): void
    {
        $this->action('edited_channel_post', null, $action);
    }

    public function onInlineQuery(callable $action): void
    {
        $this->action('inline_query', null, $action);
    }

    public function onChosenInlineResult(callable $action): void
    {
        $this->action('chosen_inline_result', null, $action);
    }

    public function onCallbackQuery(callable $action): void
    {
        $this->action('callback_query', null, $action);
    }

    public function onCallbackQueryData(array|string $pattern, callable $action): void
    {
        $this->action('callback_query_data', $pattern, $action);
    }

    public function onShippingQuery(callable $action): void
    {
        $this->action('shipping_query', null, $action);
    }

    public function onPreCheckoutQuery(callable $action): void
    {
        $this->action('pre_checkout_query', null, $action);
    }

    public function onPollAnswer(callable $action): void
    {
        $this->action('poll_answer', null, $action);
    }

    public function onMyChatMember(callable $action): void
    {
        $this->action('my_chat_member', null, $action);
    }

    public function onChatMember(callable $action): void
    {
        $this->action('chat_member', null, $action);
    }

    public function onChatJoinRequest(callable $action): void
    {
        $this->action('chat_join_request', null, $action);
    }

    public function onAny(callable $action): void
    {
        $this->action('any', null, $action);
    }
}