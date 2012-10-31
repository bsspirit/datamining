#This is competition CREATE SQL.
#@author Conan Zhang
#@date 2012-10-31

use competition;

CREATE TABLE t_quiz(
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(16) NOT NULL ,
    content MEDIUMTEXT NULL ,
    create_date TIMESTAMP NULL  DEFAULT now(),
    end_date TIMESTAMP NULL ,
    owner_id INT NOT NULL ,
    category INT NOT NULL 
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE UNIQUE INDEX t_quiz_IDX_0 on t_quiz(title);
CREATE  INDEX t_quiz_IDX_1 on t_quiz(owner_id);

CREATE TABLE t_quiz_status(
    id INT PRIMARY KEY AUTO_INCREMENT,
    qid INT NOT NULL ,
    status VARCHAR(16) NULL  DEFAULT 'WAIT',
    create_date TIMESTAMP NULL  DEFAULT now(),
    description VARCHAR(512) NULL 
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE UNIQUE INDEX t_quiz_status_IDX_0 on t_quiz_status(qid);

CREATE TABLE t_quiz_data(
    id INT PRIMARY KEY AUTO_INCREMENT,
    qid INT NOT NULL ,
    type INT NOT NULL ,
    file VARCHAR(256) NOT NULL ,
    remote VARCHAR(256) NOT NULL ,
    create_date TIMESTAMP NULL  DEFAULT now()
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE  INDEX t_quiz_data_IDX_0 on t_quiz_data(qid);

CREATE TABLE t_quiz_submit(
    id INT PRIMARY KEY AUTO_INCREMENT,
    qid INT NOT NULL ,
    lang VARCHAR(16) NULL  DEFAULT 'R',
    code MEDIUMTEXT NOT NULL ,
    create_date TIMESTAMP NULL  DEFAULT now(),
    player_id INT NOT NULL ,
    status VARCHAR(8) NULL  DEFAULT 'INIT',
    result VARCHAR(16) NULL  DEFAULT 'INIT',
    prob INT NULL ,
    description VARCHAR(512) NULL 
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE  INDEX t_quiz_submit_IDX_0 on t_quiz_submit(qid);
CREATE  INDEX t_quiz_submit_IDX_1 on t_quiz_submit(player_id);

CREATE TABLE t_user(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(16) NOT NULL ,
    password VARCHAR(64) NOT NULL ,
    email VARCHAR(128) NULL ,
    create_date TIMESTAMP NULL  DEFAULT now(),
    title VARCHAR(16) NULL 
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE UNIQUE INDEX t_user_IDX_0 on t_user(name);
CREATE UNIQUE INDEX t_user_IDX_1 on t_user(email);

CREATE TABLE t_config(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(16) NOT NULL ,
    create_date TIMESTAMP NULL  DEFAULT now(),
    r VARCHAR(512) NOT NULL 
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE UNIQUE INDEX t_config_IDX_0 on t_config(name);

