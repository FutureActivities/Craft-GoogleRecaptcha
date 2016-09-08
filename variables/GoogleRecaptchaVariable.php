<?php

namespace Craft;
/*
* Google reCaptcha
*
* Forked from reCaptcha for Craft Variables
* Author: Aaron Berkowitz (@asberk)
* https://github.com/aberkie/craft-recaptcha
*
*/

class GoogleRecaptchaVariable
{
	public function render($params=null)
	{
		$return = craft()->googleRecaptcha_render->render($params);
		return $return;
	}
	
}
