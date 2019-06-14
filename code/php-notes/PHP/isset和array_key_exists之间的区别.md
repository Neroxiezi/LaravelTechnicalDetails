# isset和array_key_exists之间的区别

```
1. isset可用于数组和变量; array_key_exists只可用于数组;
2. array_key_exists检查数组中键名是否存在;
   isset同时检查键名和键值,只有键名存在,键值不为NULL的情况才返回TRUE;
```
代码
```php
<?php

$arr = ['key1' => 'val1', 'key2' => NULL];

// bool(true) bool(false)
var_dump(isset($arr['key1']), isset($arr['key2']));
// bool(true) bool(true)
var_dump(array_key_exists('key1', $arr), array_key_exists('key2', $arr));
```