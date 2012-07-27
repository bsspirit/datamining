package org.conan.dm.comp;

import org.conan.dm.comp.model.QuizData;
import org.conan.dm.comp.service.CompService;
import org.conan.dm.comp.service.CompServiceImpl;
import org.springframework.context.ApplicationContext;
import org.springframework.context.support.ClassPathXmlApplicationContext;

public class MainRun {
    
    private static ApplicationContext ctx = null;
    
    private MainRun() {
    }
    
    public static ApplicationContext getContext() {
        if (ctx == null) {
            ctx = new ClassPathXmlApplicationContext("spring.xml");
        }
        return ctx;
    }
    
    public static void main(String[] args) {
        CompService comp = MainRun.getContext().getBean(CompServiceImpl.class);
        QuizData data = comp.getTaskData(8);
        comp.execute(data);
    }
    
}
