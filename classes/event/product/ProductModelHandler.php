<?php

namespace Allekslar\Dragdrop\Classes\Event\Product;

use Lovata\Toolbox\Classes\Event\ModelHandler;

use Lovata\Shopaholic\Models\Product;
use Lovata\Shopaholic\Classes\Item\ProductItem;
use Lovata\Shopaholic\Classes\Store\ProductListStore;
use Lovata\Shopaholic\Controllers\Products;

/**
 * Class class ProductModelHandler
 * @package Allekslar\Dragdrop\Classes\Event\Product
 */
class ProductModelHandler extends ModelHandler
{
    /** @var  Product */
    protected $obElement;

    /**
     * Add listeners
     * @param \Illuminate\Events\Dispatcher $obEvent
     */
    public function subscribe($obEvent)
    {
        parent::subscribe($obEvent);

        Product::extend(function ($obElement) {
            /** @var Product $obElement */
            $obElement->fillable[] = 'position';
        });

        $obEvent->listen('shopaholic.sorting.get.list', function ($sSorting) {
            return $this->getSortingList($sSorting);
        });

    }


    /**
     * Get model class name
     * @return string
     */
    protected function getModelClass()
    {
        return Product::class;
    }

    /**
     * Get item class name
     * @return string
     */
    protected function getItemClass()
    {
        return ProductItem::class;
    }

    /**
     * After create event handler
     */
    protected function afterCreate()
    {
        $this->obElement->position = $this->obElement->id;
        $this->obElement->save();
    }


    /**
     * Get sorting by priority
     * @param string $sSorting
     * @return array|null
     */
    protected function getSortingList($sSorting)
    {
        if (empty($sSorting) || $sSorting != 'priority|desc') {
            return null;
        }
        $arResultIDList = (array) Product::orderBy('position', 'desc')->lists('id');
        return $arResultIDList;
    }
}
