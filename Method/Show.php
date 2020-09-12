<?php
namespace GDO\DogGreetings\Method;

use GDO\Dog\DOG_Command;
use GDO\Dog\DOG_Message;

final class Show extends DOG_Command
{
    public $group = "Greetings";
    public $trigger = "greeting show";
    
    public function isPrivateMethod() { return false; }
    
    public function dogExecute(DOG_Message $message)
    {
        
    }
    
}
