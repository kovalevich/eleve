<?php 

class Models_Castings_Model extends Models_Model
{
    
    public $id, $title, $text, $created, $category, $subscribes;
    
    public function __construct(array $options = null)
    {
        parent::__construct($options);
    }

    public function getSubscribes()
    {
        $list = '';
        if($this->subscribes) {
            foreach($this->subscribes as $entry) {
                $list .= $entry . ', ';
            }
        }
        return $list;
    }

    public function ifSubscribe($user_id){
        foreach($this->subscribes as $id=>$subscribe) {
            if($user_id == $id) return true;
        }
        return false;
    }
}

?>