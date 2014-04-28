<?php

class Application_Form_Profile extends Application_Form_Form
{

    public function init()
    {
        $this->setName('registration');
        $this->setAction('registration');
        $this->setEnctype(Zend_Form::ENCTYPE_MULTIPART);


        $mail = new Zend_Form_Element_Text('email');
        $mail->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true)
            ->addValidator('EmailAddress');

        $fio = new Zend_Form_Element_Text('name');
        $fio->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $brit = new Zend_Form_Element_Text('date_brit');
        $brit->addFilter('StripTags')
            ->addFilter('StringTrim');

        $passport = new Zend_Form_Element_Text('passport');
        $passport->addFilter('StripTags')
            ->addFilter('StringTrim');

        $date_passport = new Zend_Form_Element_Text('date_passport');
        $date_passport->addFilter('StripTags')
            ->addFilter('StringTrim');

        $growth = new Zend_Form_Element_Text('growth');
        $growth->addFilter('StripTags')
            ->addFilter('StringTrim');

        $volumes_shoes = new Zend_Form_Element_Text('volumes_shoes');
        $volumes_shoes->addFilter('StripTags')
            ->addFilter('StringTrim');

        $volumes = new Zend_Form_Element_Text('volumes');
        $volumes->addFilter('StripTags')
            ->addFilter('StringTrim');

        $education = new Zend_Form_Element_Text('education');
        $education->addFilter('StripTags')
            ->addFilter('StringTrim');

        $volumes = new Zend_Form_Element_Text('volumes');
        $volumes->addFilter('StripTags')
            ->addFilter('StringTrim');

        $phone = new Zend_Form_Element_Text('phone');
        $phone->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setAttrib('id', 'phone')
            ->addValidator('NotEmpty');

        $lang_1 = new Zend_Form_Element_Text('language_1');
        $lang_1->addFilter('StripTags')
            ->addFilter('StringTrim');

        $lang_2 = new Zend_Form_Element_Text('language_2');
        $lang_2->addFilter('StripTags')
            ->addFilter('StringTrim');

        $lang_1_level = new Zend_Form_Element_Text('language_1_level');
        $lang_1_level->addFilter('StripTags')
            ->addFilter('StringTrim');

        $lang_2_level = new Zend_Form_Element_Text('language_2_level');
        $lang_2_level->addFilter('StripTags')
            ->addFilter('StringTrim');

        $city = new Zend_Form_Element_Text('address');
        $city->addFilter('StripTags')
            ->addFilter('StringTrim');

        $news = new Application_Form_Element_Checkbox('getnews');

        $images = new Zend_Form_Element_File('images');
        $images->setDestination(APPLICATION_UPLOADS_DIR)
            ->addValidator('Extension', false, 'jpg,png')
            ->setMultiFile(2);

        $this->addElement('text', 'goal_1', array());
        $this->addElement('text', 'goal_2', array());
        $this->addElement('text', 'goal_3', array());
        $this->addElement('text', 'goal_4', array());
        $this->addElement('text', 'goal_5', array());
        $this->addElement('text', 'goal_6', array());
        $this->addElement('text', 'goal_7', array());
        $this->addElement('text', 'goal_8', array());
        $this->addElement('text', 'goal_9', array());
        $this->addElement('text', 'goal_10', array());
        $this->addElement('text', 'goal_11', array());

        $submit = new Zend_Form_Element_Submit('registration');
        $submit->setLabel($this->getTranslator()->translate('registration'));

        $this->addElements(array($mail, $fio, $images, $phone, $city, $news, $submit, $brit, $lang_1, $lang_2, $lang_1_level, $lang_2_level, $passport, $date_passport, $growth, $education, $volumes, $volumes_shoes));
        $this->setMethod('post');
    }

}
