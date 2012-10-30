//Create by Conan, 2010 - 2012. E-mail:bsspirit@gmail.com
package org.conan.dm.user.model;

import java.sql.Timestamp;
import org.conan.base.BaseObject;

/**
 * This is User Model DTO
 * @author Conan Zhang
 * @date 2012-10-29
 */
public class UserDTO extends BaseObject {

private static final long serialVersionUID = 13515187801090L;

public UserDTO(){}
public UserDTO(String name, String password, String email, Timestamp create_date, String title){
this.name = name;
this.password = password;
this.email = email;
this.create_date = create_date;
this.title = title;
}


private int id;
private String name;
private String password;
private String email;
private Timestamp create_date;
private String title;

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
public String getTitle (){
return this.title;
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
public void setTitle(String title) {
this.title = title;
}


}
