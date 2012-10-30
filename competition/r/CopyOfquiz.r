library(stringr)
source("db.r",encoding="utf-8")

# getQuiz<-function(sid,uid){
#   sql<-paste("select qid from t_quiz_submit where id=",sid,"AND player_id=",uid)
#   qid=query(sql)[[1]]
#   qid
# }

# getData<-function(qid,type){
#   sql<-paste(" select file from t_quiz_data where qid= ",qid," and type = ",type)
#   file=query(sql)[[1]]
#   data<-read.csv(file,header=FALSE,encoding="utf-8",sep=",")
#   data
# }
# 
# getCategory<-function(qid){
#   sql<-paste("select category from t_quiz where id=",qid)
#   category<-query(sql)[[1]]
#   category
# }

userCode<-function(sid){
  sql<-paste("select code from t_quiz_submit where id=",sid)
  code=query(sql)[[1]]
  lines<-str_split(code,'\r\n')[[1]]
  for(line in lines){
    eval(parse(text=line))
  }
  answer
}

# status<-c("INIT","RUNNING","FINISH")
# result<-c("INIT","ERROR","CORRECT","PROBABILITY","COMPILE")

# statusFinish<-function(sid,result,p=0,des=''){
#   if(result=='PROBABILITY')
#     result<-p
#   
#   sql<-paste("UPDATE t_quiz_submit",
#              "SET result='",result,"',description='",des,"'",
#              "WHERE id=",sid)
#   update(sql)
# }



# sid<-1
# uid<-3
# qid<-getQuiz(sid,uid)
# data<-getData(qid,1)
# answer<--999
answer<-userCode(sid)
cate<-getCategory(qid)#算法类别


if(cate==1){#精确匹配
  t<-category1(qid,answer)
#   if(t==1) {
#     statusFinish(sid,'CORRECT')
#   } else {
#     statusFinish(sid,'ERROR')
#   }
  
}else if(cate==2){#概率匹配
  t<-category2(qid,answer)  
#   if(t>10) {
#     statusFinish(sid,'PROBABILITY',t)
#   }else{
#     statusFinish(sid,'ERROR')
#   }
  
}else if(cate==3){#区间匹配
  t<-category3(qid,answer)
#   if(t==1) {
#     statusFinish(sid,'CORRECT')
#   }else{
#     statusFinish(sid,'ERROR')
#   }
}

rm(list=ls())

# for(l in ls()){
#   print(l)
#   print(eval(parse(text=l)))
# }

