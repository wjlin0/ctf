# CTF题库

## docker-compose
- 启动关于信息收集类的题库
```bash
./script/start.sh ../src/信息收集 build
docker ps -a
```

- 关闭关于信息收集类的题库

```bash
./script/start.sh ../src/信息收集 down
docker ps -a
```

- 删除关于信息类题库

```bash
./script/start.sh ../src/信息收集 remove
docker ps -a
```