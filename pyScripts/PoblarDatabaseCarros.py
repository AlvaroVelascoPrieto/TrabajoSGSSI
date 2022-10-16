from time import sleep
from selenium.webdriver.common.by import By
from selenium import webdriver
from selenium.webdriver.chrome.service import Service
from webdriver_manager.chrome import ChromeDriverManager
from selenium.webdriver.chrome.options import Options
from selenium.common.exceptions import NoSuchElementException
import requests
from bs4 import BeautifulSoup
import re
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC

options = Options()
#options.add_argument('--headless')

#headers for BeautifulSoup
headers={"User-Agent":"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.193 Safari/537.36"}

class Scripter:
	def __init__(self):
		self.driver = webdriver.Chrome(service=Service(executable_path=ChromeDriverManager().install()), options=options)
		self.carLinks = {} #Dict to save all the different wikipedia pages of cars through history
		
	def getPageLinks(self, year): #Obtain all car links from a certain page

		baseXPaths = '/html/body/div[3]/div[3]/div[5]/div[2]/div/div/div/div['
		for i in range(1, 27):
			row = baseXPaths + str(i) + "]/ul/li" #iterate Wikipedia letter markers
			onlyOne = row + "/a"


			try:
				if year not in self.carLinks.keys():
					self.carLinks[year] = []
					self.carLinks[year].append(self.driver.find_element(By.XPATH, onlyOne).get_attribute("href"))
				else:
					self.carLinks[year].append(self.driver.find_element(By.XPATH, onlyOne).get_attribute("href"))
			except NoSuchElementException:
				pass

			for j in range(2,10):
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
		for i in range(1950, 2023): #2023 for till 2022
			baseLinkA = "https://en.wikipedia.org/wiki/Category:"
			baseLinkB = "_Formula_One_season_cars"

			pageLink = baseLinkA + str(i) + baseLinkB
			self.driver.get(pageLink)
			self.getPageLinks(i)

	def prueba(self):
		self.driver.get("https://en.wikipedia.org/wiki/Red_Bull_Racing_RB16")
		self.driver.find_element(By.CLASS_NAME, "infobox-image").click()
		sleep(1.5)
		self.driver.find_element(By.XPATH, "/html/body/div[6]/div/div[2]/div/div[1]/img").click()
		fotoLink = self.driver.current_url
		print(fotoLink)
	def scrape(self):
		for year in self.carLinks.keys():
			for targetLink in self.carLinks[year]:
				page = requests.get(targetLink)
				soup = BeautifulSoup(page.content, "html.parser")
				print(f"Scraping: [{targetLink}]")


				try:  # Conseguir piloto
					notableDriversTH = soup.find(text='Notable drivers').findNext('td').text
					driversPreList = notableDriversTH.split(' ')
					for i in range(0, len(driversPreList) - 1):
						aux = driversPreList[i]
						aux2 = re.sub(r'\d+', '', aux)
						driversPreList[i] = aux2
					piloto = ''
					try:
						for i in range(len(driversPreList)):
							if driversPreList[i] != '' and len(piloto.split(' ')) < 2 and len(driversPreList[i]) > 4:
								piloto = driversPreList[i] + ' ' + driversPreList[i + 1]
					except IndexError:
						pass
				except AttributeError:
					pass

				try:  # Conseguir modelo
					modelo = soup.find('span', {'class': 'mw-page-title-main'}).text
				except NoSuchElementException:
					pass

				try:  # Conseguir poles y victorias
					wins = soup.find(text='Wins').findNext('td').findNext('td')
					poles = wins.findNext('td')

					victorias = wins.text
					poles = poles.text
				except AttributeError:
					pass

				try:  # Conseguir foto
					self.driver.get(targetLink)
					self.driver.find_element(By.CLASS_NAME, "infobox-image").click()
					sleep(1)
					self.driver.find_element(By.XPATH, "/html/body/div[6]/div/div[2]/div/div[1]/img").click()
					fotoLink = self.driver.current_url
					print(f"Link de la foto [{fotoLink}]")

				except AttributeError:
					pass
				except NoSuchElementException:
					pass

				try:
					carro = {'year': year,
							 'model': modelo,
							 'piloto': piloto,
							 'wins': int(victorias),
							 'poles': int(poles),
							 'foto': fotoLink}
					self.toSQL(carro)
				except ValueError:
					pass




	def scrapeOnlyOne(self, pageLink):
		page = requests.get(pageLink)
		soup = BeautifulSoup(page.content, "html.parser")

		try: #Conseguir piloto
			notableDriversTH = soup.find(text='Notable drivers').findNext('td').text
			driversPreList = notableDriversTH.split(' ')
			for i in range(0, len(driversPreList)-1):
				aux = driversPreList[i]
				aux2 = re.sub(r'\d+', '', aux)
				driversPreList[i] = aux2
			piloto = ''

			for i in range(len(driversPreList)):
				if driversPreList[i] != '' and len(piloto.split(' ')) < 2 and len(driversPreList[i]) > 4:
					piloto = driversPreList[i] + ' ' + driversPreList[i + 1]
		except NoSuchElementException:
			pass

		try: #Conseguir modelo
			modelo = soup.find('span', {'class' : 'mw-page-title-main'}).text
		except NoSuchElementException:
			pass

		try: #Conseguir poles y victorias
			wins = soup.find(text='Wins').findNext('td').findNext('td')
			poles = wins.findNext('td')

			victorias = wins.text
			poles = poles.text
		except NoSuchElementException:
			pass

		try: #Conseguir foto
			fotoLink = soup.find('td', {'class': 'infobox-image'}).findNext('img').get('src')
			fotoLink = 'https:' + fotoLink

		except NoSuchElementException:
			pass

		print(modelo)
		print(piloto)
		print(victorias)
		print(poles)
		print(fotoLink)

	def toSQL(self, carro):
		#('Ferrari F2004',15,12,'Michael Schumacher',2004, 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6c/Ferrari_f2004.jpg/2560px-Ferrari_f2004.jpg')
		f = open('queries.txt', 'a')
		query = "('" + carro["model"] + '\',' + str(carro["wins"]) + ',' + str(carro["poles"]) + ',\'' + carro["piloto"] + '\',' + str(carro["year"]) + ',\'' + carro["foto"] + "'),"
		f.write(query)
		f.close



S = Scripter()
S.fillCarLinksDict()
S.scrape()

		
		
		
