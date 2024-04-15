### 图片隐写-005

> 高度被修改，依据正确的CRC爆破出正确的长度

![img.png](img/img.png)
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