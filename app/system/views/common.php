 <?php
  $web_assets_base_url = 'http://localhost/TrackExpress/assets/website/';
  $system_assets_base_url = 'http://localhost/TrackExpress/assets/system/';

  include '../controllers/db_connect.php';
  $db = new dbconnection();
  $con = $db->connection();
// $db->editFormInTable('your_table_name', $recordId);
// $db->submitFormToTable('your_table_name');

 ?>