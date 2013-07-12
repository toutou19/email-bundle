<?php
namespace Azine\EmailBundle\Services;


/**
 * This is an example how to override the AzineWebViewSerive.
 *
 * @author dominik
 *
 */
class ExampleWebViewSerive extends AzineWebViewSerice
{

	public function getTemplatesForWebView(){
		$templates = array();

		// add your own templates here like this:

		$templates =$this->addTemplate($templates, "Some other mail",	ExampleTemplateProvider::SOME_OTHER_MAIL_TEMPLATE);
		$templates =$this->addTemplate($templates, "VIP Infos",	ExampleTemplateProvider::VIP_INFO_MAIL_TEMPLATE);

		return $templates;
	}

	public function getTestMailAccounts(){
		$emails = array();

		// add your own test-email-accounts here like this:
		$emails = $this->addTestMailAccount($emails, 'Testmail-account for MS Outlook',	'your.email.address@for.an.outlook.client.com');
		$emails = $this->addTestMailAccount($emails, 'Testmail-account for Gmail', 	'your.email.address@gmail');

		return $emails;
	}

	public function getDummyVarsFor($template){
		$variables = array();

		// override this method to provide dummy-variables
		// to view rendered templates for emails that you didn't send yet
		// or to send an email with dummy-variables to your test-account(s)
		//
		// do something like this:
		//
		if($template == ExampleTemplateProvider::VIP_INFO_MAIL_TEMPLATE){
			$vipVars = array();
			$vipVars['vipInfos'] = $someService->getVipInfosFor($aUser);
			$vipVars['userTitle'] = "You majesty";
			$variables['contentItems'][] = array(ExampleTemplateProvider::VIP_INFO_MAIL_TEMPLATE, $vipVars);

		} else if ($template == ExampleTemplateProvider::SOME_OTHER_MAIL_TEMPLATE){
			$otherMailVars = array();
			$otherMailVars['date'] = new \DateTime("long ago");
			$variables['contentItems'][] = array(ExampleTemplateProvider::SOME_OTHER_MAIL_TEMPLATE, $otherMailVars);
		}

		return $variables;
	}

}
