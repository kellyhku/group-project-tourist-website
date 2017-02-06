<?php

class CaptchaController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function setcaptchaAction()
    {
        $captcha = new Zend_Captcha_Image();
        $captcha->setWordlen(4);
        $captcha->setHeight('60');
        $captcha->setFont('./font/simkai.ttf');
        $captcha->setFontSize('35');
        $captcha->setImgDir('./images/captcha');
        $captcha->setDotNoiseLevel(10);
        $captcha->setLineNoiseLevel(10);
        $captcha->setGcFreq(1);
        $captcha->setExpiration(1);
        $id = $captcha->generate();
        $code = $captcha->getWord();
        $_SESSION['captchaSession']['captcha_url'] = "/images/captcha/" . $id . ".png";
        $_SESSION['captchaSession']['captcha_code'] = $code;
        echo "{'captcha_url':'" . $_SESSION['captchaSession']['captcha_url'] . "','capcha_code':'" . $_SESSION['captchaSession']['captcha_code'] . "'}";
        exit();
    }

    public function jquerycheckcaptchaAction()
    {
        $captcha_code = $this->getRequest()->getParam('captcha_code');
        if ($captcha_code == $_SESSION['captchaSession']['captcha_code']) {
            echo "<font color='green'>captcha correct</font>";
        } else {
            echo "<font color='red'>captcha wrong</font>";
        }
        exit();
    }
}



