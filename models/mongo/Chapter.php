<?php

class Chapter extends CollectionBase
{
	public $manga_id;
    public $name;
    public $chapter_number;
    public $chapter_page;
    public $chapter_source;
    public $image_domain;
    public $link;
    public $code; //chapter_id
    public $is_new; // bool
    public $is_show; // bool
    public $last_updated;
    public $date_create;
    public $date_modify;
    
    public $view = 0;
    public $like = 0;

    public function beforeCreate()
    {
        // Set the creation date
        $this->date_create = new MongoDate();
        $this->date_modify = new MongoDate();
    }

    public function beforeUpdate()
    {
        $this->date_modify = new MongoDate();
    }

    public function initialize()
    {
        // $this->belongsTo("manga_id", "Manga", "_id");
    }

    public function getSource()
    {
        return "chapters";
    }

    /*
    * check a chapter exit by mangaid && chapter_id
    */
    public function checkChapterExist()
    {
        if($chapter = $this->getByMangaIdChapterID())
        {
            return $chapter;
        }
        return false;
    }    

    public function getByMangaId() {
        return $this->find(
                array(
                    array(
                        "manga_id" => $this->manga_id
                    ),
                    "sort"  => array("chapter_number" => -1)
                )
            );
    }

    public function getByMangaIdChapterID() 
    {
        return $this->findFirst(
                array(
                    array(
                        "manga_id" => $this->manga_id,
                        "code" => $this->code
                    )
                )
            );
    }

}