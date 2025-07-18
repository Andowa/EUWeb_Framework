<?php
namespace library\EuFrameData;
use library\EuFrameInc;
use library\EuFramePdo;
use library\EuFrameMysql;
use library\EuFrameMssql;
use library\EuFramePgsql;
use library\EuFrameSqlite;
use library\EuFrameMongo;
use library\EuFrameRedis;
use library\EuFrameMemcache;
/**
       * --------------------------------------------------------       

       *  | AEUhor:HuangDou   Email:292951110@qq.com        |            
       *  | QQ-Group:583610949                              |           
       *  | WebSite:http://www.EuFrame.com                |            
       *  | EU Framework is suitable for Apache2 protocol.  |            
       * --------------------------------------------------------                
 */
/**
 * 统一操作数据
 */
class EUData{
    /**
     * 获取主数据库
     */
    public static function GetDb(){
        $config=EuFrameInc\EUInc::GetConfig();
        return $config["DBTYPE"];
    }
    /**
     * 连接数据库
     */
    public static function GetDatabase(){
        if(EUData::GetDb()=="pdo"){
            return EuFramePdo\EUPdo::GetPdo();
        }elseif(EUData::GetDb()=="mysql"){
            return EuFrameMysql\EUMysql::GetMysql();
        }elseif(EUData::GetDb()=="mssql"){
            return EuFrameMssql\EUMssql::GetMssql();
        }elseif(EUData::GetDb()=="pgsql"){
            return EuFramePgsql\EUPgsql::GetPgsql();
        }elseif(EUData::GetDb()=="sqlite"){
            return EuFrameSqlite\EUSqlite::GetSqlite();
        }else{
            return false;
        }
    }
    /**
     * 判断表是否存在
     * @param string $table
     * @return bool
     */
    public static function ModTable($table){
        if(EUData::GetDb()=="pdo"){
            return EuFramePdo\EUPdo::ModTable($table);
        }elseif(EUData::GetDb()=="mysql"){
            return EuFrameMysql\EUMysql::ModTable($table);
        }elseif(EUData::GetDb()=="mssql"){
            return EuFrameMssql\EUMssql::ModTable($table);
        }elseif(EUData::GetDb()=="pgsql"){
            return EuFramePgsql\EUPgsql::ModTable($table);
        }elseif(EUData::GetDb()=="sqlite"){
            return EuFrameSqlite\EUSqlite::ModTable($table);
        }else{
            return false;
        }
    }
    /**
     * 执行SQL或命令
     * @param string $sql SQL语句/命令
     * @return bool
     */
    public static function RunSql($sql){
        if(EUData::GetDb()=="pdo"){
            return EuFramePdo\EUPdo::RunSql($sql);
        }elseif(EUData::GetDb()=="mysql"){
            return EuFrameMysql\EUMysql::RunSql($sql);
        }elseif(EUData::GetDb()=="mssql"){
            return EuFrameMysql\EUMssql::RunSql($sql);
        }elseif(EUData::GetDb()=="pgsql"){
            return EuFramePgsql\EUPgsql::RunSql($sql);
        }elseif(EUData::GetDb()=="sqlite"){
            return EuFrameSqlite\EUSqlite::RunSql($sql);
        }else{
            return false;
        }
    }
    /**
     * 查询数据
     * @param string $table 被查询表名
     * @param string $field 查询字段，多个字段以‘,’分割
     * @param string $where 查询条件
     * @param string $order 排序方式，例：id desc/id asc
     * @param string|int $limit 数据显示数目，例：0,5/1
     * @param string $lang 是否开启语言识别，默认0关闭，当需要开启时，该参数填写>0的数字，自动获取全局的语言参数，也可以直接填写语言参数zh/en/ja等
     * @param string $cache 是否开启缓存，默认0关闭，需要开启时，该参数填写key名称
     * @return array 返回数组，例：array("querydata"=>array(),"curnum"=>0,"querynum"=>0)
     */
    public static function QueryData($table,$field='',$where='',$order='',$limit='',$lang='0',$cache='0'){
        if($cache==0){
            if(EUData::GetDb()=="pdo"){
                $data=EuFramePdo\EUPdo::QueryData($table,$field,$where,$order,$limit,$lang);
            }elseif(EUData::GetDb()=="mysql"){
                $data=EuFrameMysql\EUMysql::QueryData($table,$field,$where,$order,$limit,$lang);
            }elseif(EUData::GetDb()=="mssql"){
                $data=EuFrameMssql\EUMssql::QueryData($table,$field,$where,$order,$limit,$lang);
            }elseif(EUData::GetDb()=="pgsql"){
                $data=EuFramePgsql\EUPgsql::QueryData($table,$field,$where,$order,$limit,$lang);
            }elseif(EUData::GetDb()=="sqlite"){
                $data=EuFrameSqlite\EUSqlite::QueryData($table,$field,$where,$order,$limit,$lang);
            }else{
                $data=array();
            }
            return $data;
        }else{
            EUData::GetCache($table,$field,$where,$order,$limit,$lang,$cache);
        }
    }
    /**
     * 执行SQL并返回数据集
     * @param string $sql SQL语句/命令
     * @return bool
     */
    public static function JoinQuery($sql){
        if(EUData::GetDb()=="pdo"){
            return EuFramePdo\EUPdo::JoinQuery($sql);
        }elseif(EUData::GetDb()=="mysql"){
            return EuFrameMysql\EUMysql::JoinQuery($sql);
        }elseif(EUData::GetDb()=="mssql"){
            return EuFrameMysql\EUMssql::JoinQuery($sql);
        }elseif(EUData::GetDb()=="pgsql"){
            return EuFramePgsql\EUPgsql::JoinQuery($sql);
        }elseif(EUData::GetDb()=="sqlite"){
            return EuFrameSqlite\EUSqlite::JoinQuery($sql);
        }else{
            return false;
        }
    }
    /**
     * 创建数据
     * @param string $table 表名
     * @param array $data 字段及值的数组，例：array("字段1"=>"值1","字段2"=>"值2")
     * @return bool 当结果为真时返回最新添加的记录id
     */
    public static function InsertData($table,$data){
        if(EUData::GetDb()=="pdo"){
            return EuFramePdo\EUPdo::InsertData($table,$data);
        }elseif(EUData::GetDb()=="mysql"){
            return EuFrameMysql\EUMysql::InsertData($table,$data);
        }elseif(EUData::GetDb()=="mssql"){
            return EuFrameMysql\EUMssql::InsertData($table,$data);
        }elseif(EUData::GetDb()=="pgsql"){
            return EuFramePgsql\EUPgsql::InsertData($table,$data);
        }elseif(EUData::GetDb()=="sqlite"){
            return EuFrameSqlite\EUSqlite::InsertData($table,$data);
        }else{
            return false;
        }
    }
    /**
     * 更新数据
     * @param string $table 表名
     * @param array $data 字段及值的数组，例：array("字段1"=>"值1","字段2"=>"值2")
     * @param string $where 条件
     * @return bool
     */
    public static function UpdateData($table,$data,$where){
        if(EUData::GetDb()=="pdo"){
            return EuFramePdo\EUPdo::UpdateData($table,$data,$where);
        }elseif(EUData::GetDb()=="mysql"){
            return EuFrameMysql\EUMysql::UpdateData($table,$data,$where);
        }elseif(EUData::GetDb()=="mssql"){
            return EuFrameMysql\EUMssql::UpdateData($table,$data,$where);
        }elseif(EUData::GetDb()=="pgsql"){
            return EuFramePgsql\EUPgsql::UpdateData($table,$data,$where);
        }elseif(EUData::GetDb()=="sqlite"){
            return EuFrameSqlite\EUSqlite::UpdateData($table,$data,$where);
        }else{
            return false;
        }
    }
    /**
     * 删除数据
     * @param string $table 表名
     * @param string $where 条件
     * @return bool
     */
    public static function DelData($table,$where){
        if(EUData::GetDb()=="pdo"){
            return EuFramePdo\EUPdo::DelData($table,$where);
        }elseif(EUData::GetDb()=="mysql"){
            return EuFrameMysql\EUMysql::DelData($table,$where);
        }elseif(EUData::GetDb()=="mssql"){
            return EuFrameMysql\EUMssql::DelData($table,$where);
        }elseif(EUData::GetDb()=="pgsql"){
            return EuFramePgsql\EUPgsql::DelData($table,$where);
        }elseif(EUData::GetDb()=="sqlite"){
            return EuFrameSqlite\EUSqlite::DelData($table,$where);
        }else{
            return false;
        }
    }
    /**
     * 复制数据
     * @param string $table 表名
     * @param array $where 条件
	 * @param string aEUokey 自动编号字段
     * @return bool 当结果为真时返回最新添加的记录id
     */
    public static function CopyData($table,$where,$aEUokey='id'){
        if(EUData::GetDb()=="mysql"){
            return EuFrameMysql\EUMysql::CopyData($table,$where,$aEUokey);
        }else{
            return false;
        }
    }
    /**
     * 获取数据标签
     * @param string $table 表名
     * @param string $field 标签字段，只能为1个
     * @param string $where 条件
     * @param string $order 排序方式
     * @param string $lang 是否自动开启语言，默认0关闭
     * @param string $cache 是否开启redis缓存，默认0关闭，需要开启时，该参数填写key名称
     * @return array 返回数组，例：array('tags'=>$taglist)
     */
    public static function TagData($table,$field='',$where='',$order='',$lang='0'){
        if(EUData::GetDb()=="mysql"){
            return EuFrameMysql\EUMysql::TagData($table,$field,$where,$order,$lang);
        }elseif(EUData::GetDb()=="mssql"){
            return EuFrameMysql\EUMssql::TagData($table,$field,$where,$order,$lang);
        }elseif(EUData::GetDb()=="pgsql"){
            return EuFramePgsql\EUPgsql::TagData($table,$field,$where,$order,$lang);
        }elseif(EUData::GetDb()=="sqlite"){
            return EuFrameSqlite\EUSqlite::TagData($table,$field,$where,$order,$lang);
        }else{
            return array();
        }
    }
    /**
     * 获取数据首图
     * @param string $table 表名
     * @param string $field 检索字段，只能为1个
     * @param string $where 条件
     * @param string $cache 是否开启redis缓存，默认0关闭，需要开启时，该参数填写key名称
     * @return array 返回数组，在其数组中返回指定字段的第一张图片imageurl
     */
    public static function FigureData($table,$field,$where='',$limit=''){
        if(EUData::GetDb()=="mysql"){
            return EuFrameMysql\EUMysql::FigureData($table,$field,$where,$limit);
        }elseif(EUData::GetDb()=="mssql"){
            return EuFrameMysql\EUMssql::FigureData($table,$field,$where,$limit);
        }elseif(EUData::GetDb()=="pgsql"){
            return EuFramePgsql\EUPgsql::FigureData($table,$field,$where,$limit);
        }elseif(EUData::GetDb()=="sqlite"){
            return EuFrameSqlite\EUSqlite::FigureData($table,$field,$where,$limit);
        }else{
            return array();
        }
    }
    /**
     * 搜索数据
     * @param string $keyword 关键词
     * @return array 返回数组
     */
    public static function SearchData($keyword){
        if(EUData::GetDb()=="mysql"){
            return EuFrameMysql\EUMysql::SearchData($keyword);
        }else{
            return array();
        }	
    }
    /**
     * 获取及更新缓存
     * @param string $cache 键或元素
     * @param string $data 数据
     * @return array
     */
    public static function GetCache($table,$field,$where,$order,$limit,$lang,$cache){
        $config=EuFrameInc\EUInc::GetConfig();
        $dbcache=$config["DBCACHE"];
        if($dbcache=="redis"):
            if(EuFrameRedis\EURedis::ModTable($cache)):
                return EuFrameRedis\EURedis::QueryData($cache);
            else:
                $data=EUData::QueryData($table,$field,$where,$order,$limit,$lang,0);
                EuFrameRedis\EURedis::InsertData($cache,$data,1);
                return $data;
            endif;
        elseif($dbcache=="mongo"):
            if(EuFrameMongo\EUMongo::ModTable($cache)):
                return EuFrameMongo\EUMongo::QueryData($cache);
            else:
                $data=EUData::QueryData($table,$field,$where,$order,$limit,$lang,0);
                EuFrameMongo\EUMongo::InsertData($cache,$data);
                return $data;
            endif;
        elseif($dbcache=="memcache"):
            if(EuFrameMemcache\EUMemcache::ModTable($cache)):
                return EuFrameMemcache\EUMemcache::QueryData($cache);
            else:
                $data=EUData::QueryData($table,$field,$where,$order,$limit,$lang,0);
                EuFrameMemcache\EUMemcache::InsertData($cache,$data,1);
                return $data;
            endif;
        else:
            return array();
        endif;
    }
    /**
     * 获取记录数目
     * @param string $sql SQL语句
     * @return int 
     */
    public static function QueryNum($sql){
            if(EUData::GetDb()=="pdo"){
                $data=EuFramePdo\EUPdo::QueryNum($sql);
            }elseif(EUData::GetDb()=="mysql"){
                $data=EuFrameMysql\EUMysql::QueryNum($sql);
            }elseif(EUData::GetDb()=="mssql"){
                $data=EuFrameMssql\EUMssql::QueryNum($sql);
            }elseif(EUData::GetDb()=="pgsql"){
                $data=EuFramePgsql\EUPgsql::QueryNum($sql);
            }elseif(EUData::GetDb()=="sqlite"){
                $data=EuFrameSqlite\EUSqlite::QueryNum($sql);
            }else{
                $data=array();
            }
            return $data;
    }
}