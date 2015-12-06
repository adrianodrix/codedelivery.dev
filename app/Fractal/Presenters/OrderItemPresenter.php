<?php

namespace CodeDelivery\Fractal\Presenters;

use CodeDelivery\Fractal\Transformers\OrderItemTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class OrderItemPresenter
 *
 * @package namespace CodeDelivery\Fractal\Presenters;
 */
class OrderItemPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new OrderItemTransformer();
    }
}
