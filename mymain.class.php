<?php

/*
 * 一些单独的函数
 */ 
class MyMain {

    /**
     * 获取教务处验证码
     * 地址http://210.42.38.26:81/jwc_glxt/ValidateCode.aspx
     * @param type $path 验证码存储地址
     */
    public function getCheckCode($url,$path = NULL) {
	//$url = "http://210.42.38.26:81/jwc_glxt/ValidateCode.aspx";
	
		//$url = './image/abby.jpg';

        $im = imagecreatefromjpeg($url);
        if ($path && $path != "") {
            YImageTool::save($im, $path);
        } else {
            if ($im) {
                return $im;
            }
        }
    }

    /**
     * 批量截取验证码的一部份并保存
     * @param type $filearray 验证码文件名数组
     */
    public function copy($filearray) {
        foreach ($filearray as $value) {
            $im = imagecreatefromjpeg("./image/$value.jpg");
            $newimage = imagecreate(10, 14);
            imagecopy($newimage, $im, 0, 0, 5, 5, 10, 14);
            $image = new YImage($newimage);
            $newimage = $image->quzhao();

            imagecopy($newimage, $im, 0, 0, 17, 5, 10, 14);
            $image = new YImage($newimage);
            $newimage = $image->quzhao();

            imagecopy($newimage, $im, 0, 0, 28, 5, 10, 14);
            $image = new YImage($newimage);
            $newimage = $image->quzhao();

            imagecopy($newimage, $im, 0, 0, 40, 5, 10, 14);
            $image = new YImage($newimage);
            $newimage = $image->quzhao();
//            $value = $value + 171;
            YImageTool::save($newimage, "./image/data1/$value.jpg");
        }
    }

    /**
     * 把验证码分为四块并返回一个数组
     * @param type $im图片资源
     */
    public function getImageArray($im) {
        $array = array();
        $im = $im;
		/*
        $newimage = imagecreate(10, 14);
        imagecopy($newimage, $im, 0, 0, 5, 5, 10, 14);
        $image = new YImage($newimage);
        $newimage = $image->quzhao();
        array_push($array, $newimage);
*/
		$is_qz = 0;//取样本时不用去  不去燥
        $newimage1 = imagecreate(30, 48);
        imagecopy($newimage1, $im, 0, 0, 10, 5, 30, 48);
		if($is_qz)
		{
			$image1 = new YImage($newimage1);
			$newimage1 = $image1->quzhao();
		}
        array_push($array, $newimage1);

        $newimage2 = imagecreate(30, 48);
        imagecopy($newimage2, $im, 0, 0, 40, 5, 30, 48);
		if($is_qz)
		{
			$image2 = new YImage($newimage2);
			$newimage2 = $image2->quzhao();
		}
        array_push($array, $newimage2);

        $newimage3 = imagecreate( 30, 48);
        imagecopy($newimage3, $im, 0, 0, 70, 5,  30, 48);
		if($is_qz)
		{
			$image3 = new YImage($newimage3);
			$newimage3 = $image3->quzhao();
		}
        array_push($array, $newimage3);
		
		$newimage3 = imagecreate( 30, 48);
        imagecopy($newimage3, $im, 0, 0, 90, 5,  30, 48);
		if($is_qz)
		{
			$image3 = new YImage($newimage3);
			$newimage3 = $image3->quzhao();
		}
        array_push($array, $newimage3);

        return $array;
    }

    /**
     * 比较不同文件夹下的文件
     * @param type $tagArray
     * @param type $fileArray
     */
    public function compare($tagArray, $fileArray) {

        $tagArrayLen = count($tagArray);
        $filearrayLen = count($fileArray);
        for ($x = 0; $x < $tagArrayLen; $x++) {
            $image = new YImage(imagecreatefromjpeg("./image/data/$tagArray[$x].jpg"));
            $image->quzhao();
            for ($y = $x + 1; $y < $filearrayLen; $y++) {
                $image1 = new YImage(imagecreatefromjpeg("./image/data/$fileArray[$y].jpg"));
                $image1->quzhao();
                if ($image->compare1($image1->getDataAray())) {
                    echo "success$tagArray[$x]=>$fileArray[$y]";
                    echo "<br/>";
                }
            }
        }
    }

    /**
     * 比较相同文件夹下的文件
     * @param type $fileArray
     */
    public function compare1($fileArray) {
        $filearrayLen = count($fileArray);
        for ($x = 0; $x < $filearrayLen; $x++) {
            $image = new YImage(imagecreatefromjpeg("./image/data/$fileArray[$x].jpg"));
            $image->quzhao();
            for ($y = $x + 1; $y < $filearrayLen; $y++) {
                $image1 = new YImage(imagecreatefromjpeg("./image/data/$fileArray[$y].jpg"));
                $image1->quzhao();
                if ($image->compare1($image1->getDataAray())) {
                    echo "$fileArray[$x]=>$fileArray[$y]";
                    echo "<br/>";
                }
            }
        }
    }

}
