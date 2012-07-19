#http://f.dataguru.cn/thread-14884-1-1.html
data<-read.csv("../metadata/data/sample.csv",header=FALSE)
names(data)<-c("n","e","c","eshort","elen","ecom","enum","enlcs","ecount","ncount","score")

library(ggplot2)

# library(rpart)
# rp<-rpart(c~elen+ecom+enum+enlcs,data=data,method="class")
# plot(rp,uniform=TRUE,branch=0,margin=0.1)
# text(rp,use.n=TRUE,fancy=TRUE,col="blue")
# print(rp)


data[order(-data$enlcs),]

d<-data

# #全数字，enum=1,ecount=1 => c=2
# d<-data[which(data$enum==1 & data$ecount==1),]
# 
# #lcs>40 => c=2
# d<-data[which(data$enlcs>=36 ),]
# 
# #字符组合,ecom>1 => c=1
# d<-data[which(data$ecom>1),]

# d<-data[which( data$elen==8),]

p<-ggplot(d,aes(x=score,y=enlcs,fill=factor(d$c),colour=factor(d$c)))
p<-p+geom_point(size=4,alpha=0.5)
#p<-p+geom_text(aes(y=enlcs+3,label=eshort,size=4),data=d)
p


d<-data[which(data$score>=-5 &data$score<=0),][-2]
d[order(d$eshort),]
