//Create by Conan, 2010 - 2012. E-mail:bsspirit@gmail.com
package org.conan.dm.quiz.model;

import java.sql.Timestamp;
import org.conan.base.BaseObject;

/**
 * This is QuizData Model DTO
 * @author Conan Zhang
 * @date 2012-10-29
 */
public class QuizDataDTO extends BaseObject {

private static final long serialVersionUID = 13515187800930L;

public QuizDataDTO(){}
public QuizDataDTO(Integer qid, Integer type, String file, String remote, Timestamp create_date){
this.qid = qid;
this.type = type;
this.file = file;
this.remote = remote;
this.create_date = create_date;
}


private int id;
private Integer qid;
private Integer type;
private String file;
private String remote;
private Timestamp create_date;

public int getId() {
return this.id;
}

public Integer getQid (){
return this.qid;
}
public Integer getType (){
return this.type;
}
public String getFile (){
return this.file;
}
public String getRemote (){
return this.remote;
}
public Timestamp getCreate_date (){
return this.create_date;
}


public void setId(int id) {
this.id = id;
}

public void setQid(Integer qid) {
this.qid = qid;
}
public void setType(Integer type) {
this.type = type;
}
public void setFile(String file) {
this.file = file;
}
public void setRemote(String remote) {
this.remote = remote;
}
public void setCreate_date(Timestamp create_date) {
this.create_date = create_date;
}


}
