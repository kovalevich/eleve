<?php

class Application_Form_Company extends Application_Form_Form
{

    public function init()
    {
        $this->setName('article')
            ->setAction('/adminpanel/discounts/add/')
            ->setMethod('post');

        $category = new Application_Form_Element_Select('category_id');
        $category->setLabel($this->getTranslator()->translate('category'))
            ->setRequired(true);

        $title = new Zend_Form_Element_Text('title');
        $title->setLabel($this->getTranslator()->translate('article title'))
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim');

        $text = new Application_Form_Element_Wysiwyg('text');
        $text->setLabel($this->getTranslator()->translate('text'));

        // создаём кнопку submit
        $submit = new Application_Form_Element_Submit('save');
        $submit->setLabel($this->getTranslator()->translate('save'));

        $this->addElements(array($category, $title, $text, $submit));

        $this->prepare();
    }

    public function prepare()
    {
        $category = $this->getElement('category_id');
        $model = new Models_Categories_Mapper();
        $categories = $model->getCategories('discounts');
        foreach ($categories as $t) {
            $category->addMultiOption($t->id, $t->title);
        }
    }

}