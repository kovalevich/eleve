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
class Zend_View_Helper_Level
{

    /**
     *
     * @var Zend_View_Interface
     */
    public $view;

    /**
     */
    public function level ($level)
    {
        switch($level) {
            case 1: return 'низкий';
            case 2: return 'средний';
            case 3: return 'высокий';
            default: return 'средний';
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
