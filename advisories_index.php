<?php
session_start();
include'connection.php';
$sql = "SELECT headers FROM advisoriesheader";
		
$result = mysqli_query($link,$sql);
if(!$result)
{
    echo mysqli_error($link);
    exit();
}

while($rows = mysqli_fetch_array($result))
{

    $category_list[]= array('category' => $rows['headers']);
}
//echo $category_list[0]['category'];
$val= count($category_list);
//echo $val;



?>
<?php
$change="";
$abc="";


 define ("MAX_SIZE","400");
 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
include 'connection.php';
//Insert or Update item information
if(isset($_POST['action_type']))
{
	$image =$_FILES["file"]["name"];
	//echo $image;
	//echo $_FILES["file"]["name"];
	$uploadedfile = $_FILES['file']['tmp_name'];     
	//echo $uploadedfile;
   if ($_POST['action_type'] == 'add' or $_POST['action_type'] == 'edit')
    {
	//Sanitize the data and assign to variables
	    $id = (isset($_POST["sn"])? $_POST["sn"] : '');
       // $s_no = mysqli_real_escape_string($link, strip_tags($_POST['s_no']));
        $name = mysqli_real_escape_string($link, strip_tags($_POST['name']));
		$target_path = mysqli_real_escape_string($link, strip_tags($_POST['images_path'])); 
		echo $target_path;
        //$item_category =$_POST['categorylist'];	
		$item_header =$_POST['headerlist'];		
        $designation = mysqli_real_escape_string($link, strip_tags($_POST['designation']));
        $description = mysqli_real_escape_string($link, strip_tags($_POST['description']));
         if ($image) 
 	{
 	
 		$filename = stripslashes($_FILES['file']['name']);
 	
  		$extension = getExtension($filename);
 		$extension = strtolower($extension);
		
		
 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
 		{
		
 			$change='<div class="msgdiv">Unknown Image extension </div> ';
 			$errors=1;
 		}
 		else
 		{

 $size=filesize($_FILES['file']['tmp_name']);


if ($size > MAX_SIZE*1024)
{
	$change='<div class="msgdiv">You have exceeded the size limit!</div> ';
	$errors=1;
}


if($extension=="jpg" || $extension=="jpeg" )
{
$uploadedfile = $_FILES['file']['tmp_name'];
$src = imagecreatefromjpeg($uploadedfile);

}
else if($extension=="png")
{
$uploadedfile = $_FILES['file']['tmp_name'];
$src = imagecreatefrompng($uploadedfile);

}
else 
{
$src = imagecreatefromgif($uploadedfile);
}

//echo $scr;

list($width,$height)=getimagesize($uploadedfile);


$newwidth=100;
$newheight=($height/$width)*$newwidth;
$tmp=imagecreatetruecolor($newwidth,$newheight);


$newwidth1=72;
$newheight1=($height/$width)*$newwidth1;
$tmp1=imagecreatetruecolor($newwidth1,$newheight1);

//imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);


//$filename = "images/". $_FILES['file']['name'];

$filename1 = "advisoriesimages/small". $_FILES['file']['name'];



imagejpeg($tmp,$filename,200);

imagejpeg($tmp1,$filename1,200);
imagedestroy($src);
imagedestroy($tmp);
imagedestroy($tmp1);
}}
                 
        if ($_POST['action_type'] == 'add')
        {
		//echo $item;
		
				$sql = "INSERT INTO advisoriesitems SET
                  
                    name = '$name',
					image_path='$filename1',
                    
					advisories_header = '$item_header',
                    designation = '$designation',
                    description = '$description'";
				
        }
		else
		{
		$sql= "UPDATE advisoriesitems SET 
					
					name = '$item',
					image_path='$filename1',
					
					advisories_header = '$item_header',
					designation = '$designation',
					description = '$description'
					WHERE s_no = $id";
       
        }
         
        if (!mysqli_query($link, $sql))
        {
            echo 'Error Saving Data. '. mysqli_error($link);
            exit();
        }
    
}
header("Location: advisories_itemlist.php");
	exit();
}
//End Insert or Update item information
//Start of edit item read
$gresult = ''; //declare global variable
if(isset($_POST["action"]) and $_POST["action"]=="edit")
{
	$id = (isset($_POST["sn"])? $_POST["sn"] : '');
	$sql = "SELECT s_no, name, image_path, advisories_header ,designation, description from advisoriesitems 
			WHERE s_no = $id";
	$result = mysqli_query($link, $sql);

	if(!$result)
	{
		echo mysqli_error($link);
		exit();
	}
	$gresult = mysqli_fetch_array($result);
	include 'advisories_update.php';
	exit();
}
//end of edit item read

//Start Delete item
if(isset($_POST["action"]) and $_POST["action"]=="delete")
{
	$id = (isset($_POST["sn"])? $_POST["sn"] : '');
	$sql = "DELETE FROM advisoriesitems
			WHERE s_no = $id";

	$result = mysqli_query($link, $sql);

	if(!$result)
	{
		echo mysqli_error($link);
		exit();
	}
}
//End Delete item
$item_list[] ='';

for($i=0; $i<$val; $i++)
{
$header=$category_list[$i]['category'];
//Read item information from database
$sql = "SELECT s_no, name, image_path, advisories_header,
        designation, description FROM advisoriesitems
		WHERE advisories_header='$header'";
		
$result = mysqli_query($link,$sql);
if(!$result)
{
    echo mysqli_error($link);
    exit();
}

while($rows = mysqli_fetch_array($result))
	{
//Loop through each row on array and store the data to $item_list[]
    $item_list[$i][] =  array('s_no' => $rows['s_no'],
                         'name' => $rows['name'],
						 'images_path' => $rows['image_path'],                         
						 'item_header' => $rows['advisories_header'],
                         'designation' => $rows['designation'],
                         'description' => $rows['description']
						 );
	
	}
//echo $category_list[$i]['category'];	
}
$values= count($item_list);
//echo $values;	

 $itemlist_json = json_encode($item_list);
 //echo $itemlist_json;
 include 'advisories_itemlist.php';
 //echo $item_list[0][0]['item'];
 
 
	
 exit();
?>