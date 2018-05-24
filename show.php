<?php
mysql_connect("localhost","root");
mysql_select_db("toybox");
mysql_query("set names utf8");
$data=mysql_query("select * from toy");
?>

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html;  charest=utf-8" />
    <title>DashBoard</title>
  </head>

  <body>
    <form method="POST" action="clound_scan.php">
      <p>IP or Website:</p>
      <input type="text" name=ip_n_web>
      <!--
      <p>Thread:</p>
      <input type="text" name=thread>
      -->
      <input type="submit" value="Scan it !">
    </form>
    <table width="700" border="1">
      <tr>
        <td>scan_id</td>
        <td>ip_address</td>
        <td>port</td>
        <td>product</td>
        <td>version</td>
        <td>name</td>
        <td>cpe</td>
        <td>extrainfo</td>
      </tr>

      <?php
      for ($i=1;$i<=mysql_num_rows($data);$i++){
      $rs=mysql_fetch_row($data);   
      ?>

      <tr>
        <td id="scan_id"><?php echo $rs[0];?></td>
        <td id="ip_address"><?php echo $rs[1];?></td>
        <td id="port"><?php echo $rs[2];?></td>
        <td id="product"><?php echo $rs[3];?></td>
        <td id="version"><?php echo $rs[4];?></td>
        <td id="name"><?php echo $rs[5];?></td>
        <td id="cpe"><?php echo $rs[6];?></td>
        <td id="extrainfo"><?php echo $rs[7];?></td>
      </tr>

      <?php
      }
      ?>
    </table>
  </body>
</html>