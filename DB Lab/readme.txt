TwitterLab - INFO 154 Lab 3
===========================
This folder holds the files for lab 3 of INFO 154. Work was done by Gregory Woods and Stephen Weber again. This builds off of lab 2 (yay recycled code!) to save tweet search results to an SQL database. A new page was built to display the saved results, called history.php.

Required SQL setup:
Schema = info154
Table = tweets
User = infousr
Password = D1oASa1
Permissions = select, insert, update, delete (All in the Data category)
Columns (in this order):
tweet_text - varchar(150), not null
user_name - varchar(80), not null
tweet_time - varchar(80), not null
tweet_id - int(11), not null, auto increment, PRIMARY KEY

Don't steal my API keys. Or XANA will find you.