<?php
session_start();
if(isset($_SESSION))
{
    $key = $_GET['aid'];
    function encryptIt( $q ) 
                {
                    $cryptKey  = 'asbp7dnrn1521';
                    $qEncoded  = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
                    return( $qEncoded );
                }
    include('dbconfig.php'); 
    $authqry = "SELECT * from ACCOUNTDETAILS where AccID = \"$key\"";
    $rs = mysql_query($authqry);
    $row = mysql_fetch_assoc($rs);
    $encrypted = encryptIt($row['AccID']);
}
else
{
    header("location:errorpage.html");
}
?>
<form action="02-instances.php" method="post" id="jsform"><input type="hidden" name="aid" value="<?php echo ($encrypted); ?>"/>
<input type="hidden" name="cname" value="<?php echo ($row['AccName']); ?>"/><input type="hidden" name="akey" value="<?php echo ($row['AccessKey']); ?>"/>
<input type="hidden" name="skey" value="<?php echo ($row['SecretKey']); ?>"/></form>
<script type="text/javascript">
  document.getElementById('jsform').submit();
</script>
