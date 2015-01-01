<?php
class Tools{
    public static function toArray($array){
        $myAarray = array();
        foreach ($array as $key=>$value) {
            if(is_array($value)){
                Tools::toArray($value);
            }else{
                if(!is_int($key))
               array_push ($myAarray, $value);
            }
        }
        return $myAarray;
    }
}