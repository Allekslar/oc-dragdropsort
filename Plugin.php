<?php namespace Allekslar\Dragdrop;


use Event;
use System\Classes\PluginBase;
use  Allekslar\Dragdrop\Classes\Event\Product\ExtendFieldHandler;
use  Allekslar\Dragdrop\Classes\Event\Product\ProductModelHandler;
use  Allekslar\Dragdrop\Classes\Event\Product\ExtendProductColumnsHandler;
use  Allekslar\Dragdrop\Classes\Event\Product\ExtendProductController;

/**
 * Class Plugin
 * @package Allekslar\Dragdrop
 */
class Plugin extends PluginBase
{
    /** @var array Plugin dependencies */
    public $require = ['Lovata.Shopaholic', 'Lovata.Toolbox'];

    /**
     * Plugin boot method
     */
    public function boot()
    {
        $this->addEventListener();
    }

    /**
     * Add event listeners
     */
    protected function addEventListener()
    {
        Event::subscribe(ExtendFieldHandler::class);
        Event::subscribe(ProductModelHandler::class);
        Event::subscribe(ExtendProductColumnsHandler::class);
        Event::subscribe(ExtendProductController::class);
    }


}
