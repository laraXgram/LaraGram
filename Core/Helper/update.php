<?php

use Bot\Core\Request;

function getData()
{
    return (Request::getInstance())->getData();
}

function Entities()
{
    return (Request::getInstance())->Entities();
}

function Message()
{
    return (Request::getInstance())->Message();
}

function Dice()
{
    return (Request::getInstance())->Dice();
}

function DiceEmoji()
{
    return (Request::getInstance())->DiceEmoji();
}

function DiceValue()
{
    return (Request::getInstance())->DiceValue();
}

function Text()
{
    return (Request::getInstance())->Text();
}

function Caption()
{
    return (Request::getInstance())->Caption();
}

function ChatID()
{
    return (Request::getInstance())->ChatID();
}

function Chat()
{
    return (Request::getInstance())->Chat();
}

function MessageID()
{
    return (Request::getInstance())->MessageID();
}

function ReplyToMessageID()
{
    return (Request::getInstance())->ReplyToMessageID();
}

function ReplyToMessageFromUserID()
{
    return (Request::getInstance())->ReplyToMessageFromUserID();
}

function Inline_Query()
{
    return (Request::getInstance())->Inline_Query();
}

function Callback_Query()
{
    return (Request::getInstance())->Callback_Query();
}

function Callback_ID()
{
    return (Request::getInstance())->Callback_ID();
}

function Callback_Data()
{
    return (Request::getInstance())->Callback_Data();
}

function Callback_Message()
{
    return (Request::getInstance())->Callback_Message();
}

function Callback_ChatID()
{
    return (Request::getInstance())->Callback_ChatID();
}

function Callback_FromID()
{
    return (Request::getInstance())->Callback_FromID();
}

function Dates()
{
    return (Request::getInstance())->Date();
}

function FirstName()
{
    return (Request::getInstance())->FirstName();
}

function LastName()
{
    return (Request::getInstance())->LastName();
}

function Username()
{
    return (Request::getInstance())->Username();
}

function BotUsername()
{
    return (Request::getInstance())->BotUsername();
}

function Location()
{
    return (Request::getInstance())->Location();
}

function Contact()
{
    return (Request::getInstance())->Contact();
}

function Game()
{
    return (Request::getInstance())->Game();
}

function Poll()
{
    return (Request::getInstance())->Poll();
}

function Venue()
{
    return (Request::getInstance())->Venue();
}

function NewChatMembers()
{
    return (Request::getInstance())->NewChatMembers();
}

function LeftChatMember()
{
    return (Request::getInstance())->LeftChatMember();
}

function UpdateID()
{
    return (Request::getInstance())->UpdateID();
}

function UpdateCount(): int
{
    return (Request::getInstance())->UpdateCount();
}

function UserID()
{
    return (Request::getInstance())->UserID();
}

function ReplyToUserID()
{
    return (Request::getInstance())->ReplyToUserID();
}

function FromID()
{
    return (Request::getInstance())->FromID();
}

function FromChatID()
{
    return (Request::getInstance())->FromChatID();
}

function MessageFromGroup(): bool
{
    return (Request::getInstance())->MessageFromGroup();
}

function GetContactPhoneNumber()
{
    return (Request::getInstance())->GetContactPhoneNumber();
}

function MessageFromGroupTitle()
{
    return (Request::getInstance())->MessageFromGroupTitle();
}