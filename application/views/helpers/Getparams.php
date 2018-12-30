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
class Zend_View_Helper_Getparams
{

    /**
     *
     * @var Zend_View_Interface
     */
    public $view;

    /**
     */
    public function getparams ()
    {
        $params = array();
        foreach ($_GET as $key=>$value)
        {
            $params[] = $key . '=' . $value;
        }
        return count($params) ? '?' . implode('&', $params) : '';
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
