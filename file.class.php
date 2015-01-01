<?php

class File {

    /**
     * 获取文件夹下的文件名
     * @param string $dir
     * @return array 文件名数组
     */
    public static function getFileName($dir) {
        if ($dir == NULL) {
            $dir = "./";
        }
        $fopen = opendir($dir);
        $FileArray = array();
        while ($File = readdir($fopen)) {
            if ($File != '.' && $File != '..' && strpos($File, '.')) {
                $index = substr_replace($File, '', -4);
                $FileArray[] = $index;
            }
        }
        return $FileArray;
    }

    /**
     * 返回数组中的最大值
     * @param array $array
     * @return boolean
     */
    public static function max($array) {
        if (is_array($array)) {
            return max($array);
        }
        return false;
    }

}
