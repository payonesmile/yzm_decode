<?php

class CheckCode {

    private $codeLenth = 4;
    private $tempFile = "./image/temp.jpg";
    private $dataPath = "./image/data/";
    private $checkCode = "";

    public function discernCheckCode($url) {
        $fileArray = File::getFileName($this->dataPath);

        $main = new MyMain();
        $im = $main->getCheckCode($url);
        $imageArray = $main->getImageArray($im);

        YImageTool::save($im, $this->tempFile);
        for ($index = 0; $index < $this->codeLenth; $index++) {

            $image = new YImage($imageArray[$index]);
            $image->quzhao();
            $image = $image->getDataAray();
			//var_dump($image);exit;
            foreach ($fileArray as $value) {
				
                $im = imagecreatefromjpeg($this->dataPath . "" . $value . ".jpg");
                $tagImage = new YImage($im);
                $tagImage->quzhao();
                if ($tagImage->compare($image)) {
                    $this->checkCode = $this->checkCode . substr_replace($value, '', 1);
					
                    break;
                }
            }
        }

        return $this->checkCode;
    }

}
