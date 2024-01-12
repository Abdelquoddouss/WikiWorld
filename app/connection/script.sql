CREATE DATABASE wikiworld;

CREATE TABLE role(
 id int PRIMARY key AUTO_INCREMENT,
 name VARCHAR(255)
);

CREATE Table users(
     id int PRIMARY key AUTO_INCREMENT,
    firstName VARCHAR(255),
    lastName  VARCHAR(255),
    email     VARCHAR(255),
    password  varchar(255),
    adress  VARCHAR(255),
    role_id int,
    Foreign Key (role_id) REFERENCES role(id) oN DELETE CASCADE ON UPDATE CASCADE
);


CREATE Table categories(
    id int PRIMARY key AUTO_INCREMENT,
 name VARCHAR(255)
);


CREATE Table wikis(
     id int PRIMARY key AUTO_INCREMENT,
    description VARCHAR(255),
    title VARCHAR(255),
    status VARCHAR(255),
    img VARCHAR(255),
    categorie_id int ,
    user_id int,
    Foreign Key (categorie_id) REFERENCES categories(id)oN DELETE CASCADE ON UPDATE CASCADE,
    Foreign Key (user_id) REFERENCES users(id)oN DELETE CASCADE ON UPDATE CASCADE
);



CREATE Table tags(
     id int PRIMARY key AUTO_INCREMENT,
 name VARCHAR(255)
);

CREATE Table wikis_tags(
     id int PRIMARY key AUTO_INCREMENT,
     wiki_id,
     tags_id,
         Foreign Key (wiki_id) REFERENCES wikis(id)oN DELETE CASCADE ON UPDATE CASCADE
    Foreign Key (tags_id) REFERENCES tags(id)oN DELETE CASCADE ON UPDATE CASCADE
);