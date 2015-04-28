<?php/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2015-03-22 21:40:59
 * @version $Id$
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8; text/php" />
<meta name="keywords" content="Mr.Wang,Login" />
<meta name="description" content="Mr.Wang Login" />
<title>Mr.Wang Login</title> 
<link rel='stylesheet' href='../album/album.css' media='screen' />
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href="login.css" rel="stylesheet">
</head>
<body>
<!--网页顶部-->
<!--top menu-->

<div id="menu-head">
	<div id="menu-top">
		<p>Administrator Login Interface<p>
		<div id="social-icons">
			<ul class="sharesheet-links">
				<li><a href ="http://weibo.com/nguide/recommend?ugf=home"><i class="fa fa-weibo"></i></a></li>
				<li><a href="http://t.qq.com/"><i class="fa fa-tencent-weibo"></i></a></li>
				<li><a href ="https://wx.qq.com/"><i class="fa fa-weixin"></i></a></li>
				<li><a href ="http://www.renren.com/"><i class="fa fa-renren"></i></a></li>
				<li><a href ="http://qzone.qq.com/"><i class="fa fa-qq"></i></a></li>
				<li><a href ="http://www.facebook.com/"><i class="fa fa-facebook-square"></i></a></li>
			</ul>
		</div>
	</div>

	<!--菜单栏-->
	<div id="menu-bottom">
		<ul id="menu">
			<li><a href ="../../index.html">About me</a></li>
			
			<li><a href="#">Album</a>
				<ul>
					<li><a href="../journey/journey_album.html">Journey album</a></li><hr/>
					<li><a href="#">Home album</a></li><hr/>
					<li><a href="../study/study_album.html">Study album</a></li>
				</ul>
			</li>
			
			<li><a href="#">Diary</a>
				<ul>
					<li><a href="#">Mood diary</a></li><hr/>
					<li><a href="#">Informao essay</a></li><hr/>
					<li><a href="#">Travel diary</a></li>
				</ul>
			</li>

			<li><a href="#">Favorite</a>
				<ul>
					<li><a href="#">Sport</a></li><hr/>
					<li><a href="#">Music</a></li><hr/>
					<li><a href="#">Book</a></li>
				</ul>
			</li>
			
			<li><a href="#">Contact</a></li>
        </ul>
	</div>
</div>

<?php
//定义存储接受表单数据的变量
$admin=$pass="";
$adminErr=$passErr=$error="";
function textInput($data){
		$data=trim($data);
		$data=stripcslashes($data);
		$data=htmlspecialchars($data);
		return $data;
	}//function

if($_SERVER["REQUEST_METHOD"] == "POST"){	
	if(empty($_POST["admin"])){
		$adminErr="*必须选择管理员权限";
	}
	else{
		$admin=textInput($_POST["admin"]);
	}
	if(empty($_POST["password"])){
		$passErr="*必须输入长度在6~15，同时包含大写或小写字母和数字的密码";
	}
	else{
		$pass=textInput($_POST["password"]);
		if(!preg_match('/^(?![^a-zA-Z]+$)(?!\D+$).{6,20}$/', $pass)){
			$passErr="*必须输入长度在6~15，同时包含大写或小写字母和数字的密码";
		}//if preg_match
	}//else
	//检测到没有不符合要求规格的输入后验证身份和密码
	if($adminErr == "" && $passErr == ""){
		$con=@mysql_connect("localhost","root","wang834379220") or die("Could not connect".mysql_error());
		@mysql_select_db("personnalWeb") or die("Could not use personnalWeb".mysql_error());
			$query="SELECT password FROM admin WHERE permission = '$admin' AND password = '$pass'";
		if(mysql_num_rows(mysql_query($query)) == 0){
			$error="Error Password";
		}//if(mysql_num_rows(mysql_query($query)) == 0)
		else{
			$_SESSION["admin"]=$admin;
			$_SESSION["password"]=$pass;
			mysql_close($con);
			echo "<script language='javascript'>window.location.href='../admin/indexadmin.html'</script>";
		}//else
	}//if($adminErr == "" && $passErr == "")
}//if($_SERVER["REQUEST_METHOD"] == "POST")
//php
?>

<div id="error">
	<p><?php echo $adminErr; ?>&nbsp&nbsp&nbsp<?php echo $passErr; ?></p>
	<p><?php echo $error; ?></p>
</div>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	<table>
		<tr>
			<td>Permission:</td>
			<td><input type ="radio" name="admin" <?php if (isset($admin) && $admin == "superAdmin") echo "checked"; ?> value="superAdmin"/></td>
			<td>Super Admin</td>
			<td><input type ="radio" name="admin" <?php if (isset($admin) && $admin == "generalAdmin") echo "checked"; ?> value="generalAdmin"/></td>
			<td>General Admin</td>
		</tr>
		<tr>
			<td>Password:</td>
			<td colspan="4"><input type="password" name="password" value="<?php echo $pass; ?>" /></td>
		</tr>
		<tr>
			<td colspan="5"><input type="submit" name="submit" value="L o g i n"></td>
		</tr>
	</table>
</form>

<!-- Footer -->
<footer id="footer">
  <p class="right">Design: <a href="http://www.solucija.com/" title="Information Architecture and Web Design">Mr.Wang</a> &copy; Copyright 2015 <a href="#">Mr.Wang Personal Website</a> &middot; All Rights Reserved</p>
</body>
</html>