package org.conan.dm.comp.service;

import java.util.List;

import org.conan.dm.comp.model.QuizData;

public interface CompService {
    
    QuizData getTaskData(int tid);
    List<String> execute(QuizData data);
    void setResult(List<String> list, QuizData data);
    
}
