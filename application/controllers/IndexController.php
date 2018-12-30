<?php

class IndexController extends Zend_Controller_Action
{
    
    private $user;

    public function init()
    {
        $this->redirect('/news');
        $this->user = Zend_Registry::get('user');
    }

    public function indexAction()
    {

        $this->view->bgs = '<div class="caledoscop">
            <img alt="" src="img/slids/img_1.jpg">
            <img alt="" src="img/slids/img_2.jpg">
            <img alt="" src="img/slids/img_3.jpg">
            <img alt="" src="img/slids/img_4.jpg">
            <img alt="" src="img/slids/img_5.jpg">
            <img alt="" src="img/slids/img_6.jpg">
            <img alt="" src="img/slids/img_7.jpg">
            <img alt="" src="img/slids/img_8.jpg">
            <img alt="" src="img/slids/img_9.jpg">
            <img alt="" src="img/slids/img_10.jpg">
            <img alt="" src="img/slids/img_11.jpg">
            <img alt="" src="img/slids/img_12.jpg">
            <img alt="" src="img/slids/img_13.jpg">
            <img alt="" src="img/slids/img_14.jpg">
        </div>';
        
        $usermenu = '';
        if ($this->user) {
            $usermenu .= 
                '<li><a href="' . $this->view->url(array('controller'=>'room')) . '">' . $this->view->translate('room') . '</a></li>';
            if ($this->user->role == 'admin' || $this->user->role == 'manager')
                $usermenu .= 
                    '<li><a href="' . $this->view->url(array('module'=>'adminpanel')) . '">' . $this->view->translate('adminpanel') . '</a></li>';
            $usermenu .= 
                '<li class="last"><a  href="' . $this->view->url(array('controller'=>'auth', 'action'=>'logout')) . '">' . $this->view->translate('logout') . '</a></li>';
        }
        else {
            $usermenu .=
                '<li><a  href="' . $this->view->url(array('controller'=>'auth', 'action'=>'login')) . '">' . $this->view->translate('login1') . '</a></li>' .
                '<li class="last"><a  href="' . $this->view->url(array('controller'=>'registration', 'action'=>'index')) . '">' . $this->view->translate('registration') . '</a></li>';
        }
        
        
        
        //! Подготовка переменных вида
        //$this->view->form = $form;
        $this->view->usermenu = $usermenu;

    }

}