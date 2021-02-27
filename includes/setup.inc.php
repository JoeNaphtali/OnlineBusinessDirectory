<?php

//INITIATE VARIABLES

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";

//CREATE DATABASE CONNECTION

$conn = mysqli_connect($servername, $dBUsername, $dBPassword);

if (!$conn) {
    //If database connection fails, display error
    die("Connection failed: ".mysqli_connect_error());
}

//CREATE DATABASE

$sql = "CREATE DATABASE online_business_directory";
//Display success message if database was created
if ($conn->query($sql)==TRUE) {
    echo "Database created successfully | ";
}
//Display error message if database was not created
else {
    echo "There was an error creating the database: ". $conn->error;
}
mysqli_select_db($conn, "online_business_directory");

//CREATE USER TABLE

$sql = "CREATE TABLE user(
    id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    profile_picture_status BOOLEAN NOT NULL,
    phone_number VARCHAR(255),
    bio TEXT
)";
//Display success message if table is created
if($conn->query($sql)===TRUE) {
    echo "The 'user' table was created succesfully | ";
}
//Display error message if table is not created
else {
    echo "There was an error creating the 'user' table: ".$conn->error;
}

//CREATE LISTING CATEGORY TABLE

$sql = "CREATE TABLE listing_category(
    id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    category VARCHAR(255) NOT NULL
)";
//Display success message if table is created
if($conn->query($sql)===TRUE) {
    echo "The 'listing_category' table was created succesfully | ";
}
//Display error message if table is not created
else {
    echo "There was an error creating the 'listing_category' table: ".$conn->error;
}

//CREATE LISTING TABLE

$sql = "CREATE TABLE listing(
    id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user__id INT(11) NOT NULL,
    listing_name VARCHAR(255) NOT NULL,
    category_id INT(11) NOT NULL,
    overview TEXT NOT NULL,
    rating NUMERIC,
    listing_address VARCHAR(255),
    friendly_address VARCHAR(255),
    latitude VARCHAR(255),
    longtitude VARCHAR(255),
    website VARCHAR(255),
    email VARCHAR(255),
    twitter VARCHAR(255),
    facebook VARCHAR(255),
    instagram VARCHAR(255),
    FOREIGN KEY (category_id) REFERENCES listing_category(id),
    FOREIGN KEY (user__id) REFERENCES user(id)
)";
//Display success message if table is created
if($conn->query($sql)===TRUE) {
    echo "The 'listing' table was created succesfully | ";
}
//Display error message if table is not created
else {
    echo "There was an error creating the 'listing' table: ".$conn->error;
}

// CREATE DAYS TABLE

$sql = "CREATE TABLE days_of_week (
    id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    day_of_week VARCHAR(255) NOT NULL
)";
//Display success message if table is created
if($conn->query($sql)===TRUE) {
    echo "The 'days_of_week' table was created succesfully | ";
}
//Display error message if table is not created
else {
    echo "There was an error creating the 'days_of_week' table: ".$conn->error;
}

// CREATE OPENING HOURS TABLE

$sql = "CREATE TABLE opening_hours(
    listing_id INT(11) NOT NULL,
    weekday VARCHAR(255) NOT NULL,
    opening_time VARCHAR(255) NOT NULL,
    closing_time VARCHAR(255) NOT NULL,
    openclose_status BOOLEAN,
    FOREIGN KEY (listing_id) REFERENCES listing(id)
)";
//Display success message if table is created
if($conn->query($sql)===TRUE) {
    echo "The 'opening_hours' table was created succesfully | ";
}
//Display error message if table is not created
else {
    echo "There was an error creating the 'opening_hours' table: ".$conn->error;
}

// CREATE EVENT DATE TABLE

$sql = "CREATE TABLE event_date_time(
    event_date date NOT NULL,
    start_time time NOT NULL,
    end_time time NOT NULL,
    listing_id INT(11) NOT NULL,
    FOREIGN KEY (listing_id) REFERENCES listing(id)
)";
//Display success message if table is created
if($conn->query($sql)===TRUE) {
    echo "The 'event_date_time' table was created succesfully | ";
}
//Display error message if table is not created
else {
    echo "There was an error creating the 'event_date_time' table: ".$conn->error;
}

// CREATE AMENITY TABLE

$sql = "CREATE TABLE amenity(
    listing_id INT(11) NOT NULL,
    amenity VARCHAR(255) NOT NULL,
    FOREIGN KEY (listing_id) REFERENCES listing(id),
    CONSTRAINT PK_amenity PRIMARY KEY (listing_id, amenity)
    )";
//Display success message if table is created
if($conn->query($sql)===TRUE) {
    echo "The 'amenity' table was created succesfully | ";
}
//Display error message if table is not created
else {
    echo "There was an error creating the 'amenity' table: ".$conn->error;
}

// CREATE LISTING PHONE NUMBER TABLE

$sql = "CREATE TABLE listing_phone_number(
    listing_id INT(11) NOT NULL,
    phone_number VARCHAR(255) NOT NULL,
    number_rank INT(11) NOT NULL,
    FOREIGN KEY (listing_id) REFERENCES listing(id),
    CONSTRAINT PK_listing_phone_number PRIMARY KEY (listing_id, phone_number)
    )";
//Display success message if table is created
if($conn->query($sql)===TRUE) {
    echo "The 'listing_phone_number' table was created succesfully | ";
}
//Display error message if table is not created
else {
    echo "There was an error creating the 'listing_phone_number' table: ".$conn->error;
}

// CREATE REVIEW TABLE

$sql = "CREATE TABLE review(
    id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user__id INT(11) NOT NULL,
    listing_id INT(11) NOT NULL,
    review TEXT NOT NULL,
    rating NUMERIC NOT NULL,
    FOREIGN KEY (user__id) REFERENCES user(id),
    FOREIGN KEY (listing_id) REFERENCES listing(id)
    )";
//Display success message if table is created
if($conn->query($sql)===TRUE) {
    echo "The 'review' table was created succesfully | ";
}
//Display error message if table is not created
else {
    echo "There was an error creating the 'review' table: ".$conn->error;
}

// CREATE PRODUCT CATEGORY TABLE

$sql = "CREATE TABLE product_category(
    id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    listing_id INT(11) NOT NULL,
    category VARCHAR(255) NOT NULL,
    FOREIGN KEY (listing_id) REFERENCES listing(id)
    )";
//Display success message if table is created
if($conn->query($sql)===TRUE) {
    echo "The 'product_category' table was created succesfully | ";
}
//Display error message if table is not created
else {
    echo "There was an error creating the 'product_category' table: ".$conn->error;
}

// CREATE PRODUCT TABLE

$sql = "CREATE TABLE product(
    id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    listing_id INT(11) NOT NULL,
    category_id INT(11),
    product_name VARCHAR(255) NOT NULL,
    product_description VARCHAR(255) NOT NULL,
    product_price VARCHAR(255) NOT NULL,
    FOREIGN KEY (listing_id) REFERENCES listing(id),
    FOREIGN KEY (category_id) REFERENCES product_category(id)
    )";
// Display success message if table is created
if($conn->query($sql)===TRUE) {
    echo "The 'product' table was created succesfully | ";
}
// Display error message if table is not created
else {
    echo "There was an error creating the 'product' table: ".$conn->error;
}

// CREATE BOOKMARK TABLE

$sql = "CREATE TABLE bookmark(
    user__id INT(11) NOT NULL,
    listing_id INT(11) NOT NULL,
    FOREIGN KEY (user__id) REFERENCES user(id),
    FOREIGN KEY (listing_id) REFERENCES listing(id),
    CONSTRAINT PK_bookmark PRIMARY KEY (user__id, listing_id)
)";
// Display success message if table is created
if($conn->query($sql)===TRUE) {
    echo "The 'bookmark' table was created succesfully | ";
}
// Display error message if table was not created
else {
    echo "There was an error creating the 'bookmark' table: ".$conn->error;
}

// CREATE ARTICLE CATEGORY TABLE

$sql = "CREATE TABLE article_category(
    id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    category VARCHAR(255) NOT NULL
)";
// Dwasplay success message if table was created
if($conn->query($sql)===TRUE) {
    echo "The 'article_category' table was created succesfully | ";
}
// Display error message if table was not created
else {
    echo "There was an error creating the 'article_category' table: ".$conn->error;
}

// CREATE ARTICLE TABLE

$sql = "CREATE TABLE article(
    id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user__id INT(11) NOT NULL,
    category_id INT(11) NOT NULL,
    title VARCHAR(255) NOT NULL,
    header_photo_status BOOLEAN NOT NULL,
    post_date DATETIME NOT NULL,
    content TEXT NOT NULL,
    comment_count INT(11),
    view_count INT(11),
    FOREIGN KEY (user__id) REFERENCES user(id),
    FOREIGN KEY (category_id) REFERENCES article_category(id)
)";
// Display success message if table was created
if($conn->query($sql)===TRUE) {
    echo "The 'article' table was created succesfully | ";
}
// Display error message if table was not created
else {
    echo "There was an error creating the 'article' table: ".$conn->error;
}

// CREATE READ LATER TABLE

$sql = "CREATE TABLE read_later(
    user__id INT(11) NOT NULL,
    article_id INT(11) NOT NULL,
    FOREIGN KEY (user__id) REFERENCES user(id),
    FOREIGN KEY (article_id) REFERENCES article(id),
    CONSTRAINT PK_bookmark PRIMARY KEY (user__id, article_id)
    )";
// Display success message if table was created
if($conn->query($sql)===TRUE) {
    echo "The 'read_later' table was created succesfully | ";
}
// Display error message if table was not created
else {
    echo "There was an error creating the 'read_later' table: ".$conn->error;
}

// CREATE PASSWORD RESET TABLE

$sql = "CREATE TABLE password_reset(
    id INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    password_reset_email TEXT NOT NULL,
    password_reset_selector TEXT NOT NULL,
    password_reset_token LONGTEXT NOT NULL,
    password_reset_expires TEXT NOT NULL
    )";
// Display success message if table was created
if($conn->query($sql)===TRUE) {
    echo "The 'password_reset' table was created succesfully | ";
}
// Display error message if table was not created
else {
    echo "There was an error creating the 'password_reset' table: ".$conn->error;
}

// INSERT DEFAULT USER

$password = "josewamu";
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO user (first_name, last_name, email, user_password, profile_picture_status) 
        VALUES ('Joseph', 'Wamulume', 'josephwamulume@gmail.com', '$hashed_password', false)";
// Display success message if user was added
if($conn->query($sql)===TRUE) {
    echo "The default user was added succesfully | ";
}
// Display error message if user was not added
else {
    echo "There was an error adding the default user: ".$conn->error;
}

// INSERT LISTING CATEGORIES

$sql = "INSERT INTO listing_category (category) 
        VALUES ('Food & Drinks'), ('Shopping'), ('Accomodation & Travel'), ('Salon, Barber & Spa'), ('Home Services'), ('Car Services')";
// Display success message if user was added
if($conn->query($sql)===TRUE) {
    echo "The default categories were added succesfully | DONE!";
}
// Display error message if user was not added
else {
    echo "There was an error adding the default categories: ".$conn->error;
}

// INSERT DAYS INTO 'DAYS_OF_WEEK' TABLE

$sql = "INSERT INTO days_of_week (day_of_week) 
        VALUES ('Monday'), ('Tuesday'), ('Wednesday'), ('Thursday'), ('Friday'), ('Saturday'), ('Sunday')";
// Display success message if user was added
if($conn->query($sql)===TRUE) {
    echo "The days were added succesfully | DONE!";
}
// Display error message if user was not added
else {
    echo "There was an error adding the days: ".$conn->error;
}

// Close connection string
mysqli_close($conn);

?>