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
class Zend_View_Helper_Userstable
{

    /**
     *
     * @var Zend_View_Interface
     */
    public $view;

    private $class;

    /**
     */
    public function userstable ($entries)
    {
        $html = '
        <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Имя</th>
                  <th>Ссылка в каталоге</th>
                  <th>Роль</th>
                  <th>Цель</th>
                  <th>Тип</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>';

        if (count($entries)) {
            foreach ($entries as $entry) {
                $html .= '
                        <tr>
                            <td>' . $entry->id . '</td>
        	                <td>' . $entry->name . '</td>
                            <td><a href="' . $this->view->url(array('id'=>$entry->id), 'catalogin') . '">' . $this->view->url(array('id'=>$entry->id), 'catalogin') . '</a></td>
                            <td>' . $this->view->role($entry->role) . '</td>
                            <td>' . $this->view->target($entry->account_type) . '</td>
                            <td>' . $this->view->type($entry->account_type1) . '</td>
                            <td>
                                <a href="/profile/' . $entry->id . '"><span class="glyphicon glyphicon-pencil"></span></a>
                                ' . ($entry->account_status ?
                                '<a href="/adminpanel/users?deactivate=' . $entry->id . '"><span class="glyphicon glyphicon-star"></span></a>' :
                                '<a href="/adminpanel/users?activate=' . $entry->id . '"><span class="glyphicon glyphicon-star-empty"></span></a>') .

                            $this->view->delete('user', $entry) . '
                            </td>
                        </tr>
        	            ';
            }
        }
        else {
            $html .= '
                        <tr>
                            <td colspan="5">Нет публикаций</td>
                        </tr>
                    ';
        }

        $html .='
              </tbody>
            </table>
          </div>
        ';

        return $html;
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