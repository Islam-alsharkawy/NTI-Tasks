<!-- # SQL . . . 
https://www.w3schools.com/sql/default.asp
# mysql . . .
https://www.w3schools.com/mysql/default.asp
==================================================================================
# Task . . .

Build a CRUD for (pageviews Module )  contains  following data (project,article,granularity,timestamp,access,agent,views) 

** Notices 
1-Create operation (Read Data From API , Clean & validate it then  Insert Into Database)   
// API LINK 
https://wikimedia.org/api/rest_v1/metrics/pageviews/per-article/en.wikipedia/all-access/all-agents/Tiger_King/daily/20210901/20210930

2-Read operation (Read Data From Database and Display).
3-Update operation (Read Data From Database and Update).
4-Delete operation (Delete DATA FROM DB).


==================================================================================
those are supposed to be colums name
project,article,granularity,timestamp,access,agent,views

get the data from the api and validate the data and do crud


 -->
<?php
 $link = "https://wikimedia.org/api/rest_v1/metrics/pageviews/per-article/en.wikipedia/all-access/all-agents/Tiger_King/daily/20210901/20210930";
    $jsonOBJ = file_get_contents($link);
    $data = json_decode($jsonOBJ,true);
    //print_r($dat);
    echo
    $data['items'][0]['project'];