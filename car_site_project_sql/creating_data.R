library(stringi)

#Car data generation
#license plate
license_plate <- stri_rand_strings(150, 7, pattern = "[A-Z0-9]")
write.csv(license_plate, file="license.csv")

#make
manufacturers <- c("Jeep", "Honda", "Nissan", "Toyota", "Dodge", "Audi", "BMW", "Mercedes", "Hyundai", "GMC", "Chevrolet", 
                 "Volkswagen", "Fiat", "Ford", "Ram", "Chrysler", "Mitsubishi", "Mini", "Buick", "Tesla", "Alfa Romeo", 
                 "Acura", "Cadillac", "Infiniti", "Kia", "Jaguar", "Land Rover", "Lexus", "Lincoln", "Mazda", "Subaru", "Volvo")
make <- sample(manufacturers, 150, replace=TRUE)
write.csv(make, file="make.csv")

#year
year <- floor(runif(150, min=2004, max=2023))
write.csv(year, file="year.csv")

#color
colors <- c("Black", "Grey", "Blue", "Yellow", "Red", "Orange", "Brown", "White", "Silver" , "Green")
car_color <- sample(colors, 150, replace=TRUE)
write.csv(car_color, file="color.csv")

#customer data generation
#customer_id
customer_id <- stri_rand_strings(150, 6, pattern="[0-9]")
write.csv(customer_id, file="customer_id.csv")

#first_name
names <- c("Maria", "Robert", "Daniel", "Anna", "Carlos", "James", "Antonio", "Joseph", "Elena", "Peter", "Paul", "Bob",
           "Bill", "Pedro", "Thomas", "Patricia", "Sara", "Sarah", "Manuel", "Sandra", "Martha", "Andrea", "Christine",
           "Laura", "Linda", "George", "Robert", "Susan", "Albert", "Eric", "Claudia")
first_name <- sample(names, 150, replace=TRUE)
write.csv(first_name, file="first_name.csv")

#last_name
lastnames <- c("Smith", "Johnson", "Williams", "Brown", "Jones", "Garcia", "Miller", "Davis", "Rodriguez", "Martinez", "Hernandez",
               "Lopez", "Gonzalez", "Wilson", "Anderson", "Thomas", "Taylor", "Mooree", "Jackson", "Martin", "Lee",
               "Perez", "Thompson", "White", "Harris", "Sanchez", "Clark", "Lewis", "Robinson", "Walker", "Young", "Allen",
               "King", "Wright", "Scott", "Hill", "Adams", "Nelson", "Hall", "Baker", "Campbell", "Carter", "Mitchell", "Roberts")
last_name <- sample(lastnames, 150, replace=TRUE)
write.csv(last_name, file="last_name.csv")

#age
age <- floor(runif(150, min=18, max=99))
write.csv(age, file="age.csv")

#gender
genders <- c("Male", "Female")
gender <- sample(genders, 150, replace=TRUE)
write.csv(gender, file="gender.csv")


#insurance poliicy data generation
#policy id
policy_id <- stri_rand_strings(150, 6, pattern="[A-Z0-9]")
write.csv(policy_id, file="policy_id.csv")

#monthly cost
monthly_cost <- floor(runif(150, min=40, max=500))
write.csv(monthly_cost,file="monthly_cost.csv")

#deductible
amounts <- c("100", "250", "500", "1000")
deductible <- sample(amounts, 150, replace=TRUE)
write.csv(deductible, file="deductible.csv")


#incident data generation
#incident id
incident_id <- stri_rand_strings(150, 6, pattern="[A-Z0-9]")
write.csv(incident_id, file="incident_id.csv")

#incident description 
descriptions <- c("Front collision", "Right side impact", "Rear-End collision", "Left side impact", "Hit fixed object", "Hit an animal", "Hit a pedestrian")
incident_description <- sample(descriptions, 150, replace=TRUE)
write.csv(incident_description, file="incident_description.csv")

#resolved
tf <- c("True", "False")
resolved <- sample(tf, 150, replace=TRUE)
write.csv(resolved, file="resolved.csv")

#cost
cost <- floor(runif(150, min=300, max=60000))
write.csv(cost, file="cost.csv")

#customer rents car data generation
#incident
incident <- sample(tf, 150, replace=TRUE)
write.csv(incident, file="incident_boolean.csv")

#date_out
date_out <- sample(seq(as.Date('2023/01/01'), as.Date('2023/04/01'), by="day"), 150, replace=TRUE)
write.csv(date_out, file="date_out.csv")



