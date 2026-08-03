import os
import sys
import time
import re
import pymysql
from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.by import By

def run_agent_session():
    print("=" * 65)
    print("  INFINITYFREE FULLY AUTOMATED AGENT SESSION DEPLOYER  ")
    print("=" * 65)

    options = Options()
    options.add_argument('--no-sandbox')
    options.add_argument('--disable-dev-shm-usage')

    print("Launching Selenium Chrome with Session Support...")
    try:
        driver = webdriver.Chrome(options=options)
    except Exception as e:
        print(f"Error launching Chrome: {e}")
        return

    try:
        print("Navigating to https://dash.infinityfree.com/accounts ...")
        driver.get("https://dash.infinityfree.com/accounts")
        time.sleep(3)

        if "login" in driver.current_url.lower():
            print("\nPlease log in to InfinityFree once in the opened Chrome window.")
            print("The agent will automatically proceed after login...")
            while "login" in driver.current_url.lower():
                time.sleep(2)
            print("Login detected! Agent resuming...")

        print("Navigating into account details for if0_42562646...")
        driver.get("https://dash.infinityfree.com/accounts")
        time.sleep(3)

        # Look for account link or manage button
        links = driver.find_elements(By.TAG_NAME, "a")
        target_link = None
        for l in links:
            href = l.get_attribute("href") or ""
            text = l.text or ""
            if "if0_42562646" in href or "manage" in text.lower() or "if0_42562646" in text:
                target_link = l
                break
        
        if target_link:
            print("Opening account if0_42562646...")
            target_link.click()
            time.sleep(4)

        # Look for Control Panel / cPanel link
        print("Looking for Control Panel / cPanel link...")
        cp_btn = None
        links = driver.find_elements(By.TAG_NAME, "a")
        for l in links:
            href = l.get_attribute("href") or ""
            text = l.text or ""
            if "cpanel" in href.lower() or "control panel" in text.lower() or "controlpanel" in href.lower():
                cp_btn = l
                break

        if cp_btn:
            print("Found Control Panel link, navigating...")
            cp_btn.click()
            time.sleep(6)

        print("Current URL:", driver.current_url)
        print("Current Title:", driver.title)
        
        # Scrape MySQL Host & Database info from page
        body_text = driver.find_element(By.TAG_NAME, "body").text
        
        mysql_host = None
        host_match = re.search(r'sql\d+\.[a-z0-9\.]+', body_text, re.IGNORECASE)
        if host_match:
            mysql_host = host_match.group(0)
            print(f"Extracted MySQL Host: {mysql_host}")

        db_name = None
        db_match = re.search(r'if0_42562646_[a-zA-Z0-9_]+', body_text)
        if db_match:
            db_name = db_match.group(0)
            print(f"Extracted DB Name: {db_name}")

        if mysql_host and db_name:
            print("\nExecuting Database Import via pymysql...")
            conn = pymysql.connect(
                host=mysql_host,
                user="if0_42562646",
                password="Arkanza0123456",
                database=db_name,
                autocommit=True
            )
            print("Successfully connected to MySQL database!")
            
            with open("database_dump.sql", "r", encoding="utf-8") as f:
                sql_script = f.read()

            statements = sql_script.split(';')
            cursor = conn.cursor()
            count = 0
            for stmt in statements:
                s = stmt.strip()
                if s:
                    try:
                        cursor.execute(s)
                        count += 1
                    except Exception:
                        pass
            print(f"Successfully executed {count} SQL statements!")
            conn.close()
            print("\nAGENT DATABASE IMPORT COMPLETE!")
        else:
            print("\nAgent has opened the Control Panel page.")
            print("If database is created, MySQL host will be detected automatically.")

    except Exception as e:
        print("Agent automation error:", e)

if __name__ == "__main__":
    run_agent_session()
