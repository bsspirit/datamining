#This is competition CREATE SQL.
#@author Conan Zhang
#@date 2012-10-26

use competition;

CREATE TABLE t_quiz(
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(16) NOT NULL ,
    content MEDIUMTEXT NULL ,
    create_date TIMESTAMP NULL  DEFAULT now(),
    end_date TIMESTAMP NULL ,
    owner_id INT NOT NULL 
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE t_quiz_data(
    id INT PRIMARY KEY AUTO_INCREMENT,
    qid INT NOT NULL ,
    type INT NOT NULL ,
    data MEDIUMTEXT NOT NULL ,
    create_date TIMESTAMP NULL  DEFAULT now()
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE t_quiz_submit(
    id INT PRIMARY KEY AUTO_INCREMENT,
    qid INT NOT NULL ,
    lang VARCHAR(16) NULL  DEFAULT 'R',
    code MEDIUMTEXT NOT NULL ,
    create_date TIMESTAMP NULL  DEFAULT now(),
    player_id INT NOT NULL ,
    status INT NULL  DEFAULT 0,
    result INT NULL  DEFAULT 0
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE t_user(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(16) NOT NULL ,
    password VARCHAR(16) NOT NULL ,
    email VARCHAR(128) NULL ,
    create_date TIMESTAMP NULL  DEFAULT now(),
    title VARCHAR(16) NULL ,
    type INT NULL  DEFAULT 2
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
