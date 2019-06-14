## PHP 杂点

*PHP中的传值与引用*

> 按值传递：函数范围内对值的任何改变在函数外部都会被忽略 

>按引用传递：函数范围内对值的任何改变在函数外部也能反映出这些修改 

> 优缺点：按值传递时，php必须复制值。特别是对于大型的字符串和对象来说，这将会是一个代价很大的操作。 按引用传递则不需要复制值，对于性能提高很有好处。


*php中empty()和isset()的区别*

```
isset 用于检测变量是否被设置，使用 isset() 测试一个被设置成 NULL 的变量，将返回 FALSE 。
empty 如果 var 是非空或非零的值，则 empty() 返回 FALSE。换句话说，""、0、"0"、NULL、FALSE、array()、var $var; 以及没有任何属性的对象都将被认为是空的，如果 var 为空，则返回 TRUE 。

如果变量为 0 ，则empty()会返回TRUE，isset()会返回TRUE；
如果变量为空字符串，则empty()会返回TRUE，isset()会返回TRUE；
如果变量未定义，则empty()会返回TRUE，isset()会返回FLASE。

注意：isset() 只能用于变量，因为传递任何其它参数都将造成解析错误。若想检测常量是否已设置，可使用 defined() 函数。 当要 判断一个变量是否已经声明的时候 可以使用 isset 函数；
当要 判断一个变量是否已经赋予数据且不为空 可以用 empty 函数；
当要 判断 一个变量 存在且不为空 先 isset 函数 再用 empty 函数；
```

*PHP垃圾回收机制*

```
php中的变量存储在变量容器zval中，zval中除了存储变量类型和值外，还有is_ref和refcount字段。refcount表示指向变量的元素个数，is_ref表示变量表示是否是引用变量。
如果refcount为0时，就回收该变量容器。
```
*数据库索引作用、类型及其区别*

```
大大减少服务器需要扫描的数据量
帮助服务器避免排序和临时表
将随机I/O变顺序/O
大大提高查询速度,降低写的速度、占用磁盘

索引就一种特殊的查询表，数据库的搜索引擎可以利用它加速对数据的检索。
普通索引:最基本的索引,没有任何约束限制。
唯一索引:与普通索引类似,但是具有唯一性约束。
主键索引:特殊的唯一索引,不允许有空值。
组合索引:将多个列组合在一起创建索引,可以覆盖多个列。
外键 全文基本不用，一般用业务逻辑实现。
外键索引:只有 InnoDB类型的表才可以使用外键索引,保证数据的一致性、完整性和实现级联操作。
全文索引: MySQLI自带的全文索引只能用于 MyISAM,并且只能对英文进行全文检索。

```

*redis 和 memache 缓存的区别*

```
总结一：

1.数据类型

Redis数据类型丰富，支持set list等类型
memcache支持简单数据类型，需要客户端自己处理复杂对象

2.持久性

redis支持数据落地持久化存储
memcache不支持数据持久存储

3.分布式存储

redis支持master-slave复制模式
memcache可以使用一致性hash做分布式

value大小不同

memcache是一个内存缓存，key的长度小于250字符，单个item存储要小于1M，不适合虚拟机使用

4.数据一致性不同

redis使用的是单线程模型，保证了数据按顺序提交。
memcache需要使用cas保证数据一致性。CAS（Check and Set）是一个确保并发一致性的机制，属于“乐观锁”范畴；原理很简单：拿版本号，操作，对比版本号，如果一致就操作，不一致就放弃任何操作

5.cpu利用

redis单线程模型只能使用一个cpu，可以开启多个redis进程

总结二：

1.Redis中，并不是所有的数据都一直存储在内存中的，这是和Memcached相比一个最大的区别。
2.Redis不仅仅支持简单的k/v类型的数据，同时还提供list，set，hash等数据结构的存储。
3.Redis支持数据的备份，即master-slave模式的数据备份。
4.Redis支持数据的持久化，可以将内存中的数据保持在磁盘中，重启的时候可以再次加载进行使用。
我个人认为最本质的不同是Redis在很多方面具备数据库的特征，或者说就是一个数据库系统，而Memcached只是简单的K/V缓存

总结三：

redis和memecache的不同在于：

1、存储方式：
memecache 把数据全部存在内存之中，断电后会挂掉，数据不能超过内存大小
redis有部份存在硬盘上，这样能保证数据的持久性。
2、数据支持类型：
redis在数据支持上要比memecache多的多。
3、使用底层模型不同：
新版本的redis直接自己构建了VM 机制 ，因为一般的系统调用系统函数的话，会浪费一定的时间去移动和请求。
4、运行环境不同：
redis目前官方只支持Linux 上去行，从而省去了对于其它系统的支持，这样的话可以更好的把精力用于本系统 环境上的优化，虽然后来微软有一个小组为其写了补丁。但是没有放到主干上

memcache只能当做缓存，cache
redis的内容是可以落地的，就是说跟MongoDB有些类似，然后redis也可以作为缓存，并且可以设置master-slave

```

*函数内部 static 和 global 关键字的作用*

```
static 是静态变量,在局部函数中存在且只初始化一次,使用过后再次使用会使用上次执行的结果; 作为计数，程序内部缓存，单例模式中都有用到。

global 关键字,引用全局变量，wordpress中大量用到，如面向过程开发。

static 静态方法,是类的成员方法,但不需要实例化类可直接使用

$GLOBAL 在函数内使用具有全局作用域的变量,如$GLOBAL['a']
```


## 连接

[memcached与Redis实现的对比](https://cloud.tencent.com/developer/article/1004377)

[海量数据处理面试题](https://blog.csdn.net/v_JULY_v/article/details/6279498)

[MySQL锁详解](https://www.cnblogs.com/luyucheng/p/6297752.html)

[redis 主从同步](https://www.cnblogs.com/zhao-blog/p/6131524.html)

[金题](https://www.jintix.com/)

[S.O.L.I.D 面向对象设计和编程](https://learnku.com/articles/4160/solid-notes-on-object-oriented-design-and-programming-oodoop)

[PHPer面试指定](https://todayqq.gitbooks.io/phper/content/)