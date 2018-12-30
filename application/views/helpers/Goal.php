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
class Zend_View_Helper_Goal
{

    /**
     *
     * @var Zend_View_Interface
     */
    public $view;

    /**
     */
    public function goal ($goal)
    {
        switch($goal) {
            case 1: return 'Мастер-классы';
            case 2: return 'Промо-акции';
            case 3: return 'Съемки для катологов';
            case 4: return 'Съемки в киносериалах';
            case 5: return 'Съемки в рекламе';
            case 6: return 'Вокальные, танцевальные или другие проекты';
            case 7: return 'Fashion показы, defile';
            case 8: return 'Презентации и выставки';
            case 9: return 'Съемки для журналов';
            case 10: return 'Съемки в клипах';
            case 11: return 'Работа переводчиком';
            default: return 'Мастер-классы';
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
