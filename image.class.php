<?php

require_once 'imageTool.class.php';

class YImage {

    private $Iresource;
    private $white;
    private $hight;
    private $dataArray;
    private $dataLenth;

    public function __construct($Iresource) {
        $this->Iresource = $Iresource;
        $this->white = @imagesx($this->Iresource);
        $this->hight = @imagesy($this->Iresource);
        $this->dataLenth = $this->white * $this->hight;
		
    }

    /**
     * 根据验证码的相同度判断是否为同一个
     * @param type $dataArray
     * @return boolean
     */
    public function compare($dataArray) {

        $tag = 0;
        for ($x = 0; $x <  $this->dataLenth; $x++) {
			//echo $this->dataArray[$x] .'=='. $dataArray[$x].'<br>';
            if ($this->dataArray[$x] == $dataArray[$x]) {
                $tag++;
				//echo $tag .'=='.$this->dataLenth.'<br>';
                if ($tag >=  $this->dataLenth-200)//容差
                    return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * 根据rgb去噪
     * 原理是因为验证码和背景色的rgb不同
     * @return image
     */
    public function quzhao() {
        $data = array();
        for ($x = 0; $x < $this->white; $x++) {
            for ($y = 0; $y < $this->hight; $y++) {
                $index = ImageColorAt($this->Iresource, $x, $y);
                $rgbarray = imagecolorsforindex($this->Iresource, $index);
                if ($rgbarray['red'] < 200 || $rgbarray['green'] < 200 || $rgbarray['blue'] < 200) {
                    array_push($data, 1);
                     //  echo "*";
                } else {
                    array_push($data, 0);
                    imagefill($this->Iresource, $x, $y, self::getWhitePaint());
                     // echo "-";
                }
                  //echo " ";
            }
            // echo " <br/>";
        }
        // echo "<br/>";
        $this->dataArray = $data;
        return $this->Iresource;
    }

    /**
     * 白色画笔
     * @return type
     */
    public function getWhitePaint() {
        return imagecolorallocate($this->Iresource, 0xFF, 0xFF, 0xFF);
    }

    public function getDataAray() {
        return $this->dataArray;
    }

    public function getImage() {
        return $this->Iresource;
    }

    public function save($path) {
        YImageTool::save($this->Iresource, $path);
    }

    public function printImage() {
        YImageTool::printImage($this->Iresource);
    }

}
