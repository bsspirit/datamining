package org.conan.r.service;

import java.util.ArrayList;
import java.util.Iterator;
import java.util.List;
import java.util.Map;

import org.rosuda.JRI.REXP;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.stereotype.Service;

@Service
public class RServiceImpl extends RService {
    
    final private static Logger log = LoggerFactory.getLogger(RServiceImpl.class);
    
    public void call(String file) {
        call(file, null);
    }
    
    @Override
    public void call(String file, Map<String, String> params) {
        log.debug("Start R Calling");
        String wd = file.substring(0, file.lastIndexOf("/"));
        log.debug(r.eval("setwd(\"" + wd + "\")").toString());
        log.debug(r.eval("ls()").toString());
        if (params != null) {
            Iterator<String> iter = params.keySet().iterator();
            while (iter.hasNext()) {
                String k = iter.next();
                String v = params.get(k);
                r.assign(k, params.get(k));
                log.debug(k + "<-" + v);
            }
        }
        String source = "source(\"" + file + "\",echo=TRUE)";
        if (System.getProperties().get("os.name").toString().toLowerCase().contains("window")) {
            source = "source(\"" + file + "\",echo=TRUE,encoding=\"utf-8\")";
        }
        log.debug(source);
        r.eval(source);
        r.eval("rm(list=ls())");
        log.debug("Finish R Calling");
    }
    
    @Override
    public List<String> call2(String content, Map<String, String> params) {
        log.debug("Start R Calling");
        log.debug(r.eval("ls()").toString());
        if (params != null) {
            Iterator<String> iter = params.keySet().iterator();
            while (iter.hasNext()) {
                String k = iter.next();
                String v = params.get(k);
                r.assign(k, params.get(k));
                log.debug(k + "<-" + v + "\n");
            }
        }
        
        // log.debug(content);
        List<String> list = new ArrayList<String>();
        String[] lines = content.split("\r\n");
        for (String line : lines) {
            if (line == null || line.equals("") || line.length() == 0) {
                continue;
            }
            REXP rexp = r.eval(line);
            String result = rexp.getContent().toString();
            list.add(result);
            
            log.debug("Output=>" + result);
        }
        r.eval("rm(list=ls())");
        log.debug("Finish R Calling");
        return list;
    }
}
