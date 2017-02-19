# Description
This is codes for DimHub's website. Using Djikstra's Algorithm for route pathfinding. Written in HTML, PHP, and CSS. (No JS)

# Setup
1) Setup your database to be similar like this <br />
id | origin | destination | dist | eor*

2) Fill your database with routes ability. <br />
Example :
1) ID: 1, Origin: Los Angeles, Destination: Washington DC, Dist: 20

3) Set your database connection. <br />
Since we are using mysqli for the connection, you'll need a $connect variable.
The value of $connect variable is :
$connect = new mysqli($hostname, $username, $password, $db_name);

Then you're good to go.

#Notes
- This code already consist of $row['origin'] for fetching data from database, you may need to modify this code for your usage. <br />

- 1) ID is the PRIMARY code, 2) Origin and Destination will be your route ability, 3) Dist is the distance between 2 nodes (cities), 4) Eor will be the end-of-route mark (optional)

--Tier 9 / Proclub--
