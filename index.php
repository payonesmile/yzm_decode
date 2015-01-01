<?php

set_time_limit(0);
/*require_once 'convimg.class.php';
for($i=0; $i<=1000;$i++)
{
	$gif = file_get_contents('http://nvcsz.gtimg.com/43192664/16970618041617093564.gif?r=18994'.$i);

	$url = './image/yb/qq.gif';

	file_put_contents($url,$gif);

			//转jpg
$obj = new ReSizeImage(); 
$obj->setSourceFile($url); 
$obj->setDstFile('./image/yb/'.date('His').$i.'.jpg'); 
$obj->draw();


	//sleep(1);
}
echo '取样成功 ';
exit;

*/

//ini_set('error_reporting', 'E_ALL ^ E_NOTICE');
require_once 'file.class.php';
require_once 'image.class.php';
require_once 'mymain.class.php';
require_once 'checkcode.class.php';

/*
//把样本分拆开，要先改好名
$fileArray = File::getFileName('./image/yb');

$main = new MyMain();
foreach($fileArray as $i=>$value)
{
	$url = './image/yb/'.$value.'.jpg';
	
	$im = imagecreatefromjpeg($url);
	$imageArray = $main->getImageArray($im);
	$info = pathinfo($url);

	for ($index = 0; $index < 4; $index++) {
		YImageTool::save($imageArray[$index], "./image/data1/".$info['filename'][$index].date('His')."_$index.jpg");

	}
sleep(1);
	//echo $url;exit;
}
echo  $i;
exit;*/



$url = './image/xhkd.jpg';
$stime = time();

$checkCode = new CheckCode();
$code = $checkCode->discernCheckCode($url);

echo '腾讯QQ验证码识别：http://pt.3g.qq.com/<br/>';

var_dump($code );
if (strlen($code) == 4) {
    echo "识别成功";
} else {
    echo "识别失败";
}

$etime = time();
echo $code;
echo '<br>共';
echo $etime - $stime; 
echo '秒<br>';
?>
<img src="./image/temp.jpg"/>