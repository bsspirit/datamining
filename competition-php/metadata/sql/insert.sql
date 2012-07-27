use competition;

insert into t_user(id,name,passwrod,type) values(1,'admin','admin',0);
insert into t_user(id,name,passwrod,type) values(2,'owner','owner',1);
insert into t_user(id,name,passwrod,type) values(3,'player1','player1',2);

insert into t_quiz(id,title,content,uid) values(1,'垃圾虫问题','垃圾虫问题',2);
insert into t_quiz_data(qid,type,file,local) values(1,0,'http://d.fens.me/1/train.csv','/home/conan/app/DataMining/competition-php/metadata/data/1/train.csv');
insert into t_quiz_data(qid,type,file,local) values(1,1,'http://d.fens.me/1/test.csv','/home/conan/app/DataMining/competition-php/metadata/data/1/test.csv');

insert into t_quiz_submit(qid,lang,code,uid) values(1,'R','print("abcd")',3);

