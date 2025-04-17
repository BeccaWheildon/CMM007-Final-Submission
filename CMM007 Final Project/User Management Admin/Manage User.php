<!DOCTYPE html>
<!-- Code created referencing YouTube video - https://www.youtube.com/watch?v=nd9nOQemVAc&t=158s -->
 <!-- Using Tabledit plugin with jQuery Datatable in PHP Ajax -->

<html lang="en">
<head>
  <title>Admin Database Management - User Details</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <link href="../Website Styling.css" rel="stylesheet">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script>
 </head>
<main class="container">


<div class="banner">
   <h2 class="text-center my-3" style="font-weight: bold;">Admin Database Management - Book Catalogue</h2>
</div>
   <a href="../Admin Dashboard/Admin Dashboard.php" class="edit btn btn-primary btn-sm">Return to Admin Dashboard</a><br>
   <br />
   <br />
   <div class="panel panel-default">
    <div class="panel-heading">Book Catalogue</div>
    <div class="panel-body">
     <div class="table-responsive">
      <table id="user_data" class="table table-bordered table-striped">
       <thead>
        <tr>
         <th>User ID</th>
         <th>Full Name</th>
         <th>Email Address</th>
         <th>User Type</th>
        </tr>
       </thead>
       <tbody></tbody>
      </table>
     </div>
    </div>
   </div>
  </div>
  <br />
  <br />


<script type="text/javascript" language="javascript" >
$(document).ready(function(){

 var dataTable = $('#user_data').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: "fetch.php",
        type: "POST"
    },
    columns: [
        { data: 'userID' },
        { data: 'userName' },
        { data: 'email' },
        { data: 'userType' }
    ]
});

 $('#user_data').on('draw.dt', function(){
  $('#user_data').Tabledit({
   url:'action.php',
   dataType:'json',
   columns:{
    identifier : [0, 'userID'],
    editable:[[1, 'userName'], [2, 'email'], [3, 'userType', '{"Admin":"Admin","User":"User"}']]
   },
   restoreButton:false,
   onSuccess:function(data, textStatus, jqXHR)
   {
    if(data.action == 'delete')
    {
     $('#' + data.userID).remove();
     $('#user_data').DataTable().ajax.reload();
    }
   }
  });
 });
  
}); 
</script>
</html>