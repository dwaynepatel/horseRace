Compare Horse racing races using:
Betfair API calls .
PHP scraping.
PHP simple scraping library. 
Angular js. 
User login.

 allowing any number of calculations be done across a number of bookies.

Files:
Index.php:
	Prompt user to enter username and password
	Default is : xxxxxxxxxxxxxxxxxxx   xxxxxxxxxxxxxxxxx
Select.php:
	Select bookies from angular checkboxes and choose your race from today's races UK & Irl
GetRace.php:
Uses the info from select.php i.e. venue and race time to scrape data by calling the oddssCheckerClass
Logs into the betfair API and queries the race (use your own API credentials)
Display desired results.

oddsChecker.Class.php:


