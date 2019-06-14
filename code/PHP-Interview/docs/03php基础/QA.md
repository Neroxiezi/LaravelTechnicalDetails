## PHP 基础篇

### <div id="概念理解"> 概念理解</div> 
PHP（“PHP: Hypertext Preprocessor”，超文本预处理器的字母缩写）是一种被广泛应用的开放源代码的多用途脚本语言，它可嵌入到 HTML中，尤其适合 web 开发。

特点：入门快，开发成本低，PHP是解释性的脚本语言,有很多开源框架可以使用。并且配置及部署相对简单。
### <div id="八大数据类型"> 八大数据类型</div> 
简单数据类型有四种 ：boolean(布尔),integer(整型),float or double(浮点型),string(字符型) 

复合数据类型有两种：array（数组）和 object（对象）。

特殊数据类型分为两种：resource（资源）和 null（空值）
### <div id="打印函数区别"> echo,print,print_r,var_dump区别</div> 
**echo**

输出单个或多个字符，多个使用逗号分隔，无返回值
echo "String 1", "String 2";

**print**

只可以输出单个字符，打印简单变量。可用于表达式

**print_r**

输出关于变量的易于理解的信息
支持多种数据类型，包括字符、数组、对象，格式化成易读格式

**var_dump**

输出关于变量的易于理解的信息，多个可用分号分隔
支持多种数据类型，包括字符、数组、对象，格式化成易读格式
输出格式与print_r不同，var_dump的输出包含数据类型，无返回值

**注意**

即使print可用于表达式，但这种用法，常常不利于代码可读性，与其他操作符混用容易让人误解
echo和print都是语言结构，print_r和var_dump是普通函数。echo或print使用时，不需要使用括号将变量括起来
### <div id="判空函数区别"> isset 和empty 区别</div> 
isset：检测变量是否已设置并且非 NULL

empty：判断变量是否为空，变量为 0/false 也会被认为是空；变量不存在，不会产生警告
### <div id="包含函数区别"> include ,require ,include_once ,require_once 区别</div> 
include包含文件时，当包含的文件不存在，系统会报出警告级别的错误，程序会继续往下执行。   
require包含文件时，当包含的文件不存在，系统会报一个致命级别的错误。程序将终止执行。
once区别是 PHP 会检查该文件是否已经被包含过，如果是则不会再次包含。
### <div id="array函数"> 常用的数组处理函数</div> 
array_count_values — 统计数组中所有的值

array_flip — 交换数组中的键和值

array_merge — 合并一个或多个数组

array_multisort — 对多个数组或多维数组进行排序

array_pad — 以指定长度将一个值填充进数组

array_pop — 弹出数组最后一个单元(出栈)

array_push — 将一个或多个单元压入数组的末尾(入栈)

array_rand — 从数组中随机(伪随机)取出一个或多个单元

array_keys — 返回数组中部分的或所有的键名

array_values — 返回数组中所有的值

count — 计算数组中的单元数目，或对象中的属性个数

sort — 对数组排序

array_shift 删除数组中首个元素，并返回被删除元素的值。

array_unshift 向数组头部插入新元素

implode  把数组转成字符串

explode 字符串转数组

### <div id="cookie与session"> cookie 与session</div> 
1、cookie数据存放在客户的浏览器上，session数据放在服务器上。

2、cookie并不是很安全，别人可以分析存放在本地的cookie并进行cookie欺骗，考虑到安全应当使用session。

3、session会在一定时间内保存在服务器上。当访问增多，会比较占用你服务器的性能，考虑到减轻服务器性能方面，应当使用cookie。

4、单个cookie保存的数据不能超过4K，很多浏览器都限制一个站点最多保存20个cookie。

5、可以考虑将登陆信息等重要信息存放为session，其他信息如果需要保留，可以放在cookie中。

6、session会在浏览器关闭或者一段时间内销毁而cookie将持久化的存放在客户端
### <div id="构造析构函数"> 构造函数和析构函数</div> 
构造函数：PHP 5 允行开发者在一个类中定义一个方法作为构造函数。具有构造函数的类会在每次创建新对象时先调用此方法，所以非常适合在使用对象之前做一些初始化工作。

	public function __construct(){
		/**/
	}

析构函数：PHP 5 引入了析构函数的概念，析构函数会在到某个对象的所有引用都被删除或者当对象被显式销毁时执行。

	public function __destruct(){
		/**/
	}
	
### <div id="访问修饰符"> 访问修饰符public ,private ,protected 表示什么</div> 
对属性或方法的访问控制，是通过在前面添加关键字 public（公有），protected（受保护）或 private（私有）来实现的。被定义为公有的类成员可以在任何地方被访问

|访问权限|public|protected|private|
|:----:|:----:|:----:|:----:|
|本类|允许|允许|允许|
|子类|允许|允许||
|所有|允许|||

PHP 5 新增了一个 final 关键字。如果父类中的方法被声明为 final，则子类无法覆盖该方法。如果一个类被声明为 final，则不能被继承
### <div id="类调用"> 类的静态调用和实例化调用</div> 
	class A{
    
	    public function bar(){
	        echo 'bar'.PHP_EOL;
	    }
	    public static function foo(){
	        echo 'foo'.PHP_EOL;
	    }
	}
静态调用 

	A::foo();

>注： 只能调用静态方法

实例化调用 :

	$obj = new A();
	$obj->foo();
### <div id="面向对象"> 面向对象的理解</div>
面向对象的三要素：继承、封装和多态。

1. 封装：封装就是把抽取出来的数据和对数据的操作封装在一起，数据被保护在内部，程序的其他部分只有被授权的操作（方法）才能对数据进行操作。
1. 继承：继承就是一个子类(Subclass)通过 extends 父类 把父类(BaseClass)中的public 和 protected 的属性和方法继续下来，不能继承private属性和方法。php不能多继承，可以多层继承。
1. 多态：一个类，被多个子类继承，如果这个类的某个方法，在多个子类中，表现出不同的功能，我们称这种行为为多态。(同一个类的不同子类表现出不同的形态)
