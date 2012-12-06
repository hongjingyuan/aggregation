<?php

class SiteController extends Controller
{
	
	/**
	 * 聚合页
	 */
	public function actionIndex()
	{
		$model = new Problem();
		$recommends = $model->idDesc()->findAll();
		
		$answers = $model->idDesc()->findAll();
		
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
		$model = new Problem();
		$recommends =  $model->limit()->findAll();
		
		$this->render('recommend',array(
				'recommend' => $recommends
				));
	}
	
	/**
	 * 等待您来回答更多页
	 */
	public function actionAnswer(){
		$model = new Problem();
		$answer = $model->limit()->findAll();
		
		$this->render('answer',array(
				'answer' => $answer
		));
		
	}
	
}