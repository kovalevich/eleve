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
class Zend_View_Helper_Companieslist
{

    /**
     *
     * @var Zend_View_Interface
     */
    public $view;

    private $class;

    /**
     */
    public function companieslist ($entries)
    {
        $list = '<ul class="list_catalog_in">';
        if (count($entries) > 0) {
            foreach ($entries as $entry) {
                $list .= '<li>
                    <h3>' . $entry->title . '</h3>
                    <span class="title">' . $entry->category->title . '</span>
                    ' . $entry->text . '
                </li>';
            }
        }
        else {
            $list .= $this->view->translate(_('Пока нет скидок в этой категории'));
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

    private function toogleClass ()
    {
        if ($this->class == 'even') {
            $this->class = 'odd';
        }
        else $this->class = 'even';

        return $this->class;
    }
}
