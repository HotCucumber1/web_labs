CREATE TABLE post(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    subtitle VARCHAR(255),
    content TEXT NOT NULL,
    author VARCHAR(255),
    author_url VARCHAR(255),
    publish_date TIMESTAMP,
    image_url VARCHAR(255),
    featured TINYINT(1) DEFAULT(0),
    type VARCHAR(50)
);