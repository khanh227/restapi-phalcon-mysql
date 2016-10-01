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

class Users extends ModelBase
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

    public function getUsers()
    {
    	$phql = "SELECT * FROM users";

        return $this->executeQuery($phql);
    }

    public function validation()
    {
        $this->validate(new StringLength(array(
                "field" => 'name',
                'max' => 50,
                'min' => 2,
                'messageMaximum' => 'We don\'t like really long names',
                'messageMinimum' => 'We want more than just their initials'
        )));

        // Type must be: droid, mechanical or virtual
        // $this->validate(
        //     new InclusionIn(
        //         [
        //             "field"  => "name",
        //             "domain" => [
        //                 "droid",
        //                 "mechanical",
        //                 "virtual",
        //             ]
        //        ]
        //     )
        // );

        // Email must be unique
        $this->validate(
            new Uniqueness(
                [
                    "field"   => "email",
                    "message" => "Value of field 'email' is already present in another record",
                ]
            )
        );

        // Email
        $this->validate(
            new Email(
                [
                    "field"   => "email",
                    "message" => "The email must be email structure",
                ]
            )
        );


        // Check if any messages have been produced
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}