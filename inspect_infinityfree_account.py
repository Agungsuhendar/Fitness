import time
import re
from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.by import By

def inspect():
    options = Options()
    options.add_argument('--no-sandbox')
    options.add_argument('--disable-dev-shm-usage')

    print("Launching Chrome to inspect InfinityFree Account details...")
    driver = webdriver.Chrome(options=options)

    try:
        driver.get("https://dash.infinityfree.com/accounts")
        time.sleep(3)

        if "login" in driver.current_url.lower():
            print("\nPlease log in to InfinityFree in the opened Chrome window if needed...")
            while "login" in driver.current_url.lower():
                time.sleep(2)
            print("Login detected! Proceeding...")

        time.sleep(3)
        print("Current URL:", driver.current_url)

        # Look for if0_42586885 link
        links = driver.find_elements(By.TAG_NAME, "a")
        target_link = None
        for l in links:
            href = l.get_attribute("href") or ""
            text = l.text or ""
            if "if0_42586885" in href or "if0_42586885" in text or "fitlifehub" in href or "fitlifehub" in text:
                target_link = l
                break

        if target_link:
            print("Clicking into account if0_42586885...")
            target_link.click()
            time.sleep(4)

        body_text = driver.find_element(By.TAG_NAME, "body").text
        print("\n--- ACCOUNT PAGE DETAILS ---")
        lines = body_text.split('\n')
        for line in lines:
            if any(k in line.lower() for k in ['sql', 'mysql', 'database', 'host', 'username', 'password', 'if0_']):
                print(line)
        print("----------------------------\n")

    except Exception as e:
        print("Inspection notice:", e)
    finally:
        time.sleep(10)
        driver.quit()

if __name__ == "__main__":
    inspect()
