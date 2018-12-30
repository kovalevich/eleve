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
class Zend_View_Helper_Role
{

    /**
     *
     * @var Zend_View_Interface
     */
    public $view;

    /**
     */
    public function role ($role)
    {
        switch($role){
            case 'admin': {
                return 'Администратор'; break;
            }
            case 'user': {
                return 'Пользователь'; break;
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
