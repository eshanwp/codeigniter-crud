<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery_data_model extends CI_Model {
	private  $gallery_id;
    private  $gallery_name;
    private  $gallery_titel;
    private  $gallery_status;


  

    /**
     * @return mixed
     */
    public function getGalleryId()
    {
        return $this->gallery_id;
    }

    /**
     * @param mixed $gallery_id
     *
     * @return self
     */
    public function setGalleryId($gallery_id)
    {
        $this->gallery_id = $gallery_id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGalleryName()
    {
        return $this->gallery_name;
    }

    /**
     * @param mixed $gallery_name
     *
     * @return self
     */
    public function setGalleryName($gallery_name)
    {
        $this->gallery_name = $gallery_name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGalleryTitel()
    {
        return $this->gallery_titel;
    }

    /**
     * @param mixed $gallery_titel
     *
     * @return self
     */
    public function setGalleryTitel($gallery_titel)
    {
        $this->gallery_titel = $gallery_titel;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGalleryStatus()
    {
        return $this->gallery_status;
    }

    /**
     * @param mixed $gallery_status
     *
     * @return self
     */
    public function setGalleryStatus($gallery_status)
    {
        $this->gallery_status = $gallery_status;

        return $this;
    }
}

