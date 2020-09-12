<?php
namespace GDO\DogGreetings\Method;

use GDO\Dog\DOG_Command;
use GDO\Dog\DOG_Message;

final class Remove extends DOG_Command
{
    public $group = "Greetings";
    public $trigger = "greeting remove";
    
    public function isPrivateMethod() { return false; }
    
    public function dogExecute(DOG_Message $message)
    {
        
    }

}
