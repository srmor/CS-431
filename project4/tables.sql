DROP TABLE IF EXISTS Flights;
DROP TABLE IF EXISTS Markets;
DROP TABLE IF EXISTS Locations;
DROP TABLE IF EXISTS Carriers;
DROP TABLE IF EXISTS CancelationCodes;
DROP TABLE IF EXISTS Airports;

CREATE TABLE Airports(
  Code int(5) PRIMARY KEY,
  City varchar(60),
  Location varchar(60),
  Name varchar(100)
) engine=InnoDB;

CREATE TABLE CancelationCodes(
  Code char(1) PRIMARY KEY,
  Description varchar(25)
) engine=InnoDB;

CREATE TABLE Carriers(
  Code varchar(4) PRIMARY KEY,
  Name varchar(100)
) engine=InnoDB;

CREATE TABLE Locations(
  Abbreviation varchar(60) PRIMARY KEY,
  Location varchar(60)
) engine=InnoDB;

CREATE TABLE Markets(
  Code int(5) PRIMARY KEY,
  City varchar(60),
  Location varchar(60)
) engine=InnoDB;

CREATE TABLE Flights(
  Month int(2),
  DayOfMonth int(2),
  DayOfWeek int(1),
  UniqueCarrier varchar(4),
  FlNum varchar(8),
  OriginAirportId int(5),
  OriginCityMarketId int(5),
  DestAirportId int(5),
  DestCityMarketId int(5),
  DepDelay decimal(5,2),
  TaxiOut decimal(5,2),
  TaxiIn decimal(5,2),
  ArrDelay decimal(5,2),
  Cancelled int(1),
  CancellationCode char(1),
  Diverted int(1),
  AirTime int(4),
  Flights int(1),
  Distance int(4),
  CarrierDelay int(4),
  WeatherDelay int(4),
  NasDelay int(4),
  SecurityDelay int(4),
  LateAircraftDelay int(4)
) engine=InnoDB;

create index OriginAirportsIndex on Flights(OriginAirportId);
create index DestAirportsIndex on Flights(DestAirportId);

load data local infile 'cs431/jan2014.csv' into table Flights columns terminated by ',' optionally enclosed by '"' ignore 1 lines;
load data local infile 'cs431/feb2014.csv' into table Flights columns terminated by ',' optionally enclosed by '"' ignore 1 lines;
load data local infile 'cs431/airports.csv' into table Airports columns terminated by ',' optionally enclosed by '"' ignore 1 lines;
load data local infile 'cs431/cancelation_codes.csv' into table CancelationCodes columns terminated by ',' optionally enclosed by '"' ignore 1 lines;
load data local infile 'cs431/carriers.csv' into table Carriers columns terminated by ',' optionally enclosed by '"' ignore 1 lines;
load data local infile 'cs431/city_markets.csv' into table Markets columns terminated by ',' optionally enclosed by '"' ignore 1 lines;
load data local infile 'cs431/locations.csv' into table Locations columns terminated by ',' optionally enclosed by '"' ignore 1 lines;
