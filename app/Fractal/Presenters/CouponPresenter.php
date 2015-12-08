<?php

namespace CodeDelivery\Fractal\Presenters;

use CodeDelivery\Fractal\Transformers\CouponTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CouponPresenter
 *
 * @package namespace CodeDelivery\Fractal\Presenters;
 */
class CouponPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CouponTransformer();
    }
}
