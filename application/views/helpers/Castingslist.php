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
class Zend_View_Helper_Castingslist
{

    /**
     *
     * @var Zend_View_Interface
     */
    public $view;

    /**
     */
    public function castingslist ($entries)
    {
        $list = '
            <ul class="list_comunication">';
        foreach ($entries as $entry) {
            $list .= '
                <li>
                        <h3><a href="#">' . $entry->title . '</a></h3>
                        <span class="title">' . $entry->category->title . '</span>
                        ' . $entry->text . '
                        <p>' . $this->view->translate(_('Отметили')) . ': ' . $entry->getSubscribes() . '</p><br/>
                        ' . ($this->view->user && !$entry->ifSubscribe($this->view->user) ? '<a href="?check=' . $entry->id . '" class="btn_save" style="padding: 3px 15px; font-size: 12px; text-decoration: solid;">' . $this->view->translate(_('Отметить')) . '</a>' : ''). '
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
