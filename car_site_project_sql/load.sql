USE rental_cars;


LOAD DATA INFILE "C:/Users/franc/OneDrive/Desktop/UR/SPRING_2023/CSC_261/Milestone3/SQL/Car.csv"
INTO TABLE car
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;


LOAD DATA INFILE "C:/Users/franc/OneDrive/Desktop/UR/SPRING_2023/CSC_261/Milestone3/SQL/customer.csv"
INTO TABLE customer
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;


LOAD DATA INFILE "C:/Users/franc/OneDrive/Desktop/UR/SPRING_2023/CSC_261/Milestone3/SQL/insurance.csv"
INTO TABLE insurance_policy
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;


LOAD DATA INFILE "C:/Users/franc/OneDrive/Desktop/UR/SPRING_2023/CSC_261/Milestone3/SQL/incident.csv"
INTO TABLE incident
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;


LOAD DATA INFILE "C:/Users/franc/OneDrive/Desktop/UR/SPRING_2023/CSC_261/Milestone3/SQL/customer_rents_car.csv"
INTO TABLE customer_rents_car
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS
(date_out, date_in, incident, license_plate, customer_id);

UPDATE car SET color = REPLACE(color, '\r', '');

UPDATE customer SET gender = REPLACE(gender, '\r', '');

UPDATE customer_rents_car SET customer_id = REPLACE(customer_id, '\r', '');

UPDATE incident SET license_plate = REPLACE(license_plate, '\r', '');

UPDATE insurance_policy SET license_plate = REPLACE(license_plate, '\r', '');