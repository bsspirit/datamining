//Create by Conan, 2010 - 2012. E-mail:bsspirit@gmail.com
package org.conan.dm.quiz.model;

import java.sql.Timestamp;
import org.conan.base.BaseObject;

/**
 * This is Quiz Model DTO
 * @author Conan Zhang
 * @date 2012-10-29
 */
public class QuizDTO extends BaseObject {

private static final long serialVersionUID = 13515187800931L;

public QuizDTO(){}
public QuizDTO(String title, String content, Timestamp create_date, Timestamp end_date, Integer owner_id, Integer category){
this.title = title;
this.content = content;
this.create_date = create_date;
this.end_date = end_date;
this.owner_id = owner_id;
this.category = category;
}


private int id;
private String title;
private String content;
private Timestamp create_date;
private Timestamp end_date;
private Integer owner_id;
private Integer category;

public int getId() {
return this.id;
}

public String getTitle (){
return this.title;
}
public String getContent (){
return this.content;
}
public Timestamp getCreate_date (){
return this.create_date;
}
public Timestamp getEnd_date (){
return this.end_date;
}
public Integer getOwner_id (){
return this.owner_id;
}
public Integer getCategory (){
return this.category;
}


public void setId(int id) {
this.id = id;
}

public void setTitle(String title) {
this.title = title;
}
public void setContent(String content) {
this.content = content;
}
public void setCreate_date(Timestamp create_date) {
this.create_date = create_date;
}
public void setEnd_date(Timestamp end_date) {
this.end_date = end_date;
}
public void setOwner_id(Integer owner_id) {
this.owner_id = owner_id;
}
public void setCategory(Integer category) {
this.category = category;
}


}
