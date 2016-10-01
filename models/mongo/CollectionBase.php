<?php

use \Phalcon\Mvc\Collection as Collection;

class CollectionBase extends Collection
{
 	public function getID() {
 		return (string)$this->_id;
 	}
}