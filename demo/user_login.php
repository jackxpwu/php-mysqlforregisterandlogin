<?php
    header("Content-type:text/html;charset=utf-8");
    if(isset($_POST["Submit"]) && $_POST["Submit"] == "立即登录")
    {
        $username = $_POST["username"];
        $password = $_POST["password"];
        if($username == "" || $password == "")
        {
            echo "<script>alert('请输入用户名或密码！'); history.go(-1);</script>";
        }
        else
        {
            $link = mysqli_connect('localhost', 'root', '');//链接数据库
            mysqli_select_db($link,"jackwu");
            mysqli_query($link,"set names utf8");
            // mysql_connect("localhost","root","");
            // mysql_select_db("jackwu");
            // mysql_query("set names 'gbk'");
            $sql = "select username,password from registe_login where username = '$_POST[username]' and password = '$_POST[password]'";
            $result = mysqli_query($link,$sql);
            $num = mysqli_num_rows($result);
            if($num)
            {
                $row = mysqli_fetch_array($result);  //将数据以索引方式储存在数组中
                echo "邮箱".$row[0]."登录成功";
            }
            else
            {
                echo "<script>alert('用户名或密码不正确！');history.go(-1);</script>";
            }
        }
    }
    else
    {
        echo "<script>alert('提交未成功！'); history.go(-1);</script>";
    }

?>
