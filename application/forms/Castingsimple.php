<?php

class Application_Form_Castingsimple extends Application_Form_Form
{

    public function init()
    {
        $this->setName('casting')
            ->setAction('/contacts/')
            ->setMethod('post');

        $name = new Zend_Form_Element_Text('title');
        $name->setLabel($this->getTranslator()->translate('article title'))
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim');

        $text = new Application_Form_Element_Wysiwyg('text');
        $text->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim');

        $submit = new Application_Form_Element_Submit('save');
        $submit->setLabel($this->getTranslator()->translate('save'));

        $this->addElements(array($name, $text, $submit));

    }

}