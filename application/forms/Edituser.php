<?php

class Application_Form_Edituser extends Application_Form_Form
{

    public function init()
    {
        $this->setName('edituser');
        
        
        $role = new Zend_Form_Element_Radio('role');
        $role->setLabel($this->getTranslator()->translate('role'));
        $role->addMultiOption('admin', $this->getTranslator()->translate('adminrole'))
        ->addMultiOption('manager', 'Менеджер')
        ->addMultiOption('author', $this->getTranslator()->translate('authorrole'))
        ->addMultiOption('user', $this->getTranslator()->translate('userrole'));
        
        $status = new Zend_Form_Element_Radio('status');
        $status->setLabel($this->getTranslator()->translate('status'));
        $status->addMultiOption('0', 'Не активный')
        ->addMultiOption('1', 'Активный')
        ->addMultiOption('2', 'Заблокирован')
        ->addMultiOption('3', 'Удалить');

        $notation = new Zend_Form_Element_Textarea('notation');
        $notation->setLabel('Заметка');
        
        // создаём кнопку submit
        $submit = new Zend_Form_Element_Submit('save');
        $submit->setLabel($this->getTranslator()->translate('save'));
        
        $this->addElements(array($role, $status, $notation, $submit));
        
        $this->setMethod('post');
    }


}

