<?php

class Application_Form_Type extends Application_Form_Form
{

    public function init()
    {
        $this->setName('type');
        $this->setAction('/adminpanel/types/add');
        $this->setMethod('post');
        
        $id = new Zend_Form_Element_Text('id');
        $id->setLabel($this->getTranslator()->translate('id'))
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addFilter('Alpha')
        ->addValidator('Db_NoRecordExists', false, array(
        		'table'=>'types',
        		'field'=>'id',
        ));
                
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel($this->getTranslator()->translate('name'))
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim');
        
        $description = new Zend_Form_Element_Text('description');
        $description->setLabel($this->getTranslator()->translate('description'))
        ->addFilter('StripTags')
        ->addFilter('StringTrim');
        
        $price_of_one_page = new Zend_Form_Element_Text('price_of_one_page');
        $price_of_one_page->setLabel($this->getTranslator()->translate('price of one page'))
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('Digits');
        
        $coefficient = new Zend_Form_Element_Text('coefficient');
        $coefficient->setLabel($this->getTranslator()->translate('coefficient'))
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim');
        
        $term_options = new Zend_Form_Element_Textarea('term_options');
        $term_options->setLabel($this->getTranslator()->translate('term options'))
        ->setAttrib('rows', 5)
        ->setAttrib('cols', 20)
        ->addFilter('StripTags')
        ->addFilter('StringTrim');
        
        $proc_for_author = new Zend_Form_Element_Text('proc_for_author');
        $proc_for_author->setLabel($this->getTranslator()->translate('proc for author'))
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('Digits');
        
        // создаём кнопку submit
        $submit = new Zend_Form_Element_Submit('save');
        $submit->setLabel($this->getTranslator()->translate('save'));
        
        $this->addElements(array($id, $name, $description, $price_of_one_page, $proc_for_author, $coefficient, $term_options, $submit));
        
    }


}