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
class Zend_View_Helper_Castingstable
{

    /**
     *
     * @var Zend_View_Interface
     */
    public $view;

    private $class;

    /**
     */
    public function castingstable ($entries)
    {
        $html = '
        <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Название</th>
                  <th>Ссылка на кастинг</th>
                  <th>Категория</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>';

        if (count($entries)) {
            foreach ($entries as $entry) {
                $html .= '
                        <tr>
                            <td>' . $entry->id . '</td>
        	                <td>' . $entry->title . '</td>
                            <td><a href="/castings/' . $entry->id . '">/castings/' . $entry->id . '</a></td>
                            <td>' . $entry->category->title . '</td>
                            <td>
                                ' . $this->view->edit('casting', $entry) . '
                                ' . $this->view->delete('casting', $entry) . '
                            </td>
                        </tr>
        	            ';
            }
        }
        else {
            $html .= '
                        <tr>
                            <td colspan="5">Нет кастингов</td>
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
