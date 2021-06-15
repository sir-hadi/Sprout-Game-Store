from selenium import webdriver
from selenium.webdriver.common.keys import Keys

driver = webdriver.Chrome(executable_path='C:\chrome-driver\chromedriver.exe')
driver.get("http://localhost/SGSWebsite/auth")

#! Testing Login dengan data salah
element = driver.find_element_by_id('email')
element.send_keys('udin@yahoo.com')
pass_element = driver.find_element_by_id('password')
pass_element.send_keys('12345678')
pass_element.send_keys(Keys.RETURN)