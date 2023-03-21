<?php
namespace GDO\DogGreetings\Method;

use GDO\Dog\DOG_Command;
use GDO\Dog\DOG_Message;

final class Show extends DOG_Command
{

	public $group = 'Greetings';
	public $trigger = 'show_greeting';

	public function isPrivateMethod() { return false; }

	public function dogExecute(DOG_Message $message)
	{
		$set = DOG_Command::byTrigger('set_greeting');
		$greeting = $set->getConfigValueRoom($message->room, 'greetings_text', null);
		$message->rply('msg_dog_greeting_show', [$message->room->getName(), $greeting]);
	}

}
