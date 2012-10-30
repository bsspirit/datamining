//Create by Conan, 2010 - 2012. E-mail:bsspirit@gmail.com
package org.conan.dm.config.model;

import java.sql.Timestamp;
import org.conan.base.BaseObject;

/**
 * This is Config Model DTO
 * @author Conan Zhang
 * @date 2012-10-30
 */
public class ConfigDTO extends BaseObject {

private static final long serialVersionUID = 13515634499531L;

public ConfigDTO(){}
public ConfigDTO(String name, Timestamp create_date, String r){
this.name = name;
this.create_date = create_date;
this.r = r;
}


private int id;
private String name;
private Timestamp create_date;
private String r;

public int getId() {
return this.id;
}

public String getName (){
return this.name;
}
public Timestamp getCreate_date (){
return this.create_date;
}
public String getR (){
return this.r;
}


public void setId(int id) {
this.id = id;
}

public void setName(String name) {
this.name = name;
}
public void setCreate_date(Timestamp create_date) {
this.create_date = create_date;
}
public void setR(String r) {
this.r = r;
}


}
