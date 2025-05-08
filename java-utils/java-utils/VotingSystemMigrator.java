import java.io.*;
import java.util.*;

public class VotingSystemMigrator {

    static class MigrationEntry {
        String phpFile;
        String suggestedJavaClass;
        String type;

        public MigrationEntry(String phpFile, String className, String type) {
            this.phpFile = phpFile;
            this.suggestedJavaClass = className;
            this.type = type;
        }
    }

    public static void main(String[] args) {
        String directoryPath = "./"; // Your project directory
        File folder = new File(directoryPath);

        if (!folder.exists()) {
            System.out.println("Project directory not found.");
            return;
        }

        File[] phpFiles = folder.listFiles((dir, name) -> name.endsWith(".php"));
        if (phpFiles == null || phpFiles.length == 0) {
            System.out.println("No PHP files found for migration.");
            return;
        }

        List<MigrationEntry> migrationPlan = new ArrayList<>();

        for (File file : phpFiles) {
            String name = file.getName();
            String baseName = name.replace(".php", "");
            String className = capitalize(baseName) + "Service";

            String type = "Service";
            if (baseName.contains("auth") || baseName.contains("check")) type = "Security";
            else if (baseName.contains("feedback")) type = "Feedback Handler";
            else if (baseName.contains("admin") || baseName.contains("cpanel")) type = "Admin Panel";
            else if (baseName.contains("mark") || baseName.contains("vote")) type = "Voting Logic";

            migrationPlan.add(new MigrationEntry(name, className, type));
        }

        System.out.println("Java Migration Plan for PHP Files:\n");
        System.out.printf("%-25s %-30s %-20s%n", "PHP File", "Suggested Java Class", "Module Type");
        System.out.println("-----------------------------------------------------------------------");

        for (MigrationEntry entry : migrationPlan) {
            System.out.printf("%-25s %-30s %-20s%n", entry.phpFile, entry.suggestedJavaClass, entry.type);
        }
    }

    private static String capitalize(String text) {
        if (text == null || text.isEmpty()) return text;
        return text.substring(0, 1).toUpperCase() + text.substring(1);
    }
}