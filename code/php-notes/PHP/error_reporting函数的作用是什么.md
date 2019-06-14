# error_reporting函数的作用是什么

```
error_reporting 作用是设置错误报告级别
error_reporting ([ int $level ] ) : int

设置错误报告级别的方式有两种: 
1. 在php.ini文件中配置
2. 通过error_reporting()函数设置, 只在当前脚本生效
```
如果没有设置可选参数level, error_reporting()仅会返回当前的错误报告级别
```php
<?php

// 32767 等于 E_ALL
error_reporting();
```

level常见的值有:
```
E_ALL 所有可能出现的错误
E_ERROR 运行时致命错误, 程序停止执行
E_WARNING 非致命的警告错误, 程序不会停止执行
E_PARSE 编译时解析错误
E_NOTICE 通知类错误
```
示例:
```php
<?php

// 报告所有错误但是除了E_NOTICE级别的错误
error_reporting(E_ALL & ~E_NOTICE);

// 报告所有错误但是除了E_NOTICE级别的错误
error_reporting(E_ALL ^ E_NOTICE);

// 报告所有错误
error_reporting(E_ALL);

// 只报告E_ERROR、E_WARNING、E_NOTICE三种错误
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// 关闭所有PHP错误报告
error_reporting(0);

// 报告所有 PHP 错误
error_reporting(-1);

// 和 error_reporting(E_ALL); 一样
ini_set('error_reporting', E_ALL);
```

### 参考
- [https://php.net/manual/zh/function.error-reporting.php](https://php.net/manual/zh/function.error-reporting.php)