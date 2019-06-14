### 优化MYSQL数据库的方法


1 选取最适用的字段属性,尽可能减少定义字段长度,尽量把字段设置NOT NULL,例如'省份,性别',最好设置为ENUM

2  使用连接（JOIN）来代替子查询:

```mysql
  a.删除没有任何订单客户:DELETE FROM customerinfo WHERE customerid NOT in(SELECT customerid FROM orderinfo)
  b.提取所有没有订单客户:SELECT FROM customerinfo WHERE customerid NOT in(SELECT customerid FROM orderinfo)
  c.提高b的速度优化:SELECT FROM customerinfo LEFT JOIN orderid customerinfo.customerid=orderinfo.customerid
  WHERE orderinfo.customerid IS NULL
```
3 使用联合(UNION)来代替手动创建的临时表

```mysql
   创建临时表:SELECT name FROM `nametest` UNION SELECT username FROM `nametest2`
```

4 事务处理:

```mysql
  # 保证数据完整性,例如添加和修改同时,两者成立则都执行,一者失败都失败
  mysql_query("BEGIN");
  mysql_query("INSERT INTO customerinfo (name) VALUES ('$name1')";
  mysql_query("SELECT * FROM `orderinfo` where customerid=".$id");
  mysql_query("COMMIT");
```

5 锁定表,优化事务处理:

```mysql
a.我们用一个 SELECT 语句取出初始数据，通过一些计算，用 UPDATE 语句将新值更新到表中。
    包含有 WRITE 关键字的 LOCK TABLE 语句可以保证在 UNLOCK TABLES 命令被执行之前，
    不会有其它的访问来对 inventory 进行插入、更新或者删除的操作
  mysql_query("LOCK TABLE customerinfo READ, orderinfo WRITE");
  mysql_query("SELECT customerid FROM `customerinfo` where id=".$id);
  mysql_query("UPDATE `orderinfo` SET ordertitle='$title' where customerid=".$id);
  mysql_query("UNLOCK TABLES");
```

6 使用外键,优化锁定表

```mysql
# 把customerinfo里的customerid映射到orderinfo里的customerid, 任何一条没有合法的customerid的记录不会写到orderinfo里
   CREATE TABLE customerinfo
   (
     customerid INT NOT NULL,
     PRIMARY KEY(customerid)   
   )TYPE = INNODB;
   CREATE TABLE orderinfo
   (
     orderid INT NOT NULL,
     customerid INT NOT NULL,
     PRIMARY KEY(customerid,orderid),
     FOREIGN KEY (customerid) REFERENCES customerinfo
     (customerid) ON DELETE CASCADE    
   )TYPE = INNODB;

  # 注意:'ON DELETE CASCADE',该参数保证当customerinfo表中的一条记录删除的话同时也会删除order 表中的该用户的所有记录,注意使用外键要定义事务安全类型为INNODB;
```
7 建立索引:

```mysql
    a.格式:
      (普通索引)->
      创建:CREATE INDEX <索引名> ON tablename (索引字段)
      修改:ALTER TABLE tablename ADD INDEX [索引名] (索引字段)
      创表指定索引:CREATE TABLE tablename([...],INDEX[索引名](索引字段))  
      (唯一索引)->
      创建:CREATE UNIQUE <索引名> ON tablename (索引字段)
      修改:ALTER TABLE tablename ADD UNIQUE [索引名] (索引字段)
      创表指定索引:CREATE TABLE tablename([...],UNIQUE[索引名](索引字段))  
      (主键)->
      它是唯一索引,一般在创建表是建立,格式为:
      CREATA TABLE tablename ([...],PRIMARY KEY[索引字段])

```

8 优化查询语句

```mysql
a.最好在相同字段进行比较操作,在建立好的索引字段上尽量减少函数操作
  例子1:
   SELECT * FROM order WHERE YEAR(orderDate)<2008;(慢)
   SELECT * FROM order WHERE orderDate<"2008-01-01";(快)
   例子2:
   SELECT * FROM order WHERE addtime/7<24;(慢)
   SELECT * FROM order WHERE addtime<24*7;(快)
   例子3:
   SELECT * FROM order WHERE title like "%good%";
   SELECT * FROM order WHERE title>="good" and name<"good";
```