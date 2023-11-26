<?php

global $flag;
global $db;
require "flag.php";
require "db.php";

$id= $_GET['id'];
$infos = NULL;
if (!is_null($id)){
    $sql = "select * from ctf.user where id=".$id;
//    echo $sql;
    $row = $db->multi_query($sql);
   if($row){
       do {
           // 获取查询结果
           $result = $db->store_result();

           // 处理结果集...
           while ($row = $result->fetch_assoc()) {
               // 处理每一行
               if (is_array($row)){
                   if (is_null($infos)) {
                       $infos = array();
                   }
                   $infos[] = $row;
               }
           }

           // 移到下一个结果集
       } while ($db->more_results() && $db->next_result());
    }else{
        $error_message = "id 不存在";
    }
}
// 关闭连接
$db->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER INFO</title>
</head>
<body>
<h2>USER INFO</h2>

<?php
// 如果有错误消息，显示出来
if (isset($error_message)) {
    echo "<p style='color:red;'>$error_message</p>";
}
?>

<!--<hint> ?id=? </hint>-->
<?php
// 如果有错误消息，显示出来
if (!is_null($infos)) {
    foreach ($infos as $k =>$v){
       if (is_array($v)){
           foreach ($v as $vk=>$vv){
               echo "<hr/><p style='color:green;'>".$vv."</p>";
           }
       }else{
           echo "<hr/><p style='color:green;'>".$v."</p>";
       }

    }
}
?>
</body>
</html>
