<?php

namespace Codilar\Seller\Model\Api;

use Exception;
use Codilar\Seller\Api\SellerRepositoryInterface;
use Codilar\Seller\Model\Seller as Model;
use Codilar\Seller\Model\SellerFactory as ModelFactory;
use Codilar\Seller\Model\ResourceModel\Seller as ResourceModel;
use Magento\Framework\Exception\AlreadyExistsException;
use Codilar\Seller\Model\ResourceModel\Seller\Collection;
use Codilar\Seller\Model\ResourceModel\Seller\CollectionFactory;

/**
 * Class SellerRepository
 *
 * @description A magento 2 module to have sellers for products
 * @author   Codilar Team Player <ankith@codilar.com>
 * @license  Open Source
 * @link     https://www.codilar.com
 * @copyright Copyright © 2021 Codilar Technologies Pvt. Ltd.. All rights reserved
 *
 * A magento 2 module to have sellers for products
 */
class SellerRepository implements SellerRepositoryInterface
{
    /**
     * @var ModelFactory
     */
    private  $modelFactory;
    /**
     * @var ResourceModel
     */
    private  $resourceModel;
    /**
     * @var CollectionFactory
     */
    private  $collectionFactory;

    /**
     * SellerRepository constructor.
     * @param CollectionFactory $collectionFactory
     * @param ModelFactory $modelFactory
     * @param ResourceModel $resourceModel
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        ModelFactory $modelFactory,
        ResourceModel $resourceModel
    ) {
        $this->modelFactory = $modelFactory;
        $this->resourceModel = $resourceModel;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @param $id
     * @return Model
     */
    public function getDataBYId($id): Model
    {
        return $this->load($id);
    }

    /**
     * @throws AlreadyExistsException
     */
    public function save(Model $model)
    {
       $this->resourceModel->save($model);
    }

    /**
     * @param Model $model
     * @return Model|void
     */
    public function afterSave(Model $model)
    {
        return $this->afterSave($model);
    }

    /**
     * @param Model $model
     * @return bool
     */
    public function delete(Model $model): bool
    {
        try {
            $this->resourceModel->delete($model);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * @param $value
     * @param string|null $field
     * @return Model
     */
    public function load($value, $field = null): Model
    {
        $model = $this->create();
        $this->resourceModel->load($model, $value, $field);
        return $model;
    }

    /**
     * @return Model
     */
    public function create(): Model
    {
       return $this->modelFactory->create();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById($id): bool
    {
       $model = $this->load($id);
       return $this->delete($model);
    }

    /**
     * @param $value
     * @param string|null $field
     * @return bool
     */
    public function deleteByField($value, $field=null): bool
    {
        $model = $this->load($value, $field);
        return $this->delete($model);
    }

    /**
     * @return Model
     */
    public function getCollection(): Model
    {
        return $this->collectionFactory->create();
    }
}
