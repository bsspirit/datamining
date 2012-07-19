package org.conan.dm.lijichong;

import java.io.BufferedReader;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.regex.Pattern;

public class MainRunTest {
    
    public static void main(String[] args) throws IOException {
        String testFile = "metadata/data/test.txt";
        if (args.length > 0) {
            testFile = args[0];
        }
        MainRunTest t = new MainRunTest();
        List<String> list1 = t.readFile(testFile);
        List<String> csv = t.format2CSV(list1);
        List<String> clazz = t.addClass(csv);
        List<String> mail = t.filterMail(clazz);
        List<String> rule1 = t.rule1(mail);
        List<String> rule2 = t.rule2(rule1);
        List<String> rule3 = t.rule3(rule2);
        List<String> rule4 = t.rule4(rule3);
        List<String> rule5 = t.rule5(rule4);
        List<String> result = t.classifer(rule5);
        
        for (String s : result) {
            String[] arr = s.split(",");
            System.out.println(arr[0] + "\t" + arr[1] + "\t" + arr[11]);
        }
    }
    
    public List<String> readFile(String file) throws IOException {
        List<String> lines = new ArrayList<String>();
        FileReader f = new FileReader(file);
        BufferedReader br = new BufferedReader(f);
        String line;
        while ((line = br.readLine()) != null) {
            if (line.length() > 0) {
                lines.add(line);
            }
        }
        return lines;
    }
    
    public void writeFile(String file, List<String> lines) throws IOException {
        FileWriter fw = new FileWriter(file, false);
        for (String line : lines) {
            fw.write(line + "\n");
        }
        fw.close();
    }
    
    public List<String> format2CSV(List<String> lines) {
        List<String> csv = new ArrayList<String>();
        for (String line : lines) {
            // System.out.println(line.trim().replace(" \t", ","));
            csv.add(line.trim().replace(" \t", ","));
        }
        return csv;
    }
    
    public List<String> addClass(List<String> lines) {
        List<String> csv = new ArrayList<String>();
        int sign = 1;
        for (String line : lines) {
            if (line.contains("#垃圾虫")) {
                sign = 1;
                continue;
            } else if (line.equals("正常")) {
                sign = 2;
                continue;
            }
            // System.out.println(line + "," + sign);
            csv.add(line + "," + sign);
        }
        return csv;
    }
    
    public List<String> filterMail(List<String> lines) {
        List<String> csv = new ArrayList<String>();
        for (String line : lines) {
            // System.out.println(line + "," + line.split(",")[1].split("@")[0]);
            String email = line.split(",")[1].split("@")[0];
            csv.add(line + "," + email + "," + email.length());
        }
        return csv;
    }
    
    /**
     * #rule1:邮箱大小写混合
     * 
     * @return 0其他情况,1小写或大学写,2大小写混,3大写数字混,4大小写数字混
     */
    public List<String> rule1(List<String> lines) {
        String p1 = "^[a-z]*$";
        String p2 = "^[A-Z]*$";
        String p3 = "[a-z]";
        String p4 = "[A-Z]";
        String p5 = "[0-9]";
        
        List<String> csv = new ArrayList<String>();
        for (String line : lines) {
            String email = line.split(",")[3];
            int tmp = -1;
            if (Pattern.compile(p1).matcher(email).matches() || Pattern.compile(p2).matcher(email).matches()) {
                tmp = 1;
            } else if (Pattern.compile(p3).matcher(email).find() && Pattern.compile(p4).matcher(email).find()) {
                tmp = 2;
                if (Pattern.compile(p5).matcher(email).find()) {
                    tmp = 4;
                }
            } else if (Pattern.compile(p4).matcher(email).find() && Pattern.compile(p5).matcher(email).find()) {
                tmp = 3;
            } else {
                tmp = 0;
            }
            // System.out.println(line + "," + tmp);
            csv.add(line + "," + tmp);
        }
        return csv;
    }
    
    /**
     * #rule2:邮箱纯数字
     * 
     * @return 1纯数字,0非纯数字
     */
    public List<String> rule2(List<String> lines) {
        String p = "^[0-9]*$";
        List<String> csv = new ArrayList<String>();
        for (String line : lines) {
            String email = line.split(",")[3];
            int tmp = 0;
            if (Pattern.compile(p).matcher(email).matches()) {
                tmp = 1;
            }
            // System.out.println(line + "," + tmp);
            csv.add(line + "," + tmp);
        }
        return csv;
    }
    
    /**
     * #rule3:邮箱与名字重叠率(最长字串)
     * 
     * @return [0,1]*100
     */
    public List<String> rule3(List<String> lines) {
        List<String> csv = new ArrayList<String>();
        for (String line : lines) {
            String[] arr = line.split(",");
            // System.out.println(arr[0] + ":" + arr[3]);
            
            char[] row = ("$" + arr[0].toLowerCase()).toCharArray();
            char[] col = ("$" + arr[03].toLowerCase()).toCharArray();
            
            int[][] array = LCSAlogithm.getLength(row, col);
            int len = LCSAlogithm.getLength(array, row, col);
            // System.out.println(len);
            
            float pre1 = (float) len / (float) arr[3].length() * 100;
            float pre2 = (float) len / (float) arr[0].length() * 100;
            float pre = (pre1 + pre2) / 2;
            // System.out.println(line + "," + pre);
            csv.add(line + "," + pre);
        }
        return csv;
    }
    
    /**
     * #rule4:邮箱的重复次数
     */
    public List<String> rule4(List<String> lines) {
        List<String> csv = new ArrayList<String>();
        Map<String, Integer> map = new HashMap<String, Integer>();
        for (String line : lines) {
            String email = line.split(",")[3];
            if (map.containsKey(email)) {
                map.put(email, map.get(email) + 1);
            } else {
                map.put(email, 1);
            }
        }
        
        for (String line : lines) {
            String email = line.split(",")[3];
            int count = map.get(email);
            // System.out.println(line + "," + count);
            csv.add(line + "," + count);
        }
        
        return csv;
    }
    
    /**
     * #rule5:名字的辅音字符个数
     */
    public List<String> rule5(List<String> lines) {
        String p = "bcdfghjklmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ";
        
        List<String> csv = new ArrayList<String>();
        for (String line : lines) {
            int s = 0;
            String name = line.split(",")[0];
            for (char n : name.toCharArray()) {
                if (p.indexOf(n) >= 0) {
                    s++;
                }
            }
            
            if (name.length() <= 6) {
                s = (int) (s * 1.5);
            }
            
            // System.out.println(line + "," + s);
            csv.add(line + "," + s);
        }
        return csv;
    }
    
    /**
     */
    public List<String> classifer(List<String> lines) {
        List<String> csv = new ArrayList<String>();
        for (String line : lines) {
            int score = 0;
            String[] arr = line.split(",");
            int elen = Integer.parseInt(arr[4]);
            int ecom = Integer.parseInt(arr[5]);
            int enums = Integer.parseInt(arr[6]);
            float enlcs = Float.parseFloat(arr[7]);
            int ecount = Integer.parseInt(arr[8]);
            int ncount = Integer.parseInt(arr[9]);
            
            if (enums == 1 && ecount == 1) {
                score += -10;
            }
            
            if (enlcs >= 60) {
                score += -8;
            } else if (enlcs >= 36) {
                score += -5;
            }
            
            if (ecom > 1) {
                score += 5;
            }
            
            if (elen == 8 || elen == 9) {
                score += 3;
            } else if (elen <= 6) {
                score += -3;
            } else if (elen >= 10) {
                score += -2;
            }
            
            if (ecount > 1) {
                score += 6;
            }
            
            if (ncount >= 6) {
                score += 5;
            } else if (ncount >= 4) {
                score += 3;
            }
            
            // System.out.println(line + "," + score);
            
            if (score > 0) {
                csv.add(line + "," + score + "," + 1);
            } else {
                csv.add(line + "," + score + "," + 2);
            }
            
        }
        return csv;
    }
}

class LCSAlogithm {
    
    public static int[][] getLength(char[] x, char[] y) {
        int[][] c = new int[x.length][y.length];
        for (int i = 1; i < x.length; i++) {
            for (int j = 1; j < y.length; j++) {
                if (x[i] == y[j]) {
                    c[i][j] = c[i - 1][j - 1] + 1;
                } else if (c[i - 1][j] >= c[i][j - 1]) {
                    c[i][j] = c[i - 1][j];
                } else {
                    c[i][j] = c[i][j - 1];
                }
            }
        }
        return c;
    }
    
    public static int getLength(int[][] array, char[] row, char[] column) {
        int x = row.length - 1;
        int y = column.length - 1;
        
        StringBuilder sb = new StringBuilder();
        while (x >= 1 && y >= 1) {
            if (row[x] == column[y]) {
                sb.insert(0, row[x]);
                x--;
                y--;
            } else {
                if (array[x - 1][y] < array[x][y - 1]) {
                    y--;
                } else {
                    x--;
                }
            }
        }
        // System.out.println(sb.toString());
        return sb.length();
    }
    
}
