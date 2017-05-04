CREATE TABLE users (
        id int(11) NOT NULL AUTO_INCREMENT,
        email varchar(255) NOT NULL,
        password varchar(255) NOT NULL,
        firstname varchar(255) NOT NULL,
        lastname varchar(255) NOT NULL,
        admin boolean NOT NULL,
        active boolean NOT NULL,
        PRIMARY KEY (id)
);

CREATE TABLE functions (
        id int(11) NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        active boolean NOT NULL,
        PRIMARY KEY (id)
);

CREATE TABLE contacts (
        id int(11) NOT NULL AUTO_INCREMENT,
        active boolean NOT NULL,
        title char(3) NOT NULL,
        lastname varchar(255) NOT NULL,
        firstname varchar(255) NOT NULL,
        telephone varchar(255),
        mobile varchar(255),
        fax varchar(255),
        decisionmaker boolean,
        company varchar(255) NOT NULL,
        functions,
        address varchar(255),
        address2 varchar(255),
        postalcode int(5),
        city varchar(255),
        country varchar(255),
        website varchar(255),
        email varchar(255),
        photo varchar(255),
        comment text,
        lastmodified date NOT NULL,
        modifiedby int(11) NOT NULL,
        PRIMARY KEY (id)
);