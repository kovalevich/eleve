<?php

class Application_Form_Contacts extends Application_Form_Form
{

    public function init()
    {
        $this->setName('contacts')
            ->setAction('/contacts/')
            ->setMethod('post');

        $name = new Zend_Form_Element_Text('name');
        $name->setLabel($this->getTranslator()->translate('article title'))
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim');

        $phone = new Zend_Form_Element_Text('phone');
        $phone->setLabel($this->getTranslator()->translate('article title'))
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim');

        $email = new Zend_Form_Element_Text('email');
        $email->setLabel($this->getTranslator()->translate('email'))
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true)
            ->addValidator('EmailAddress');

        $text = new Application_Form_Element_Wysiwyg('text');
        $text->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim');

        $submit = new Application_Form_Element_Submit('save');
        $submit->setLabel($this->getTranslator()->translate('save'));

        $this->addElements(array($name, $phone, $text, $email, $submit));

    }

}