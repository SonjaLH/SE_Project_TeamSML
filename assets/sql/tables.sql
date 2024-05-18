CREATE TABLE User
(
    user_id    INT AUTO_INCREMENT PRIMARY KEY,
    username   VARCHAR(50) UNIQUE,
    password   VARCHAR(100),
    first_name VARCHAR(50),
    last_name  VARCHAR(50),
    email      VARCHAR(100),
    user_type  ENUM ('a', 'o', 'c') NOT NULL
);

CREATE TABLE CarOwner
(
    user_id      INT UNIQUE PRIMARY KEY,
    phone_number VARCHAR(20),
    address      VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES User (user_id)
);

CREATE TABLE Admin
(
    user_id INT UNIQUE PRIMARY KEY,
    FOREIGN KEY (user_id) REFERENCES User (user_id)
);

CREATE TABLE Customer
(
    user_id      INT UNIQUE PRIMARY KEY,
    phone_number VARCHAR(20),
    address      VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES User (user_id)
);

CREATE TABLE Car
(
    car_id        INT AUTO_INCREMENT PRIMARY KEY,
    owner_id      INT,
    make          VARCHAR(50),
    model         VARCHAR(50),
    type          ENUM ('sedan', 'suv', 'cupe','van','sport') NOT NULL,
    year          INT,
    color         VARCHAR(50),
    mileage       INT,
    price_per_day DECIMAL(10, 2),
    available     BOOLEAN,
    FOREIGN KEY (owner_id) REFERENCES CarOwner (user_id)
);

CREATE TABLE CarReview
(
    review_id   INT AUTO_INCREMENT PRIMARY KEY,
    car_id      INT,
    customer_id INT,
    rating      INT,
    review_text TEXT,
    FOREIGN KEY (car_id) REFERENCES Car (car_id),
    FOREIGN KEY (customer_id) REFERENCES Customer (user_id)
);

CREATE TABLE CarIMG
(
    image_id  INT AUTO_INCREMENT PRIMARY KEY,
    car_id    INT,
    image_url VARCHAR(255),
    FOREIGN KEY (car_id) REFERENCES Car (car_id)
);

CREATE TABLE Reservation
(
    reservation_id INT AUTO_INCREMENT PRIMARY KEY,
    car_id         INT,
    customer_id    INT,
    start_date     DATE,
    end_date       DATE,
    total_cost     DECIMAL(10, 2),
    FOREIGN KEY (car_id) REFERENCES Car (car_id),
    FOREIGN KEY (customer_id) REFERENCES Customer (user_id)
);

CREATE TABLE Payment
(
    payment_id     INT AUTO_INCREMENT PRIMARY KEY,
    reservation_id INT,
    payment_date   DATE,
    amount         DECIMAL(10, 2),
    payment_method VARCHAR(50),
    FOREIGN KEY (reservation_id) REFERENCES Reservation (reservation_id)
);
