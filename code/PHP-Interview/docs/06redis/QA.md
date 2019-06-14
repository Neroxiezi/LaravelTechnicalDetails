## Redis 篇
### <div id="Redis"> Redis</div>
Redis本质上是一个Key-Value类型的内存数据库，很像memcached，整个数据库统统加载在内存当中进行操作，定期通过异步操作把数据库数据flush到硬盘上进行保存。

使用Redis有哪些好处？

(1) 速度快，因为数据存在内存中，类似于HashMap，HashMap的优势就是查找和操作的时间复杂度都是O(1)

(2) 支持丰富数据类型，支持string，list，set，sorted set，hash

(3) 支持事务，操作都是原子性，所谓的原子性就是对数据的更改要么全部执行，要么全部不执行

(4) 丰富的特性：可用于缓存，消息，按key设置过期时间，过期后将会自动删除

因为是纯内存操作，Redis的性能非常出色，每秒可以处理超过 10万次读写操作，是已知性能最快的Key-Value DB。

Redis的出色之处不仅仅是性能，Redis最大的魅力是支持保存多种数据结构，此外单个value的最大限制是1GB，不像 memcached只能保存1MB的数据，因此Redis可以用来实现很多有用的功能。

比方说用他的List来做FIFO双向链表，实现一个轻量级的高性 能消息队列服务，用他的Set可以做高性能的tag系统等等。

另外Redis也可以对存入的Key-Value设置expire时间，因此也可以被当作一 个功能加强版的memcached来用。 Redis的主要缺点是数据库容量受到物理内存的限制，不能用作海量数据的高性能读写，因此Redis适合的场景主要局限在较小数据量的高性能操作和运算上。
### <div id="redis命令">支持的数据结构及命令</div>
redis的key名要区分大小写，在redis中除了 和空格外，其他的字符都可以做为key名，且长度不做限制，不过为了性能考虑，一般key名不要设置的太长。

#### 一：redis命令

1.【 set key value 】 存入一个key和值。如：set myname reson

2.【 get key 】 读取一个key的值。

3.【 del key 】 删除一个key。

4.【 del key1 key2 ... keyN 】 删除多个key。如：del myname1 myname2

5.【 exists key 】 判断一个key是否存在。

6.【 type key 】 查看key的类型。

7.【 rename key keyNew 】 重命名key名。如：rename myname myname2

8.【 dbsize 】 查看当前库中的key的条数。

9.【 expire key time 】 指定key的过期时间，单位为秒。如：expire myname 9（设置9秒后过期）

10.【 ttl key 】 查看redis有多长时间过期，单位为秒。

11.【 keys * 】 列出当前库中所有的key名。

12.【 keys a* 】 列出当前库中所有以字符串“a"开头的key。

13.【 select db-index 】 选择一个数据库，如选择第一个数据库：select 0；选择第二个 select 1；默认有16个数据库，这个值可以在redis.conf中配置。

14.【 flushdb 】 清掉当前库中所有的key（生产环境下需谨慎操作）。

15.【 flushall 】 清掉所有库中全部的key（生产环境下需谨慎操作）。

16.【 mset key1 value1 key2 value2 ... keyN valueN 】 一次性存入多个key和值。

17.【 mget key1 key2 ... keyN 】 一次性读取多个key。

18.【 incr key 】 可以对key类型+1的操作（相当于编程语言里面的++），只能操作number型，操作字符串会报错。可对新值进行操作。

19.【 decr key 】 可以对key类型-1的操作（相当于编程语言里面的--），只能操作number型，操作字符串会报错。

20.【 incrby key num 】 同incr，对key的值加num，比如 incrby aa 10，对aa+10。

21.【 decrby key num 】 同上，对key的值减num。

22.【 append key value 】 对指定key的字符串进行追加，如果key为整形，会被转为字符串。如aa的值为9，执行append aa 10后，会变成910。

23.【 substr key start end 】 对key进行截取start到end个字符。如aa的值为：abcdef，执行substr aa 2 3后，返回“cd”。

#### 二：redis链表类型（list）命令

24.【 lpush key value 】 往队列头部插入一个元素

25.【 rpush key value 】 从尾部插入一个元素

26.【 lpop key 】 从队列头部删掉一个元素

27.【 rpop key 】 从队列尾部删掉一个元素，并返回被删除元素的值

28.【 llen 】 返回队列的长度，即里面有多少个元素。不存在key返回0，不为队列类型的key会返回报错。

29.【 lrange key start end 】 返回队列从start到end之间的元素信息。

30.【 ltrim key start end 】 截取一个队列，只保留指定区间内的元素。

#### 三：redis无序集合set类型命令

31.【 sadd key vaule 】 往集合中插入一个元素，如果value值已存在集合中，则返回0，不会被重复插入。

32.【 sinter key1 key2 ... keyN 】 取出n个key之间的交集。比如 key1里面有值a,b,c,d,e，key2里面有d,e,f，sinter key1 key2返回d，e。

33.【 sunion key1 key2 ... keyN 】 取出n个key之间的并集。比如 key1里面有值a,b,c,d,e，key2里面有d,e,f，sunion key1 key2返回a,b,c,d,e,f。

34.【 sdiff key1 key2 】 取出n个key之间的差集。比如 key1里面有值a,b,c,d,e，key2里面有d,e,f，sdiff key1 key2返回a,b,c；反过来sdiff key2 key1返回f。

35.【 smembers key 】 返回key集合中所有的元素，结果是无序的。

36.【 sismember key value 】 查看value这个值是否在key集合中。存在返回1，不存在返回0。

37.【 scard key 】 返回集合中有多少个元素。

38.【 smove key1 key2 value 】 把value从key1中移到key2中去。

39.【 srem key value1 value2 ... valueN 】 从key集合中删掉某些元素。

#### 四：redis有序集合sorted set命令

40.【 zadd key v k 】 往key中添加一个元素，k为键，v为值。如：zadd artHits 99 12表示id为12的文章点击量为99次。

41.【 zrange key start end 】 根据v的值由小到大进行排序来获得start到end之间的元素。

注：0表示第一个元素，-1表示最后一个元素，-2表示倒数第二个元素，以此类推，如果要获取第一个到倒数第三个之间的元素，命令为：zrange key 0 -3。

42.【 zrevrange key start end 】 同上，根据v的值由大到小进行排序来获得start到end之间的元素。可以轻松取出点击量最高的前n篇文章。

43.【 zremrangebyrank key start end 】 删除集合中的元素。排序的方式为按照v由小到大的顺序，如果要删除key集合中的第一个值，则运行 zremrangebyrank artHits 0 0；删除前3个值：zremrangebyrank artHits 0 2。

44.【 zcard 】 返回key集合中元素的个数。

45.【 zrank key k 】 返回值k在集合key中排第几位，是按照v由小到大的顺序。排第一名返回0，第二返回1，以此类推。

46.【 zrevrank key k 】 同上，不同的是，按照v由大到小的顺序。可以轻松取出点击量最高的文章。

47.【 zscore key k 】 取出集合key中键为k对应的值v。

48.【 zrem key k 】 删除集合中指定元素。

49.【 zincrby key num k 】 给集合key中的元素k加上num，值针对整型。比如 zincrby artHits 3 12，给id为12的文章加上3个点击量。此时zscore artHits 12的结果是99+3为102。

#### 五：redis哈希hash类型命令

50.【 hset key field value 】 设置hash field为指定值，如果key不存在，则先创建。

51.【 hmset key field1 value1 ... fieldN valueN 】 同时设置多个值。

52.【 hget key field 】 获取指定的hash field

53.【 hmget key field1 field1 ... fieldN 】 获取指定的多个hash field

54.【 hincrby key field num 】 将指定的hash field加上指定的值。

55.【 hexists key field 】 查看指定field是否存在。

56.【 hdel key field 】 删除指定的hash field。

57.【 hlen key 】 返回指定hash中field的数量。

58.【 hkeys key 】 返回hash所有的field。

59.【 hvals 】 返回hash中所有的value。

60.【 hgetall key 】 返回hash中所有的field和value。
### <div id="发布订阅">发布订阅</div>
### <div id="持久化策略"> 持久化策略</div>
---
**RDB持久化**

RDB持久化是将当前进程中的数据生成快照保存到硬盘(因此也称作快照持久化)，保存的文件后缀是rdb；当Redis重新启动时，可以读取快照文件恢复数据。

那么RDB持久化的过程，相当于在执行bgsave命令。

**AOF持久化**

RDB持久化是将进程数据写入文件，而AOF持久化(即Append Only File持久化)，则是将Redis执行的每次写命令记录到单独的日志文件中。

随着时间的流逝，你会发现这个AOF文件越来越大，于是redis有一套rewrite机制，来缩小AOF文件的体积。
### <div id="Redis事物"> Redis事物</div>
事务是一个单独的隔离操作：事务中的所有命令都会序列化、按顺序地执行。事务在执行的过程中，不会被其他客户端发送来的命令请求所打断。

事务是一个原子操作：事务中的命令要么全部被执行，要么全部都不执行。
### <div id="单线程如何应对并发请求"> 单线程如何应对并发请求</div>
采用非阻塞多路 I/O 复用技术可以让单个线程高效的处理多个连接请求（尽量减少网络IO的时间消耗）
1）为什么不采用多进程或多线程处理？

多线程处理可能涉及到锁 
多线程处理会涉及到线程切换而消耗CPU

2）单线程处理的缺点？

无法发挥多核CPU性能，不过可以通过在单机开多个Redis实例来完善
### <div id="内存淘汰机制"> Redis 过期策略及内存淘汰机制</div>
noeviction:返回错误当内存限制达到并且客户端尝试执行会让更多内存被使用的命令（大部分的写入指令，但DEL和几个例外）

allkeys-lru: 尝试回收最少使用的键（LRU），使得新添加的数据有空间存放。

volatile-lru: 尝试回收最少使用的键（LRU），但仅限于在过期集合的键,使得新添加的数据有空间存放。

allkeys-random: 回收随机的键使得新添加的数据有空间存放。

volatile-random: 回收随机的键使得新添加的数据有空间存放，但仅限于在过期集合的键。

volatile-ttl: 回收在过期集合的键，并且优先回收存活时间（TTL）较短的键,使得新添加的数据有空间存放。