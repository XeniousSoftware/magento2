<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Controller\Api;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context as Context;
use Magento\Framework\Controller\Result\JsonFactory as JSON;
use TmobLabs\Tappz\API\ProductRepositoryInterface;
use TmobLabs\Tappz\Helper\RequestHandler as RequestHandler;

/**
 * Class Productsearch.
 */
class Productsearch extends Action
{
    /**
     * @var
     */
    private $jsonResult;
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * Productsearch constructor.
     *
     * @param Context $context
     * @param JSON $json
     * @param ProductRepositoryInterface $productRepository
     * @param RequestHandler $helper
     */
    public function __construct(
        Context $context,
        JSON $json,
        ProductRepositoryInterface $productRepository,
        RequestHandler $helper
    ) {
        parent::__construct($context);
        $this->jsonResult = $json->create();
        $this->productRepository = $productRepository;
        $helper->checkAuth();
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $params = ($this->getRequest()->getParams());
        $result = $this->productRepository->getProductSearch($params);
        $this->jsonResult->setData($result);

        return $this->jsonResult;
    }
}
