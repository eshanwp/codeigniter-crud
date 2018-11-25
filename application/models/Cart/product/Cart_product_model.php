<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_product_model extends CI_Model {
    
    private  $product_id;
    private  $product_name;
    private  $product_url;
    private  $product_description;
    private  $category_url;
    private  $sub_category_url;
    private  $market_price;
    private  $discount_percent;
    private  $sale_price;
    private  $product_banner;
    private  $product_status;
    private  $product_in_stock;



    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @param mixed $product_id
     *
     * @return self
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProductName()
    {
        return $this->product_name;
    }

    /**
     * @param mixed $product_name
     *
     * @return self
     */
    public function setProductName($product_name)
    {
        $this->product_name = $product_name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProductUrl()
    {
        return $this->product_url;
    }

    /**
     * @param mixed $product_url
     *
     * @return self
     */
    public function setProductUrl($product_url)
    {
        $this->product_url = $product_url;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProductDescription()
    {
        return $this->product_description;
    }

    /**
     * @param mixed $product_description
     *
     * @return self
     */
    public function setProductDescription($product_description)
    {
        $this->product_description = $product_description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategoryUrl()
    {
        return $this->category_url;
    }

    /**
     * @param mixed $category_url
     *
     * @return self
     */
    public function setCategoryUrl($category_url)
    {
        $this->category_url = $category_url;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubCategoryUrl()
    {
        return $this->sub_category_url;
    }

    /**
     * @param mixed $sub_category_url
     *
     * @return self
     */
    public function setSubCategoryUrl($sub_category_url)
    {
        $this->sub_category_url = $sub_category_url;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMarketPrice()
    {
        return $this->market_price;
    }

    /**
     * @param mixed $market_price
     *
     * @return self
     */
    public function setMarketPrice($market_price)
    {
        $this->market_price = $market_price;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDiscountPercent()
    {
        return $this->discount_percent;
    }

    /**
     * @param mixed $discount_percent
     *
     * @return self
     */
    public function setDiscountPercent($discount_percent)
    {
        $this->discount_percent = $discount_percent;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSalePrice()
    {
        return $this->sale_price;
    }

    /**
     * @param mixed $sale_price
     *
     * @return self
     */
    public function setSalePrice($sale_price)
    {
        $this->sale_price = $sale_price;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProductBanner()
    {
        return $this->product_banner;
    }

    /**
     * @param mixed $product_banner
     *
     * @return self
     */
    public function setProductBanner($product_banner)
    {
        $this->product_banner = $product_banner;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProductStatus()
    {
        return $this->product_status;
    }

    /**
     * @param mixed $product_status
     *
     * @return self
     */
    public function setProductStatus($product_status)
    {
        $this->product_status = $product_status;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProductInStock()
    {
        return $this->product_in_stock;
    }

    /**
     * @param mixed $product_in_stock
     *
     * @return self
     */
    public function setProductInStock($product_in_stock)
    {
        $this->product_in_stock = $product_in_stock;

        return $this;
    }
}

