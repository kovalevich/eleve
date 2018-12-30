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
class Zend_View_Helper_Delete
{

    /**
     *
     * @var Zend_View_Interface
     */
    public $view;

    /**
     */
    public function delete ($type, $obj)
    {
        $text = '';
        $url = '';
        
        $filter = new Zend_Filter_PregReplace(array('match' => '/\'|\"/',
        		                                    'replace' => ''));
        
        switch ($type) {
        	case 'category': {
        	    $text = sprintf("Удалить категорию %s безвозвратно?", $filter->filter($obj->title));
        	    $url = $this->view->url(array('id'=>$obj->id), 'deletecategory');
        		break;
        	}
            case 'article': {
                $text = sprintf("Удалить статью %s безвозвратно?", $filter->filter($obj->title));
                $url = $this->view->url(array('id'=>$obj->id), 'deletearticle');
                break;
            }
            case 'company': {
                $text = sprintf("Удалить компанию %s безвозвратно?", $filter->filter($obj->title));
                $url = $this->view->url(array('id'=>$obj->id), 'deletecompany');
                break;
            }
            case 'user': {
                $text = sprintf("Удалить пользователя %s безвозвратно?", $filter->filter($obj->name));
                $url = $this->view->url(array('id'=>$obj->id), 'deleteuser');
                break;
            }
            case 'communication': {
                $text = sprintf("Удалить событие %s безвозвратно?", $filter->filter($obj->title));
                $url = $this->view->url(array('id'=>$obj->id), 'deletecommunication');
                break;
            }
            case 'casting': {
                $text = sprintf("Удалить кастинг %s безвозвратно?", $filter->filter($obj->title));
                $url = $this->view->url(array('id'=>$obj->id), 'deletecasting');
                break;
            }
        }
        
        $html = '<a href="#" onClick="Confirm(\'' . $text . '\', \'' . $url . '\')"><span class="glyphicon glyphicon-trash"></span></a>';
        
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
