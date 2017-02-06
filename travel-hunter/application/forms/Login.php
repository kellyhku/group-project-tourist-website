<?php
require_once APPLICATION_PATH . "/models/ConfirmValidator.php";


class Application_Form_Login extends Zend_Form
{
    public function init()
    {
        // Set the method for the display form to POST


        $this->setMethod('post');
        $this->setAttrib('role', 'form');
//        $this->setAttrib('class','form-horizontal');

        $member_login = new Zend_Form_Element_Text('loginId');
        $member_password = new Zend_Form_Element_Password('memberPassword');
        $submit = new Zend_Form_Element_Submit('submit');

        $confirmValidator = new ConfirmValidator($member_password);

        $member_login->setLabel('login_ID')
            ->setRequired('true')
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
            ->setAttrib('class', 'form-control')
            ->setDecorators(array(
                'ViewHelper',
                'Description',
                'Errors',
                array(array('data' => 'HtmlTag'), array('tag' => 'td')),
                array('Label', array('tag' => 'td')),
                array(array('row' => 'HtmlTag'), array('tag' => 'tr'))


            ));


        $submit->setLabel('Login')
            ->setAttrib('class', 'form-control btn btn-default')
            ->setDecorators(array(
                'ViewHelper',
                'Description',
                'Errors',
                array(array('data' => 'HtmlTag'), array('tag' => 'td', 'colspan' => '2')),
                array(array('row' => 'HtmlTag'), array('tag' => 'tr'))


            ));


        $this->addElements(array($member_login, $member_password, $submit));

        $this->setDecorators(array(
            'FormElements',
            array(array('data' => 'HtmlTag'), array('tag' => 'table', 'class' => 'table table-striped')),
            'Form'
        ));


    }
}
