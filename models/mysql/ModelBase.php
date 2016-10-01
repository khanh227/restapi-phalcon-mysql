<?php

use \Phalcon\Mvc\Model;

class ModelBase extends Model
{
	
 	public function getID() {
 		return (string)$this->_id;
 	}
}