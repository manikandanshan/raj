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
//Loop through each row on array and store the data to $item_list[]
    $category_list[] = array('category' => $rows['headers']);
  }
?>  
<!DOCTYPE html>
<html>
<head>
<body background="rest.png">
    <title>Advisories - Update</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
	 <link rel="stylesheet" href="css/advisories_newsandevents.css"  type="text/css" />
<script type="text/javascript">
 
function GotoHome()
{
    window.location = 'advisories_index.php?';
}
 </script>
 
 
        <!-- libraries -->
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.appear.js"></script>
		<script src="js/advisories_newsandevents_validator.js"></script>
</head>
<body>
    <div class="wrapper">
		<div class="content" style="width: 500px !important;">
			<?php// include 'header.php'; ?><br/>
			<div>
			<form id="frmvalue" method="POST"  enctype="multipart/form-data" action="advisories_index.php"; >		
				<input type="hidden" name="S No" 
		         value="<?php echo (isset($gresult) ? $gresult["s_no"] : ''); ?>" /> 

				<table>
					
					<tr>
					
						<td>
						
							<label for="item_category">ADVISORIES HEADER: </label>
						
						</td>
						<td>
							
							<select name="headerlist"  >
							<?php foreach($category_list as $value): ?>
							<option value="<?php echo $value['category'];?>"> <?php echo $value['category'];?> </option>
							<?php endforeach; ?>
							</select>
							

						</td>
						
					<tr>
					<tr>
					
						<td>
							<label for="item">NAME: </label>
						</td>
						
						<td>
							<input type="text" name="name" 
							value="<?php echo (isset($gresult) ? $gresult["name"] :  ''); ?>" 
							class="txt-fld"/>
						</td>
						
					</tr>
					
					<tr>
						<td>
							<label for="status">DESIGNATION: </label>
						</td>
						<td>
							<input type="text" name="designation" 
							value="<?php echo (isset($gresult) ? $gresult["designation"] :  '');?>" 
							class="txt-fld"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="price">DESCRIPTION: </label>
						</td>
						<td>
							<input type="text" name="description" 
							value="<?php echo (isset($gresult) ? $gresult["description"] :  '');?>" 
							class="txt-fld"/>
						</td>
						</tr>
						<tr>
						<td>
							<label for="file">IMAGE: </label>
						</td>
						<td>
						<input size="25" name="file" type="file" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10pt" class="box"/>
					     <label for="filename"> <?php echo (isset($gresult) ? $gresult["image_path"] :  '');?></label>
													
							
						</td>
					</tr>
					
						<br>
						<br>
						</form>
				</table>
				<input type="hidden" name="action_type" value="<?php echo (isset($gresult) ? 'edit' :  'add');?>"/>
				<div style="text-align: center; padding-top: 30px;">
				<input type="hidden" name="sn"
                                     value="<?php echo (isset($gresult) ? $gresult["s_no"] : '');  ?>" />
					<input class="btn" type="submit" name="save" id="save" value="SAVE" />
					<input class="btn" type="button" name="save" id="cancel" value="CANCEL" 
					onclick=" return GotoHome();"/>
				</div>
			</form>
			</div>
		</div>
	</div>
</body>
</html>