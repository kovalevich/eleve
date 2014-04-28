<?php 

class Models_Users_Model extends Models_Model
{
    
    public $id, $name, $email, $phone, $photos, $role, $address, $education, $password, $date_brit, $created, $growth, $volumes, $volumes_shoes, $files, $passport, $date_passport;
    
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
