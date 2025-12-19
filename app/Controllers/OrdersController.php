<?php

namespace App\Controllers;

use App\Domain\Models\ProductsModel;
use DI\Container;

class OrdersController extends BaseController
{
    public function __construct(Container $container, private ProductsModel $products_model)
    {
        parent::__construct($container);
    }
}
