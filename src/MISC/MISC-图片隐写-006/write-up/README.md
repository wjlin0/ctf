### 图片隐写-006

> 二维码取反色
可以看到三个白色酷似二维码的定位符，于是去反色。

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

![img.png](img/img.png)