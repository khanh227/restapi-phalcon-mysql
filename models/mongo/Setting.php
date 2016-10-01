<?php

class Setting extends CollectionBase
{
	
    public $subject;
    public $key;
    public $value;

    public $date_create;
    public $date_update;

    public function initialize()
    {
        // $this->ensureIndex();
    }

    // public function ensureIndex()
    // {
    //     // Get the raw \MongoDB Connection
    //     $connection = $this->getConnection();

    //     // Get the \MongoCollection connection (with added dynamic collection name (thanks Phalcon))
    //     $collection = $connection->selectCollection($this->getSource());

    //     // One index.
    //     $collection->createIndex(
    //         array('key' => 1),
    //         array('value' => true)
    //     );
    // }

    public function beforeCreate()
    {
        // Set the creation date
        $this->date_create = new MongoDate();
        $this->date_update = new MongoDate();
    }

    public function beforeUpdate()
    {
        $this->date_update = new MongoDate();
    }

    public function getSource()
    {
        return "setting";
    }

    public function findByKey()
    {
        return $this->findFirst(
                array(
                    array(
                        'key'=>$this->key
                    )
                )
            );
    }

}