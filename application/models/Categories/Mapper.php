<?php 

class Models_Categories_Mapper extends Models_Mapper
{
    
    public function __construct($id = null)
    {
    	parent::__construct('Categories');
    	if ($id) {
    		$this->getRow($id);
    	}
    	return $this;
    }
    
    public function getCategory($id)
    {
        if(!$category = Classes_Cache::get('category'.$id)){
            $select = $this->_db->select()
                ->from (array('category'=>'categories'), array('*'))
                ->where('id = ?', $id);

            $resultSet = $this->_db->fetchRow($select);
            $category = $this->convertRow($resultSet);

            Classes_Cache::save($category, 'category'.$id, array('categories'));
        }
        return $category;
    }
    
    public function getCategories($type = null)
    {
        if(!$categories = Classes_Cache::get('categories'.$type)){
            $select = $this->_db->select()
                ->from (array('category'=>'categories'), array('*'))
                ->order('title');

            if ($type){
                $select->where('type = ?', $type);
            }

            $resultSet = $this->_db->fetchAll($select);
            $categories = $this->convertRows($resultSet);

            Classes_Cache::save($categories, 'categories'.$type, array('categories'));
        }
        return $categories;
    }

    public function convertRow($row)
    {
        $entry = parent::convertRow($row);
        if (!$entry) return null;
        return $entry;
    }
    
    public function save()
    {
    	Classes_Cache::clear(array('categories'));
    	parent::save();
    }
    
    public function delete($id)
    {
    	Classes_Cache::clear(array('categories'));
    	parent::delete($id);
    }
    
}

?>