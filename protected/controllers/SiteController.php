<?php

class SiteController extends Controller
{
	
	/**
	 * 聚合页
	 */
	public function actionIndex()
	{
		$recommend = new CDbCriteria();
		$recommend->limit = 12;
		$recommends = $this->problem($recommend);
		
		$answer = new CDbCriteria();
		$answer->limit = 12;
		$answers = $this->problem($answer);
		
		//$tops = $this->top();
		
		$this->render('index',array(
				//'add'=>$add,
				'recommend'=>$recommends,
				'$recommends'=>$answers,
				//'$top'=>$tops,
				
				));
	}
	
	/**
	 *  精彩推荐更多页
	 */
	public function actionRecommend (){
		
		$recommends = $this->problem();
		CVarDumper::dump($recommends,3,true);die;
		
		$this->render('recommend',array(
				'recommend' => $recommends
				));
	}
	
	/**
	 * 等待您来回答更多页
	 */
	public function actionAnswer(){
		
		$answer = $this->problem();
		
		$this->render('answer',array(
				'answer' => $answer
		));
		
	}
	
	/**

	 * 查询所有的问题

	 * @param unknown_type $criteria

	 */
	public function problem(){

		$model = new Problem();

		$problem = $model->limt()->findAll();
	
		return $problem;

	}

	
}