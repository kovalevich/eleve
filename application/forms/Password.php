<?php

class Application_Form_Password extends Application_Form_Form
{

    public function init()
    {
        $this->setName('cahgepassword');
        $this->setAction('/cahgepassword');
        $this->setMethod('post');
        $this->setEnctype(Zend_Form::ENCTYPE_MULTIPART);

        $this->addElement('text', 'code', array(
            'placeholder'   => 'Code',
            'label'         => 'Code from email',
            'required'      => true,
            'class'         => 'form-control',
            'filters'       => array(
                'StripTags', 'StripTags'
            )
        ));

        $this->addElement('password', 'password', array(
            'placeholder'   => 'Password',
            'label'         => 'Password',
            'required'      => true,
            'class'         => 'form-control',
            'validators'    => array(
                'NotEmpty'
            )
        ));

        $this->addElement('password', 'password_confirm', array(
            'placeholder'   => 'Confirm password',
            'label'         => 'Confirm password',
            'class'         => 'form-control',
            'required'      => true,
            'prefixPath'    => array('validate'=>array('Classes_Validator'=>'Validator')),
            'validators'    => array(
                'NotEmpty',
                'PasswordConfirm'
            )
        ));

        $this->addElement('button', 'submit', array(
            'label'         => 'Save',
            'type'          => 'submit',
            'buttonType'    => 'success',
            'icon'          => 'ok',
            'escape'        => false
        ));


    }

}
