<?php

use LaraGram\Core\Request;

function getMe()
{
    return (Request::getInstance())->getMe();
}

function logOut()
{
    return (Request::getInstance())->logOut();
}

function close()
{
    return (Request::getInstance())->close();
}

function respondSuccess(): false|string
{
    return (Request::getInstance())->respondSuccess();
}

function sendMessage(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->sendMessage($content, $mode);
}

function copyMessage(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->copyMessage($content, $mode);
}

function forwardMessage(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->forwardMessage($content, $mode);
}

function sendPhoto(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->sendPhoto($content, $mode);
}

function sendAudio(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->sendAudio($content, $mode);
}

function sendDocument(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->sendDocument($content, $mode);
}

function sendAnimation(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->sendAnimation($content, $mode);
}

function sendSticker(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->sendSticker($content, $mode);
}

function sendVideo(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->sendVideo($content, $mode);
}

function sendVoice(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->sendVoice($content, $mode);
}

function sendLocation(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->sendLocation($content, $mode);
}

function editMessageLiveLocation(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->editMessageLiveLocation($content, $mode);
}

function stopMessageLiveLocation(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->stopMessageLiveLocation($content, $mode);
}

function setChatStickerSet(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->setChatStickerSet($content, $mode);
}

function deleteChatStickerSet(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->deleteChatStickerSet($content, $mode);
}

function sendMediaGroup(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->sendMediaGroup($content, $mode);
}

function sendVenue(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->sendVenue($content, $mode);
}

function sendContact(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->sendContact($content, $mode);
}

function sendPoll(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->sendPoll($content, $mode);
}

function sendDice(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->sendDice($content, $mode);
}

function sendChatAction(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->sendChatAction($content, $mode);
}

function getUserProfilePhotos(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->getUserProfilePhotos($content, $mode);
}

function getFile($file_id, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->getFile($file_id, $mode);
}

function kickChatMember(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->kickChatMember($content, $mode);
}

function leaveChat(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->leaveChat($content, $mode);
}

function banChatMember(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->banChatMember($content, $mode);
}

function unbanChatMember(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->unbanChatMember($content, $mode);
}

function getChat(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->getChat($content, $mode);
}

function getChatAdministrators(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->getChatAdministrators($content, $mode);
}

function getChatMemberCount(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->getChatMemberCount($content, $mode);
}

function getChatMembersCount(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->getChatMembersCount($content, $mode);
}

function getChatMember(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->getChatMember($content, $mode);
}

function answerInlineQuery(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->answerInlineQuery($content, $mode);
}

function setGameScore(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->setGameScore($content, $mode);
}

function getGameHighScores(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->getGameHighScores($content, $mode);
}

function answerCallbackQuery(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->answerCallbackQuery($content, $mode);
}

function setMyCommands(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->setMyCommands($content, $mode);
}

function deleteMyCommands(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->deleteMyCommands($content, $mode);
}

function getMyCommands(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->getMyCommands($content, $mode);
}

function setChatMenuButton(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->setChatMenuButton($content, $mode);
}

function getChatMenuButton(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->getChatMenuButton($content, $mode);
}

function setMyDefaultAdministratorRights(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->setMyDefaultAdministratorRights($content, $mode);
}

function getMyDefaultAdministratorRights(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->getMyDefaultAdministratorRights($content, $mode);
}

function editMessageText(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->editMessageText($content, $mode);
}

function editMessageCaption(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->editMessageCaption($content, $mode);
}

function editMessageMedia(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->editMessageMedia($content, $mode);
}

function editMessageReplyMarkup(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->editMessageReplyMarkup($content, $mode);
}

function stopPoll(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->stopPoll($content, $mode);
}

function downloadFile($telegram_file_path, $local_file_path): void
{
    (Request::getInstance())->downloadFile($telegram_file_path, $local_file_path);
}

function setWebhook($url, $certificate = '')
{
    return (Request::getInstance())->setWebhook($url, $certificate);
}

function deleteWebhook()
{
    return (Request::getInstance())->deleteWebhook();
}

function sendInvoice(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->sendInvoice($content, $mode);
}

function answerShippingQuery(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->answerShippingQuery($content, $mode);
}

function answerPreCheckoutQuery(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->answerPreCheckoutQuery($content, $mode);
}

function setPassportDataErrors(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->setPassportDataErrors($content, $mode);
}

function sendGame(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->sendGame($content, $mode);
}

function sendVideoNote(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->sendVideoNote($content, $mode);
}

function restrictChatMember(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->restrictChatMember($content, $mode);
}

function promoteChatMember(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->promoteChatMember($content, $mode);
}

function setChatAdministratorCustomTitle(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->setChatAdministratorCustomTitle($content, $mode);
}

function banChatSenderChat(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->banChatSenderChat($content, $mode);
}

function unbanChatSenderChat(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->unbanChatSenderChat($content, $mode);
}

function setChatPermissions(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->setChatPermissions($content, $mode);
}

function exportChatInviteLink(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->exportChatInviteLink($content, $mode);
}

function createChatInviteLink(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->createChatInviteLink($content, $mode);
}

function editChatInviteLink(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->editChatInviteLink($content, $mode);
}

function revokeChatInviteLink(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->revokeChatInviteLink($content, $mode);
}

function approveChatJoinRequest(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->approveChatJoinRequest($content, $mode);
}

function declineChatJoinRequest(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->declineChatJoinRequest($content, $mode);
}

function setChatPhoto(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->setChatPhoto($content, $mode);
}

function deleteChatPhoto(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->deleteChatPhoto($content, $mode);
}

function setChatTitle(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->setChatTitle($content, $mode);
}

function setChatDescription(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->setChatDescription($content, $mode);
}

function pinChatMessage(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->pinChatMessage($content, $mode);
}

function unpinChatMessage(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->unpinChatMessage($content, $mode);
}

function unpinAllChatMessages(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->unpinAllChatMessages($content, $mode);
}

function getStickerSet(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->getStickerSet($content, $mode);
}

function uploadStickerFile(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->uploadStickerFile($content, $mode);
}

function createNewStickerSet(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->createNewStickerSet($content, $mode);
}

function addStickerToSet(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->addStickerToSet($content, $mode);
}

function setStickerPositionInSet(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->setStickerPositionInSet($content, $mode);
}

function deleteStickerFromSet(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->deleteStickerFromSet($content, $mode);
}

function setStickerSetThumb(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->setStickerSetThumb($content, $mode);
}

function deleteMessage(array $content, int $mode = REQUEST_METHODE_CURL)
{
    return (Request::getInstance())->deleteMessage($content, $mode);
}

function getUpdates($offset = 0, $limit = 100, $timeout = 0, $update = true)
{
    return (Request::getInstance())->getUpdates($offset, $limit, $timeout, $update);
}

function serveUpdate($update): void
{
    (Request::getInstance())->serveUpdate($update);
}

function getUpdateType(): bool|string
{
    return (Request::getInstance())->getUpdateType();
}