<?php

class Application_Form_Registration extends Application_Form_Form
{

    public function init()
    {
        $this->setName('registration');
        $this->setAction('registration');
        $this->setEnctype(Zend_Form::ENCTYPE_MULTIPART);
        
        // создаём текстовый элемент
        $mail = new Zend_Form_Element_Text('email');
        
        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $mail->setLabel($this->getTranslator()->translate('mail'))
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty', true)
        ->addValidator('EmailAddress')
        ->addValidator('Db_NoRecordExists', false, array(
                'table'=>'users',
                'field'=>'email',
        ));
        
        // создаём текстовый элемент
        $fio = new Zend_Form_Element_Text('name');
        
        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $fio->setLabel($this->getTranslator()->translate('fio'))
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty');
        
        // создаём текстовый элемент
        $phone = new Zend_Form_Element_Text('phone');
        
        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $phone->setLabel($this->getTranslator()->translate('phone'))
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->setAttrib('id', 'phone')
        ->addValidator('NotEmpty');

        $this->addElement('text', 'passport', array(
            'class'         => 'form-control',
            'filters'       => array(
                'StripTags', 'StripTags'
            )
        ));

        $this->addElement('text', 'date_passport', array(
            'class'         => 'form-control',
            'filters'       => array(
                'StripTags', 'StripTags'
            )
        ));
        
        // создаём текстовый элемент
        $city = new Zend_Form_Element_Text('address');
        
        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $city->setLabel($this->getTranslator()->translate('address'))
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty');
        
        $getnews = new Application_Form_Element_Checkbox('getnews');
        
        // создаём кнопку submit
        $submit = new Zend_Form_Element_Submit('registration');
        $submit->setLabel($this->getTranslator()->translate('registration'));
        
        $this->addElements(array($mail, $fio, $phone, $city, $getnews, $submit));
        $this->setMethod('post');
    }

}

