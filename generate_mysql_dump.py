import sqlite3

def generate_dump():
    conn = sqlite3.connect("database/database.sqlite")
    c = conn.cursor()

    c.execute("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%';")
    tables = [row[0] for row in c.fetchall()]
    print("Tables found:", tables)

    schema_sql = """-- Complete MySQL Schema and Data Dump for InfinityFree
SET FOREIGN_KEY_CHECKS=0;

"""

    for t in tables:
        c.execute(f"PRAGMA table_info('{t}');")
        cols = c.fetchall()
        
        col_defs = []
        pk_col = None
        
        for col in cols:
            col_id, col_name, col_type, notnull, default_val, pk = col
            m_type = "VARCHAR(255)"
            t_upper = col_type.upper()
            
            if "INT" in t_upper:
                m_type = "INT"
                if pk:
                    m_type = "INT AUTO_INCREMENT"
                    pk_col = col_name
            elif "TEXT" in t_upper:
                m_type = "LONGTEXT"
            elif "VARCHAR" in t_upper or "STRING" in t_upper:
                m_type = "VARCHAR(255)"
            elif "DATETIME" in t_upper or "TIMESTAMP" in t_upper:
                m_type = "DATETIME"
            elif "DOUBLE" in t_upper or "FLOAT" in t_upper or "NUMERIC" in t_upper:
                m_type = "DOUBLE"
                
            null_str = "NOT NULL" if notnull or pk else "NULL"
            col_defs.append(f"`{col_name}` {m_type} {null_str}")
        
        if pk_col:
            col_defs.append(f"PRIMARY KEY (`{pk_col}`)")
            
        create_stmt = f"DROP TABLE IF EXISTS `{t}`;\nCREATE TABLE `{t}` (\n  " + ",\n  ".join(col_defs) + "\n) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;\n\n"
        schema_sql += create_stmt
        
        c.execute(f"SELECT * FROM `{t}`;")
        rows = c.fetchall()
        col_names = [f"`{col[1]}`" for col in cols]
        col_names_str = ", ".join(col_names)
        
        for row in rows:
            vals = []
            for v in row:
                if v is None:
                    vals.append("NULL")
                elif isinstance(v, (int, float)):
                    vals.append(str(v))
                else:
                    s_val = str(v).replace("'", "''").replace("\\", "\\\\")
                    vals.append(f"'{s_val}'")
            vals_str = ", ".join(vals)
            schema_sql += f"INSERT INTO `{t}` ({col_names_str}) VALUES ({vals_str});\n"
        
        schema_sql += "\n"

    schema_sql += "SET FOREIGN_KEY_CHECKS=1;\n"

    with open("database_dump.sql", "w", encoding="utf-8") as f:
        f.write(schema_sql)

    print("Generated COMPLETE CREATE TABLE + INSERT database_dump.sql (Length:", len(schema_sql), "bytes)")

if __name__ == "__main__":
    generate_dump()
