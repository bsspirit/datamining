//Create by Conan, 2010 - 2012. E-mail:bsspirit@gmail.com
package org.conan.dm.config.service;

import java.util.List;
import java.util.Map;
import org.conan.base.service.PageInObject;
import org.conan.base.service.PageOutObject;
import org.conan.base.service.SpringService;

import org.conan.dm.config.model.ConfigDTO;

/**
 * This is Config DAO interface
 * @author Conan Zhang
 * @date 2012-10-30
 */
public interface ConfigService extends SpringService {

    int insertConfig(ConfigDTO dto);
    int updateConfig(ConfigDTO dto);
    int saveConfig(ConfigDTO dto);
    int saveConfig(ConfigDTO dto, Map<String,Object> paramMap);
    int deleteConfig(int id);
    int deleteConfig(ConfigDTO dto);
    

    ConfigDTO getConfigById(int id);
    ConfigDTO getConfigOne(Map<String,Object> paramMap);
    List<ConfigDTO> getConfigs(Map<String,Object> paramMap);
    PageOutObject<ConfigDTO> getConfigsPaging(Map<String,Object> paramMap, PageInObject page);
    int getConfigsCount(Map<String,Object> paramMap);
}

