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

    public function setPassword($password)
    {
        $this->_row->password = md5(md5($password).md5(Zend_Registry::get('_config')->my->salt));
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

    public function getAncket($id)
    {
        $select = $this->_db->select()
            ->from (array('user'=>'users'), array('*'));

        $select->where('user.public_id = ?', $id);

        $resultSet = $this->_db->fetchRow($select);
        $user = $this->convertRow($resultSet);

        return $user;
    }

    public function checkId($id)
    {
        $select = $this->_db->select()
            ->from (array('user'=>'users'), array('*'));

        $select->where('user.public_id = ?', $id);

        $resultSet = $this->_db->fetchRow($select);
        if($resultSet) return true;
        else return false;
    }

    public function findByEmail($email)
    {
        $select = $this->_db->select()
            ->from (array('user'=>'users'), array('id'));

        $select->where('user.email = ?', $email);
        $resultSet = $this->_db->fetchRow($select);
        if (!$resultSet) return null;
        $this->getRow($resultSet['id']);

        return $this->convertRow($this->getArray());
    }

    public function getSubscribes ($id)
    {
        $select = $this->_db->select()
            ->from (array('subscribe'=>'subscription'), array('*'))
            ->join(array('casting'=>'castings'), 'casting.id = subscribe.casting_id', array(
                'casting_title'=>'title'
            ))
            ->where('subscribe.user_id = ?', $id);
            //->group('subscribe.casting_id');

        $resultSet = $this->_db->fetchAll($select);
        $arr = array();
        foreach ($resultSet as $entry){
            $arr[$entry['casting_id']] = $entry['casting_title'];
        }
        return $arr;
    }

    public function getUsers($role = null, $count = 5, $type = null, $active = null)
    {
        if(!$users = Classes_Cache::get('users'.$role.$count.$type.$active)){
            $select = $this->_db->select()
                ->from (array('user'=>'users'), array('*'));

            if($role)
                $select->where('role = ?', $role);

            if($type !== null)
                $select->where('account_type = ?', $type);

            if($active !== null)
                $select->where('account_status = ?', $active);

            $select->order('created desc');

            if ($count > 0)
                $select->limit($count);

            $resultSet = $this->_db->fetchAll($select);
            $users = $this->convertRows($resultSet);

            Classes_Cache::save($users, 'users'.$role.$count, array('users'));
        }
        return $users;
    }

    public function getPage($page = 1, $type = null, $active = null)
    {
        $select = $this->_db->select()
            ->from (array('user'=>'users'), array('*'))
            ->where('user.status = 1');

        $select->order('user.account_type1 DESC');

        $targets = Zend_Registry::isRegistered('filter_targets') ? Zend_Registry::get('filter_targets') : null;
        if($targets) $select->where('user.goal_' . $targets .' = 1');

        $status = Zend_Registry::isRegistered('filter_prof') ? Zend_Registry::get('filter_prof') : null;
        if($status) $select->where('user.prof_' . $status .' = 1');

        $growth = Zend_Registry::isRegistered('filter_growth') ? Zend_Registry::get('filter_growth') : null;
        if($growth) {
            switch ($growth){
                case 1: $gr_l = 170; $gr_r = 180; break;
                case 2: $gr_l = 180; $gr_r = 190; break;
                case 3: $gr_l = 190; $gr_r = 195; break;
                default: $gr_l = 170; $gr_r = 195; break;
            }
            $select->where('user.growth >= ?', $gr_l);
            $select->where('user.growth <= ?', $gr_r);
        }

        $b = Zend_Registry::isRegistered('filter_b') ? Zend_Registry::get('filter_b') : null;
        if($b) {
            $today = time();
            switch ($b){
                case 20: $gr_l = date('Y-m-d', $today - 20 * 365 * 24 * 3600); $gr_r = date('Y-m-d', $today - 18 * 365 * 24 * 3600); break;
                case 30: $gr_l = date('Y-m-d', $today - 30 * 365 * 24 * 3600); $gr_r = date('Y-m-d', $today - 20 * 365 * 24 * 3600); break;
                case 40: $gr_l = date('Y-m-d', $today - 40 * 365 * 24 * 3600); $gr_r = date('Y-m-d', $today - 30 * 365 * 24 * 3600); break;
                default: $gr_l = date('Y-m-d', $today - 40 * 365 * 24 * 3600); $gr_r = date('Y-m-d', $today - 12 * 365 * 24 * 3600); break;
            }
            $select->where('user.date_brit > ?', $gr_l);
            $select->where('user.date_brit < ?', $gr_r);
        }
        if($type !== null)
            $select->where('account_type = ?', $type);

        if($active !== null)
            $select->where('account_status = ?', $active);
        $adapter = new Zend_Paginator_Adapter_DbSelect($select);
        $paginator = new Zend_Paginator($adapter);
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage ($this->_config->items_on_page_catalog);

        return $paginator;
    }
    
    public function convertRow($row = null)
    {
    	$entry = parent::convertRow($row);
        $entry->subscribes = $this->getSubscribes($entry->id);
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