<?php

namespace backend\models;

use Yii;

class Logs extends \yii\db\ActiveRecord
{

	public static function tableName()
	{
		return 'tbl_logs';
	}

	public function rules()
	{
		return [
		[['new'], 'boolean'],
		[['time'], 'integer'],
		[['ip', 'module', 'language', 'method', 'browser', 'os', 'device', 'type', 'port'], 'string', 'max' => 50],
		[['referrer', 'csrfToken', 'user_agent'], 'string', 'max' => 500],
		];
	}

	public function attributeLabels()
	{
		return [
		'id' => 'ID',
		'ip' => 'Ip',
		'module' => 'Module',
		'referrer' => 'Referrer',
		'new' => 'New',
		'language' => 'Language',
		'method' => 'Method',
		'browser' => 'Browser',
		'os' => 'Os',
		'device' => 'Device',
		'type' => 'Type',
		'csrfToken' => 'Csrf Token',
		'port' => 'Port',
		'user_agent' => 'User Agent',
		'time' => 'Time',
		];
	}

	protected function setQueries($sql)
	{
		$data = [];
		$connection = Yii::$app->getDb();
		$command = $connection->createCommand($sql);
		$result = $command->queryAll();

		foreach ($result as $value) {$data[] = $value;}
		return $data;
	}

	protected function selectQueries($var)
	{
		switch ($var) {
			case 'categories':
			$sql = "select tbl_category.name,
			sum(tbl_post.count) as 'visits' 
			from tbl_category
			inner join tbl_post_category 
			on tbl_category.id=tbl_post_category.id_category
			inner join tbl_post
			on tbl_post.id=tbl_post_category.id_post
			group by tbl_category.name";
			return Logs::setQueries($sql);      
			break;

			case 'visits':
			$sql = "select tbl_post.titulo, tbl_post.count
			from tbl_post group by tbl_post.titulo
			order by tbl_post.created_at desc limit 10";
			return Logs::setQueries($sql);      
			break;

			case 'browser':
			$sql = "select tbl_logs.browser, count(tbl_logs.browser) as 'count'
			from tbl_logs group by tbl_logs.browser";
			return Logs::setQueries($sql);      
			break;

			case 'referrer':
			$sql = "select tbl_logs.referrer, count(tbl_logs.referrer) as 'count'
			from tbl_logs group by tbl_logs.referrer";
			return Logs::setQueries($sql);      
			break;

			case 'language':
			$sql = "select tbl_logs.`language`, count(tbl_logs.`language`) as 'count'
			from tbl_logs group by tbl_logs.`language`";
			return Logs::setQueries($sql);      
			break;

			case 'os':
			$sql = "select tbl_logs.os, count(tbl_logs.os) as 'count'
			from tbl_logs group by tbl_logs.os";
			return Logs::setQueries($sql);      
			break;  

			case 'device':
			$sql = "select tbl_logs.device, count(tbl_logs.device) as 'count'
			from tbl_logs group by tbl_logs.device";
			return Logs::setQueries($sql);      
			break;

			case 'type':
			$sql = "select tbl_logs.`type`, count(tbl_logs.`type`) as 'count'
			from tbl_logs group by tbl_logs.`type`";
			return Logs::setQueries($sql);      
			break;

			case 'new':
			$sql = "select tbl_logs.`new`, count(tbl_logs.`new`) as 'count' 
			from tbl_logs group by tbl_logs.`new`";
			return Logs::setQueries($sql);
			break;

			case 'activityIp':
			$sql = "select tbl_logs.id, tbl_logs.ip, tbl_logs.module, tbl_logs.referrer, tbl_logs.`language`,
			tbl_logs.method, tbl_logs.browser, tbl_logs.os, tbl_logs.device, tbl_logs.`type`,
			tbl_logs.port, count(module) as 'count'
			from tbl_logs
			where ip = '$id'
			group by module";
			return Logs::setQueries($sql);
			break;

			default:
			return null;
			break;
		}
	}

	public function getCategories(){   
		$array = [];
		$data = Logs::selectQueries($var ='categories');
		if (!is_null($data)) {
			foreach ($data as $value) {$array[] = array($value['name'],(int)$value['visits']);}
			return $array;
		}
	}

	public function getVisits(){    
		$array = [];
		$data = Logs::selectQueries('visits');
		if (!is_null($data)) {
			foreach ($data as $value) {$array[] = array($value['titulo'],(int)$value['count']);}
			return $array;
		}
	}

	public function getNames(){   
		$array = [];
		$data = Logs::selectQueries('visits');
		if (!is_null($data)) {
			foreach ($data as $value) {$array[] = array($value['titulo']);}
			return $array;
		}
	}

	public function getBrowser(){
		$array = [];
		$data = Logs::selectQueries('browser');
		if (!is_null($data)) {
			foreach ($data as $value) {
				if($value['browser'] != 'unknown'){
					$array[] = array($value['browser'],(int)$value['count']);
				}
			}
			return $array;
		}
	}

	public function getReferrer(){
		$array = [];
		$data = Logs::selectQueries('referrer');
		if (!is_null($data)) {
			foreach ($data as $value) {$array[] = array($value['referrer'], (int)$value['count']);}
			return $array;
		}
	}

	public function getLanguage(){
		$array = [];
		$data = Logs::selectQueries('language');
		if (!is_null($data)) {
			foreach($data as $value) {
				if($value['language'] != ''){
					$array[] = array($value['language'], (int)$value['count']);
				}
			}
			return $array;
		}
	}

	public function getOs(){
		$array = [];
		$data = Logs::selectQueries('os');
		if (!is_null($data)) {
			foreach ($data as $value){
				if ($value['os'] != 'unknown') {
					$array[] = array($value['os'], (int)$value['count']);
				}
			}
			return $array;
		}
	}

	public function getDevice(){
		$array = [];
		$data = Logs::selectQueries('device');
		if (!is_null($data)) {
			foreach ($data as $value){
				if ($value['device'] != 'unknown') {
					$array[] = array($value['device'], (int)$value['count']);
				}
			}
			return $array;
		}
	}

	public function getType(){
		$array = [];
		$data = Logs::selectQueries('type');
		if (!is_null($data)) {
			foreach($data as $value){$array[] = array($value['type'], (int)$value['count']);}
			return $array;
		}
	}

	public function getNew(){
		$array = [];
		$new = [];
		$data = Logs::selectQueries('new');
		if (!is_null($data)) {
			foreach ($data as $value){
				if ($value['new'] == 1 ) {
					$array[] = array('new',(int)$value['count']); 
				} else {
					$array[] = array('Return',(int)$value['count']); 
				}
			}
			return $array;
		}
	}

	public function getActivityIp(){
		$array = [];
		$data = Logs::selectQueries('activityIp');
		if (!is_null($data)) {
			foreach($data as $value){
				$array[] = array($value['id'],(int)$value['ip'],(int)$value['module'],
					(int)$value['referrer'],(int)$value['language'],(int)$value['method'],
					(int)$value['browser'],(int)$value['device'],(int)$value['type'],
					(int)$value['port'],(int)$value['count']);
			}
			return $array;
		}
	}

}
