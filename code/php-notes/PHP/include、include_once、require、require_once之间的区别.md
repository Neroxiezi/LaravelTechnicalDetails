# include、include_once、require、require_once之间的区别

```
include/include_once 在引入不存在文件时产生一个警告且脚本还会继续执行
require/require_once 在引入不存在文件时产生一个致命错误且脚本停止执行

_once的作用是先判断是否包含该文件, 如果已经包含则不再包含, 这样可以避免函数重定义和变量被覆盖的问题

和echo一样, 它们都属于语言结构而不是严格意义上的函数, 使用的时候可以加括号也可以不加括号, 比如
require '1.php';
或者
require('1.php');
```