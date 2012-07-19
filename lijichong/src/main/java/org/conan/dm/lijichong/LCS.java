package org.conan.dm.lijichong;

import java.util.Random;

/**
 * 最长公共子序列LCS(不连续)
 * 
 * @author conan
 * 
 */
public class LCS {
    
    public static void main(String[] args) {
        LCS l = new LCS();
//         char[] row = "$高新技术|农业|家政".toCharArray();//l.randomString(10).toCharArray();
//         char[] column = "$高新术".toCharArray();//l.randomString(10).toCharArray();
        
        char[] row = "$isumsen".toCharArray();
        char[] column = "$sumsen".toCharArray();
        
        System.out.print("row=\t");
        l.displayArray(row);
        System.out.print("column=\t");
        l.displayArray(column);
        
        int[][] array = l.getLength(row, column);
        System.out.println("=======LCS矩阵========");
        l.displayArray2(array);
        l.display(array, row, column);
    }
    
    public int[][] getLength(char[] x, char[] y) {
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
    
    public void displayArray(char[] arr) {
        for (int i = 0; i < arr.length; i++) {
            System.out.print(arr[i] + ",");
        }
        System.out.println();
    }
    
    public void displayArray2(int[][] arr2) {
        for (int i = 0; i < arr2.length; i++) {
            for (int j = 0; j < arr2[0].length; j++) {
                System.out.printf("%-4d", arr2[i][j]);
            }
            System.out.println("");
        }
    }
    
    public void display(int[][] array, char[] row, char[] column) {
        int x = row.length - 1;
        int y = column.length - 1;
        
        StringBuilder sb = new StringBuilder();
        while (x >= 1 && y >= 1) {
            // System.out.printf("x=%d,y=%d\n",x,y);
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
        System.out.println("最长公共子序列为：" + sb.toString() + " [length=" + sb.length() + "]");
    }
    
    public String randomString(int length) {
        StringBuffer buffer = new StringBuffer("abcdefghijklmnopqrstuvwxyz");
        StringBuffer sb = new StringBuffer();
        Random r = new Random();
        int range = buffer.length();
        for (int i = 0; i < length; i++) {
            sb.append(buffer.charAt(r.nextInt(range)));
        }
        return sb.toString();
    }
}
