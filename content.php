<?php
	session_start();
	$usr = isset($_SESSION['USR'])?$_SESSION['USR']:'';
	
	define("IN_PHP",12);
	//连接数据库
	include_once "class/mysql.class.php";
	include_once "class/Upload.class.php";

	$dbObj = new db_mysql('localhost','root','root','zuoye');
	
	if(!empty($POST)){
		//处理文件上传
		if($_FILES['pictrue']['name'] != '')
		{
			//设置文件上传
			$tArr = array(
							'filepath'=>date('Y-m'),
							'allowsize'=>1024*1024*2,
							'allowmime'=>array(
												'image/jpeg',
												'image/jpg',
												'image/gif',
												'image/png'
												),
							 'israndname'=>1
						  );
			$upObj = new fileup($tArr);
			$files = $upObj->up('pictrue');
			if($files)//上传成功
			{
				$_POST['pictrue']= date('Y-m').'/'.$files;
				alert('上传成功');
			}
			else//上传失败
			{
				echo $upObj->geterror();
				exit();
			}
		}
		
		$_POST['timeline'] = time();
		$rtn = $dbObj->insert('liuyan',$_POST);
		if($rtn)
		{
			echo "<script>";
			echo "alert('添加成功');";
			echo "location.href='index.php';";
			echo "</script>";
		}else
		{
			echo "<script>";
			echo "alert('添加失败');";
			echo "location.href='content.php';";
			echo "</script>";
		}

		exit();
	}
	
	$sql = "select * from user";
	$typeArr = $dbObj->getall($sql);
	
?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/global.css">
</head>
<body>
<div>
    <h2>欢迎您：<?php echo $usr;?></h2>
	<hr style=" height:1px;border:none;border-top:1px dashed #0066CC;">
	<form enctype="multipart/form-data" action="content.php" method="post">
    <div class="index_new_box_3">
        <ul>
            <li>
                <div class="index_new_box_3_main"><span>留言心情：</span></div>
                <div class="index_new_box_3_main"><input type="file" name="pictrue">   </div>				
            </li>		
            <li>
                <div class="index_new_box_3_main"><span>留言内容：</span></div>
                <div class="index_new_box_3_main"><textarea  name="content" STYLE="border:1px dotted   #6CABE7;" cols="90" rows="4"></textarea>   </div>				
            </li>
           	
            <li>
                <div class="index_new_box_3_main">&nbsp;<button style="margin-left:180px;"type="submit" class="btn btn-primary" type="submit">保存</button>&nbsp;&nbsp;<a href="index.php">返回列表</a></div>
            </li>				
        </ul>
	</div>
	</form>
</div>
</body>
</html>