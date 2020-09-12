<?php
namespace GDO\DogGreetings;

use GDO\Core\GDO_Module;

final class Module_DogGreetings extends GDO_Module
{
    public function getDependencies() { return ['Dog']; }
    
    public function onLoadLanguage() { return $this->loadLanguage('lang/greetings'); }
    
}
