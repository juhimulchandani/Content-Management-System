<?php
class Helper{
    public static function sectionYield($sectionName){
        include_once(LAYOUT."{$sectionName}.php");
    }
    
    public static function redirect($url){
        header("Location: {$url}");
    }
}
?>