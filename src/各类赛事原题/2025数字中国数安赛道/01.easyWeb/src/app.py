import os
from flask import Flask, request, jsonify, send_from_directory
from PIL import Image
import pytesseract
import io
from flask_cors import CORS
from db import Database

# 初始化数据库
db = Database()

app = Flask(__name__)
app.config['JSON_AS_ASCII'] = False
CORS(app)


@app.route('/')
def index():
    return send_from_directory('static', 'index.html')


def image_to_text(image):
    try:
        # 图片预处理
        # 转换为灰度图
        image = image.convert('L')

        # 使用 pytesseract 进行OCR识别
        text = pytesseract.image_to_string(image, lang='eng')

        return text.strip()
    except Exception as e:
        return f'图片处理失败：{str(e)}'


@app.route('/ocr', methods=['POST'])
def ocr():
    if 'file' not in request.files:
        return jsonify({
            'success': False,
            'error': '没有上传文件'
        }), 400

    file = request.files['file']
    if file.filename == '':
        return jsonify({
            'success': False,
            'error': '文件名为空'
        }), 400

    try:
        # 直接从内存中读取图片数据
        image_data = file.read()
        image = Image.open(io.BytesIO(image_data))

        # 进行OCR识别
        result = image_to_text(image)

        if result:
            # 获取客户端IP地址
            client_ip = request.remote_addr

            # 记录到数据库
            ok, msg = db.add_record(client_ip, result)
            if not ok:
                return jsonify({
                    'success': False,
                    'error': msg
                }), 500

            response = jsonify({
                'success': True,
                'text': result
            })
            response.headers['Content-Type'] = 'application/json; charset=utf-8'
            return response
        else:
            response = jsonify({
                'success': False,
                'error': '文字识别失败'
            }), 500
            response[0].headers['Content-Type'] = 'application/json; charset=utf-8'
            return response

    except Exception as e:
        response = jsonify({
            'success': False,
            'error': str(e)
        }), 500
        response[0].headers['Content-Type'] = 'application/json; charset=utf-8'
        return response


if __name__ == '__main__':
    app.run(host='0.0.0.0', port=8000)
