<!DOCTYPE html>
<html>
<head>

    <title>Menu - Update</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
 
function GotoHome()
{
    window.location = 'headingindex.php?';
}
function GotoCall()
{
    window.location = 'advisories_index.php?';
}
 </script>
</head>
<body>
    <div class="wrapper">
		<div class="content" style="width: 500px !important;">
			<?php //include 'header.php'; ?><br/>
			<div>
			<form id="frmvalue" method="POST" action="headingindex.php"; >		
				<input type="hidden" name="S No" 
		         value="<?php echo (isset($gresult) ? $gresult["s_no"] : ''); ?>" /> 

				<table>
					
					<tr>
						<td>
							<label for="advisoryheader">ADVISORIES HEADER: </label>
						</td>
						<td>
							<input type="text" name="advisoryheader" 
							value="<?php echo (isset($gresult) ? $gresult["advisoryheader"] :  '');?>" 
							class="txt-fld"/>
						</td>
					</tr>
					
					
				</table>
				
				<input type="hidden" name="action_type" value="<?php echo (isset($gresult) ? 'edit' :  'add');?>"/>
				<div style="text-align: center; padding-top: 30px;">
					<input class="btn" type="submit" name="save" id="save" value="SAVE" 
					onclick=" return GotoHome();"/>
					<input class="btn" type="button" name="save" id="cancel" value="CANCEL" 
					onclick=" return GotoCall();"/><br><br>
					 <a href="advisories_heading_list.php" class="link-btn">HEADERS LIST</a>
				</div>
			</form>
			
			</div>
		</div>
	</div>
</body>
</html>