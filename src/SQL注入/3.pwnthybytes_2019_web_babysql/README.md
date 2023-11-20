# PwnThyBytes 2019 Baby sql

## 题目详情

- PwnThyBytes 2019 Baby sql is not baby anymore（题目名太长了）
- I had problems in the past with SQLi so I searched for recommendations. I know for sure that PHP addslashes is a pain and nobody can bypass this.
- Difficulty: Medium.

## 考点

- 代码审计
- SQL注入

## 启动

    docker-compose up -d
    open http://127.0.0.1:6385/

## Writeups

> https://tiaonmmn.github.io/2019/10/08/PwnThyBytes-2019-Baby-sql-is-not-baby-anymore/

## 题目说明
- Flag位于files/flag中，Docker中位于/flag。本题flag位于数据库，在index.php中有一段读/flag并写入数据库的代码。
- 部署时不需要给出源码，页面有提示。

## 版权
- 该题目复现环境尚未取得主办方及出题人相关授权，如果侵权，请联系本人删除（tiaonmmn@live.cn）



