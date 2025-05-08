import java.io.*;
import java.util.regex.*;

public class PhpFileAnalyzer {

    public static void main(String[] args) {
        String directoryPath = "./"; // Path to your project
        File folder = new File(directoryPath);

        if (!folder.exists()) {
            System.out.println("Directory does not exist.");
            return;
        }

        File[] files = folder.listFiles((dir, name) -> name.endsWith(".php"));
        if (files == null || files.length == 0) {
            System.out.println("No PHP files found.");
            return;
        }

        Pattern functionPattern = Pattern.compile("function\\s+([a-zA-Z0-9_]+)");

        System.out.println("PHP Function Analysis:\n");

        for (File phpFile : files) {
            try (BufferedReader reader = new BufferedReader(new FileReader(phpFile))) {
                String line;
                int functionCount = 0;
                while ((line = reader.readLine()) != null) {
                    Matcher matcher = functionPattern.matcher(line);
                    while (matcher.find()) {
                        String funcName = matcher.group(1);
                        System.out.println("[" + phpFile.getName() + "] → function: " + funcName);
                        functionCount++;
                    }
                }
                if (functionCount == 0) {
                    System.out.println("[" + phpFile.getName() + "] → No functions found.");
                }
            } catch (IOException e) {
                System.out.println("Error reading file: " + phpFile.getName());
            }
        }
    }
}