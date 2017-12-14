-- postgres CREATE TABLE
CREATE TABLE IF NOT EXISTS city (
  cityid SERIAL PRIMARY KEY,
  cityname varchar(200) NOT NULL
);

CREATE TABLE IF NOT EXISTS country (
  countryid SERIAL PRIMARY KEY,
  countryname varchar(200) NOT NULL
);

-- add countryid
ALTER TABLE city ADD COLUMN countryid int;




-- TODO test with mysql
-- mysql CREATE TABLE
CREATE TABLE IF NOT EXISTS city (
     cityid MEDIUMINT NOT NULL AUTO_INCREMENT,
     cityname varchar(200) NOT NULL,
     PRIMARY KEY (id)
);