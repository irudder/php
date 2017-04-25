#YAFPHP

###Yaf在php.ini中的配置

	[yaf]
	yaf.environ=widuu
	yaf.use_namespace=1


## Contributing

1. 登录 <https://coding.net>
2. Fork <https://coding.net/widuu/YAFPHP.git>
3. 创建您的特性分支 (`git checkout -b my-new-feature`)
4. 提交您的改动 (`git commit -am 'Added some feature'`)
5. 将您的改动记录提交到远程 git 仓库 (`git push origin my-new-feature`)
6. 然后到 coding 网站的该 git 远程仓库的 `my-new-feature` 分支下发起 Pull Request


##Library

	Register.php 	注册服务
	Model.php	 	模型服务
	Driver.php		数据库抽象驱动
	Database.php	单态模式的数据库实例化方法
	Db\Pdo.php		PDO驱动
	Db\Mysql.php	Mysql驱动		