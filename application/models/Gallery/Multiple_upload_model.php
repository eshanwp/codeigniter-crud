<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Multiple_upload_model extends CI_Model {
    private  $id;
	private  $gallery_id;
    private  $file_name;




    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
    public function getFileName()
    {
        return $this->file_name;
    }

    /**
     * @param mixed $file_name
     *
     * @return self
     */
    public function setFileName($file_name)
    {
        $this->file_name = $file_name;

        return $this;
    }
}

