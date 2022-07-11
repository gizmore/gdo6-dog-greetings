<?php
namespace GDO\DogGreetings;

use GDO\Core\GDO_Module;

final class Module_DogGreetings extends GDO_Module
{
    public function getDependencies() : array { return ['Dog']; }
    
    public function onLoadLanguage() : void { $this->loadLanguage('lang/greetings'); }
    
}
