<?php
namespace GDO\DogGreetings\Method;

use GDO\Dog\DOG_Command;
use GDO\Dog\DOG_Message;

final class Remove extends DOG_Command
{
    public $group = "Greetings";
    public $trigger = "remove_greeting";
    
    public function isPrivateMethod() { return false; }
    
    public function dogExecute(DOG_Message $message)
    {
        /** @var \GDO\DogGreetings\Method\Set $set **/
        $set = DOG_Command::byTrigger('set_greeting');
        $set->setConfigValueRoom($message->room, 'greetings_text', null);
        $message->rply('msg_dog_greeting_removed', [$message->room->getName()]);
    }

}
