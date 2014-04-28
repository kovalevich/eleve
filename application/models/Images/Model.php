<?php 

class Models_Images_Model extends Models_Model
{
    
    public $id, $user_id, $name, $description, $is_primary;
    
    public function __construct(array $options = null)
    {
        parent::__construct($options);
    }
    
}

?>