//Create by Conan, 2010 - 2012. E-mail:bsspirit@gmail.com
package org.conan.dm.user.model;

import java.sql.Timestamp;
import org.conan.base.BaseObject;

/**
 * This is User Model DTO
 * @author Conan Zhang
 * @date 2012-10-26
 */
public class UserDTO extends BaseObject {

private static final long serialVersionUID = 13512372044061L;

public UserDTO(){}
public UserDTO(String name, String password, String email, Timestamp create_date, Integer type){
this.name = name;
this.password = password;
this.email = email;
this.create_date = create_date;
this.type = type;
}


private int id;
private String name;
private String password;
private String email;
private Timestamp create_date;
private Integer type;

public int getId() {
return this.id;
}

public String getName (){
return this.name;
}
public String getPassword (){
return this.password;
}
public String getEmail (){
return this.email;
}
public Timestamp getCreate_date (){
return this.create_date;
}
public Integer getType (){
return this.type;
}


public void setId(int id) {
this.id = id;
}

public void setName(String name) {
this.name = name;
}
public void setPassword(String password) {
this.password = password;
}
public void setEmail(String email) {
this.email = email;
}
public void setCreate_date(Timestamp create_date) {
this.create_date = create_date;
}
public void setType(Integer type) {
this.type = type;
}


}
