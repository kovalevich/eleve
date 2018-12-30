<?php 

class Models_Communications_Mapper extends Models_Mapper
{
    
    public function __construct($id = null)
    {
    	parent::__construct('Communications');
    	if (isset($id)) {
    		$this->getRow($id);
    	}
    	return $this;
    }
    
    public function getArticle()
    {
    	return $this->convertRow($this->_row);
    }

    public function getCommunications($category = null, $count = 5){

        if(!$communications = Classes_Cache::get('communications'.$category.$count)){
            $select = $this->_db->select()
                ->from (array('communication'=>'communications'), array('*'))
                ->join(array('category'=>'categories'), 'category.id = communication.category_id', array(
                    'category_title'=>'title'
                ));

            if($category)
                $select->where('communication.category_id = ?', $category);

            $select->order('created desc');

            if ($count > 0)
                $select->limit($count);

            $resultSet = $this->_db->fetchAll($select);
            $communications = $this->convertRows($resultSet);

            Classes_Cache::save($communications, 'communications'.$category.$count, array('communications'));
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
            ->from (array('communication'=>'communications'), array('*'))
            ->join(array('category'=>'categories'), 'category.id = communication.category_id', array(
                'category_title'=>'title'
            ))
            ->order('communication.created desc');

        if ($category)
            $select->where ('communication.category_id = ?', $category);

        $adapter = new Zend_Paginator_Adapter_DbSelect($select);
        $paginator = new Zend_Paginator($adapter);
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage ($this->_config->items_on_page);

        return $paginator;
    }
    
    
    public function convertRow($row = null)
    {
    	$entry = parent::convertRow($row);
        if (!$entry) return null;

        $entry->category = new Models_Categories_Model(array(
            'id'=>$row['category_id'],
            'title'=>$row['category_title']
        ));
    	return $entry;
    }
    
    public function save()
    {
    	Classes_Cache::clear(array('communications'));
    	parent::save();
    } 
    
    public function delete($id)
    {
    	Classes_Cache::clear(array('communications', 'categories'));
    	parent::delete($id);
    }
}

?>