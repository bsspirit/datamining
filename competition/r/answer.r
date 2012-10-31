userCode<-function(sid){
  answer<=-999
  sql<-paste("select code from t_quiz_submit where id=",sid)
  code=query(sql)[[1]]
  lines<-str_split(code,'\r\n')[[1]]
#   for(line in lines){
#     eval(parse(text=line))
#   }
  eval(parse(text=lines))
  answer
}
