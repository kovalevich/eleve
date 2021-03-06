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
class Zend_View_Helper_Catalogpage
{

    /**
     *
     * @var Zend_View_Interface
     */
    public $view;

    private $class;

    /**
     */
    public function catalogpage ($entries)
    {
        $list = '';
        if (count($entries) > 0) {
            foreach ($entries as $entry) {
                $photo = $entry->getPhoto(0);
                $list .= '<li>
                            <a href="' . $this->view->url(array('id'=>$entry->id), 'catalogin') . '">' . $this->view->photo($photo, 2) . '</a>
                            <span class="name"><a href="' . $this->view->url(array('id'=>$entry->id), 'catalogin') . '">' . $entry->name . '</a></span>
                        </li>';
            }
        }
        else {
            $list .= 'По вашему запросу нет предложений';
        }
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
