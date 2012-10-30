# uid=3
# qid=17
# library(stringr)
# print(uid)
# print(qid)
source("db.r")
# sql<-paste("select category from t_quiz where id=",qid)
# data<-query(sql)
# print(data)


# args <- commandArgs(TRUE)
# 
# uid<-args[1]
# qid<-args[2]
 
sql<-paste("update t_quiz_submit",
           "set status = 'RUNNING'",
           "where qid=17 and player_id=3")
update(sql)



