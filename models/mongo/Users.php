<?php

class Users extends CollectionBase
{
    public $_id;
    public $email;
    public $name;
    public $phone;
    public $create;
    public $modify;

    public function getSource()
    {
        return "users";
    }

}