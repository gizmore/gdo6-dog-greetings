<?php
namespace GDO\DogGreetings\Method;

use GDO\Core\GDO;
use GDO\Dog\DOG_Command;
use GDO\Dog\DOG_ConfigRoom;
use GDO\Dog\DOG_Message;

final class Reset extends DOG_Command
{

	public $group = 'Greetings';
	public $trigger = 'reset';

	protected function isPrivateMethod(): bool { return false; }

	public function dogExecute(DOG_Message $message)
	{
		/** @var Set $set * */
		$set = DOG_Command::byTrigger('set_greeting');
		$cmd = GDO::escapeS(get_class($set));
		DOG_ConfigRoom::table()->deleteWhere("confr_command=$cmd AND confr_key='greetings_text'");
		DOG_ConfigRoom::table()->clearCache();
		$message->rply('msg_dog_greeting_reset', [$message->room->getName()]);
	}

}
