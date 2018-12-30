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
class Zend_View_Helper_Target
{

    /**
     *
     * @var Zend_View_Interface
     */
    public $view;

    /**
     */
    public function target ($role)
    {
        switch($role){
            case '0': {
                return 'публикация кастингов'; break;
            }
            case '1': {
                return 'участие в кастинге'; break;
            }
            case '2': {
                return 'размещение анкеты'; break;
            }
            case '3': {
                return 'дисконтный клуб'; break;
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
