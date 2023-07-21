<?php

namespace Bot\Core\Handler;

use Bot\Core\Interface\MessageHandlerInterface;
use Bot\Core\Matching;
use Bot\Core\Trait\Authentication;
use Bot\Core\Trait\Condition;
use Bot\Core\Trait\Scope;

class Handler extends Matching implements MessageHandlerInterface
{
    use Authentication, Condition, Scope;

    public function on(array|string $message, callable $action): static
    {
        $this->action('text', $message, $action);
        return $this;
    }

    public function onText(array|string $message, callable $action): static
    {
        $this->action('text', $message, $action);
        return $this;
    }

    public function onCommand(array|string $command, callable $action): static
    {
        $this->action('command', $command, $action);
        return $this;
    }

    public function onAnimation(callable $action, array|string|null $file_id = null): static
    {
        $this->action('animation', $file_id, $action);
        return $this;
    }

    public function onAudio(callable $action, array|string|null $file_id = null): static
    {
        $this->action('audio', $file_id, $action);
        return $this;
    }

    public function onDocument(callable $action, array|string|null $file_id = null): static
    {
        $this->action('document', $file_id, $action);
        return $this;
    }

    public function onPhoto(callable $action, array|string|null $file_id = null): static
    {
        $this->action('photo', $file_id, $action);
        return $this;
    }

    public function onSticker(callable $action, array|string|null $file_id = null): static
    {
        $this->action('sticker', $file_id, $action);
        return $this;
    }

    public function onVideo(callable $action, array|string|null $file_id = null): static
    {
        $this->action('video', $file_id, $action);
        return $this;
    }

    public function onVideoNote(callable $action, array|string|null $file_id = null): static
    {
        $this->action('video_note', $file_id, $action);
        return $this;
    }

    public function onVoice(callable $action, array|string|null $file_id = null): static
    {
        $this->action('voice', $file_id, $action);
        return $this;
    }

    public function onContact(callable $action): static
    {
        $this->action('contact', null, $action);
        return $this;
    }

    public function onDice(callable $action, string|null $emoji = null, string|int|null $value = null): static
    {
        $this->action('dice', [$emoji, $value], $action);
        return $this;
    }

    public function onGame(callable $action): static
    {
        $this->action('game', null, $action);
        return $this;
    }

    public function onPoll(callable $action): static
    {
        $this->action('poll', null, $action);
        return $this;
    }

    public function onVenue(callable $action): static
    {
        $this->action('venue', null, $action);
        return $this;
    }

    public function onLocation(callable $action): static
    {
        $this->action('location', null, $action);
        return $this;
    }

    public function onNewChatMembers(callable $action): static
    {
        $this->action('new_chat_members', null, $action);
        return $this;
    }

    public function onLeftChatMember(callable $action): static
    {
        $this->action('left_chat_member', null, $action);
        return $this;
    }

    public function onNewChatTitle(callable $action): static
    {
        $this->action('new_chat_title', null, $action);
        return $this;
    }

    public function onNewChatPhoto(callable $action): static
    {
        $this->action('new_chat_photo', null, $action);
        return $this;
    }

    public function onDeleteChatPhoto(callable $action): static
    {
        $this->action('delete_chat_photo', null, $action);
        return $this;
    }

    public function onGroupChatCreated(callable $action): static
    {
        $this->action('group_chat_created', null, $action);
        return $this;
    }

    public function onSuperGroupChatCreated(callable $action): static
    {
        $this->action('supergroup_chat_created', null, $action);
        return $this;
    }

    public function onMessageAutoDeleteTimerChanged(callable $action): static
    {
        $this->action('message_auto_delete_timer_changed', null, $action);
        return $this;
    }

    public function onMigrateToChatId(callable $action): static
    {
        $this->action('migrate_to_chat_id', null, $action);
        return $this;
    }

    public function onMigrateFromChatId(callable $action): static
    {
        $this->action('migrate_from_chat_id', null, $action);
        return $this;
    }

    public function onPinnedMessage(callable $action): static
    {
        $this->action('pinned_message', null, $action);
        return $this;
    }

    public function onInvoice(callable $action): static
    {
        $this->action('invoice', null, $action);
        return $this;
    }

    public function onSuccessfulPayment(callable $action): static
    {
        $this->action('successful_payment', null, $action);
        return $this;
    }

    public function onConnectedWebsite(callable $action): static
    {
        $this->action('connected_website', null, $action);
        return $this;
    }

    public function onPassportData(callable $action): static
    {
        $this->action('passport_data', null, $action);
        return $this;
    }

    public function onProximityAlertTriggered(callable $action): static
    {
        $this->action('proximity_alert_triggered', null, $action);
        return $this;
    }

    public function onForumTopicCreated(callable $action): static
    {
        $this->action('forum_topic_created', null, $action);
        return $this;
    }

    public function onForumTopicEdited(callable $action): static
    {
        $this->action('forum_topic_edited', null, $action);
        return $this;
    }

    public function onForumTopicClosed(callable $action): static
    {
        $this->action('forum_topic_closed', null, $action);
        return $this;
    }

    public function onForumTopicReopened(callable $action): static
    {
        $this->action('forum_topic_reopened', null, $action);
        return $this;
    }

    public function onVideoChatScheduled(callable $action): static
    {
        $this->action('video_chat_scheduled', null, $action);
        return $this;
    }

    public function onVideoChatStarted(callable $action): static
    {
        $this->action('video_chat_started', null, $action);
        return $this;
    }

    public function onVideoChatEnded(callable $action): static
    {
        $this->action('video_chat_ended', null, $action);
        return $this;
    }

    public function onVideoChatParticipantsInvited(callable $action): static
    {
        $this->action('video_chat_participants_invited', null, $action);
        return $this;
    }

    public function onWebAppData(callable $action): static
    {
        $this->action('web_app_data', null, $action);
        return $this;
    }

    public function onMessage(callable $action): static
    {
        $this->action('message', null, $action);
        return $this;
    }

    public function onMessageType(array|string $type, callable $action): static
    {
        $this->action('message_type', $type, $action);
        return $this;
    }

    public function onEditedMessage(callable $action): static
    {
        $this->action('edited_message', null, $action);
        return $this;
    }

    public function onChannelPost(callable $action): static
    {
        $this->action('channel_post', null, $action);
        return $this;
    }

    public function onEditedChannelPost(callable $action): static
    {
        $this->action('edited_channel_post', null, $action);
        return $this;
    }

    public function onInlineQuery(callable $action): static
    {
        $this->action('inline_query', null, $action);
        return $this;
    }

    public function onChosenInlineResult(callable $action): static
    {
        $this->action('chosen_inline_result', null, $action);
        return $this;
    }

    public function onCallbackQuery(callable $action): static
    {
        $this->action('callback_query', null, $action);
        return $this;
    }

    public function onCallbackQueryData(array|string $pattern, callable $action): static
    {
        $this->action('callback_query_data', $pattern, $action);
        return $this;
    }

    public function onShippingQuery(callable $action): static
    {
        $this->action('shipping_query', null, $action);
        return $this;
    }

    public function onPreCheckoutQuery(callable $action): static
    {
        $this->action('pre_checkout_query', null, $action);
        return $this;
    }

    public function onPollAnswer(callable $action): static
    {
        $this->action('poll_answer', null, $action);
        return $this;
    }

    public function onMyChatMember(callable $action): static
    {
        $this->action('my_chat_member', null, $action);
        return $this;
    }

    public function onChatMember(callable $action): static
    {
        $this->action('chat_member', null, $action);
        return $this;
    }

    public function onChatJoinRequest(callable $action): static
    {
        $this->action('chat_join_request', null, $action);
        return $this;
    }

    public function onAny(callable $action): static
    {
        $this->action('any', null, $action);
        return $this;
    }
}