<! DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>表格练习</title>
		<style>
		.error{
			color: red;
		}
		</style>
	</head>
	<body>
		<?php
		$name=$email=$gender=$website=$comment="";
		$nameErr=$emailErr=$genderErr=$websiteErr=$commentErr="";
		if($_SERVER["REQUEST_METHOD"] == "post")
		{
			if(empty($_POST["name"])){
				$nameErr="name是必需的！";
			}
			else{
				$name=text_input($_POST["name"]);
				if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
					$nameErr = "只允许字母和空格"; 
				}
			}
			if(empty($_POST["email"])){
				$emailErr="email是必需的";
			}
			else{
				$email=text_input($_POST["name"]);
				if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)){
					$emailErr="无效的email格式";
				}
			}
			if(empty($_POST["gender"])){
				$genderErr="gender是必需的";
			}
			else{
				$gender=text_input($_POST["gender"]);
			}
			if(empty($_POST["website"])){
				$website="";
			}
			else{
				$website=text_input($_POST["website"]);
				if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website)){
					$websiteErr="URL格式错误！";
				}
			}
			if(empty($_POST["comment"])){
				$comment="";
			}
			else{
				$comment=text_input($_POST["comment"]);
			}
		}

		function text_input($input_data){
			$input_data=trim($input_data);
			$input_data=stripcslashes($input_data);
			$input_data=htmlspecialchars($input_data);
			return $input_data;
		}
		?>

		<h2>PHP 验证实例</h2>
		<p><span class="error">*&nbsp必需的验证</span></p>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			Name:<input type="text" name="name" value="<?php echo $name; ?>"/>&nbsp<span class="error">*<?php echo $nameErr; ?></span>
			<br/><br/>
			Email:<input type="text" name="email" value="<?php echo $email; ?>"/>&nbsp<span class="error">*<?php echo $emailErr; ?></span>
			<br/><br/>
			Website:<input type="text" name="website" value="<?php echo $website; ?>"/>&nbsp<span class="error"><?php echo $websiteErr; ?></span>
			<br/><br/>
			Gender:<br/>
			<input type="radio" name="gender" 
			<?php if (isset($gender) && $gender=="female") echo "checked"; ?>
			value="female"/>女
			<input type="radio" name="gender" 
			<?php if (isset($gender) && $gender=="male") echo "checked"; ?>
			value="male"/>男
			&nbsp&nbsp<span class="error">*<?php echo $genderErr; ?></span>
			<br/><br/>
			Comment:<br/>
			<textarea name="comment" cols="40" rows="5">
				<?php echo $comment;?>
			</textarea>
			<br/><br/><br/>
			<input type="submit" value="提交" name="submit">
		</form>
		<p><?php echo $name.$website.$email ?></p>
	</body>
</html>