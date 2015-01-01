<?php

class YImageTool {

    public static function save($resource, $path) {
        if ($resource === NULL or $path === NULL) {
            return FALSE;
        }
        imagejpeg($resource, $path);
        imagedestroy($resource);
        return TRUE;
    }

    public static function printImage($resource) {
        if ($resource) {
            header('Content-Type: image/jpeg');
            imagejpeg($resource);
            imagedestroy($resource);
        } else {
            echo "error";
        }
    }

}
