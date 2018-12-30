<?php 

class Models_Communications_Model extends Models_Model
{
    
    public $id, $title, $text, $created, $meta_title, $meta_keywords, $meta_description, $category;
    
    public function __construct(array $options = null)
    {
        parent::__construct($options);
    }
}

?>