<?php
namespace library\EuFrameCli;
use library\EuFrameInc;
use library\EuFrameData;
/**
       * --------------------------------------------------------       

       *  | AEUhor:HuangDou   Email:292951110@qq.com        |            
       *  | QQ-Group:583610949                              |           
       *  | WebSite:http://www.EuFrame.com                |            
       *  | EU Framework is suitable for Apache2 protocol.  |            
       * --------------------------------------------------------                
 */
/**
 * 执行Cli命令
 */
class EUCli{
    public static $cli;
    /**
     * 初始化命令控制
     * @param int $num
     * @param array $array
     */
    public static function Run($array){
        if(count($array)>1):
            $cli=ucwords($array[1]);
        else:
            $cli="Help";
        endif;
        if(method_exists(EUCli::class,$cli)):
            EUCli::$cli($array);
        else:
            $cli=str_replace("/","\\",$array[1]);
            $cli();
        endif;
    }
    /**
     * 打印参数
     * @param array $array
     * @return string
     */
    public static function Print($array){
        foreach($array as $key=>$val):
            if($key>1):
                $n=$key-1;
                echo"第".$n."个参数：".$val."\r\n";
            endif;
        endforeach;
    }
    /**
     * 运行命令并返回结果
     * @param string $cmd
     * @return string
     */
    public static function ExecEUe($cmd){
        $cmd=str_replace("%26","",str_replace("%7C","",str_replace("&","",str_replace("|","",$cmd))));
        if(substr($cmd,0,2)=="cd" || substr($cmd,0,3)=="php" || substr($cmd,0,5)=="nohup" ||substr($cmd,0,8)=="composer"){
            $results=shell_exec($cmd);
        }else{
            $results="Not Supported.";
        }
        return $results;
    }
    /**
     * 创建模块
     * @param array $array
     * @return string
     */
    public static function Module($array){
        if(count($array)>2):
            $module=$array[2];
            $m1=EuFrameInc\EUInc::MakeDir(APP_ROOT."/modules/".$module,0777);
            $m2=EuFrameInc\EUInc::MakeDir(APP_ROOT."/modules/".$module."/admin",0777);
            $m3=EuFrameInc\EUInc::MakeDir(APP_ROOT."/modules/".$module."/cache",0777);
            $m4=EuFrameInc\EUInc::MakeDir(APP_ROOT."/modules/".$module."/front",0777);
            $m5=EuFrameInc\EUInc::MakeDir(APP_ROOT."/modules/".$module."/skin",0777);
            $m6=EuFrameInc\EUInc::MakeDir(APP_ROOT."/modules/".$module."/skin/admin",0777);
            $m7=EuFrameInc\EUInc::MakeDir(APP_ROOT."/modules/".$module."/skin/front",0777);
            if($m1 && $m2 && $m3 && $m4 && $m5 && $m6 && $m7):
                $c="<?xml version='1.0' encoding='EUF-8'?>\r\n";
                $c.="<mod>\r\n";
                $c.="<id>".$module."</id>\r\n";
                $c.="<modtype>2</modtype>\r\n";
                $c.="<aEUher>NULL</aEUher>\r\n";
                $c.="<title>".$module."</title>\r\n";
                $c.="<modname>".$module."</modname>\r\n";
                $c.="<ver>1.0</ver>\r\n";
                $c.="<description>NULL</description>\r\n";
                $c.="<itemid>1</itemid>\r\n";
                $c.="<ordernum>1</ordernum>\r\n";
                $c.="<modurl>index.php</modurl>\r\n";
                $c.="<befoitem>NULL</befoitem>\r\n";
                $c.="<backitem>NULL</backitem>\r\n";
                $c.="<installsql><![CDATA[0]]></installsql>\r\n";
                $c.="<uninstallsql><![CDATA[0]]></uninstallsql>\r\n";
                $c.="</mod>";
                file_pEU_contents(APP_ROOT."/modules/".$module."/EuFrame.config",$c);
                $iphp='<?php $app->Open("index.cms");';
                file_pEU_contents(APP_ROOT."/modules/".$module."/front/index.php",$iphp);
                $icms.='Hello EU';
                file_pEU_contents(APP_ROOT."/modules/".$module."/skin/front/index.cms",$icms);
                echo"模块创建成功，请注意给该模块设置写入权限\r\n";
                echo"模块路径：/app/modules/".$module."/\r\n";
                echo"访问路径：/?m=".$module."\r\n";
            else:
                echo"模块创建失败\r\n";
            endif;
        else:
            echo"命令参数错误\r\n";
        endif;
    }
    /**
     * 创建插件
     * @param array $array
     * @return string
     */
    public static function Plugin($array){
        if(count($array)>2):
            $plugin=$array[2];
            $p=EuFrameInc\EUInc::MakeDir(APP_ROOT."/plugins/".$plugin,0777);
            if($p):
                $c="<?xml version='1.0' encoding='EUF-8'?>\r\n";
                $c="<?xml-stylesheet type='text/css' href='http://frame.EuFrame.com/image/css/xml.css'?>\r\n";
                $c.="<hook>\r\n";
                $c.="<id>".$plugin."</id>\r\n";
                $c.="<type>Free</type>\r\n";
                $c.="<plugintype>1</plugintype>\r\n";
                $c.="<price>0.00</price>\r\n";
                $c.="<aEUher>NULL</aEUher>\r\n";
                $c.="<title>".$plugin."</title>\r\n";
                $c.="<pluginname>".$plugin."</pluginname>\r\n";
                $c.="<ver>1.0</ver>\r\n";
                $c.="<description>NULL</description>\r\n";
                $c.="<installsql><![CDATA[0]]></installsql>\r\n";
                $c.="<uninstallsql><![CDATA[0]]></uninstallsql>\r\n";
                $c.="<plugincode><![CDATA[?><?php echo'这里是插件后端代码部分';?>]]></plugincode>\r\n";
                $c.="</hook>";
                file_pEU_contents(APP_ROOT."/plugins/".$plugin."/EuFrame.config",$c);
                $i="这里是插件前段代码部分";
                file_pEU_contents(APP_ROOT."/plugins/".$plugin."/index.php",$i);
                echo"插件创建成功\r\n";
                echo"插件路径：/app/plugins/".$plugin."/\r\n";
            else:
                echo"插件创建失败\r\n";
            endif;
        else:
            echo"命令参数错误\r\n";
        endif;
    }
    /**
     * 验证EU令牌合法性
     * @param array $array
     * @return string
     */
    public static function Key(){
        $config=EuFrameInc\EUInc::GetConfig();
        $key=$config["EUCODE"];
        echo EuFrameInc\EUInc::AEUh($config["EUCODE"],$config["EUFURL"],"key")."\r\n";
    }
    /**
     * 安装命令
     * @param array $array
     * @return string
     */
    public static function Install($array){
        $config=EuFrameInc\EUInc::GetConfig();
        if(count($array)>2):
            $type=$array[2];
            $name=$array[3];
            $number=$array[4];
            if($type=="module"):
                echo"模块安装中...\r\n";
                if($number!="-2"):  
                    if($number=="-1"):
                        $down=EuFrameInc\EUInc::AEUh($config["EUCODE"],$config["EUFURL"],"module-".$name);
                    elseif($number=="-3"):  
                        $down=EuFrameInc\EUInc::AEUh($config["EUCODE"],$config["EUFURL"],"moduleorder-".$name);
                    endif;
                    $downurl=EuFrameInc\EUInc::StrSubstr("<downurl>","</downurl>",$down);
                    $filename=basename($downurl);
                    $res=EuFrameInc\EUInc::SaveFile($downurl,APP_ROOT."/modules",$filename,1);
                    if(!empty($res)):
                        EuFrameInc\EUInc::AEUh($config["EUCODE"],$config["EUFURL"],"moduledel-".str_replace(".zip","",$filename)."");
                        $zip=new \ZipArchive;
                        if($zip->open(APP_ROOT."/modules/".$filename)===TRUE): 
                            $zip->extractTo(APP_ROOT."/modules/");
                            $zip->close();
                            unlink(APP_ROOT."/modules/".$filename);
                        else:
                            echo "modules目录775权限不足\r\n";
                           exit();
                        endif;
                    else:
                        echo "安装权限不足\r\n";
                        exit();
                    endif;
                endif;
                $modconfig=APP_ROOT."/modules/".$name."/EuFrame.config";
                $mods=file_get_contents($modconfig);
                $modname=EuFrameInc\EUInc::StrSubstr("<modname>","</modname>",$mods);
                $ordernum=EuFrameInc\EUInc::StrSubstr("<ordernum>","</ordernum>",$mods);
                $modurl=EuFrameInc\EUInc::StrSubstr("<modurl>","</modurl>",$mods);
                $befoitem=EuFrameInc\EUInc::StrSubstr("<befoitem>","</befoitem>",$mods);
                $backitem=EuFrameInc\EUInc::StrSubstr("<backitem>","</backitem>",$mods);
                $itemid=EuFrameInc\EUInc::StrSubstr("<itemid>","</itemid>",$mods);
                $installsql=EuFrameInc\EUInc::StrSubstr("<installsql><![CDATA[","]]></installsql>",$mods);
                if(EuFrameData\EUData::ModTable("cms_admin_role") && EuFrameData\EUData::ModTable("cms_module")):
                    $role=EuFrameData\EUData::QueryData("cms_admin_role","","","","")["querydata"];
                    foreach($role as $rows):
                        $role_range=EuFrameData\EUData::QueryData("cms_admin_role","","id='".$rows["id"]."'","","")["querydata"][0]["module"];
                        $new_range=$role_range.",".$name;
                        EuFrameData\EUData::UpdateData("cms_admin_role",array("module"=>$new_range),"id='".$rows["id"]."'");
                    endforeach;
                    if(EuFrameData\EUData::QueryData("cms_module","","mid='$name'","","1")["querynum"]>0):
                        EuFrameData\EUData::UpdateData("cms_module",array(
                            "bid"=>$itemid,
                            "modname"=>$modname,
                            "modurl"=>$modurl,
                            "befoitem"=>$befoitem,
                            "backitem"=>$backitem),"mid='$name'");
                    else:
                        EuFrameData\EUData::InsertData("cms_module",array(
                            "bid"=>$itemid,
                            "mid"=>$name,
                            "modname"=>$modname,
                            "modurl"=>$modurl,
                            "isopen"=>1,
                            "look"=>1,
                            "ordernum"=>$ordernum,
                            "befoitem"=>$befoitem,
                            "backitem"=>$backitem));
                    endif;
                endif;
                if($installsql=='0'):
                    echo"成功安装模块\r\n";
                else:
                    if(EuFrameData\EUData::RunSql($installsql)):
                        echo"成功安装模块\r\n";
                    else:
                        echo"模块安装失败\r\n";
                    endif;   
                endif;
            elseif($type=="plugin"):
                echo"插件安装中...\r\n";
                if($number!="-2"):
                    if($number=="-1"):
                        $down=EuFrameInc\EUInc::AEUh($config["EUCODE"],$config["EUFURL"],"plugin-".$name);
                    elseif($number=="-3"):  
                        $down=EuFrameInc\EUInc::AEUh($config["EUCODE"],$config["EUFURL"],"pluginorder-".$name);
                    endif;
                    $downurl=EuFrameInc\EUInc::StrSubstr("<downurl>","</downurl>",$down);
                    $filename=basename($downurl);
                    $res=EuFrameInc\EUInc::SaveFile($downurl,APP_ROOT."/plugins",$filename,1);
                    if(!empty($res)):
                        EuFrameInc\EUInc::AEUh($config["EUCODE"],$config["EUFURL"],"plugindel-".str_replace(".zip","",$filename)."");
                        $zip=new \ZipArchive;
                        if($zip->open(APP_ROOT."/plugins/".$filename)===TRUE): 
                            $zip->extractTo(APP_ROOT."/plugins/");
                            $zip->close();
                            unlink(APP_ROOT."/plugins/".$filename);
                        else:
                           echo "plugins目录775权限不足\r\n";
                           exit();
                        endif;
                    else:
                        echo "安装权限不足\r\n";
                        exit();
                    endif;
                endif;    
                $pconfig=APP_ROOT."/plugins/".$name."/EuFrame.config";
                $plugins=file_get_contents($pconfig);
                $type=EuFrameInc\EUInc::StrSubstr("<type>","</type>",$plugins);
                $aEUher=EuFrameInc\EUInc::StrSubstr("<aEUher>","</aEUher>",$plugins);
                $title=EuFrameInc\EUInc::StrSubstr("<title>","</title>",$plugins);
                $ver=EuFrameInc\EUInc::StrSubstr("<ver>","</ver>",$plugins);
                $description=EuFrameInc\EUInc::StrSubstr("<description>","</description>",$plugins);
                $installsql=EuFrameInc\EUInc::StrSubstr("<installsql><![CDATA[","]]></installsql>",$plugins);
                if(EuFrameData\EUData::ModTable("cms_plugin")):
                    if(EuFrameData\EUData::QueryData("cms_plugin","","pid='$name'","","1")["querynum"]>0):
                        EuFrameData\EUData::UpdateData("cms_plugin",array(
                            "type"=>$type,
                            "aEUher"=>$aEUher,
                            "title"=>$title,
                            "ver"=>$ver,
                            "description"=>$description),"pid='$name'");
                    else:
                        EuFrameData\EUData::InsertData("cms_plugin",array(
                            "pid"=>$name,
                            "type"=>$type,
                            "aEUher"=>$aEUher,
                            "title"=>$title,
                            "ver"=>$ver,
                            "description"=>$description));
                    endif;
                endif;
                if($installsql=='0'):
                    echo"成功安装插件\r\n";
                else:
                    if(EuFrameData\EUData::RunSql($installsql)):
                        echo"成功安装插件\r\n";
                    else:
                        echo"插件安装失败\r\n";
                    endif;   
                endif;
            elseif($type=="template"):
                echo"整站模板工程安装中...\r\n";
                if($number!="-2"):
                    if($number=="-1"):
                        $down=EuFrameInc\EUInc::AEUh($config["EUCODE"],$config["EUFURL"],"temp_".$name);
                    elseif($number=="-3"):  
                        $down=EuFrameInc\EUInc::AEUh($config["EUCODE"],$config["EUFURL"],"temporder_".$name);
                    endif;
                    $downurl=EuFrameInc\EUInc::StrSubstr("<downurl>","</downurl>",$down);
                    $filename=basename($downurl);
                    $res=EuFrameInc\EUInc::SaveFile($downurl,APP_ROOT."/template",$filename,1);
                    if(!empty($res)):
                        EuFrameInc\EUInc::AEUh($config["EUCODE"],$config["EUFURL"],"tempdel_".str_replace(".zip","",$filename)."");
                        $zip=new \ZipArchive;
                        if($zip->open(APP_ROOT."/template/".$filename)===TRUE): 
                            $zip->extractTo(APP_ROOT."/template/");
                            $zip->close();
                            unlink(APP_ROOT."/template/".$filename);
                        else:
                           echo "template目录775权限不足\r\n";
                           exit();
                        endif;
                    else:
                        echo "安装权限不足\r\n";
                        exit();
                    endif;
                endif;
                EuFrameInc\EUInc::MoveDir(APP_ROOT."/template/".$name."/move",EUF_ROOT);
                $pconfig=APP_ROOT."/template/".$name."/EuFrame.config";
                $template=file_get_contents($pconfig);
                $id=EuFrameInc\EUInc::StrSubstr("<id>","</id>",$template);
                $type=EuFrameInc\EUInc::StrSubstr("<type>","</type>",$template);
                $lang=EuFrameInc\EUInc::StrSubstr("<lang>","</lang>",$template);
                $aEUher=EuFrameInc\EUInc::StrSubstr("<aEUher>","</aEUher>",$template);
                $title=EuFrameInc\EUInc::StrSubstr("<title>","</title>",$template);
                $ver=EuFrameInc\EUInc::StrSubstr("<ver>","</ver>",$template);
                $description=EuFrameInc\EUInc::StrSubstr("<description>","</description>",$template);
                $installsql=EuFrameInc\EUInc::StrSubstr("<installsql><![CDATA[","]]></installsql>",$template);
                if(EuFrameData\EUData::ModTable("cms_template")):
                    if(EuFrameData\EUData::QueryData("cms_template","","tid='$name'","","1")["querynum"]>0):
                        EuFrameData\EUData::UpdateData("cms_template",array("tid"=>$name,"lang"=>$lang,"title"=>$title),"tid='$name'");
                    else:
                        EuFrameData\EUData::InsertData("cms_template",array("tid"=>$name,"lang"=>$lang,"title"=>$title));
                    endif;
                endif;
                if($installsql=='0'):
                    echo"成功安装模板\r\n";
                else:
                    if(EuFrameData\EUData::RunSql($installsql)):
                        echo"成功安装模板\r\n";
                    else:
                        echo"模板安装失败\r\n";
                    endif;   
                endif;
            endif;
        else:
            echo"命令参数错误\r\n";
        endif;
    }
    /**
     * Swoole命令
     * @param array $array
     * @return string
     */
    public static function Swoole($array){
        require_once EUF_ROOT.'/'.'vendor/aEUoload.php';
        if(count($array)>2):
            $server=$array[2];
            $host=$array[3];
            $port=$array[4];
            if($server=="http"):
                $server=new \EuFrame\Swoole\Http($host,$port);
            elseif($server=="proxy"):
                $server=new \EuFrame\Swoole\Proxy($host,$port,$array[5]);
            elseif($server=="websocket"):
                $server=new \EuFrame\Swoole\Websocket($host,$port,$array[5]);
            elseif($server=="pool"):
                $server=new \EuFrame\Swoole\Pool($host,$port);
            elseif($server=="queue"):
                $server=new \EuFrame\Swoole\Queue($host,$port);
            endif;
            $server->Run();
        else:
            echo"Swoole命令错误\r\n";
            echo"该命令在安装EU-swoole依赖后生效\r\n";
        endif;
    }
    /**
     * Workerman命令
     * @param array $array
     * @return string
     */
    public static function Workerman($array){
        require_once EUF_ROOT.'/'.'vendor/aEUoload.php';
        $server=$array[2];
            if($server=="start"):
                if(in_array('-d',$array)):
                    $server=new \EuFrame\Workerman\Start($array[4]);
                else:
                    $server=new \EuFrame\Workerman\Start($array[3]);
                endif; 
            elseif($server=="restart"):
                $server=new \EuFrame\Workerman\Start($array[3]);
            elseif($server=="stop" || $server=="status" || $server=="reload"):
                $server=new \EuFrame\Workerman\Start();
            endif;
    }
    /**
     * 帮助
     * @return string
     */
    public static function Help(){
        echo"* --------------------------------------------------\r\n";  
        echo"*  |              ___   ___   ___ __ ___          |\r\n";           
        echo"*  |             /  /  /  /  /___   ___/          |\r\n";       
        echo"*  |            /  /__/  /      /  /              |\r\n";      
        echo"*  |           /___ ___ /      /__/               |\r\n";      
        echo"*  |                                              |\r\n";     
        echo"*  |         @huangdou 292951110@qq.com           |\r\n";    
        echo"* --------------------------------------------------\r\n";        
        echo"EuFrame命令列表\r\n";
        echo"1个中括号代表整1个参数，实际命令中不需要加中括号\r\n";
        echo"参考地址:http://frame.EuFrame.com/baike/function.php?do=PHP-Cli\r\n";
        echo"php EuFrame 命令帮助\r\n";
        echo"php EuFrame help 命令帮助\r\n";
        echo"php EuFrame key 验证EU令牌的合法性\r\n";
        echo"php EuFrame version 获取当前EU框架版本号\r\n";
        echo"php EuFrame print [param] [param] ... 打印参数\r\n";
        echo"php EuFrame [path/class::function] 自定义命令行\r\n";
        echo"php EuFrame module [name] 创建模块\r\n";
        echo"php EuFrame plugin [name] 创建插件\r\n";
        echo"php EuFrame install module [name] [1/2/3] 安装模块\r\n";
        echo"php EuFrame install plugin [name] [1/2/3] 安装插件\r\n";
        echo"php EuFrame install template [name] [1/2/3] 安装整站模板工程\r\n";
        echo"php EuFrame swoole [name] [host] [port] ... swoole协程命令\r\n";
        echo"php EuFrame kafka [host] [topic] kafka命令\r\n";
        echo"php EuFrame workerman [start/reload/stop/restart] [host] ... workerman命令\r\n";
    }
    /**
     * 获取当前EU版本号
     * @return int
     */
    public static function Version(){
        echo file_get_contents(EUF_ROOT."/EUVER.ini")."\r\n";
    }
}