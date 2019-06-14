# 写出PHP如何连接MySQL

## 目录

PHP连接MySQL常用的方式有三种:
1. MySQL扩展(PHP5.5.0起被弃用,不建议使用)
2. mysqli扩展
3. PDO扩展

### SQL准备
```sql
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '姓名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student
-- ----------------------------
INSERT INTO `student` VALUES ('1', '小明');
INSERT INTO `student` VALUES ('2', '小红');
```

### MySQL扩展
```php
/**
 * API说明
 *
 * mysql_query(query,connection)
 * mysql_select_db(database,connection)
 * mysql_fetch_assoc(data) 从结果集中取得一行作为关联数组
 * mysql_close(link_identifier) link_identifier => MySQL 的连接标识符 关闭非持久的MySQL连接
 */

$db_host = 'localhost:3306';
$db_user = 'root';
$db_pass = '';
$db_name = 'testdb';

$conn = mysql_connect($db_host, $db_user, $db_pass) or die('unable to connect to the MySQL');
mysql_query("SET NAMES UTF8", $conn);
$select_db = mysql_select_db($db_name, $conn) or die('cant not use db ' . $db_name);
$sql = "select * from student";

$res = mysql_query($sql, $conn) or die(mysql_error());
while ($row = mysql_fetch_assoc($res)) {
    print_r($row);
}

mysql_close($conn);
```
执行结果
```
Array
(
    [id] => 1
    [name] => 小明
)
Array
(
    [id] => 2
    [name] => 小红
)
```

### MySQLi扩展
```php
$db_host = 'localhost:3306';
$db_user = 'root';
$db_pass = '';
$db_name = 'testdb';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die(mysqli_connect_error());
mysqli_query($conn, "SET NAMES UTF8"); 
$sql = "select * from student";

$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($res)) {
    print_r($row);
}

mysqli_free_result($res);
mysqli_close($conn);
```
执行结果
```
Array
(
    [0] => 1
    [id] => 1
    [1] => 小明
    [name] => 小明
)
Array
(
    [0] => 2
    [id] => 2
    [1] => 小红
    [name] => 小红
)
```