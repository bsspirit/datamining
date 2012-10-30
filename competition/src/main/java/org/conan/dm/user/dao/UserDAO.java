//Create by Conan, 2010 - 2012. E-mail:bsspirit@gmail.com
package org.conan.dm.user.dao;

import java.util.List;
import java.util.Map;
import org.conan.base.dao.MybatisDAO;

import org.conan.dm.user.model.UserDTO;

/**
 * This is User DAO interface
 * @author Conan Zhang
 * @date 2012-10-29
 */
public interface UserDAO extends MybatisDAO {

    int insertUser(UserDTO dto);
    int updateUser(UserDTO dto);
    int deleteUser(int id);
    int deleteUsers (UserDTO dto);

    UserDTO getUserById(int id);
    UserDTO getUserOne(Map<String,Object> paramMap);
    List<UserDTO> getUsers(Map<String,Object> paramMap);
    int getUsersCount(Map<String,Object> paramMap);
}

