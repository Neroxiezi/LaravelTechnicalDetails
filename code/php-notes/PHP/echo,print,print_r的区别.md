# echo,print,print_r的区别

### 区别1
```
echo/print是语言结构, print_r是函数
```
#### 如何区分语言结构和函数?
```php
<?php

$func = 'print_r';
// [1, 2]
$func([1,2]);

$func = 'print';
// PHP Fatal error:  Uncaught Error: Call to undefined function print()
// $func(1);

$func = 'echo';
// Fatal error: Uncaught Error: Call to undefined function echo()
// $func(1);
```
从上面代码可以看出, 语言结构不能作为[可变函数](https://www.php.net/manual/zh/functions.variable-functions.php)  


#### 语言结构和函数的区别
```
1. 语言结构的执行速度快于函数
2. 语言结构可以加括号也可以不加. 比如 echo 1; 或者 echo(1); 都是可以的.
```

### 区别2
```
echo和print可以打印四种标量(布尔型/字符串/整型/浮点型)
print_r可以打印四种标量和两种复合数据类型(数组和对象)
```

### 区别3
```
echo可以一次打印多个字符串, print一次只能打印一个, 但是echo打印多个字符串的时候不能加括号
```