import mysql.connector
from datetime import datetime


class Database:
    def __init__(self, db_config=None):
        self.db_config = db_config or {
            'host': '127.0.0.1',
            'user': 'root',
            'password': 'root',
            'database': 'ctf'
        }
        self.init_db()

    def init_db(self):
        """初始化数据库，创建记录表"""
        conn = mysql.connector.connect(**self.db_config)
        cursor = conn.cursor()

        # 创建记录表
        cursor.execute('''
            CREATE TABLE IF NOT EXISTS ocr_records (
                id INT AUTO_INCREMENT PRIMARY KEY,
                ip_address VARCHAR(255) NOT NULL,
                timestamp DATETIME NOT NULL,
                recognized_text TEXT NOT NULL
            )
        ''')

        conn.commit()
        conn.close()

    def add_record(self, ip_address, recognized_text):
        """添加新的OCR识别记录"""
        try:
            conn = mysql.connector.connect(**self.db_config)
            cursor = conn.cursor()

            # 获取当前时间
            current_time = datetime.now().strftime('%Y-%m-%d %H:%M:%S')
            print('''
                INSERT INTO ocr_records (ip_address, timestamp, recognized_text)
                VALUES ('{}', '{}', '{}')
            '''.format(ip_address, current_time, recognized_text))
            # 插入记录
            cursor.execute('''
                INSERT INTO ocr_records (ip_address, timestamp, recognized_text)
                VALUES ('{}', '{}', '{}')
            '''.format(ip_address, current_time, recognized_text))

            conn.commit()
            return True, None
        except Exception as e:
            print(f'Error adding record: {str(e)}')
            return False, str(e)
        finally:
            conn.close()

    def get_records(self, limit=10):
        """获取最近的OCR识别记录"""
        try:
            conn = mysql.connector.connect(**self.db_config)
            cursor = conn.cursor()

            cursor.execute('''
                SELECT id, ip_address, timestamp, recognized_text
                FROM ocr_records
                ORDER BY timestamp DESC
                LIMIT %s
            ''', (limit,))

            records = cursor.fetchall()
            return records
        except Exception as e:
            print(f'Error getting records: {str(e)}')
            return []
        finally:
            conn.close()
