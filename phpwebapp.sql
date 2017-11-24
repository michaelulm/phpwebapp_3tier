-- postgres CREATE TABLE
CREATE TABLE IF NOT EXISTS city (
  cityid SERIAL PRIMARY KEY,
  cityname varchar(200) NOT NULL
);

-- mysql CREATE TABLE
CREATE TABLE IF NOT EXISTS city (
     cityid MEDIUMINT NOT NULL AUTO_INCREMENT,
     cityname varchar(200) NOT NULL,
     PRIMARY KEY (id)
);