<?php
	require_once('conn.php');
	$sql="select * from liuyan order by rand() limit 1";
	echo $sql.'<hr>';
	$res=mysql_query($sql);
	while($row=mysql_fetch_row($res))
	{
	    	$str=$row[0].'<br>';
	    	$str.=$row[1].'<br>';
	    	$str.=$row[2].'<br>';
	    	$str.=$row[3].'<br>';
	    	$str.=$row[4].'<br>';
	    	$str.=$row[5].'<br>';
	}
	echo $str.'<hr>';

	$name = date('Y-m-d').'.txt';
	echo '文件名:'.$name.'<br>';
	#$flag = fopen($name,'w+');
	$flag = fopen($name,'a+');
	if(!$flag)
	{
	    echo "文本打开失败,中止操作<br>";
	    exit();
	}
	echo "打开文本成功!!<br>";
	$flag2=fwrite($flag,$str);
	if(!$flag2)
	{
	    echo "写入失败!!<br>";
	    exit();
	}
	echo "写入成功!!<br>";
	fclose($flag);
	$path='./downloads/'.$name;
	echo "移动后的路径:".$path."<br>";
	$flag3=rename($name,$path);
	#$flag3=copy($name,$path);
	if(!$flag3)
	{
	    echo "文本移动失败!!<br>";
	    exit();
	}
	echo "文本移动成功!!<br>";
?>
