<?php 

class Models_Castings_Mapper extends Models_Mapper
{
    
    public function __construct($id = null)
    {
    	parent::__construct('Castings');
    	if ($id) {
    		$this->getRow($id);
    	}
    	return $this;
    }
    
    public function getCasting()
    {
    	return $this->convertRow($this->_row);
    }

    public function Subscribe($user_id, $casting_id) {
        $table = new Models_Tables_Subscription();
        $data = array(
            'user_id'=>$user_id,
            'casting_id'=>$casting_id
        );
        $table->insert($data);
    }

    public function getSubscribes ($id)
    {
        $select = $this->_db->select()
            ->from (array('subscribe'=>'subscription'), array('*'))
            ->join(array('user'=>'users'), 'user.id = subscribe.user_id', array(
                'user_name'=>'name'
            ))
            ->where('subscribe.casting_id = ?', $id)
            ->group('subscribe.user_id');

        $resultSet = $this->_db->fetchAll($select);
        $arr = array();
        foreach ($resultSet as $entry){
            $arr[$entry['user_id']] = $entry['user_name'];
        }
        return $arr;
    }

    public function getCastings($category = null, $count = 5){

        if(!$communications = Classes_Cache::get('castings'.$category.$count)){
            $select = $this->_db->select()
                ->from (array('casting'=>'castings'), array('*'))
                ->join(array('category'=>'categories'), 'category.id = casting.category_id', array(
                    'category_title'=>'title'
                ));

            if($category)
                $select->where('casting.category_id = ?', $category);

            $select->order('created desc');

            if ($count > 0)
                $select->limit($count);

            $resultSet = $this->_db->fetchAll($select);
            $communications = $this->convertRows($resultSet);

            Classes_Cache::save($communications, 'casting'.$category.$count, array('castings'));
        }
        return $communications;
    }
    
    public function getSearch ($id = null)
    {
    	$select = $this->_dbTable->select();
    	$select->where('id LIKE ?', $id.'%')
    	->limit(5, 0);
    	$resultSet = $this->_dbTable->fetchAll($select);
    
    	return $this->convertRows($resultSet);
    }

    public function getPage ($category = null, $page = 1)
    {
        $select = $this->_db->select()
            ->from (array('casting'=>'castings'), array('*'))
            ->join(array('category'=>'categories'), 'category.id = casting.category_id', array(
                'category_title'=>'title'
            ))
            ->order('casting.created desc');

        if ($category)
            $select->where ('casting.category_id = ?', $category);

        $adapter = new Zend_Paginator_Adapter_DbSelect($select);
        $paginator = new Zend_Paginator($adapter);
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage ($this->_config->items_on_page);

        return $paginator;
    }
    
    
    public function convertRow($row)
    {
    	$entry = parent::convertRow($row);
        if (!$entry) return null;

        $entry->category = new Models_Categories_Model(array(
            'id'=>$row['category_id'],
            'title'=>$row['category_title']
        ));
        $entry->subscribes = $this->getSubscribes($row['id']);
    	return $entry;
    }
    
    public function save()
    {
    	Classes_Cache::clear(array('castings'));
    	parent::save();
    } 
    
    public function delete($id)
    {
    	Classes_Cache::clear(array('castings', 'categories'));
    	parent::delete($id);
    }
}

?>