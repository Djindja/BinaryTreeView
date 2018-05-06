<?php

//Bsaic Setup - should not be changed

error_reporting(E_ALL);
ini_set("display_startup_errors","1");
ini_set("display_errors","1");


//Includes
require('abstractTreeView.class.php');
require('myTreeView.class.php');

$treeView = new myTreeView();
echo $treeView->showAjaxTree();