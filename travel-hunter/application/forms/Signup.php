<?php
require_once APPLICATION_PATH . "/models/ConfirmValidator.php";


class Application_Form_Signup extends Zend_Form
{
    public function init()
    {
        // Set the method for the display form to POST


        $this->setMethod('post');
        $this->setAttrib('role', 'form');
//        $this->setAttrib('class','form-horizontal');

        $member_login = new Zend_Form_Element_Text('memberLogin');
        $member_password = new Zend_Form_Element_Password('memberPassword');
        $member_password_confirm = new Zend_Form_Element_Password('memberPasswordConfirm');
        $first_name = new Zend_Form_Element_Text('firstName');
        $last_name = new Zend_Form_Element_Text('lastName');
        $email = new Zend_Form_Element_Text('email');
        $birthday = new Zend_Form_Element_Text('birthday');
        $submit = new Zend_Form_Element_Submit('submit');

        $confirmValidator = new ConfirmValidator($member_password);

        $member_login->setLabel('member_Login')
            ->setRequired('true')
            ->addValidator('StringLength', false, array(5, 50))
            ->addValidator('alnum')
            ->setAttrib('class', 'form-control')
            ->setDecorators(array(
                'ViewHelper',
                'Description',
                'Errors',
                array(array('data' => 'HtmlTag'), array('tag' => 'td')),
                array('Label', array('tag' => 'td')),
                array(array('row' => 'HtmlTag'), array('tag' => 'tr'))


            ));

        $member_password->setLabel('Password')
            ->setRequired('true')
            ->addValidator('StringLength', false, array(5, 5))
//            ->addValidator($confirmValidator)
            ->setAttrib('class', 'form-control')
            ->setDecorators(array(
                'ViewHelper',
                'Description',
                'Errors',
                array(array('data' => 'HtmlTag'), array('tag' => 'td')),
                array('Label', array('tag' => 'td')),
                array(array('row' => 'HtmlTag'), array('tag' => 'tr'))


            ));

        $member_password_confirm->setLabel('Confirm')
            ->setRequired('true')
            ->addValidator('StringLength', false, array(5, 5))
//            ->addValidator($confirmValidator)
            ->setAttrib('class', 'form-control')
            ->setDecorators(array(
                'ViewHelper',
                'Description',
                'Errors',
                array(array('data' => 'HtmlTag'), array('tag' => 'td')),
                array('Label', array('tag' => 'td')),
                array(array('row' => 'HtmlTag'), array('tag' => 'tr'))


            ));

        $first_name->setLabel('First name')
            ->setRequired('true')
            ->addValidator('StringLength', false, array(3, 50))
            ->setAttrib('class', 'form-control')
            ->setDecorators(array(
                'ViewHelper',
                'Description',
                'Errors',
                array(array('data' => 'HtmlTag'), array('tag' => 'td')),
                array('Label', array('tag' => 'td')),
                array(array('row' => 'HtmlTag'), array('tag' => 'tr'))


            ));

        $last_name->setLabel('Last name')
            ->setRequired('false')
            ->addValidator('StringLength', false, array(3, 50))
            ->setAttrib('class', 'form-control')
            ->setDecorators(array(
                'ViewHelper',
                'Description',
                'Errors',
                array(array('data' => 'HtmlTag'), array('tag' => 'td')),
                array('Label', array('tag' => 'td')),
                array(array('row' => 'HtmlTag'), array('tag' => 'tr'))


            ));

        $email->setLabel('Email')
            ->setRequired('true')
            ->addValidator('EmailAddress')
            ->setAttrib('class', 'form-control')
            ->setDecorators(array(
                'ViewHelper',
                'Description',
                'Errors',
                array(array('data' => 'HtmlTag'), array('tag' => 'td')),
                array('Label', array('tag' => 'td')),
                array(array('row' => 'HtmlTag'), array('tag' => 'tr'))


            ));

        $birthday->setLabel('Birthday')
            ->setRequired('true')
            ->addValidator('Date')
            ->setAttrib('class', 'form-control')
            ->setDecorators(array(
                'ViewHelper',
                'Description',
                'Errors',
                array(array('data' => 'HtmlTag'), array('tag' => 'td')),
                array('Label', array('tag' => 'td')),
                array(array('row' => 'HtmlTag'), array('tag' => 'tr'))


            ));


        $submit->setLabel('Signup')
            ->setAttrib('class', 'form-control btn btn-default')
            ->setDecorators(array(
                'ViewHelper',
                'Description',
                'Errors',
                array(array('data' => 'HtmlTag'), array('tag' => 'td', 'colspan' => '2')),
                array(array('row' => 'HtmlTag'), array('tag' => 'tr'))


            ));


        $this->addElements(array($member_login, $member_password, $member_password_confirm, $first_name, $last_name, $email, $birthday, $submit));

        $this->setDecorators(array(
            'FormElements',
            array(array('data' => 'HtmlTag'), array('tag' => 'table', 'class' => 'table table-striped')),
            'Form'
        ));


    }
}
