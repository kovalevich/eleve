<?php 

class Models_Discounts_Mapper extends Models_Mapper
{
    
    public function __construct($id = null)
    {
    	parent::__construct('Discounts');
    	if ($id) {
    		$this->getRow($id);
    	}
    	return $this;
    }

    public function getCompany($id)
    {
        $cache_id = preg_replace('[-]', '_', $id);
        if(!$article = Classes_Cache::get('company'.$cache_id)){
            $select = $this->_db->select()
                ->from (array('discount'=>'discounts'), array('*'))
                ->join(array('category'=>'categories'), 'category.id = discount.category_id', array(
                    'category_id'=>'id',
                    'category_title'=>'title',
                ));

            $select->where('discount.id = ?', $id);

            $resultSet = $this->_db->fetchRow($select);
            $article = $this->convertRow($resultSet);
            Classes_Cache::save($article, 'company'.$cache_id, array('discounts'));

        }

        return $article;
    }

    public function getCompanies($category = null, $count = 5){

        if(!$articles = Classes_Cache::get('companies'.$category.$count)){
            $select = $this->_db->select()
                ->from (array('discount'=>'discounts'), array('*'))
                ->join(array('category'=>'categories'), 'category.id = discount.category_id', array(
                    'category_title'=>'title'
                ))
                ->order('discount.created desc');

            if($category)
                $select->where('category_id = ?', $category);

            if ($count > 0)
                $select->limit($count);

            $resultSet = $this->_db->fetchAll($select);
            $articles = $this->convertRows($resultSet);

            Classes_Cache::save($articles, 'companies'.$category.$count, array('discounts'));
        }
        return $articles;
    }

    public function getPage ($category = null, $page = 1)
    {
        $select = $this->_db->select()
            ->from (array('discount'=>'discounts'), array('*'))
            ->join(array('category'=>'categories'), 'category.id = discount.category_id', array(
                'category_title'=>'title'
            ))
            ->order('discount.created desc');

        if ($category)
            $select->where ('discount.category_id = ?', $category);

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
    	return $entry;
    }
    
    public function save()
    {
    	Classes_Cache::clear(array('discounts'));
    	parent::save();
    } 
    
    public function delete($id)
    {
    	Classes_Cache::clear(array('discounts'));
    	parent::delete($id);
    }

    public function upHits ($id = false) {
        if ($id) {
            $this->_db->query('update `articles` set `hits` = `hits` + 1 where `id` = "' . $id . '"');
        }
    }
}

?>