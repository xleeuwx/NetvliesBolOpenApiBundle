<?php

namespace Netvlies\Bundle\BolOpenApiBundle\Response;

use Netvlies\Bundle\BolOpenApiBundle\Model\Category;
use Netvlies\Bundle\BolOpenApiBundle\Model\OriginalRequest;
use Netvlies\Bundle\BolOpenApiBundle\Model\Product;
use Netvlies\Bundle\BolOpenApiBundle\Model\RefinementGroup;

class SearchResultsResponse
{
    protected $sessionId;
    protected $products;
    protected $totalResultSize;
    protected $categories;
    protected $refinementGroups;
    protected $originalRequest;

    public function __construct()
    {
        $this->products = array();
        $this->categories = array();
        $this->refinementGroups = array();
    }

    /**
     * @param \Netvlies\Bundle\BolOpenApiBundle\Model\Category $category
     */
    public function addCategory(Category $category)
    {
        $this->categories[] = $category;
    }

    /**
     * @param array $categories
     */
    public function setCategories(array $categories)
    {
        $this->categories = $categories;
    }

    /**
     * @return \Netvlies\Bundle\BolOpenApiBundle\Model\Category[]
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param \Netvlies\Bundle\BolOpenApiBundle\Model\OriginalRequest $originalRequest
     */
    public function setOriginalRequest(OriginalRequest $originalRequest)
    {
        $this->originalRequest = $originalRequest;
    }

    /**
     * @return \Netvlies\Bundle\BolOpenApiBundle\Model\OriginalRequest|null
     */
    public function getOriginalRequest()
    {
        return $this->originalRequest;
    }

    /**
     * @param \Netvlies\Bundle\BolOpenApiBundle\Model\Product $product
     */
    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    /**
     * @param array $products
     */
    public function setProducts(array $products)
    {
        $this->products = $products;
    }

    /**
     * @return \Netvlies\Bundle\BolOpenApiBundle\Model\Product[]
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param \Netvlies\Bundle\BolOpenApiBundle\Model\RefinementGroup $refinementGroup
     */
    public function addRefinementGroup(RefinementGroup $refinementGroup)
    {
        $this->refinementGroups[] = $refinementGroup;
    }

    /**
     * @param $refinementGroups
     */
    public function setRefinementGroups(array $refinementGroups)
    {
        $this->refinementGroups = $refinementGroups;
    }

    /**
     * @return \Netvlies\Bundle\BolOpenApiBundle\Model\RefinementGroup[]
     */
    public function getRefinementGroups()
    {
        return $this->refinementGroups;
    }

    /**
     * @param string $sessionId
     */
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;
    }

    /**
     * @return string
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * @param int $totalResultSize
     */
    public function setTotalResultSize($totalResultSize)
    {
        $this->totalResultSize = $totalResultSize;
    }

    /**
     * @return int
     */
    public function getTotalResultSize()
    {
        return $this->totalResultSize;
    }

    /**
     * @param \SimpleXMLElement $xmlElement
     */
    public function fromXml(\SimpleXMLElement $xmlElement)
    {
        foreach ($xmlElement->children() as $child) {
            if($child->getName() == 'Product') {
                $product = new Product();
                $product->fromXml($child);
                $this->addProduct($product);
            } elseif($child->getName() == 'Category') {
                $category = new Category();
                $category->fromXml($child);
                $this->addCategory($category);
            } elseif($child->getName() == 'RefinementGroup') {
                $refinementGroup = new RefinementGroup();
                $refinementGroup->fromXml($child);
                $this->addRefinementGroup($refinementGroup);
            } elseif($child->getName() == 'OriginalRequest') {
                $originalRequest = new OriginalRequest();
                $originalRequest->fromXml($child);
                $this->setOriginalRequest($originalRequest);
            } elseif($child->getName() == 'SessionId') {
                $this->setSessionId((string) $xmlElement->SessionId);
            } elseif($child->getName() == 'TotalResultSize') {
                $this->setTotalResultSize((string) $xmlElement->TotalResultSize);
            }
        }
    }
}