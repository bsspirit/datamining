use competition;

insert into t_user(id,name,password,email,type) values(1,'admin','a','bsspirit@gmail.com',0); /*admin*/
insert into t_user(id,name,password,email,type) values(2,'owner','a','123@gmail.com',1); /*owner*/
insert into t_user(id,name,password,email,type) values(3,'player1','a','123@gmail.com',2); /*player*/

insert into t_quiz(id,title,content,owner_id) values(1,'q1','问题1',2);
insert into t_quiz_data(qid,type,data) values(1,0,'ylpylb,1rVeQX0d@xxx.xxx,1,1rVeQX0d,8,4,0,0.0,1,9,9,13\ndeojog,B4PLAQM0@xxx.xxx,1,B4PLAQM0,8,3,0,0.0,1,4,4,11\ndaxlybol,ertjpece@xxx.xxx,1,ertjpece,8,1,0,0.0,1,6,6,8\n');
insert into t_quiz_data(qid,type,data) values(1,1,'eccgg,tkhigjugx@xxx.xxx,1,tkhigjugx,9,1,0,31.11111,1,6,6,8\n7l1h8r8v5,roraluotece@xxx.xxx,1,roraluotece,11,1,0,10.10101,1,4,4,1\nrfg3ifwodh,hhdfsrhthff@xxx.xxx,1,hhdfsrhthff,11,1,0,28.636364,1,7,7,3\n');

insert into t_quiz(id,title,content,owner_id) values(2,'q2','问题2',2);
insert into t_quiz_data(qid,type,data) values(1,0,'ylpylb,1rVeQX0d@xxx.xxx,1,1rVeQX0d,8,4,0,0.0,1,9,9,13\ndeojog,B4PLAQM0@xxx.xxx,1,B4PLAQM0,8,3,0,0.0,1,4,4,11\ndaxlybol,ertjpece@xxx.xxx,1,ertjpece,8,1,0,0.0,1,6,6,8\n');


insert into t_quiz_submit(qid,lang,code,player_id) values(1,'R','print("abcd")',3);

