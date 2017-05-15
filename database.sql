CREATE TABLE functions (
        id int(11) NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        active boolean NOT NULL,
        PRIMARY KEY (id)
);

CREATE TABLE users (
        id int(11) NOT NULL AUTO_INCREMENT,
        active boolean NOT NULL,
        title char(3) NOT NULL,
        password varchar(255) NOT NULL,
        admin boolean NOT NULL,  
        lastname varchar(255) NOT NULL,
        firstname varchar(255),
        birthday date,
        address varchar(255) NOT NULL,
        address2 varchar(255),
        postcode int(5) NOT NULL,
        city varchar(255) NOT NULL,
        country varchar(255) NOT NULL,
        telephone varchar(255) NOT NULL,
        mobile varchar(255),
        email varchar(255) NOT NULL,
        PRIMARY KEY (id),
        UNIQUE INDEX ind_uni_email (email)
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
        address varchar(255),
        address2 varchar(255),
        postcode int(5),
        city varchar(255),
        country varchar(255),
        website varchar(255),
        email varchar(255),
        photo varchar(255),
        comment text,
        lastmodified date NOT NULL,
        modifiedby int(11) NOT NULL,
        PRIMARY KEY (id),
        CONSTRAINT fk_modified FOREIGN KEY (modifiedby) REFERENCES users(id),
        INDEX (lastname),
        INDEX (firstname),
        INDEX (lastmodified)
);

CREATE TABLE contacts_functions (
        id_contact int(11) NOT NULL,
        id_function int(11) NOT NULL,
        CONSTRAINT pk_c_f PRIMARY KEY (id_contact, id_function),
        CONSTRAINT fk_contact FOREIGN KEY (id_contact) REFERENCES contacts(id),
        CONSTRAINT fk_function FOREIGN KEY (id_function) REFERENCES functions(id)
);

INSERT INTO 'users' ('id', 'active', 'title', 'password', 'admin', 'lastname', 'firstname', 'birthday', 'address', 'address2', 'postcode', 'city', 'country', 'telephone', 'mobile', 'email') VALUES (NULL, '1', 'mon', '$2y$10$17HLyFrlGlzwjHkVrMpEauJTM46hhoKoISkRDU4CVi8hMy8dp6GbW', '1', 'ADMIN', 'Admin', '1990-03-18', '6b rue Auguste Vitu', NULL, '75015', 'Paris', 'France', '0102030405', '0605040302', 'admin@gmail.com');
