<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_category_model extends CI_Model {
    
  private  $category_id;
  private  $category_name;
  private  $category_url;
  private  $category_description;
  private  $category_banner;
  private  $sub_category;
  private  $category_status;

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * @param mixed $category_id
     *
     * @return self
     */
    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategoryName()
    {
        return $this->category_name;
    }

    /**
     * @param mixed $category_name
     *
     * @return self
     */
    public function setCategoryName($category_name)
    {
        $this->category_name = $category_name;

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
    public function getCategoryDescription()
    {
        return $this->category_description;
    }

    /**
     * @param mixed $category_description
     *
     * @return self
     */
    public function setCategoryDescription($category_description)
    {
        $this->category_description = $category_description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategoryBanner()
    {
        return $this->category_banner;
    }

    /**
     * @param mixed $category_banner
     *
     * @return self
     */
    public function setCategoryBanner($category_banner)
    {
        $this->category_banner = $category_banner;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubCategory()
    {
        return $this->sub_category;
    }

    /**
     * @param mixed $sub_category
     *
     * @return self
     */
    public function setSubCategory($sub_category)
    {
        $this->sub_category = $sub_category;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategoryStatus()
    {
        return $this->category_status;
    }

    /**
     * @param mixed $category_status
     *
     * @return self
     */
    public function setCategoryStatus($category_status)
    {
        $this->category_status = $category_status;

        return $this;
    }
}

