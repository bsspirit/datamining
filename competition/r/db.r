library(RMySQL)
query<-function(sql){
  conn <- dbConnect(dbDriver("MySQL"), dbname = "competition", username="comp", password="comp")
  query <- dbGetQuery(conn, sql)
  dbDisconnect(conn)
  query
}

update<-function(sql){
  conn <- dbConnect(dbDriver("MySQL"), dbname = "competition", username="comp", password="comp")
  dbSendQuery(conn, sql)
  dbDisconnect(conn)
}