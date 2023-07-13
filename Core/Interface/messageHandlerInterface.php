<?php

namespace Bot\Core\Interface;

interface MessageHandlerInterface
{
    public function on(array|string $message, callable $action);

    public function onText(array|string $message, callable $action);

    public function onCommand(array|string $command, callable $action);

    public function onAnimation(callable $action, array|string $file_id = null);

    public function onAudio(callable $action, array|string $file_id = null);

    public function onDocument(callable $action, array|string $file_id = null);

    public function onPhoto(callable $action, array|string $file_id = null);

    public function onSticker(callable $action, array|string $file_id = null);

    public function onVideo(callable $action, array|string $file_id = null);

    public function onVideoNote(callable $action, array|string $file_id = null);

    public function onVoice(callable $action, array|string $file_id = null);

    public function onContact(callable $action);

    public function onDice(callable $action, string|null $emoji = null, string|int|null $value = null);

    public function onGame(callable $action);

    public function onPoll(callable $action);

    public function onVenue(callable $action);

    public function onLocation(callable $action);

    public function onNewChatMembers(callable $action);

    public function onLeftChatMember(callable $action);

    public function onNewChatTitle(callable $action);

    public function onNewChatPhoto(callable $action);

    public function onDeleteChatPhoto(callable $action);

    public function onGroupChatCreated(callable $action);

    public function onSuperGroupChatCreated(callable $action);

    public function onMessageAutoDeleteTimerChanged(callable $action);

    public function onMigrateToChatId(callable $action);

    public function onMigrateFromChatId(callable $action);

    public function onPinnedMessage(callable $action);

    public function onInvoice(callable $action);

    public function onSuccessfulPayment(callable $action);

    public function onConnectedWebsite(callable $action);

    public function onPassportData(callable $action);

    public function onProximityAlertTriggered(callable $action);

    public function onForumTopicCreated(callable $action);

    public function onForumTopicEdited(callable $action);

    public function onForumTopicClosed(callable $action);

    public function onForumTopicReopened(callable $action);

    public function onVideoChatScheduled(callable $action);

    public function onVideoChatStarted(callable $action);

    public function onVideoChatEnded(callable $action);

    public function onVideoChatParticipantsInvited(callable $action);

    public function onWebAppData(callable $action);
}