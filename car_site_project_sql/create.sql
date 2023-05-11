
-- creating our database
CREATE DATABASE IF NOT EXISTS rental_cars;

USE rental_cars;

-- creating Car
CREATE TABLE IF NOT EXISTS Car (
	license_plate varchar(7) PRIMARY KEY,
    make varchar(20),
    model varchar(20),
    year int,
    color varchar(20),
    CONSTRAINT year_chk CHECK (year BETWEEN 1970 AND 2023)
    );

-- creating Customer
CREATE TABLE IF NOT EXISTS Customer (
	customer_id varchar(6) PRIMARY KEY,
    first_name varchar(20) NOT NULL,
    last_name varchar(20) NOT NULL,
    age int NOT NULL,
    gender varchar(20),
    CONSTRAINT age_chk CHECK (age BETWEEN 18 AND 99)
    );

-- creating Insurance_policy
CREATE TABLE IF NOT EXISTS Insurance_policy (
	policy_id varchar(6) PRIMARY KEY,
    monthly_cost int NOT NULL,
    deductible int NOT NULL,
    license_plate varchar(7),
    FOREIGN KEY (license_plate) REFERENCES Car(license_plate)
		ON DELETE SET NULL
	);

-- creating Incident
CREATE TABLE IF NOT EXISTS Incident (
	incident_id varchar(6) PRIMARY KEY,
    incident_description varchar(100) NOT NULL,
    resolved boolean NOT NULL,
    cost int,
    reinstated boolean NOT NULL,
    license_plate varchar(7),
    FOREIGN KEY (license_plate) REFERENCES Car(license_plate)
		ON DELETE SET NULL
	);



-- creating Customer_rents_car
CREATE TABLE IF NOT EXISTS Customer_rents_car (
    date_out date NOT NULL,
    date_in date,
    incident boolean NOT NULL,
    license_plate varchar(7),
	customer_id varchar(6),
    FOREIGN KEY (customer_id) REFERENCES Customer(customer_id)
		ON DELETE CASCADE,
    FOREIGN KEY (license_plate) REFERENCES Car(license_plate)
		ON DELETE CASCADE,
    PRIMARY KEY (customer_id, license_plate, date_out),
    CONSTRAINT invalid_date_range CHECK (date_out < date_in)
	);


    
    
    
    
    
    