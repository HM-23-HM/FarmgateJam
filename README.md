# FarmgateJam
TL;DR Data analysis web application for Jamaican Farmgate prices.

The data was received in the following tabular format once a week.

![image](https://user-images.githubusercontent.com/73763814/118463549-7b659700-b6c5-11eb-8183-ee15936fad41.png)

Every spreadsheet was a standalone, and this made performing simple data analysis cumbersome.<br/>
The alternative option was to use the frustrating online portal. [Maybe you'll have better luck.](http://reports.ja-mis.com/query_price_data_archiverpt.php)<br/>

So, for my first ever project I decided to create a web application to make visualization and analysis of the Farmgate data much simpler and intuitive.<br/><br/>
I created a script with Python to automatically extract the data from the Excel sheets and store them in a MySQL database.
I initially created a web app with Dash (Plotly), but I wanted greater control over the looks and feel of the web page so I created a web app from scratch.<br/>

Feedback ([See Twitter feedback](https://twitter.com/HMCodes/status/1379454456929079298?s=20)) shows that there's still room for improvement but I accomplished my goal of creating a better user experience. <br/>
I'm excited to see where I go from here.

