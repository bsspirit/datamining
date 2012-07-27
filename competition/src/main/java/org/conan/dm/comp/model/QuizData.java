package org.conan.dm.comp.model;

import org.conan.base.BaseObject;

public class QuizData extends BaseObject {
    private static final long serialVersionUID = 13433808127980L;
    
    private int tid;
    private String train;
    private String test;
    private String code;
    private String result;
    
    public QuizData() {
    }
    
    public QuizData(int tid) {
        this.tid = tid;
    }
    
    public int getTid() {
        return tid;
    }
    
    public void setTid(int tid) {
        this.tid = tid;
    }
    
    public String getTrain() {
        return train;
    }
    
    public void setTrain(String train) {
        this.train = train;
    }
    
    public String getTest() {
        return test;
    }
    
    public void setTest(String test) {
        this.test = test;
    }
    
    public String getCode() {
        return code;
    }
    
    public void setCode(String code) {
        this.code = code;
    }
    
    public String getResult() {
        return result;
    }
    
    public void setResult(String result) {
        this.result = result;
    }
    
}
