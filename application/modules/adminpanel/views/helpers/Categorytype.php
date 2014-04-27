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
class Zend_View_Helper_Categorytype
{

    /**
     *
     * @var Zend_View_Interface
     */
    public $view;

    /**
     */
    public function categorytype ($type)
    {
        switch($type){
            case 'articles': return 'Категория статей'; break;
            case 'communications': return 'Категория событий'; break;
            case 'discounts': return 'Категория компаний'; break;
            default: return 'Неизвестная категория';
        }
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
