<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['isadmin'] != 1) {
    header('Location: login.php');
    exit();
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <!-- import CSS -->
    <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
</head>
<body>
<div id="app">
    <el-container>
        <el-main>
            <el-table
                    :data="tableData"
                    style="width: 100%">
                <el-table-column
                        prop="id"
                        label="ID"
                        width="180"
                        header-align="center"
                        align="center"
                >
                </el-table-column>
                <el-table-column
                        prop="username"
                        label="姓名"
                        width="180"
                        header-align="center"
                        align="center"
                >
                </el-table-column>
                <el-table-column
                        prop="address"
                        label="地址"
                        header-align="center"
                        align="center"
                >
                </el-table-column>
            </el-table>
        </el-main>
    </el-container>

    <el-upload
            class="upload-demo"
            ref="upload"
            action="./upload.php"
            :on-preview="handlePreview"
            :on-remove="handleRemove"
            :file-list="fileList"
            :auto-upload="false">
        <el-button slot="trigger" size="small" type="primary">选取文件</el-button>
        <el-button style="margin-left: 10px;" size="small" type="success" @click="submitUpload">上传到服务器</el-button>
        <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
    </el-upload>
</div>

</body>
<script src="https://unpkg.com/vue@2/dist/vue.js"></script>

<script src="https://unpkg.com/element-ui/lib/index.js"></script>
<script>
    new Vue({
            el: '#app',
            data() {
                return {
                    tableData: <?php
                    //session_start();
                    //if (!isset($_SESSION['username']) || $_SESSION['isadmin'] != 1) {
                    //    header('Location: login.php');
                    //    exit();
                    //}
                    require 'db.php';
                    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
                    $sql = "SELECT * FROM userinfo WHERE username LIKE '%$keyword%' or address LIKE '%$keyword%' ";
                    $result = $db->query($sql);
                    $rows = array();
                    for ($i = 0; $i < $result->num_rows; $i++) {
                        $row = $result->fetch_assoc();
                        $rows[$i] = $row;
                    }
                    echo json_encode($rows);
                    ?>,
                    fileList: [
                    ]
                }
            },
            methods: {
                submitUpload() {
                    this.$refs.upload.submit();
                },
                handleRemove(file, fileList) {
                    console.log(file, fileList);
                },
                handlePreview(file) {
                    console.log(file);
                }
            }


        }
    )
</script>
</html>



