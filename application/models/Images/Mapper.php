<?php 

class Models_Images_Mapper extends Models_Mapper
{
    
    public function __construct($id = null)
    {
    	parent::__construct('Images');
    	if ($id) {
    		$this->getRow($id);
    	}
    	return $this;
    }
    
    public function getImage($id)
    {
        $select = $this->_db->select()
            ->from (array('image'=>'images'), array('*'));

        $select->where('image.id = ?', $id);

        $resultSet = $this->_db->fetchRow($select);
        $user = $this->convertRow($resultSet);

        return $user;
    }

    public function getImages($user_id, $count = null)
    {
        if(!$images = Classes_Cache::get('images'.$user_id.$count)){
            $select = $this->_db->select()
                ->from (array('image'=>'images'), array('*'));

            if($user_id)
                $select->where('image.user_id = ?', $user_id);

            $select->order('image.is_primary desc');

            if ($count > 0)
                $select->limit($count);

            $resultSet = $this->_db->fetchAll($select);
            $images = $this->convertRows($resultSet);

            Classes_Cache::save($images, 'images'.$user_id.$count, array('images'));
        }
        return $images;
    }

    public function loadImages(Zend_Form_Element_File $files, $user_id)
    {

        $adapter = $files->getTransferAdapter();
        foreach ($adapter->getFileInfo() as $info)
        {
            if ($info['name']) {
                $fileInfo = new SplFileInfo($info['name']);
                $newFilename = 'photo-' . Classes_IdGenerator::generate() . '.' . $fileInfo->getExtension();
                $adapter->clearFilters();
                $adapter->addFilter('Rename', $newFilename);

                if ($adapter->receive($info['name']))
                {
                    $this->cropImage('data/uploads/'.$newFilename, 130, 194);
                    $this->cropImage('data/uploads/'.$newFilename, 310, 460);
                    $this->cropImage('data/uploads/'.$newFilename, 110, 110);
                    $this->_row = $this->getNullRow();
                    $this->user_id = $user_id;
                    $this->name = $newFilename;
                    $this->save();
                }
				else echo $info['name'];
            }
        }
    }

    public function addImage($user_id, $image, $is_primary = 0, $description = null)
    {
        $this->getNullRow();
        $this->user_id = $user_id;
        $this->name = $image;
        $this->is_prymary = $is_primary;
        $this->description = $description;

        return $this->save();
    }

    private function cropImage($image, $w, $h)
    {
        $img = new Imagick($image);
        $img->cropThumbnailImage($w, $h);
        $name = str_replace('uploads/', 'uploads/' . $w . '-' . $h . '-', $image);
        $img->writeImage($name);
    }

    
    public function convertRow($row, $is_files = false)
    {
    	$entry = parent::convertRow($row);
    	return $entry;
    }
    
    public function save()
    {
    	Classes_Cache::clear(array('images'));
    	return parent::save();
    }
    
    public function delete($id)
    {
    	Classes_Cache::clear(array('images'));
    	parent::delete($id);
    }
    
}

?>