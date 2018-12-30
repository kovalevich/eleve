<?php

class Application_Form_Category extends Application_Form_Form
{

    public function init()
    {
        $this->setName('type');
        $this->setAction('/adminpanel/categories/add');
        $this->setMethod('post');
        
        $id = new Zend_Form_Element_Text('id');
        $id->setLabel($this->getTranslator()->translate('id'))
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('Db_NoRecordExists', false, array(
        		'table'=>'categories',
        		'field'=>'id',
        ));
        
        $category = new Application_Form_Element_Select('type');
        $category->setLabel('Родительская категория');
                
        $title = new Zend_Form_Element_Text('title');
        $title->setLabel('Заголовок')
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim');
        
        $description = new Application_Form_Element_Wysiwyg('description');
        $description->setLabel($this->getTranslator()->translate('description'))
        ->addFilter('StripTags')
        ->addFilter('StringTrim');
        
        // создаём кнопку submit
        $submit = new Application_Form_Element_Submit('save');
        $submit->setLabel($this->getTranslator()->translate('save'));
   
        $this->addElements(array($id, $category, $title, $description, $submit));
        $this->prepare();
        
    }
    
    public function prepare()
    {
    	$category = $this->getElement('type');
        $category->addMultiOption('articles', 'articles');
        $category->addMultiOption('communications', 'communications');
        $category->addMultiOption('discounts', 'discounts');
        $category->addMultiOption('castings', 'castings');
    }


}