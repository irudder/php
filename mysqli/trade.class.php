<?php

class trade{
    private $icon;
    private $filename;
    private $datetime;

	function sqlinit() {
		
		$dbconfi['DB_NAME']='xx';
		$dbconfi['DB_USER']='xx';
		$dbconfi['DB_PWD']='xx';
		$dbconfi['DATABASE_NAME']='xx';

		$this->icon = new mysqli($dbconfi['DB_NAME'],$dbconfi['DB_USER'],$dbconfi['DB_PWD'],$dbconfi['DATABASE_NAME']);

		if(mysqli_connect_errno())
		{
		    echo mysqli_connect_error();
		}
		
		$this->filename='../../uploads/log/trade_sql.log';
		$this->datetime= date('Y-m-d H:i:s',time());
		$this->icon->query("set names utf8");
		return $this->icon;
	}

    /***
    **更新表
    ***/
	function update($sql){
		error_log($this->datetime.':'.$sql."\r\n", 3, $this->filename);//write_log
		return $this->icon->query($sql);
	}
    
    /**
    **返回查询一行数据
    **/
	public function query($sql){
		error_log($this->datetime.':'.$sql."\r\n", 3, $this->filename);//write_log
		$rett=$this->icon->query($sql);
		$rr=$rett->fetch_assoc();
		return $rr;
	}

	function close(){
		$this->icon->close();
	}
	
	

}

?>