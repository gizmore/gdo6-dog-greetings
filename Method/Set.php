<?php
namespace GDO\DogGreetings\Method;

use GDO\Dog\DOG_Command;
use GDO\Dog\GDT_DogString;
use GDO\DB\GDT_Checkbox;
use GDO\Dog\DOG_Message;
use GDO\Dog\DOG_Server;
use GDO\Dog\DOG_User;
use GDO\Dog\DOG_Room;

final class Set extends DOG_Command
{
    public $group = "Greetings";
    public $trigger = "set_greeting";
    
    public function isPrivateMethod() { return false; }
    
    public function getConfigUser()
    {
        return array(
            GDT_Checkbox::make('greetings_done')->initial('0'),
        );
    }
    
    public function getConfigRoom()
    {
        return array(
            GDT_DogString::make('greetings_text')->notNull(),
        );
    }
    
    public function gdoParameters()
    {
        return array(
            GDT_DogString::make('text')->notNull(),
        );
    }
    
    public function dogExecute(DOG_Message $message, $text)
    {
        $this->setConfigValueRoom($message->room, 'greetings_text', $text);
        return $message->rply('msg_dog_greeting_set', [$message->room->getName(), $text]);
    }
    
    /**
     * Hook dog join event to greet a user.
     * @param DOG_Server $server
     * @param DOG_User $user
     * @param DOG_Room $room
     */
    public function dog_join(DOG_Server $server, DOG_User $user, DOG_Room $room)
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
