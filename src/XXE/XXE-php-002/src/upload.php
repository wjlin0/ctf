<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// // Check if $uploadOk is set to 0 by an error
// if ($uploadOk == 0) {
//   echo "Sorry, your file was not uploaded.";
// // if everything is ok, try to upload file
// } else {
//   if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
//     echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
//   } else {
//     echo "Sorry, there was an error uploading your file.";
//   }
// }

$allowedExts = array("xml");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);        // 获取文件后缀名
if ((($_FILES["file"]["type"] == "text/xml")
)
&& ($_FILES["file"]["size"] < 204800)    // 小于 200 kb
&& in_array($extension, $allowedExts))
{
    if ($_FILES["file"]["error"] > 0)
    {
        echo "错误：: " . $_FILES["file"]["error"] . "<br>";
    }
    else
    {
        echo "上传文件名：" . $_FILES["file"]["name"] . "<br>";
        echo "文件类型：" . $_FILES["file"]["type"] . "<br>";
        echo "文件大小：" . ($_FILES["file"]["size"] / 1024) . " kB<br>";
        echo "文件临时存储的位置：" . $_FILES["file"]["tmp_name"] . "<br>";
        
        // 判断当前目录下的 upload 目录是否存在该文件
        // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
        if (file_exists("uploads/" . $_FILES["file"]["name"]))
        {
            echo "uploads/" . $_FILES["file"]["name"] . " 文件已经存在，本次上传已终止，不会覆盖原文件。 <br>";
            // echo "<a href=\"./index.php?file=data.xml\">查看学籍数据</a><br>";
            libxml_disable_entity_loader(false);
            $xmlfile = file_get_contents("./uploads/" . $_FILES["file"]["name"]);
            // $dom = new DOMDocument(); 
            
            // $dom->loadXML($xmlfile);
            // $students = simplexml_import_dom($dom);
            $students = @simplexml_load_string($dom,'SimpleXMLElement',LIBXML_NOENT);
        }
        else
        {
            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
            move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/" . $_FILES["file"]["name"]);
            echo "文件上传成功，存储在：" . "uploads/" . $_FILES["file"]["name"];
            // echo "<br><a href=\"./index.php?file=data.xml\">查看学籍数据</a><br>";
            echo "<br>" . $_FILES["file"]["name"] . "的新数据已成功读入系统！<br>";
            libxml_disable_entity_loader(false);
            $xmlfile = file_get_contents("./uploads/" . $_FILES["file"]["name"]);
            // $dom = new DOMDocument(); 
            
            // $dom->loadXML($xmlfile);
            // $students = simplexml_import_dom($dom);
            $students = @simplexml_load_string($xmlfile,'SimpleXMLElement',LIBXML_NOENT);
        }
    }
}
else
{
    echo "非法的文件格式";
}


?>