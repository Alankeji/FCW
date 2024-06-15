<?php
$dir = "."; // 当前目录

// 检查是否有'action'参数
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'list':
            // 列出当前目录中的文件
            $files = scandir($dir);
            foreach ($files as $file) {
                if ($file == '.' || $file == '..') continue;
                echo $file . "<br>";
            }
            break;
        case 'delete':
            // 删除文件
            if (isset($_GET['file'])) {
                $file = $_GET['file'];
                if (file_exists($dir . '/' . $file)) {
                    unlink($dir . '/' . $file);
                    echo "文件 " . $file . " 已被删除";
                } else {
                    echo "文件不存在";
                }
            } else {
                echo "没有指定要删除的文件";
            }
            break;
        case 'create':
            // 创建新文件
            if (isset($_GET['file'])) {
                $file = $_GET['file'];
                $handle = fopen($dir . '/' . $file, 'w') or die('不能打开文件:  ' . $file);
                fclose($handle);
                echo "文件 " . $file . " 已被创建";
            } else {
                echo "没有指定要创建的文件名";
            }
            break;
        case 'modify':
            // 修改文件内容
            if (isset($_GET['file']) && isset($_GET['content'])) {
                $file = $_GET['file'];
                $content = $_GET['content'];
                if (file_exists($dir . '/' . $file)) {
                    file_put_contents($dir . '/' . $file, $content);
                    echo "文件 " . $file . " 已被修改";
                } else {
                    echo "文件不存在";
                }
            } else {
                echo "没有指定要修改的文件或内容";
            }
            break;
        case 'rename':
            // 重命名文件
            if (isset($_GET['oldname']) && isset($_GET['newname'])) {
                $oldname = $_GET['oldname'];
                $newname = $_GET['newname'];
                if (file_exists($dir . '/' . $oldname)) {
                    rename($dir . '/' . $oldname, $dir . '/' . $newname);
                    echo "文件 " . $oldname . " 已被重命名为 " . $newname;
                } else {
                    echo "文件不存在";
                }
            } else {
                echo "没有指定要重命名的文件名";
            }
            break;
        default:
            echo "无效的操作";
    }
} else {
    echo "没有指定操作";
}
?>
