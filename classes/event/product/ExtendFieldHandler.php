<?php namespace Allekslar\Dragdrop\Classes\Event\Product;

use Lovata\Shopaholic\Models\Product;
use Lovata\Shopaholic\Controllers\Products;


/**
 * Class ExtendFieldHandler
 * @package Allekslar\Dragdrop\Classes\Event\Product
 */
class ExtendFieldHandler
{
    /**
     * Add listeners
     * @param \Illuminate\Events\Dispatcher $obEvent
     */
    public function subscribe($obEvent)
    {
        $obEvent->listen('backend.form.extendFields', function ($obWidget) {
            $this->extendProductFields($obWidget);
        });
    }


    /**
     * Extend Product fields
     * @param \Backend\Widgets\Form $obWidget
     */
    protected function extendProductFields($obWidget)
    {
        if (!$obWidget->getController() instanceof Products || $obWidget->isNested || empty($obWidget->context)) {
            return;
        }

        if (!$obWidget->model instanceof Product) {
            return;
        }

        $arFieldList = [
            'position' => [
                'label'   => 'allekslar.dragdrop::lang.field.position',
                'tab'     => 'lovata.toolbox::lang.tab.settings',
                'span'    => 'left',
                'default' => 0,
                'type'    => 'number',
            ],
        ];

        $obWidget->addTabFields($arFieldList);
    }
}
