<?php

use Bot\Core\Request;

function getData()
{
    $update = Request::getInstance();
    return $update->getData();
}

function Entities()
{
    $update = Request::getInstance();
    return $update->Entities();
}

function Message()
{
    $update = Request::getInstance();
    return $update->Message();
}

function Dice()
{
    $update = Request::getInstance();
    return $update->Dice();
}

function DiceEmoji()
{
    $update = Request::getInstance();
    return $update->DiceEmoji();
}

function DiceValue()
{
    $update = Request::getInstance();
    return $update->DiceValue();
}

function Text()
{
    $update = Request::getInstance();
    return $update->Text();
}

function Caption()
{
    $update = Request::getInstance();
    return $update->Caption();
}

function ChatID()
{
    $update = Request::getInstance();
    return $update->ChatID();
}

function Chat()
{
    $update = Request::getInstance();
    return $update->Chat();
}

function MessageID()
{
    $update = Request::getInstance();
    return $update->MessageID();
}

function ReplyToMessageID()
{
    $update = Request::getInstance();
    return $update->ReplyToMessageID();
}

function ReplyToMessageFromUserID()
{
    $update = Request::getInstance();
    return $update->ReplyToMessageFromUserID();
}

function Inline_Query()
{
    $update = Request::getInstance();
    return $update->Inline_Query();
}

function Callback_Query()
{
    $update = Request::getInstance();
    return $update->Callback_Query();
}

function Callback_ID()
{
    $update = Request::getInstance();
    return $update->Callback_ID();
}

function Callback_Data()
{
    $update = Request::getInstance();
    return $update->Callback_Data();
}

function Callback_Message()
{
    $update = Request::getInstance();
    return $update->Callback_Message();
}

function Callback_ChatID()
{
    $update = Request::getInstance();
    return $update->Callback_ChatID();
}

function Callback_FromID()
{
    $update = Request::getInstance();
    return $update->Callback_FromID();
}

function Dates()
{
    $update = Request::getInstance();
    return $update->Date();
}

function FirstName()
{
    $update = Request::getInstance();
    return $update->FirstName();
}

function LastName()
{
    $update = Request::getInstance();
    return $update->LastName();
}

function Username()
{
    $update = Request::getInstance();
    return $update->Username();
}

function BotUsername()
{
    $update = Request::getInstance();
    return $update->BotUsername();
}

function Location()
{
    $update = Request::getInstance();
    return $update->Location();
}

function Contact()
{
    $update = Request::getInstance();
    return $update->Contact();
}

function Game()
{
    $update = Request::getInstance();
    return $update->Game();
}

function Poll()
{
    $update = Request::getInstance();
    return $update->Poll();
}

function Venue()
{
    $update = Request::getInstance();
    return $update->Venue();
}

function NewChatMembers()
{
    $update = Request::getInstance();
    return $update->NewChatMembers();
}

function LeftChatMember()
{
    $update = Request::getInstance();
    return $update->LeftChatMember();
}

function UpdateID()
{
    $update = Request::getInstance();
    return $update->UpdateID();
}

function UpdateCount(): int
{
    $update = Request::getInstance();
    return $update->UpdateCount();
}

function UserID()
{
    $update = Request::getInstance();
    return $update->UserID();
}

function ReplyToUserID()
{
    $update = Request::getInstance();
    return $update->ReplyToUserID();
}

function FromID()
{
    $update = Request::getInstance();
    return $update->FromID();
}

function FromChatID()
{
    $update = Request::getInstance();
    return $update->FromChatID();
}

function MessageFromGroup(): bool
{
    $update = Request::getInstance();
    return $update->MessageFromGroup();
}

function GetContactPhoneNumber()
{
    $update = Request::getInstance();
    return $update->GetContactPhoneNumber();
}

function MessageFromGroupTitle()
{
    $update = Request::getInstance();
    return $update->MessageFromGroupTitle();
}

function getUpdates($offset = 0, $limit = 100, $timeout = 0, $update = true)
{
    $update = Request::getInstance();
    return $update->getUpdates($offset, $limit, $timeout, $update);
}

function getUpdateType(): bool|string
{
    $update = Request::getInstance();
    return $update->getUpdateType();
}