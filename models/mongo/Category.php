<?php

class Category extends CollectionBase
{
	
    public $name;
    public $code;

    public function getSource()
    {
        return "categories";
    }

    public function getCateogries()
    {
    	return $this->find();
    }

    public function getByName()
    {
        return $this->findFirst(
            array(
                'conditions' => array(
                    'name' => $this->name
                )
            )
        );
    }
}