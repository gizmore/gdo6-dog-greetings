<?php
namespace GDO\DogGreetings\Method;

use GDO\Dog\DOG_Command;
use GDO\Dog\DOG_Message;
use GDO\Dog\DOG_ConfigRoom;
use GDO\Core\GDO;

final class Reset extends DOG_Command
{
    public $group = "Greetings";
    public $trigger = "reset_greeting";
    
    public function isPrivateMethod() { return false; }
    
    public function dogExecute(DOG_Message $message)
    {
        /** @var \GDO\DogGreetings\Method\Set $set **/
        $set = DOG_Command::byTrigger('set_greeting');
        $cmd = GDO::escapeS(get_class($set));
        DOG_ConfigRoom::table()->deleteWhere("confr_command=$cmd AND confr_key='greetings_text'")->exec();
        DOG_ConfigRoom::table()->clearCache();
        $message->rply('msg_dog_greeting_reset', [$message->room->getName()]);
    }
    
}
