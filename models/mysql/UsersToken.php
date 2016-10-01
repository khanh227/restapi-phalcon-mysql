<?php
use \Phalcon\Mvc\Model\Exception;
use \Phalcon\Mvc\Model\Message;
use \Phalcon\Mvc\Model\Validator\Uniqueness;
use \Phalcon\Mvc\Model\Validator\InclusionIn;
use \Phalcon\Mvc\Model\Validator\ExclusionIn;
use \Phalcon\Mvc\Model\Validator\Email;
use \Phalcon\Mvc\Model\Validator\StringLength;
use \Phalcon\Mvc\Model\Validator\Url;
use \Phalcon\Mvc\Model\Validator\Regex;
use \Phalcon\Mvc\Model\Validator\PresenceOf;
use \Phalcon\Mvc\Model\Validator\Numericality;
use \Phalcon\Mvc\Model\Validator\Ip;

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

    public function validation()
    {
        $this->validate(new StringLength(array(
                "field" => 'uid',
                'max' => 50,
                'min' => 2,
                'messageMaximum' => 'We don\'t like really long names',
                'messageMinimum' => 'We want more than just their initials'
        )));

        // Token must be unique
        $this->validate(
            new Uniqueness(
                [
                    "field"   => "token",
                    "message" => "The token is already present in another record",
                ]
            )
        );

        // Uid must be unique
        $this->validate(
            new Uniqueness(
                [
                    "field"   => "uid",
                    "message" => "The uid is already present in another record",
                ]
            )
        );


        // Check if any messages have been produced
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }

}