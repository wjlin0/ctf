
<!DOCTYPE html>
<html>
<body>
<form action="/upload.php" method="post" enctype="multipart/form-data">
    上传data.xml文件用以配置学籍管理系统:<br><br>
  <input type="file" name="file" id="file"><br><br>
  <input type="submit" value="提交" name="submit"><br><br>

</form>

<!-- <a href="./index.php?file=data.xml">查看学籍数据</a>
<br> -->

</body>
</html>

<?php 
if(isset($_GET['file'])){
  
   libxml_disable_entity_loader(false);
   $xmlfile = file_get_contents("./uploads/" . $_GET['file']);
   $students = @simplexml_load_string($xmlfile,'SimpleXMLElement',LIBXML_NOENT);
   echo "<br> 源码 ".$_GET['file']."<br>";
   echo htmlspecialchars($xmlfile, ENT_QUOTES, 'UTF-8');
   echo "<br>";
}
?>