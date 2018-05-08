<?php

//Bsaic Setup - should not be changed

error_reporting(E_ALL);
ini_set("display_startup_errors","1");
ini_set("display_errors","1");


//Includes
require('abstractTreeView.class.php');
require('myTreeView.class.php');

$treeView = new myTreeView();

?>
    
<!DOCTYPE html>
<html>
    <head>
        <title>Treeview</title>
        <script src="https://ajax.`googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    </head>
    <body>
        <br /><br />
        <div class="container" style="width:900px;">
            <h2 align="center">Treeview</h2>
            <a href="http://test.develop/index1.php" class="btn btn-info">Link to Treeview AJAX</a>
            <br /><br />
            <div id="treeview">
                <?php $treeView->showCompleteTree(0, 0); ?>
            </div>
        </div>

    </body>
</html>


		