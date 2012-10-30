package org.conan.comp.service;

import java.util.HashMap;
import java.util.Map;

import org.conan.r.service.RResultSet;

abstract public class AbstractQuizTemplateService implements QuizTemplateService {

    protected Map<String, String> map = new HashMap<String, String>();// R初始化参数
    protected RResultSet result = null;

    @Override
    public void run(Map<String, String> m) {
        if (m != null) {
            this.map.putAll(m);
        }

        before();
        execute();
        after();
    }

}
