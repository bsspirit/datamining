#精确匹配(算法)=======================
#data

# 1
# answer<-apply(data,1,sum);

# 2
# n<-nrow(data)
# answer<-rep(0,n)
# for(i in 1:n){
#   answer[i]<-sum(data[i,])
# }
category1<-function(qid,answer,file){
  result<-read.csv(file,header=FALSE,encoding="utf-8",sep=",")
  comp<-answer==result
  t<-0
  if(length(which(comp))==length(comp)){t=1}
  t
}


#概率匹配(分类)=======================
# 1
# answer<-rep(0,length(data))
# answer[which(data>=50)]<-1

category2<-function(qid,answer,file){
  t<-0
  result<-read.csv(file,header=FALSE,encoding="utf-8",sep=",")
  t<-length(which(result==answer))/length(result)*100
  t
}


#区间匹配(预测)=======================
# 1
# x=0.24
# l<-lm(V2~1+V1,data=data)
# new<-data.frame(V1=c(x))
# pred<-predict(l,new,interval = "prediction")
# answer<-pred[1]

category3<-function(qid,answer,file){
  result<-read.csv(file,header=FALSE,encoding="utf-8",sep=",")
  t<-0
  if(answer>=result$V1 && answer<=result$V2){
    t<-1
  }
  t
}