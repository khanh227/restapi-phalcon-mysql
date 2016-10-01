<?php

class UserFollows extends CollectionBase
{

    public $user_id;
    public $follows;
	
    public function getSource()
    {
        return "users_follows";
    }

    public function getByUserId()
    {
        return $this->findFirst(
            array(
                array(
                    "user_id" => $this->user_id
                )
            )
        );
    }
}