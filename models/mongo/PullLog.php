<?php

class PullLog extends CollectionBase
{
	
    public $title;
    public $detail;
    public $status;
    public $begin_time;
    public $end_time;

    /*
    * 1- manga list 
    * 2- manga detail
    * 3- chapter
    * 4- chapter detail
    */
    public $step;
    public $excutes;

    public function getSource()
    {
        return "log_pull";
    }
}