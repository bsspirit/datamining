package org.conan.comp.service;

import java.util.Map;

public interface QuizTemplateService {

    void before();
    void execute();
    void after();
    void run(Map<String, String> map);

}
