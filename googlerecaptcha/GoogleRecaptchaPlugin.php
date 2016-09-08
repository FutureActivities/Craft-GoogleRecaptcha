<?php

/*
* Google reCaptcha
*
* Forked from reCaptcha for Craft Main Plugin File
* Author: Aaron Berkowitz (@asberk)
* https://github.com/aberkie/craft-recaptcha
*
*/

namespace Craft;

class GoogleRecaptchaPlugin extends BasePlugin
{
	function getName()
	{
		return Craft::t('Google reCAPTCHA');
	}

	function getVersion()
	{
		return '1.0';
	}

	function getDeveloper()
	{
		return 'Nzime, Aaron Berkowitz';
	}

	function getDeveloperUrl()
	{
		return 'http://nzime.com';
	}

	protected function defineSettings()
	{
		return array(
			'siteKey' => array(AttributeType::Mixed, 'default' => ''),
			'secretKey' => array(AttributeType::Mixed, 'default' => '')
		);
	}

	public function init()
	{
		craft()->on('users.onBeforeSaveUser', function(Event $event) {

            $captcha = craft()->request->getPost('g-recaptcha-response');

            if (is_null($captcha))
            	return;

            if (!craft()->googleRecaptcha_verify->verify($captcha))
            {
                $user = $event->params['user'];
                $user->addError('recaptcha','Invalid Recaptcha');
                $event->performAction = false;
                return false;
            }
        });
	}

	public function getSettingsHtml()
	{
		return craft()->templates->render('googlerecaptcha/settings', array(
			'settings' => $this->getSettings()
		));
	}
}
