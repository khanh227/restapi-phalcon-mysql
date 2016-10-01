<?php

class Manga extends CollectionBase
{
	public $name;
	public $description;
	public $author;
	public $slug;
	public $rank;
	public $rank_order;
	public $total_chapters;
	public $status; // Ongoing
	public $image_link;
	public $total_view;
	public $code; // series_id
	public $popuplar;
	public $is_complete;
	public $is_hidden;
	public $is_new;
	public $is_process;
	public $is_crawl;
	public $genres;
	public $chapter_null;
    
    public $last_updated;
    public $date_create;
    public $date_modify;
    
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
        // $this->hasMany("_id", "Chapter", "manga_id");
    }

    public function getSource()
    {
        return "mangas";
    }

    public function getById() {
		return $this->findById($this->id);
	}

	public function getBySlug()
	{
		return $this->findFirst(
				array(
					array("slug" => $this->slug)
				)
			);
	}

	/*
	* check a manga exit by slug
	*/
	public function checkMangaExist()
	{
		if($manga = $this->getBySlug())
		{
			return $manga;
		}
		return false;
	}

	public function getPopular () {
		
	}

	public function getRamdom () {
		
	}

	public function getLatest () {
		
	}

	public function getRanking () {
		
	}

}