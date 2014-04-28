<?php

class ArticlesController extends Zend_Controller_Action
{

    public function init()
    {

    }

    public function indexAction()
    {
        if (true && $id = $this->_request->getParam('id', false)) {
            $model = new Models_Articles_Mapper();
            $article = $model->getArticle($id);
            if ($article->id){
        		$this->view->article = $article;
            }
        	else {
        	    throw new Zend_Controller_Dispatcher_Exception('Такой страницы нет на сайте');
        	}
        }   
        else {
            throw new Zend_Controller_Dispatcher_Exception('Такой страницы нет на сайте');
        }
    }

    public function categoryAction()
    {
        $id = $this->_request->getParam('id');
        if ($id) {
            $model = new Models_Categories_Mapper();
            $category = $model->getCategory($id);

        	if ($category->id) {
                $model = new Models_Articles_Mapper();
                $articles = $model->getArticles($category->id, 10);
        		$this->view->articles = $articles;
        		$this->view->category = $category;
        	}
        	else {
        		throw new Zend_Controller_Dispatcher_Exception('Такой страницы нет на сайте');
        	}
        }
        else {
        	throw new Zend_Controller_Dispatcher_Exception('Такой страницы нет на сайте');
        }
    }


}



