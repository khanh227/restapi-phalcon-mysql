<?php

class UsersToken extends ModelBase
{
 	public $_id;
    public $uid;
    public $token;
    public $salt;
    public $create;
    public $modify;

    public function getSource()
    {
        return "users_token";
    }

}
