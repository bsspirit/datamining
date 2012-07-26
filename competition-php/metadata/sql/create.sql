#This is competition CREATE SQL.
#@author Conan Zhang
#@date 2012-07-26

use competition;

CREATE TABLE t_quiz(
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(16) NOT NULL ,
    content TEXT NOT NULL ,
    create_date TIMESTAMP NULL  DEFAULT now(),
	end_data TIMESTAMP NULL,
	uid INT NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE t_quiz_data(
    id INT PRIMARY KEY AUTO_INCREMENT,
    qid INT NOT NULL,
    type INT NOT NULL, /*0:train,1:test*/
    file VARCHAR(512) NOT NULL,
    create_date TIMESTAMP NULL  DEFAULT now()
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE t_quiz_submit(
    id INT PRIMARY KEY AUTO_INCREMENT,
    qid INT NOT NULL,
    lang VARCHAR(16) NOT NULL default 'R',/*R,JAVA*/
    code TEXT NOT NULL ,
    create_date TIMESTAMP NULL  DEFAULT now(),
    uid INT NOT NULL,
    status INT NOT NULL default '0', /*0:submit,1:running,2:finish*/
    result INT NOT NULL default '0' /*0:failuer,1:success*/
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE t_user(
	id INT PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(128) NOT NULL,
	passwrod VARCHAR(128) NOT NULL,
	type INT NOT NULL default 2, /*0:admin,1:owner,2:player*/
	create_date TIMESTAMP NULL DEFAULT now()
)

