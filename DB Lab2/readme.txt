TwitterLab - INFO 154 Lab 4
===========================
This folder holds the files for lab 4 of INFO 154. Work was done by Gregory Woods and Stephen Weber again. This builds off of lab 3 (yay more recycled code!) to save tweet search results to an SQL database. livesearch.php was updated to compare search results from both user-specified keywords.

Required SQL setup:
Schema = info154
Tables = "tweets" and "tweets2"
The setup of tweets2 should be an exact copy of tweets

User = infousr
Password = D1oASa1
Permissions = select, insert, update, delete (All in the Data category)
Columns (in this order):
tweet_text - varchar(150), not null
user_name - varchar(80), not null
tweet_time - varchar(80), not null
tweet_id - int(11), not null, auto increment, PRIMARY KEY

Don't steal my API keys. Or XANA will find you.