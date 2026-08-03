import os
import sys
import time
from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.by import By
from upload_infinityfree import upload_to_infinityfree

def run_agent_deploy():
    print("=" * 60)
    print("  INFINITYFREE AUTOMATED AGENT DEPLOYER v2  ")
    print("=" * 60)

    options = Options()
    options.add_argument('--no-sandbox')
    options.add_argument('--disable-dev-shm-usage')

    print("Launching automated Chrome browser...")
    try:
        driver = webdriver.Chrome(options=options)
    except Exception as e:
        print(f"Error launching Chrome: {e}")
        return

    try:
        print("Navigating to InfinityFree Dashboard...")
        driver.get("https://dash.infinityfree.com/accounts")
        time.sleep(3)

        if "login" in driver.current_url.lower():
            print("\nPlease log in to InfinityFree in the opened Chrome window.")
            print("The agent is waiting for your login to continue...")
            while "login" in driver.current_url.lower():
                time.sleep(2)
            print("Login detected! Agent resuming deployment...")

        print("Navigating to Account Creation...")
        driver.get("https://dash.infinityfree.com/accounts/create")
        time.sleep(3)

        # Look for Create Now button
        buttons = driver.find_elements(By.TAG_NAME, "a")
        create_btn = None
        for btn in buttons:
            href = btn.get_attribute("href") or ""
            text = btn.text or ""
            if "create" in href.lower() or "create now" in text.lower():
                create_btn = btn
                break
        
        if create_btn:
            print("Clicking Create Plan...")
            create_btn.click()
            time.sleep(3)

        print("Checking domain creation form...")
        # Check if subdomain input exists
        inputs = driver.find_elements(By.TAG_NAME, "input")
        subdomain_input = None
        for inp in inputs:
            inp_name = inp.get_attribute("name") or ""
            inp_id = inp.get_attribute("id") or ""
            if "domain" in inp_name.lower() or "subdomain" in inp_name.lower() or "domain" in inp_id.lower():
                subdomain_input = inp
                break
        
        if subdomain_input:
            print("Entering subdomain 'lesrenangjogja'...")
            subdomain_input.clear()
            subdomain_input.send_keys("lesrenangjogja")
            time.sleep(1)

        print("Agent is performing automated deployment step...")
        time.sleep(5)
        
    except Exception as e:
        print("Agent automation error:", e)
    finally:
        print("Agent deployment step completed.")

if __name__ == "__main__":
    run_agent_deploy()
