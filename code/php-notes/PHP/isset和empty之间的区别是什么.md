# isset和empty之间的区别是什么

```
empty: 检查一个变量是否为空
若变量为空字符串、0、0.0、'0'、NULL、FALSE、array()、没有值的变量, 则返回TRUE

isset: 检查一个变量是否存在并且不是NULL
若变量值为NULL或者变量被unset, 则返回FALSE
```

### 参考
- [https://www.php.net/manual/zh/function.isset.php](https://www.php.net/manual/zh/function.isset.php)
- [https://www.php.net/manual/zh/function.empty.php](https://www.php.net/manual/zh/function.empty.php)