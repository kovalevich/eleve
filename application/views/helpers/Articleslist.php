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
class Zend_View_Helper_Articleslist
{

    /**
     *
     * @var Zend_View_Interface
     */
    public $view;
    
    private $class;

    /**
     */
    public function articleslist ($entries, $type = false)
    {
        $list = '';
        
        if (!$type) {
            if (count($entries) > 0) {
                foreach ($entries as $entry) {
                    $list .= '<li><div class="date">' . $this->view->nicetime($entry->created) . '</div><a href="' . $this->view->url(array('id'=>$entry->id), 'pages') . '">' . $entry->title . '</a></li>';
                }
            }
        }
        else {
            if (count($entries) > 0) {
                $list .= '<ul class="list_news">';
            	foreach ($entries as $entry) {
                    $list .= '<li><h3><a href="' . $this->view->url(array('id'=>$entry->id), 'newsin') . '">' . $entry->title . '</a></h3>
                        <span class="date">' . $this->view->nicetime($entry->created) . '</span>
                        ' . stristr($entry->text, "<hr", true) . '
                        <a href="#">подробнее</a></li>';
            	}
            	$list .= '</ul>';
            }
            else {
                $list .= 'Пока нет материалов в этой категории';
            }
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
    
    private function toogleClass ()
    {
        if ($this->class == 'even') {
        	$this->class = 'odd';
        }
        else $this->class = 'even';
        
        return $this->class;
    }
}
