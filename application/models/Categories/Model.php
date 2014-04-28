<?php 

class Models_Categories_Model extends Models_Model
{
    
    public $id, $title, $description, $type;
    
    public function __construct(array $options = NULL)
    {
        parent::__construct($options);
    }
}

?>