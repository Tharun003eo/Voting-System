import java.io.File;

public class FileStructureParser {
    public static void main(String[] args) {
        String folderPath = "./"; // Path to your project directory
        File folder = new File(folderPath);

        if (!folder.exists()) {
            System.out.println("Directory not found!");
            return;
        }

        File[] files = folder.listFiles((dir, name) -> name.endsWith(".php") || name.endsWith(".html"));
        if (files == null || files.length == 0) {
            System.out.println("No .php or .html files found.");
            return;
        }

        int phpCount = 0;
        int htmlCount = 0;

        System.out.println("Files found:");
        for (File file : files) {
            System.out.println("- " + file.getName());
            if (file.getName().endsWith(".php")) phpCount++;
            if (file.getName().endsWith(".html")) htmlCount++;
        }

        System.out.println("\nSummary:");
        System.out.println("PHP files: " + phpCount);
        System.out.println("HTML files: " + htmlCount);
    }
}