<?php

namespace Codilar\Seller\Model;

use Magento\Framework\Model\AbstractModel;
use Codilar\Seller\Model\ResourceModel\Seller as ResourceModel;
/**
 * class Seller
 *
 * @description A magento 2 module to have sellers for products
 * @author   Codilar Team Player <ankith@codilar.com>
 * @license  Open Source
 * @link     https://www.codilar.com
 * @copyright Copyright © 2021 Codilar Technologies Pvt. Ltd.. All rights reserved
 *
 * A magento 2 module to have sellers for products
 */
class Seller extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
