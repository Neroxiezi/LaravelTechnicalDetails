# 描述一下常见的关于读取文件内容的PHP函数

```
fopen()
file_get_contents()
file()

fopen()作用是打开一个文件, 返回的是文件指针, 它不能直接输出文件内容, 要配合fget()一类的函数来从文件指针中读取文件内容
文件使用完之后需要通过fclose()函数来关闭该指针指向的文件

file_get_contents()是将整个文件的内容读取到一个字符串中

file()函数和file_get_contents()函数类似, 不同的是file()函数读取文件内容并返回一个数组
该数组每个单元都是文件中相应的一行, 包括换行符在内
```

准备一个文件content.txt, 文件内容为:
```
hello

world!
```

### fopen
```php
<?php

$file = 'content.txt';

// file_exists(path) 函数检查文件或目录是否存在, 存在则返回TRUE, 否则返回FALSE
if (file_exists($file)) {
    // 只读方式打开,文件指针指向文件头
    $fp = fopen($file, 'r');
    // feof() 函数检测是否已到达文件末尾
    while (!feof($fp)) {
        // fgets() 函数从文件指针中读取一行
        $text = fgets($fp);
        echo $text;
    }

    // fclose() 函数关闭一个打开文件
    fclose($fp);
} else {
    echo 'file not exist';
}
```
执行结果:
```
hello

world!
```
### file_get_contents
```php
<?php

$file = 'content.txt';

if (file_exists($file)) {
    $text = file_get_contents($file);
    echo $text;
} else {
    echo 'file not exist';
}
```
执行结果:
```
hello

world!
```
### file
```php
<?php

$file = 'content.txt';

if (file_exists($file)) {
    $arr = file($file);
    print_r($arr);
} else {
    echo 'file not exist';
}
```
执行结果:
```
Array
(
    [0] => hello
    [1] => 
    [2] => world!
)
```