<!DOCTYPE html>
<html>
 <head>
  <title>Treeview AJAX</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
 </head>
 <body>
  <br /><br />
  <div class="container" style="width:900px;">
   <h2 align="center">Treeview AJAX</h2>
   <br /><br />
   <div id="treeview">
    
   </div>
  </div>
 </body>
</html>

<script type="text/javascript">
$(document).ready(function(){ 
    $.ajax({
   type: "GET",  
   url: "response.php",
   dataType: "json",       
   success: function(response)  
   {
     console.log(response);
    $('#treeview').treeview({data: response});
   }   
 });
});
</script>