# 文本处理工具sed
Stream EDitor: 面向字符流的非交互式编辑器
### 语法
```
格式: sed [options] 'command' file(s)

选项:
-i: 直接修改文件内容, 而不是将结果输出到终端

动作:
s: 替换
d: 删除行
a: 新增行
```


### 常用命令
替换
```
# 格式: sed -i 's/原字符串/新字符串/' 文件名
# Example
[root@localhost /]# cat 1.txt
php
php php
extension
[root@localhost /]# sed -i 's/php/java/' 1.txt
[root@localhost /]# cat 1.txt
java
java php
extension

# 替换的内容中有单引号怎么办
# 如: external_url 'http://gitlab.example.com' 替换成 external_url 'http://gitlab.phpdev.com:8088'
# 解决方法: 最外层的单引号换成双引号, 这样里面的单引号就不需要转义了, 但是/还是需要转义
sed -i "s/external_url 'http:\/\/gitlab.example.com'/external_url 'http:\/\/gitlab.phpdev.com:8088'/" /etc/gitlab/gitlab.rb
```
全局替换
```
# 格式: sed -i 's/原字符串/新字符串/g' 文件名
# Example
[root@localhost /]# cat 1.txt
php
php php
extension
[root@localhost /]# sed -i 's/php/java/g' 1.txt
[root@localhost /]# cat 1.txt
java
java java
extension
```
删除行
```
# 格式: sed -i '/字符串/d' 文件名
# Example
[root@localhost /]# cat 1.txt
php
php php
extension
[root@localhost /]# sed -i '/php/d' 1.txt
[root@localhost /]# cat 1.txt
extension
```
新增行
```
# 格式: sed -i 'a\新增内容' 文件名
# Example
# $表示最后一行
[root@localhost /]# cat 1.txt
php
php php
extension
[root@localhost /]# sed -i '$a\\n[rdkafka]\nextension=rdkafka.so' 1.txt
[root@localhost /]# cat 1.txt
php
php php
extension

[rdkafka]
extension=rdkafka.so
```