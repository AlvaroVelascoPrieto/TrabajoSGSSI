from time import sleep
from selenium.webdriver.common.by import By
from selenium import webdriver
from selenium.webdriver.chrome.service import Service
from webdriver_manager.chrome import ChromeDriverManager
from selenium.webdriver.chrome.options import Options
from selenium.common.exceptions import NoSuchElementException

options = Options()
#options.add_argument('--headless')

class Scripter:
	def __init__(self):
		self.driver = webdriver.Chrome(service=Service(executable_path=ChromeDriverManager().install()), options=options)
		self.carLinks = {} #Dict to save all the different wikipedia pages of cars through history
		
	def getPageLinks(self, year): #Obtain all car links from a certain page
		self.baseXPaths = '/html/body/div[3]/div[3]/div[5]/div[2]/div/div/div/div['
		for i in range(1, 13):
			row = self.baseXPaths + str(i) + "]/ul/li" #iterate Wikipedia letter markers
			onlyOne = row + "/a"

			try:
				if year not in self.carLinks.keys():
					self.carLinks[year] = []
					self.carLinks[year].append(self.driver.find_element(By.XPATH, onlyOne).get_attribute("href"))
				else:
					self.carLinks[year].append(self.driver.find_element(By.XPATH, onlyOne).get_attribute("href"))
			except NoSuchElementException:
				pass

			for j in range(2,8):
				element = row + "[" + str(j) + "]/a"

				try:
					if year not in self.carLinks.keys():
						self.carLinks[year] = []
						self.carLinks[year].append(self.driver.find_element(By.XPATH, element).get_attribute("href"))
					else:
						self.carLinks[year].append(self.driver.find_element(By.XPATH, element).get_attribute("href"))

				except NoSuchElementException:
					pass

	def fillCarLinksDict(self): #Must be executed to fill carLinks list
		for i in range(1950, 1951): #2023 for till 2022
			baseLinkA = "https://en.wikipedia.org/wiki/Category:"
			baseLinkB = "_Formula_One_season_cars"

			pageLink = baseLinkA + str(i) + baseLinkB
			self.driver.get(pageLink)
			self.getPageLinks(i)

	def scrape(self):
		for key in self.carLinks.keys():
			for targetLink in self.carLinks[key]:
				self.driver.get(targetLink)
				try:
					driversThTag = self.driver.find_element(By.XPATH, "//*[contains(text(), 'Notable drivers')]")
					#Hasta aqui he llegado por ahora, basicamente tenemos un diccionario con los años y los links de todos los coches
					#y he llegado al elemento <th> de Notable drivers en la caja de wikipedia, de ahí hay que buscar pasar a los
					#pilotos en sí, que son un <a> pero anterior a ellos hay otro anchor para la bandera. Hay que buscar una manera
					#igual con Xpath para saltarse un span y pasar a los pilotos
					print(driversThTag)
				except NoSuchElementException:
					pass





S = Scripter()
S.fillCarLinksDict()
S.scrape()
		
		
		
