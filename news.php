<?php include'connection.php';
$nCategory_list[] ='';
$sql = "SELECT headers FROM newsandeventsitemsheaders";
echo"hello";
sjh;

kjfkjkfj hhjhj
$result = mysqli_query($link,$sql);
if(!$result)
{
    echo mysqli_error($link);
    exit();
}

while($rows = mysqli_fetch_array($result))
{

    $nCategory_list[]= array('category' => $rows['headers']);
}
//echo $category_list[0]['category'];
$newsVal= count($nCategory_list);
//echo $newsVal;
?>

<!DOCTYPE html>
<html>
<body>
  <h1 style="text-align:center">NEWS AND EVENTS FEED</h1>
  <br>
 
 
 </h1><p><a href="news_heading_edit.php" class="link-btn"><h1 style="text-align:center">ADD NEWS & EVENTS HEADER</a> <p>
 <?php 
if($newsVal!=1)
 {
 ?>
 </h1><p><a href="news_update.php" class="link-btn"><h1 style="text-align:center">ADD NEWS & EVENTS</a></p>
 </h1><p><a href="newsAndEvents.php" class="link-btn"><h1 style="text-align:center">VIEW NEWS & EVENTS</a> <p>
  <?php 
  }
  ?>
</body>
</html>
