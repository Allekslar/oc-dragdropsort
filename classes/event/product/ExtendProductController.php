<?php namespace Allekslar\Dragdrop\Classes\Event\Product;


use Lovata\Shopaholic\Controllers\Products;

/**
 * Class ExtendProductController
 * @package Allekslar\Dragdrop\Classes\Event\Product
 */
class ExtendProductController

{
    /**
     * Add listeners
     * @param \Illuminate\Events\Dispatcher $obEvent
     */
    public function subscribe($obEvent)
    {
        Products::extend(function ($obController) {
            $this->extendConfig($obController);
        });

    }

    /**
     * Extend products controller
     * @param Products $obController
     */
    protected function extendConfig($obController)
    {
        $obController->listConfig = $obController->mergeConfig(
            $obController->listConfig,
            '$/allekslar/dragdrop/config/config_listdragdrop.yaml'
        );
        $obController->implement[] = 'Allekslar.Dragdrop.Behaviors.DragdropController';

        if (!isset($obController->dragdropConfig)) {
            $obController->addDynamicProperty('dragdropConfig');
        }

    }

}
