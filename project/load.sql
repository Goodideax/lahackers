LOAD DATA LOCAL INFILE 'buy.txt' INTO TABLE buy
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';

LOAD DATA LOCAL INFILE 'sell.txt' INTO TABLE sell
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';