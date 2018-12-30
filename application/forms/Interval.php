<?php

class Application_Form_Interval extends Application_Form_Form
{

    public function init()
    {
        $this->setName('interval');
        $this->setMethod('post');
        
                
        $first = new Zend_Form_Element_Text('first');
        $first->setLabel('От')
        ->setRequired(true)
        ->setAttrib('class', 'tcal')
        ->addValidator(new Zend_Validate_Date(
        array(
        'format' => 'Y-m-d',
        )))
        ->addPrefixPath('Classes_Validator', 'Validator', 'validate');
        
        $last = new Zend_Form_Element_Text('last');
        $last->setLabel('До')
        ->setRequired(true)
        ->setAttrib('class', 'tcal')
        ->addValidator(new Zend_Validate_Date(
        array(
        'format' => 'Y-m-d',
        )))
        ->addPrefixPath('Classes_Validator', 'Validator', 'validate');
        
        $show = new Zend_Form_Element_Submit('show');
        $show->setLabel('Показать');
        
        
        $this->addElements(array($first, $last, $show));

    }


}