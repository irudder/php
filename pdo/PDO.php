<?php
/**
 * 封装的PDO类
 * 简易连接调用 直接执行sql语句
 * 
 */
 
class CPDO{
    
    protected static $_instance = null;
    protected static $db_name = '';
    protected $dsn;
    protected $dbh;
    
    public function __construct($db_host, $db_user, $db_pwd, $db_name, $db_char) {
        try {
            $this->dsn = 'mysql:host='.$db_host.';dbname='.$db_name;
            $this->dbh = new PDO($this->dsn, $db_user, $db_pwd);
            self::$db_name = $db_name;
            $this->dbh->exec('set character_set_connection='.$db_char.',character_set_results='.$db_char.',character_set_client=binary');
        } catch (PDOException $e) {
            $this->output_error($e->getMessage());
        }
    }
    
    // 禁止克隆
    private function __clone() {}
    
    // 单例模式连接
    public static function getInstance($db_host, $db_user, $db_pwd, $db_name, $db_char) {
        // 多连接
        if (self::$_instance === null || $db_name!==self::$db_name) {
        
            self::$_instance = new self($db_host, $db_user, $db_pwd, $db_name, $db_char);
        }
        return self::$_instance;
    }
    
    // 查询语句
    public function query($str_sql, $query_model='All', $debug=false){
        if($debug === true){
            $this->debug($str_sql);
        }
        $recordset = $this->dbh->query($str_sql);
        $this->get_pdo_error($str_sql);
        if ($recordset) {
            $recordset->setFetchMode(PDO::FETCH_ASSOC);
            if ($query_model=='All') {
                $result = $recordset->fetchAll();
            } else if ($query_model=='Row') {
                $result = $recordset->fetch();
            }else{
                $result = false;
            }
        }else{
            $result = null;
        }
        return $result;
    }
    
    // 执行sql语句
    public function exec_sql($str_sql, $debug=false){
        if ($debug===true) {
            $this->debug($str_sql);
        }
        $result = $this->dbh->exec($str_sql);
        $this->get_pdo_error($str_sql);
        return $result;
    }
    
    // 事务提交
    private function commit(){
        $this->dbh->commit;
    }
    
    // 事务回滚
    private function rollback(){
        $this->dbh->rollback;
    }
    
    // transaction 多条语句事务提交
    public function exec_transaction($array_sql){
        $retval = 1;
        $this->beginTransaction();
        foreach($array_sql as $str_sql){
            if($this->exec_sql($str_sql) == 0){
                $retval = 0;
            }
        }
        if($retval == 0){
            $this->rollback;
            return false;
        } else {
            $this->commit;
            return true;
        }
    }
    
    // 调试模式
    private function debug($debuginfo){
        echo "<pre>".var_dump($debuginfo)."</pre>";
        exit;
    }
    
    // 获取数据库操作错误
    private function get_pdo_error($str_sql=''){
        if($this->dbh->errorCode() != '00000'){
            $array_error = $this->dbh->errorInfo();
            $this->output_error($array_error,$str_sql);
            
        }
    }
    
    // 输入错误
    private function output_error($str_error_msg,$str_sql){
        throw new Exception('Mysql Error:'.json_encode($str_error_msg).'->thesql:'.$str_sql);
    }
    
    // 销毁数据库连接
    public function destruct(){
        $this->dbh = null;
    }
    
}