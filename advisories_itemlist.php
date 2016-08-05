<?php
//error_reporting(E_ALL & ~E_NOTICE);
include_once 'advisories_index.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>ADVISORIES ITEMS</title>
	<link href="styleitemlist.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript">
function ConfirmDelete()
{
    var d = confirm('Do you really want to delete data?');
    if(d == false){
        return false;
    }
}


function view(){
$.ajax({
                type: 'POST',
                url: 'advisories.php',
                success: function(data) {	
				
                    console.log("data val :" +data);
					
                   
					
                }				
		});	
}
</script>

		
</head>

			<?php
			
				for ($i = 0; $i <$val; $i++) 
				{
				 $data = array();?>
				
<body>
			
    <div class="wrapper">
        <div class="content" style="width: 1000px !important;">
            
            <table class="menutable">
                <thead>
                    <tr>
                       
                        
						<th>
                            IMAGE
                        </th>
                        <th>
                            NAME
                        </th>						 
                        <th>
                            DESIGNATION
                        </th>
                        <th>
                            DESCRIPTION
                        </th>
						
                        <th></th><th></th>
						
                    </tr>
                </thead>
                <tbody>
				<?php
				if ($item_list[$i] !='')				
				{				
				foreach($item_list[$i] as $key => $value):
				$data[$key] = $value;
		
				?>
				
	
                        <tr>
                            
							
							<td>
								<img src="<?php echo $value['images_path'];?>" alt="" />
                            </td>
                            <td>
                                <?php echo $value['name']; ?>
                            </td>							
                            <td>
                                <?php echo $value['designation']; ?>
                            </td>
                            <td>
                                <?php echo $value['description']; ?>
                            </td>
							<td>
                           <form method="post" action="advisories_index.php"> 
                                    <input type="hidden" name="sn"
                                    value="<?php echo $value["s_no"]; ?>" />
                                    <input type="hidden" name="action" value="edit"/>
                                    <input type="submit" value="EDIT" />
                            </form>
                            </td>
                            <td>
                                <form method="POST" action="advisories_index.php"
                                     onSubmit="return ConfirmDelete();">
                                     <input type="hidden" name="sn"
                                     value="<?php echo $value["s_no"]; ?>" />
                                     <input type="hidden" name="action" value="delete"/>
                                    <input type="submit" value="DELETE" />
                                </form>
                            </td>
                        <tr>
						
                    <?php endforeach; 	
					}?>
<h1 style="text-align:center"><?php echo $category_list[$i]['category'];?></h1>					
					<?php }?>
					
                </tbody>
            </table><br/>
           	<a href="advisories_update.php" class="link-btn">ADD ADVISORIES</a>
			
			<a href="advisories_heading_edit.php" class="link-btn">ADD ADVISORIES HEADER</a>
			
			<a href="viewAdvisories.php" class="link-btn" onClick= "view()">VIEW ADVISORIES</a>
				
			
			<br>
			
		
        </div>
    </div>
</body>
</html>
