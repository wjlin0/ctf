<?php
# 判断文件头是否为图片
function isImg($file)
{
    $file_tmp = $file['tmp_name'];
    $file_info = getimagesize($file_tmp);
    if ($file_info === false) {
        return false;
    }
    return true;
}

# 文件上传
if ($_FILES && $_FILES['file']) {
    $file = $_FILES['file'];
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];
    $file_type = $file['type'];

    $file_ext = explode('.', $file_name);
    $file_ext = strtolower(end($file_ext));
    if (isImg($file)) {
        if ($file_error === 0) {
            if ($file_size <= 2097152) {
                $file_name_new =$file_name;
                $file_destination = 'uploads/' . $file_name_new;
                if (move_uploaded_file($file_tmp, $file_destination)) {
                    echo '文件上传成功';
                } else {
                    echo '文件上传失败';
                }
            } else {
                echo '文件过大';
            }
        } else {
            echo '上传错误';
        }
    } else {
        echo '不支持的文件类型';
    }
}
