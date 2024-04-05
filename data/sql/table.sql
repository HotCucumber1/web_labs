CREATE TABLE post(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    subtitle VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    author VARCHAR(255) NOT NULL,
    author_url VARCHAR(255),
    publish_date TIMESTAMP DEFAULT NOW(),
    image_url VARCHAR(255) NOT NULL,
    featured TINYINT(1) DEFAULT(0),
    type VARCHAR(50) NOT NULL
);