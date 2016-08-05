<?php
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
include 'connection.php';
//Insert or Update item information
if(isset($_POST['action_type']))
{
   if ($_POST['action_type'] == 'add' or $_POST['action_type'] == 'edit')
    {
	//Sanitize the data and assign to variables
	    
        $s_no = mysqli_real_escape_string($link, strip_tags($_POST['s_no']));
        $name = mysqli_real_escape_string($link, strip_tags($_POST['name']));
		$image_path = mysqli_real_escape_string($link, strip_tags($_POST['image_path'])); 
        //$item_category =$_POST['categorylist'];	
		$advisories_header =$_POST['headerlist'];		
        $designation = mysqli_real_escape_string($link, strip_tags($_POST['designation']));
        $description = mysqli_real_escape_string($link, strip_tags($_POST['description']));
 
                 
        if ($_POST['action_type'] == 'add')
        {
		
				$sql = "INSERT INTO advisoriesitems SET
                    s_no = '$s_no',
                    advisories_header = '$advisories_header',
					name='$name',
                    designation = '$designation',
					description = '$description',
                    image_path = '$image_path'
                    ";
				
        }
		else
		{
		$sql= "UPDATE advisoriesitems SET 
					s_no = '$s_no',
					item = '$item',
					images_path='$target_path',
					item_category = '$item_category',
					item_header = '$item_header',
					status = '$status',
					price = '$price'
					WHERE s_no = $s_no";
       
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
	$sql = "SELECT s_no, advisories_header, name, designation, description  from advisoriesitems 
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
	$sql = "DELETE FROM menulist
			WHERE s_no = $id";

	$result = mysqli_query($link, $sql);

	if(!$result)
	{
		echo mysqli_error($link);
		exit();
	}
}
//End Delete item
for($i=0; $i<$val; $i++)
{
$header=$category_list[$i]['category'];
//Read item information from database
$sql = "SELECT s_no, advisories_header, name, designation,description,
        image_path FROM advisoriesitems
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
                         'advisories_header' => $rows['advisories_header'],
						 'name' => $rows['name'],
                         'designation' => $rows['designation'],
						 'description' => $rows['description'],
                         'image_path' => $rows['image_path']                         
						 );
	
	}
//echo $category_list[$i]['category'];	
}
$values= count($item_list);
echo $values;	

 $itemlist_json = json_encode($item_list);
 //echo $itemlist_json;
 include 'advisories_itemlist.php';
 //echo $item_list[0][0]['item'];
 exit();
?>