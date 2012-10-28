#对图书拍卖数据的分析
data<-read.csv("data.csv",header=TRUE,encoding="utf-8",fileEncoding="utf-8");

library("SciViews")
pairs(data[-c(1,4)],diag.panel = panel.hist)

lm<-lm(gold~count+price+view+comment,data=data)
lm2<-step(lm)

princ<-princomp(gold~count+price+view+comment,data=data)

pri<-princomp(~ count+price+view+comment, data=data, cor = TRUE)

plot(data[c(2,3)])