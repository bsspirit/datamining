package org.conan.r.service;

import java.util.HashSet;
import java.util.Iterator;
import java.util.Set;

public class RResultSet {

    final public static String LINE_RESULT = "print(final)";
    final public static String LINE_RTIME = "time()";
    final public static String LINE_LAST = "rm(list=ls())";

    final public static Set<String> lines_compile = new HashSet<String>();
    static {
        lines_compile.add("parse(text = line)");
        lines_compile.add("eval.with.vis(expr, envir, enclos)");
    }

    public StringBuilder sb = new StringBuilder();
    public boolean sign = false;

    public String rtime;// R时间
    public String rmemory;// R内存
    public String jvmtime;// JVM时间
    public String jvmmemory;// JVM内存
    public boolean compileError = false;// 编译错误

    private String result;// 结果值

    public String getResult() {
        result = sb.toString().substring(sb.toString().lastIndexOf(" ") + 1);
        return result;
    }

    public static boolean containsInSet(String v) {
        Iterator<String> iter = lines_compile.iterator();
        while (iter.hasNext()) {
            if (v.contains(iter.next())) {
                return true;
            }
        }
        return false;
    }

}
