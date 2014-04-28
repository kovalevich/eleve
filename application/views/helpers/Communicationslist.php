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
class Zend_View_Helper_Communicationslist
{

    /**
     *
     * @var Zend_View_Interface
     */
    public $view;

    /**
     */
    public function communicationslist ($entries)
    {
        $list = '
            <ul class="list_comunication">';
        foreach ($entries as $entry) {
            $list .= '
                <li>
                        <h3><a href="#">' . $entry->title . '</a></h3>
                        <span class="title">' . $entry->category->title . '</span>
                        ' . $entry->text . '
                    </li>
            ';
        }
        $list .= '</ul>';
        return $list;
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
