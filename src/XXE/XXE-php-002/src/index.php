
<!DOCTYPE html>
<html>
<body>
<form action="upload.php" method="post" enctype="multipart/form-data">
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
  
  // libxml_disable_entity_loader(true);
  // $xmlfile = file_get_contents("./uploads/" . $_GET['file']);
  // $dom = new DOMDocument(); 
  
  // $dom->loadXML($xmlfile);
  // $students = simplexml_import_dom($dom);
    // $students = @simplexml_load_string($dom,'SimpleXMLElement',LIBXML_NOENT);
  // foreach ($students->student as $student) {
  //   print $student->name .  "    " . $student->year . "    " . $student->school .  "<br>";
  // }
}
?>