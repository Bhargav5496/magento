<?php

class Ccc_Practice_TempController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $file = "C:\Users\gohel\Downloads\CATEGORY.csv";
        $categoryHeader = array();
        $categoryData = array();
        $handler = fopen($file, 'r');
        if($handler){
            while($row = fgetcsv($handler)){
                if(!$categoryHeader){
                    $categoryHeader = $row;
                }else{
                    $categoryData[] = $row[1];
                }
            }   
            $categoryData = array_values(array_unique($categoryData),1);
        }
        echo '<pre>';print_r($categoryData);die;
    }
}