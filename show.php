<?php

namespace admin\cake;
use model\Category;
use model\Cat;
include "../../start.php";

$cat=new Cat();
$cateModel = new Category();

$pagerData=[
    'pageSize' => 6,
    'pageIndex' => 1
];
if(isset($_GET['page'])){
    $pagerData['pageIndex'] = $_GET['page'];
}

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
//    $result = $cat->getCatsByCategory($category_id);

    $categoryName=$cateModel->select(['id'=>$category_id])['name'];
    $result= $cat->queryPage($pagerData,['category_id'=>$category_id]);

} else {
    $categoryName="全部";
    $result = $cat ->queryPage($pagerData);
}
$categories = $cateModel->selectMany(null,null,['id'=>'asc']);
$title = "蛋糕列表";

include VIEW_PATH . "index/cake/show.html";
