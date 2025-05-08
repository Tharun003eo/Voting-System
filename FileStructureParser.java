import java.io.File;

public class FileStructureParser {
    public static void main(String[] args) {
        // Set the project directory path here
        String directoryPath = "./"; // assuming same level; adjust if needed

        File folder = new File(directoryPath);
        File[] files = folder.listFiles();

        if (files == null) {
            System.out.println("Directory not found or empty.");
            return;
        }

        int phpCount = 0;
        int htmlCount = 0;

        System.out.println("Listing files in project directory:\n");

        for (File file : files) {
            if (file.isFile()) {
                String name = file.getName();
                if (name.endsWith(".php")) {
                    System.out.println("[PHP]   " + name);
                    phpCount++;
                } else if (name.endsWith(".html")) {
                    System.out.println("[HTML]  " + name);
                    htmlCount++;
                }
            }
        }

        System.out.println("\nSummary:");
        System.out.println("PHP Files  : " + phpCount);
        System.out.println("HTML Files : " + htmlCount);
        System.out.println("Total      : " + (phpCount + htmlCount));
    }
}
