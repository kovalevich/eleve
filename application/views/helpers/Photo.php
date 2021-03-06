<?php
/**
 *
 * @author kovalevich
 * @version
 */
require_once 'Zend/View/Interface.php';

/**
 * Nicetime helper
 *
 * @uses viewHelper Zend_View_Helper
 */
class Zend_View_Helper_Photo
{

    /**
     *
     * @var Zend_View_Interface
     */
    public $view;

    /**
     */
    public function photo ($photo, $type = 3, $is_linc = false)
    {
		if(!$photo) return false;
      switch($type) {
      	case 1: $prefix = '310-460-'; break;
      	case 2: $prefix = '130-194-'; break;
      	case 3: $prefix = '110-110-'; break;
      	
      	default: $prefix = '';
      }
      return $is_linc ? '<a href="/data/uploads/' . $photo->name . '" rel="groop"><img src="/data/uploads/' . $prefix . $photo->name . '" alt=""></a>' 
      	: '<img src="/data/uploads/' . $prefix . $photo->name . '" alt="">';
    }

    /**
     * Sets the view field
     *
     * @param $view Zend_View_Interface
     */
    public function setView (Zend_View_Interface $view)
    {
        $this->view = $view;
    }

}
