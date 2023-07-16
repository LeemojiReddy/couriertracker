import time
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
import pytest
import random

random_number = str(random.randint(0, 500))

@pytest.fixture
def driver():
    # Create a new Chrome browser instance
    driver = webdriver.Chrome()
    yield driver
    # Close the browser after the test is finished
    driver.quit()

def test_login(driver):
    # Navigate to the login page
    driver.get("https://couriertracker.000webhostapp.com/CourierPartner/index.php")
    time.sleep(3)
    signup=driver.find_element(By.ID,"signup-btn")
    signup.click()
    time.sleep(3)
    signup_username = driver.find_element(By.ID, "signup-email")
    signup_password = driver.find_element(By.ID, "signup-password")
    signup_name     = driver.find_element(By.ID, "signup-name")

    signup_username.send_keys("leemoji"+random_number+".reddy@gmail.com")
    time.sleep(1)
    signup_password.send_keys("leemoji")
    time.sleep(1)
    signup_name.send_keys("Leemoji")
    time.sleep(1)
    register = driver.find_element(By.ID, "signup-submit")
    register.click()
    time.sleep(3)
    # Find the username and password input fields and enter the credentials
    username_input = driver.find_element(By.ID, "login-username")
    password_input = driver.find_element(By.ID, "loginpass")
    username_input.send_keys("leemoji"+random_number+".reddy@gmail.com")
    time.sleep(1)
    password_input.send_keys("leemoji")

    # Submit the login form
    login_button = driver.find_element(By.ID, "loginbutton")
    login_button.click()

    # Wait for the page to load after login
    time.sleep(3)

    # Verify if login was successful by checking for a welcome message or a specific element on the logged-in page
    assert "Dashboard" in driver.title, "Login failed or not redirected to the dashboard."
    awb_input = driver.find_element(By.ID, "awbNumber")
    awb_input.send_keys("141123221084922") 
    track_button = driver.find_element(By.ID, "track-btn")
    track_button.click()
    time.sleep(8)

    tracking_result = driver.find_element(By.ID, "trackingResult")
    assert "No tracking information found" not in tracking_result.text, "Tracking failed."
    print("Dashboard testing successful!")
    logout_btn = driver.find_element(By.ID, "logout")
    logout_btn.click()
    time.sleep(3)
    assert "Homepage" in driver.title,"failed"
    print("success")