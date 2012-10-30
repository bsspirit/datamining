package org.conan.r.service;

import java.util.HashMap;
import java.util.Map;

import org.conan.dm.quiz.model.QuizSubmitDTO;
import org.conan.dm.quiz.service.QuizDataService;
import org.conan.dm.quiz.service.QuizService;
import org.conan.dm.quiz.service.QuizSubmitService;
import org.conan.dm.quiz.service.impl.QuizSubmitServiceImpl;
import org.springframework.context.ApplicationContext;
import org.springframework.context.support.ClassPathXmlApplicationContext;

public class RMainRun {

    private static ApplicationContext ctx = null;

    private RMainRun() {
    }

    public static ApplicationContext getContext() {
        if (ctx == null) {
            ctx = new ClassPathXmlApplicationContext("spring.xml");
        }
        return ctx;
    }

    public static void main(String[] args) throws Exception {
        QuizSubmitService quizSubmitService = RMainRun.getContext().getBean(QuizSubmitServiceImpl.class);
        QuizDataService quizDataService = RMainRun.getContext().getBean(QuizDataService.class);
        QuizService quizService = RMainRun.getContext().getBean(QuizService.class);

        // init
        int sid = 2;
        int uid = 3;
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
        Map<String, String> map = new HashMap<String, String>();
        map.put("sid", String.valueOf(sid));
        map.put("uid", String.valueOf(uid));
        map.put("qid", String.valueOf(qid));
        map.put("category", String.valueOf(category));
        map.put("testFile", testDataFile);
        map.put("resultDataFile", resultDataFile);
        map.put("answer", "-999");
        map.put("final", "-1");

        RService rService = RMainRun.getContext().getBean(RServiceImpl.class);
        RResultSet result = rService.run("D:/workspace/datamining/competition/r/quiz.r", map);

        if (!result.compileError) {
            // FINISH
            dto.setResult("ERROR");
            try {
                switch (category) {
                case 1:
                    if (Integer.parseInt(result.getResult()) == 1) {
                        dto.setResult("CORRECT");
                    }
                    break;
                case 2:
                    if (Integer.parseInt(result.getResult()) > 10) {
                        dto.setResult("PROBABILITY-" + result.getResult() + "%");
                    }
                    break;
                case 3:
                    if (Integer.parseInt(result.getResult()) == 1) {
                        dto.setResult("CORRECT");
                    }
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
