<?php
declare(strict_types=1);
namespace GDO\DogGreetings\Method;

use GDO\Core\GDT_Checkbox;
use GDO\Dog\DOG_Command;
use GDO\Dog\DOG_Message;
use GDO\Dog\DOG_Room;
use GDO\Dog\DOG_Server;
use GDO\Dog\DOG_User;
use GDO\Dog\GDT_DogString;

/**
 * Set a greeting message for a channel.
 */
final class Set extends DOG_Command
{

	protected function isPrivateMethod(): bool { return false; }

	public function getConfigUser(): array
	{
		return [
			GDT_Checkbox::make('greetings_done')->initial('0'),
		];
	}

	protected function getConfigRoom(): array
	{
		return [
			GDT_DogString::make('greetings_text')->notNull(),
		];
	}

	public function gdoParameters(): array
	{
		return [
			GDT_DogString::make('text')->notNull(),
		];
	}

	public function dogExecute(DOG_Message $message, $text): bool
	{
		$this->setConfigValueRoom($message->room, 'greetings_text', $text);
		return $message->rply('msg_dog_greeting_set', [$message->room->getName(), $text]);
	}

	/**
	 * Hook dog join event to greet a user.
	 */
	public function dog_join(DOG_Server $server, DOG_User $user, DOG_Room $room): void
	{
		if ($text = $this->getConfigVarRoom($room, 'greetings_text'))
		{
			if (!$this->getConfigValueUser($user, 'greetings_done'))
			{
				$greetingText = sprintf('%s: %s', $user->getName(), $text);
				$server->getConnector()->sendToRoom($room, $greetingText);
				$this->setConfigValueUser($user, 'greetings_done', true);
			}
		}
	}

}
