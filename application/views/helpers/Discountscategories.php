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
class Zend_View_Helper_Discountscategories
{

    /**
     *
     * @var Zend_View_Interface
     */
    public $view;

    private $categories;

    /**
     */
    public function discountscategories ($categories)
    {
        $this->categories = $categories;
        $list = '
        <ul class="list_catalog">
            <li>
                <h3>SPA &amp; Wellness</h3>
                <ul>';
        foreach ($this->categories as $category) {
            if ($category->description == 'SPA &amp; Wellness') {
                $list .= '<li><a href="' . $this->view->url(array('id'=>$category->id), 'discountcategory') . '">' . $category->title . '</a></li>';
            }
        }
        $list .= '</ul>
            </li>';

        $list .= '
            <li>
                <h3>Shopping</h3>
                <ul>';
        foreach ($this->categories as $category) {
            if ($category->description == 'Shopping') {
                $list .= '<li><a href="' . $this->view->url(array('id'=>$category->id), 'discountcategory') . '">' . $category->title . '</a></li>';
            }
        }
        $list .= '</ul>
                    </li>';

        $list .= '<li><h3>Здоровье</h3><ul>';
        foreach ($this->categories as $category) {
            if ($category->description == 'Здоровье') {
                $list .= '<li><a href="' . $this->view->url(array('id'=>$category->id), 'discountcategory') . '">' . $category->title . '</a></li>';
            }
        }
        $list .= '</ul></li>';

        $list .= '<li><h3>Развлечения</h3><ul>';
        foreach ($this->categories as $category) {
            if ($category->description == 'Развлечения') {
                $list .= '<li><a href="' . $this->view->url(array('id'=>$category->id), 'discountcategory') . '">' . $category->title . '</a></li>';
            }
        }
        $list .= '</ul></li>';

        $list .= '<li><h3>Рестораны</h3><ul>';
        foreach ($this->categories as $category) {
            if ($category->description == 'Рестораны') {
                $list .= '<li><a href="' . $this->view->url(array('id'=>$category->id), 'discountcategory') . '">' . $category->title . '</a></li>';
            }
        }
        $list .= '</ul></li></ul>';


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
