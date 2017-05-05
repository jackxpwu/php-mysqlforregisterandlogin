<?php
    header("Content-type:text/html;charset=utf-8");
    if(isset($_POST["Submit"]) && $_POST["Submit"] == "立即注册")
    {
        $username = $_POST["username"];
        $password= $_POST["password"];
        $password_confirm = $_POST["confirm"];
        if($username == "" || $password == "" || $password_confirm == "")
        {
            echo "<script>alert('请确认信息完整性！'); history.go(-1);</script>";
        }
        else
        {
            if($password == $password_confirm)
            {
                $link = mysqli_connect('localhost', 'root', '');   //连接数据库
                mysqli_select_db($link,"jackwu");  //选择数据库
                mysqli_query($link,"set names 'gbk'"); //设定字符集
                $sql = "select username from registe_login where username = '$_POST[username]'"; //SQL语句
                $result = mysqli_query($link,$sql);    //执行SQL语句
                $num = mysqli_num_rows($result); //统计执行结果影响的行数
                if($num)    //如果已经存在该用户
                {
                    echo "<script>alert('用户名已存在'); history.go(-1);</script>";
                }
                else    //不存在当前注册用户名称
                {
                    $sql_insert = "insert into registe_login (username,password) values('$_POST[username]','$_POST[password]')";
                    $res_insert = mysqli_query($link,$sql_insert);
                    //$num_insert = mysql_num_rows($res_insert);
                    if($res_insert)
                    {
                        // echo "<script>alert('注册成功！'); history.go(-1);</script>";
                        echo "注册成功";
                    }
                    else
                    {
                        echo "<script>alert('系统繁忙，请稍候！'); history.go(-1);</script>";
                    }
                }
            }
            else
            {
                echo "<script>alert('密码不一致！'); history.go(-1);</script>";
            }
        }
    }
    else
    {
        echo "<script>alert('提交未成功！'); history.go(-1);</script>";
    }
?>
