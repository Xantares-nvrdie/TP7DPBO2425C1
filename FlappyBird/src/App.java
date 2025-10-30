import javax.swing.*;

public class App {
    public static void main(String[] args) {
        int frameWidth = 360;
        int frameHeight = 640;

        JFrame frame = new JFrame("FlappyBird");
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        frame.setSize(frameWidth, frameHeight);
        frame.setLocationRelativeTo(null);
        frame.setResizable(false);

        MainMenuPanel mainMenu = new MainMenuPanel(frame, frameWidth, frameHeight);
        frame.add(mainMenu);

        frame.pack();

        frame.setVisible(true);
    }
}
