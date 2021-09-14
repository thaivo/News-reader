# News-reader
An API project helps users to do multi-task while they are listening to the news. Because this project uses free licenses for the two following api, it only has the ability to read out loud the article titles. 
It applies two API's: 
* GNews api: gets the list of articles, but be only able to get 10 articles for free users. Furthermore, the maximum number of requests is only 100 requests per day.
* The IBM Watson™ Text to Speech api: transform text to speech. For free users, 10000 words per month is the limitation.

# Running this project:
* Double-click to open index.php with a web browser from the root dir.

# Home page:
![image](https://user-images.githubusercontent.com/12003260/130309934-9cd288e7-1dce-4ae9-873f-fba14254f11e.png)
* For search bar:
  * keywords for searching: any keyword relates to your search.
  * Type of endpoint: is a drop-down list contain search and top-headlines.
  * Language: the drop-down list contains a list of languages.
  * Country: the drop-down list contains a list of countries.
  * From and To: the range of date for the search
  * Search button: click it to search.

* For article:
  * Link : goes to the website of the selected article.
  * Sound icon: reads out loud the title of the selected article.

