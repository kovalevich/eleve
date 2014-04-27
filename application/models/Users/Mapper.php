<?php 

class Models_Users_Mapper extends Models_Mapper
{
    
    public function __construct($id = null)
    {
    	parent::__construct('Users');
    	if ($id) {
    		$this->getRow($id);
    	}
    	return $this;
    }
    
    public function getUser($id)
    {
        $select = $this->_db->select()
            ->from (array('user'=>'users'), array('*'));

        $select->where('user.id = ?', $id);

        $resultSet = $this->_db->fetchRow($select);
        $user = $this->convertRow($resultSet);

        return $user;
    }

    public function getUsers($role = null, $count = 5)
    {
        if(!$users = Classes_Cache::get('users'.$role.$count)){
            $select = $this->_db->select()
                ->from (array('user'=>'users'), array('*'));

            if($role)
                $select->where('role = ?', $role);

            $select->order('created desc');

            if ($count > 0)
                $select->limit($count);

            $resultSet = $this->_db->fetchAll($select);
            $users = $this->convertRows($resultSet);

            Classes_Cache::save($users, 'users'.$role.$count, array('users'));
        }
        return $users;
    }

    public function getPage($page = 1)
    {
        $select = $this->_db->select()
            ->from (array('user'=>'users'), array('*'))
            ->where('user.status = 1');

        $adapter = new Zend_Paginator_Adapter_DbSelect($select);
        $paginator = new Zend_Paginator($adapter);
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage ($this->_config->items_on_page);

        return $paginator;
    }
    
    public function convertRow($row, $is_files = false)
    {
    	$entry = parent::convertRow($row);
    	return $entry;
    }
    
    public function save()
    {
    	Classes_Cache::clear(array('users'));
    	parent::save();
    }
    
    public function delete($id)
    {
    	Classes_Cache::clear(array('users'));
    	parent::delete($id);
    }
    
}

?>