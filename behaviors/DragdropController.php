<?php

namespace Allekslar\Dragdrop\Behaviors;

use Lang;
use Flash;
use Lovata\Shopaholic\Models\Product;

class DragdropController extends \October\Rain\Extension\ExtensionBase
{
    /**
     * @var 
     */
    protected $parent;

    /**
     * Constructor
     */
    public function __construct($parent)
    {
        $this->parent = $parent;
        // add the dragdrop requirements
        $parent->addCss('/plugins/allekslar/dragdrop/assets/css/sortable.css');
        $parent->addJs('/plugins/allekslar/dragdrop/assets/js/html5sortable.js');
        $parent->addJs('/plugins/allekslar/dragdrop/assets/js/sortable.js');
    }
    /**
     * Extend the list query to iPosition the rows correctly
     */
    public function listExtendQuery($query, $definition = null)
    {
        $query->orderBy('position', 'asc');
    }

    /** 
     * Reorder the row iPositions
     */
    public function index_onUpdatePosition()
    {
        $arMovedPosition = [];
        $iPosition = 0;
        if (($arReorderIds = post('checked')) && is_array($arReorderIds) && count($arReorderIds)) {
            foreach ($arReorderIds as $id) {
                if (in_array($id, $arMovedPosition) || !$obProduct = Product::find($id))
                    continue;
                $obProduct->position = $iPosition;
                $obProduct->save();
                $arMovedPosition[] = $id;
                $iPosition++;
            }
            Flash::success('Successfully re-ordered obProducts.');
        }
        return $this->parent->listRefresh();
    }
}
