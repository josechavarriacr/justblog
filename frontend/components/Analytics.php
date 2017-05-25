<?php
namespace frontend\components;

use Yii;
use yii\base\Component;
use frontend\models\Logs;
use backend\models\Profile;
use Sinergi\BrowserDetector\Browser;
use Sinergi\BrowserDetector\Os;
use Sinergi\BrowserDetector\Device;
use Sinergi\BrowserDetector\Language;

class Analytics extends Component
{
	public function init()
	{
		if(Analytics::ipUser()){
			$browser = new Browser();
			$os = new Os();
			$device = new Device();
			$language = new Language();

			$request = Yii::$app->getRequest();
			$model = new Logs();
			$model->ip = $request->getUserIp();
			$model->user_agent = $request->getUserAgent();
			$model->module = $request->getUrl();
			$model->method = $request->getMethod();
			$model->csrfToken = $request->getCsrfToken();
		// $model->referrer = $request->getReferrer();
			$model->referrer = Analytics::getReferrerUrl();
			$model->new = Analytics::isNew($model->ip);
		// $model->language = $request->getPreferredLanguage();
			$model->port = Yii::$app->getResponse()->getStatusCode();
		// $model->port = $request->getPort();
			$model->time =  $_SERVER['REQUEST_TIME_FLOAT'];
			$model->browser = $browser->getName();
			$model->os = $os->getName();
			$model->device = $device->getName();
			$model->type = Analytics::isType();
			$model->language = $language->getLanguage();
			$model->save(false);
		}
		parent::init();
	}

	protected function ipUser(){
		$profile = profile::find()->orderBy('id ASC')->limit(1)->one();
		$ip = Yii::$app->getRequest()->getUserIP();

		if (!is_null($profile->ip) && $profile->ip == $ip) {
			return false;
		}else{
			return true;
		}
	}

	protected function isType()
	{
		$result;
		$mobileDetect = new MobileDetect();
		
		if ($mobileDetect->isMobile()) {
			$result ='mobile';
		} else if ($mobileDetect->isTablet()) {
			$result = 'tablet';
		} else {
			$result = 'desktop';
		}

		return $result;
	}

	protected function getReferrerUrl(){
		if (isset($_SERVER['HTTP_REFERER'])) { 

			$uri = parse_url($_SERVER['HTTP_REFERER']);
			return $uri['host'];
		}
	}

	protected function isNew($ip){
		if (($model = Logs::findOne(['ip'=>$ip])) == null) {
			return true;
		}else{
			return false;
		}
	}

	public function _print()
	{
		$browser = new Browser();
		$os = new Os();
		$device = new Device();
		$language = new Language();

		print_r('</br> Browser: '.$browser->getName().'</br>');
		print_r('Device: '.$device->getName().'</br>');
		print_r('Language: '.$language->getLanguage().'</br>');
		print_r('OS: '.$os->getName());   
		parent::init();
	}

}