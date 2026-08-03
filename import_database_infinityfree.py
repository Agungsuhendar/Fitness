import sys
import pymysql

def import_sql_dump(host, dbname, user, password, sql_file):
    print(f"Connecting to MySQL database {dbname} at {host}...")
    try:
        connection = pymysql.connect(
            host=host,
            user=user,
            password=password,
            database=dbname,
            port=3306,
            autocommit=True
        )
        print("Connected to MySQL database successfully!")
        
        print(f"Reading {sql_file}...")
        with open(sql_file, 'r', encoding='utf-8') as f:
            sql_script = f.read()

        statements = sql_script.split(';')
        cursor = connection.cursor()
        
        count = 0
        for statement in statements:
            stmt = statement.strip()
            if stmt:
                try:
                    cursor.execute(stmt)
                    count += 1
                except Exception as e:
                    print(f"Statement execution notice: {e}")

        print(f"Successfully executed {count} SQL statements!")
        cursor.close()
        connection.close()
        print("Database Import Complete!")
        return True
    except Exception as e:
        print(f"MySQL Import Failed: {e}")
        return False

if __name__ == "__main__":
    if len(sys.argv) >= 5:
        import_sql_dump(sys.argv[1], sys.argv[2], sys.argv[3], sys.argv[4], "database_dump.sql")
    else:
        print("Usage: python3 import_database_infinityfree.py <host> <dbname> <user> <password>")
