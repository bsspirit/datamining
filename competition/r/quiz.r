library(stringr)
source("db.r",encoding="utf-8")
source("answer.r",encoding="utf-8")
source("category.r",encoding="utf-8")

# uid<-3
# final<--1
# sid<-1
# category<-1
# answer<--999
# qid<-17
# testFile<-"D:/workspace/datamining/competition-php/metadata/data/17/test.csv"
# resultDataFile<-"D:/workspace/datamining/competition-php/metadata/data/17/result.csv"

data<-read.csv(testFile,header=FALSE,encoding="utf-8",sep=",")
answer<-userCode(sid)

print(answer)

if(category==1){#精确匹配
  final<-category1(qid,answer,resultDataFile)
}else if(category==2){#概率匹配
  final<-category2(qid,answer,resultDataFile)  
}else if(category==3){#区间匹配
  final<-category3(qid,answer,resultDataFile)
}

print(final)
rm(list=ls())

