<?php 

class Models_Users_Model extends Models_Model
{
    
    public $id, $name, $email, $phone, $photos, $role, $address, $education, $password, $date_brit, $created, $language_1, $language_2, $language_1_level, $language_2_level, $experience, $growth, $volumes, $volumes_shoes, $files, $passport, $date_passport,
    $account_type, $account_type1, $public_id, $goal_1, $goal_2, $goal_3, $goal_4, $goal_5, $goal_6, $goal_7, $goal_8, $goal_9, $goal_10, $goal_11, $quality, $account_status, $subscribes;
    
    public function __construct(array $options = null)
    {
        parent::__construct($options);
    }

    public function getPhoto($number = 0)
    {
        return count($this->photos) > $number ? $this->photos[$number] : null;
    }
    
}

?>
