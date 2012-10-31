x=0.24
l<-lm(V2~1+V1,data=data)
new<-data.frame(V1=c(x))
pred<-predict(l,new,interval = "prediction")
answer<-pred[1]