<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();


//Determining which actions to take
if(isset($_GET['a']) && $_GET['a'] == "return"){ 
	$type = "Return";
} else { 
	$type = "Issue";
}

// If you are searching
if(isset($_GET['v']) && trim($_GET['v']) != ""){
	$where = "AND i.serialno LIKE '%".trim($_GET['v'])."%' AND e.type = '".trim($_GET['type'])."'";
	$_SESSION['searchserial'] = $_GET['v'];
} else { 
	$where = "";
}

if(isset($_GET['d']) && $_GET['d'] == "delete"){
	mysql_query("DELETE FROM itemissue WHERE id='".$_GET['id']."'");
	$_SESSION['msg'] = "The item has been successfully deleted";
}

//Generate custom made query
$query = "SELECT i.id, i.serialno, i.inventoryofficer, i.date, e.name, e.type  FROM itemissue i, equipment e WHERE i.serialno = e.serialno  AND i.type = '".$type."' ".$where." ORDER BY date DESC";

$result = mysql_query($query);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage <?php if(isset($_GET['a']) && $_GET['a'] == "return"){ echo "Return";} else { echo "Issue";} ?>s</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../javascript/smartguard.js" type="text/javascript"></script>

</head>

<body class="mainbackground" topmargin="0" bottommargin="0">
<table width="750" border="0" align="center" cellpadding="2" cellspacing="2" class="outtertablebg">
  <tr> 
    <td height="7" colspan="2"></td>
  </tr>
  <tr> 
    <td colspan="2"><?php include "../core/header.php";?></td>
  </tr>
  <tr> 
    <td height="7" colspan="2"></td>
  </tr>
  <tr> 
    <td colspan="2" align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="contenttableborder">
      <tr>
        <td class="headings">Manage Inventory <?php if(isset($_GET['a']) && $_GET['a'] == "return"){ echo "Return";} else { echo "Issue";} ?>s</td>
      </tr>
      <tr>
        <td><table width="100%" border="0">
          

          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
		  <?php if(userHasRight($_SESSION['userid'], "112")){?>
            <td>
			  <?php if (isset($_GET['a']) && $_GET['a'] == "return"){ ?>
              <input type="button" name="newitemtype2" value="Return Item" onClick="javascript:document.location.href='../inventory/index.php?a=return'"> <?php }else { ?>
              <input type="button" name="newitemtype" value="Issue Item" onClick="javascript:document.location.href='../inventory/index.php?a=issue'"><?php } ?>
			  <?php if(isset($_GET['error'])){ 
				echo "<span class=\"redtext\">".$_GET['error']."</span>";
			} else if(isset($_GET['msg'])){ 
				echo "<span class=\"greentext\">".$_GET['msg']."</span>";
			}?></td>
			<?php } ?>
            </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
		  <?php //if(userHasRight($_SESSION['userid'], "113")){?>
            <td><form name="form1" method="post" action="">
              <div id="searchtable">
                <table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                  <tr>
                    <td>Search
                      <?php if(isset($_GET['a']) && $_GET['a'] == "return"){ echo "Return";} else { echo "Issue";}?>
                      (s) For:<br>
                      (enter serial no.) </td>
                    <td><input name="searchserial" id="searchserial" type="text" size="30" value="<?php if(isset($_SESSION['searchserial'])){ echo $_SESSION['searchserial'];}?>"></td>
                    <td nowrap>Item Type:</td>
                    <td nowrap><select name="type" id="type">
                        <?php 
						if(isset($_GET['type'])){
							$type = $_GET['type'];
						} else {
							$type = "";
						}
						echo generateSelectOptions(getAllEquipmentTypes(), $type);?>
                      </select>
                        <input type="button" name="Button" value="Search <?php if(isset($_GET['a']) && $_GET['a'] == "return"){ echo "Return";} else { echo "Issue";}?>s" onClick="pickFormItemTypeAndDirect('searchserial', 'itemissues.php?<?php if(isset($_GET['a']) && $_GET['a'] == "return"){ echo "a=return&";}?>v=', 'Please enter all or part of the item\'s serial number')"></td>
                  </tr>
                </table>
              </div>
                        </form>
            </td>
            <?php //} ?>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
			<?php
			if(mysql_num_rows($result) == 0){          			
				echo "<tr><td>There are no ";
				if(isset($_GET['a']) && $_GET['a'] == "return"){ echo "return";} else { echo "issue";}
				echo "s to display</td></tr>";
		   	} else { 
			?>
          <tr>
            <td><div style="padding:4px;width:720px;height:400px;overflow: auto">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
                <?php if(userHasRight($_SESSION['userid'], "115")){?>
				<td>Edit</td><?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "116")){?>
                <td>Delete</td><?php } ?>
                <td>Serial No.</td>
				<td>Item Name</td>
                <td>Issued By</td>
                <td>Issue Date</td>
              </tr>
			  <?php
			  $i = 0;
			   while($line = mysql_fetch_array($result,MYSQL_ASSOC)) { 
			      if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
			   ?>
              <tr class="<?php echo $rowclass; ?>">
                <!--<td><input type="checkbox" name="issueitem[]" id="issueitem[]<?php //echo $i;?>" value="<?php //echo $line['id']; ?>"></td>-->
				<?php if(userHasRight($_SESSION['userid'], "115")){?>
				<td><a href="../inventory/index.php?id=<?php echo encryptValue($line['id']);
				echo "&d=edit";
				if(isset($_GET['a']) && $_GET['a'] == "return"){ echo "&a=return";}?>" class="normaltxtlink">Edit</a></td><?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "116")){?>
                <td><a href="#" onClick="javascript:deleteEntity('../inventory/itemissues.php?id=<?php echo $line['id']; 
				echo "&d=delete";
				if(isset($_GET['a']) && $_GET['a'] == "return"){ echo "&a=return";}?>', 'item', '<?php if(isset($_GET['a']) && $_GET['a'] == "return"){ echo "return";} else { echo "issue";}
				
				echo " ".$line['serialno']; ?>')" class="normaltxtlink">Delete</a></td><?php } ?>
                <td><?php if(userHasRight($_SESSION['userid'], "114")){?><a href="../inventory/index.php?id=<?php echo encryptValue($line['id']); 
				if(isset($_GET['a']) && $_GET['a'] == "return"){ echo "&a=return";}
				echo "&d=view";
				?>" class="normaltxtlink"><?php echo $line['serialno']; ?></a><?php } else echo $line['serialno']; ?></td>
                <td><?php echo $line['serialno']; ?></td>
                <td><?php 
				$person = getRowAsArray("SELECT firstname, lastname, othernames FROM persons WHERE id = '".$line['inventoryofficer']."'");
				echo $person['firstname']." ".$person['lastname']." ".$person['othernames']; ?></td>
				<td><?php echo date("d-M-Y",strtotime($line['date'])); ?></td>
              </tr>
			  <?php 
			  $i++;
			  } ?>
            </table></div></td>
          </tr>			
			<?php } ?>


        </table>
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top" class="copyright"><?php include("../include/footer.php");?></td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
