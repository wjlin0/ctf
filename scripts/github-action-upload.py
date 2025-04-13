import os
import re


def run():
    # 当前脚本 文件 所在目录
    scripts_path = os.path.dirname(os.path.abspath(__file__))
    check_file = os.path.join(scripts_path, ".check")
    image_names = open(check_file, "r").read().split("\n")
    image_dict = {}
    for image in image_names:
        if image.strip() == "":
            continue
        name = image.split("|")[0]
        if len(image.split("|")) < 2:
            value = "false"
        else:
            value = image.split("|")[1]
        image_dict[name] = value
    # src 目录
    filepath = os.path.join(scripts_path, "..", "src")
    # 递归循环 src 目录
    for root, dirs, files in os.walk(filepath):
        # 判断当前目录是否拥有 Dockerfile docker-compose.yml
        if "Dockerfile" in files and "docker-compose.yml" in files:
            with open(os.path.join(root, "docker-compose.yml"), "r") as f:
                image_name = re.search(r"image: (.+)", f.read()).group(1)
                if image_name in image_dict.keys() and image_dict[image_name] == "true":
                    continue
                os.system(f"docker build --no-cache --platform linux/amd64 -t {image_name} {root}")
                image_dict[image_name] = "true"
                # push image
                os.system(f"docker push {image_name}")
                break

    # 将 image_dict 写入 .check 文件
    with open(check_file, "w") as f:
        for image, value in image_dict.items():
            f.write(f"{image}|{value}\n")


if __name__ == '__main__':
    run()
