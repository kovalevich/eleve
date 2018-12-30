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
class Zend_View_Helper_Type
{

    /**
     *
     * @var Zend_View_Interface
     */
    public $view;

    /**
     */
    public function type ($role)
    {
        switch($role){
            case '0': {
                return 'обычный'; break;
            }
            case '1': {
                return 'gold'; break;
            }
            case '2': {
                return 'premium'; break;
            }
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
