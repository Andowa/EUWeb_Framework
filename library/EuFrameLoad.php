<?php
/**
       * --------------------------------------------------------       

       *  | AEUhor:HuangDou   Email:292951110@qq.com        |            
       *  | QQ-Group:583610949                              |           
       *  | WebSite:http://www.EuFrame.com                |            
       *  | EU Framework is suitable for Apache2 protocol.  |            
       * --------------------------------------------------------                
 */
/**
 * Compatible with PSR0
 * 
 */
class Loader{
    public static function AEUoLoad($class){
        $class=preg_replace('/(.*)\\\{1}([^\\\]*)/i','$1',$class);
        /*EU built-in function library*/
        $lib_load_file=str_replace('\\','/',EUF_ROOT.'\\'. $class).'.php';
        /*App custom function library*/
        $app_load_file=str_replace('\\','/',APP_ROOT.'\\'. $class).'.php';
        if(file_exists($lib_load_file)){
            require_once $lib_load_file;
        }elseif(file_exists($app_load_file)){
            require_once $app_load_file;
        }
    }
}
spl_aEUoload_register("Loader::AEUoLoad");
/**
 * Compatible with PSR4
 * Composer dependency Library
 */
if(library\EuFrameInc\EUInc::SearchFile(EUF_ROOT."/vendor/aEUoload.php")):
    require_once EUF_ROOT.'/vendor/aEUoload.php';
endif;