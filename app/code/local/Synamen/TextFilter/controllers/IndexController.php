<?php
class Synamen_TextFilter_IndexController extends Mage_Core_Controller_Front_Action{
	public function IndexAction() {

		$allData = Mage::app()->getRequest()->getParam('alldata');

		$query = Mage::app()->getRequest()->getParam('query');

		$currenthtml = Mage::app()->getRequest()->getParam('currenthtml');

		$allData = json_decode($allData);

		foreach($allData as $key => $item)
		{
			if(stripos($item, $query) !== false)
			{
				$result_labels[$key] = $item;
			}
		}
		
		$htmlArray = explode("<li>",$currenthtml);
		
		
		foreach($result_labels as $key => $result_label)
		{
			foreach($htmlArray as $li)
			{
				if(strpos($li, $result_label) !== false)
				{
					$result[] = "<li>".$li;
				}
			}
		}
		
		$unique_result = array_unique($result);
		
		$resultHtml = implode("", $unique_result);
		Mage::app()->getResponse()->setBody($resultHtml);
	}
}