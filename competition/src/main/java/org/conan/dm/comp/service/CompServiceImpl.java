package org.conan.dm.comp.service;

import java.util.HashMap;
import java.util.List;
import java.util.Map;

import org.conan.dm.comp.model.QuizData;
import org.conan.dm.quiz.model.QuizDataDTO;
import org.conan.dm.quiz.model.QuizSubmitDTO;
import org.conan.dm.quiz.service.QuizDataService;
import org.conan.dm.quiz.service.QuizSubmitService;
import org.conan.r.service.RService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

@Service
public class CompServiceImpl implements CompService {
    
    @Autowired
    QuizSubmitService submitService;
    @Autowired
    QuizDataService dataService;
    @Autowired
    RService rService;
    
    public QuizData getTaskData(int tid) {
        QuizData data = new QuizData(tid);
        
        QuizSubmitDTO submit = submitService.getQuizSubmitById(tid);
        int qid = submit.getQid();
        data.setCode(submit.getCode());
        
        Map<String, Object> map = new HashMap<String, Object>();
        map.put("qid", qid);
        List<QuizDataDTO> list = dataService.getQuizDatas(map);
        for (QuizDataDTO d : list) {
            if (d.getType() == 0) {// train
                data.setTrain(d.getLocal());
            } else if (d.getType() == 1) {// test
                data.setTest(d.getLocal());
            }
        }
        return data;
    }
    
    public List<String> execute(QuizData data) {
        return rService.run2(data.getCode(), new HashMap<String, String>());
        
    }
    
    public void setResult(List<String> list, QuizData data) {
        String result = list.get(list.size() - 1);
        if (result.equals(data.getResult())) {// correct
        
        } else {// failure
        
        }
    }
    
}
