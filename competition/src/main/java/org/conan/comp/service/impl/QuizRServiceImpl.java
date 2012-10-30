package org.conan.comp.service.impl;

import java.util.HashMap;
import java.util.Map;

import org.conan.comp.Constant;
import org.conan.comp.service.AbstractQuizTemplateService;
import org.conan.comp.service.QuizTemplateService;
import org.conan.dm.config.service.ConfigService;
import org.conan.dm.quiz.model.QuizSubmitDTO;
import org.conan.dm.quiz.service.QuizDataService;
import org.conan.dm.quiz.service.QuizService;
import org.conan.dm.quiz.service.QuizSubmitService;
import org.conan.r.service.RMainRun;
import org.conan.r.service.RService;
import org.conan.r.service.RServiceImpl;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

@Service
public class QuizRServiceImpl extends AbstractQuizTemplateService implements QuizTemplateService {

    @Autowired
    RServiceImpl rService;
    @Autowired
    ConfigService configService;
    @Autowired
    QuizService quizService;
    @Autowired
    QuizDataService quizDataService;
    @Autowired
    QuizSubmitService quizSubmitService;

    @Override
    public void before() {
        int sid = Integer.parseInt(super.map.get("sid"));
        int qid = quizSubmitService.getQuizSubmitById(sid).getQid();

        Map<String, Object> param = new HashMap<String, Object>();
        param.put("qid", qid);
        param.put("type", 1);// TestData
        String testDataFile = quizDataService.getQuizDataOne(param).getFile();

        param.put("type", 2);// ResultData
        String resultDataFile = quizDataService.getQuizDataOne(param).getFile();

        int category = quizService.getQuizById(qid).getCategory();

        // RUNNING
        QuizSubmitDTO dto = new QuizSubmitDTO();
        dto.setId(sid);
        dto.setStatus("RUNNING");
        dto.setResult("COMPILE");
        quizSubmitService.updateQuizSubmit(dto);

        // param
        super.map.put("qid", String.valueOf(qid));
        super.map.put("category", String.valueOf(category));
        super.map.put("testFile", testDataFile);
        super.map.put("resultDataFile", resultDataFile);
        super.map.put("answer", "-999");
        super.map.put("final", "-1");
    }

    @Override
    public void execute() {
        Map<String, Object> paramMap = new HashMap<String, Object>();
        paramMap.put("name", Constant.QUIZ_RUN);
        String rfile = configService.getConfigOne(paramMap).getR();

        RService rService = RMainRun.getContext().getBean(RServiceImpl.class);
        super.result = rService.run(rfile, super.map);
    }

    @Override
    public void after() {
        QuizSubmitDTO dto = new QuizSubmitDTO();
        dto.setId(Integer.parseInt(super.map.get("sid")));
        int category = Integer.parseInt(super.map.get("category"));
        if (!super.result.compileError) {
            dto.setResult("ERROR");
            try {
                switch (category) {
                case 1:
                    if (Integer.parseInt(super.result.getResult()) == 1)
                        dto.setResult("CORRECT");
                    break;
                case 2:
                    if (Integer.parseInt(super.result.getResult()) > 10)
                        dto.setResult("PROBABILITY-" + super.result.getResult() + "%");
                    break;
                case 3:
                    if (Integer.parseInt(super.result.getResult()) == 1)
                        dto.setResult("CORRECT");
                    break;
                }
            } catch (Exception e) {
                e.printStackTrace();
            }
        }
        dto.setStatus("FINISH");
        quizSubmitService.updateQuizSubmit(dto);
    }
}
