package org.conan.comp.rest;

import java.util.HashMap;
import java.util.Map;

import org.conan.comp.service.impl.QuizRServiceImpl;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpEntity;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;

@Controller
@RequestMapping("/api")
public class ApiController extends WebController {

    final private static Logger log = LoggerFactory.getLogger(ApiController.class);

    @Autowired
    QuizRServiceImpl quizRServiceImpl;

    /**
     * 执行R算法
     */
    @RequestMapping(value = "/quiz/{uid}/{sid}", method = RequestMethod.GET)
    public HttpEntity<?> r(@PathVariable(value = "uid") String uid, @PathVariable(value = "sid") String sid) {
        log.info("uid => " + uid + ", sid=>" + sid);
        Map<String, String> map = new HashMap<String, String>();
        map.put("sid", sid);
        map.put("uid", uid);
        quizRServiceImpl.run(map);
        return new ResponseEntity<Integer>(1, HttpStatus.OK);
    }

}
