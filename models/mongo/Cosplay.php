<?php

class Cosplay extends CollectionBase
{
	
    public $code;
    public $title;
    public $src;
    public $view;
    public $comments;
    public $md5_src;
    public $status;
    public $date_create;
    public $date_modify;

    public function getSource()
    {
        return "cosplay";
    }

    public function beforeCreate()
    {
        // Set the creation date
        $this->date_create = new MongoDate();
        $this->date_modify = new MongoDate();
        $this->md5_src = md5($this->src);
    }

    public function beforeUpdate()
    {
        $this->date_modify = new MongoDate();
        $this->md5_src = md5($this->src);
    }

}