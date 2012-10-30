//Create by Conan, 2010 - 2012. E-mail:bsspirit@gmail.com
package org.conan.dm.quiz.model;

import java.sql.Timestamp;
import org.conan.base.BaseObject;

/**
 * This is QuizSubmit Model DTO
 * @author Conan Zhang
 * @date 2012-10-29
 */
public class QuizSubmitDTO extends BaseObject {

private static final long serialVersionUID = 13515187800932L;

public QuizSubmitDTO(){}
public QuizSubmitDTO(Integer qid, String lang, String code, Timestamp create_date, Integer player_id, String status, String result, String description){
this.qid = qid;
this.lang = lang;
this.code = code;
this.create_date = create_date;
this.player_id = player_id;
this.status = status;
this.result = result;
this.description = description;
}


private int id;
private Integer qid;
private String lang;
private String code;
private Timestamp create_date;
private Integer player_id;
private String status;
private String result;
private String description;

public int getId() {
return this.id;
}

public Integer getQid (){
return this.qid;
}
public String getLang (){
return this.lang;
}
public String getCode (){
return this.code;
}
public Timestamp getCreate_date (){
return this.create_date;
}
public Integer getPlayer_id (){
return this.player_id;
}
public String getStatus (){
return this.status;
}
public String getResult (){
return this.result;
}
public String getDescription (){
return this.description;
}


public void setId(int id) {
this.id = id;
}

public void setQid(Integer qid) {
this.qid = qid;
}
public void setLang(String lang) {
this.lang = lang;
}
public void setCode(String code) {
this.code = code;
}
public void setCreate_date(Timestamp create_date) {
this.create_date = create_date;
}
public void setPlayer_id(Integer player_id) {
this.player_id = player_id;
}
public void setStatus(String status) {
this.status = status;
}
public void setResult(String result) {
this.result = result;
}
public void setDescription(String description) {
this.description = description;
}


}
