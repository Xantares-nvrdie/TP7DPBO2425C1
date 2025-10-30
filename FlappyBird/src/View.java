import javax.swing.*;
import java.awt.*;
import java.util.ArrayList;

public class View extends JPanel{
    int width = 360;
    int height = 640;

    private Logic logic;
    private Image backgroundImage;
    private  Image gameOverImage;

    public View(Logic logic){
        this.logic = logic;
        setPreferredSize(new Dimension(width, height));
        backgroundImage = new ImageIcon(getClass().getResource("/assets/background-night.png")).getImage();
        gameOverImage = new ImageIcon(getClass().getResource("/assets/gameover.png")).getImage();
        setBackground(Color.cyan);

        setLayout(new BorderLayout());
        add(logic.getScoreLabel(), BorderLayout.NORTH);

        setFocusable(true);
        addKeyListener(logic);
    }

    @Override
    public void paintComponent(Graphics g){
        super.paintComponent(g);
        draw(g);
    }

    public void draw(Graphics g){
        if (backgroundImage != null) {
            g.drawImage(backgroundImage, 0, 0, width, height, null);
        } else {
            g.setColor(Color.cyan);
            g.fillRect(0, 0, width, height);
        }


        Player player = logic.getPlayer();
        if(player != null){
            g.drawImage(player.getImage(), player.getPosX(), player.getPosY(), player.getWidth(), player.getHeight(), null);
        }

        ArrayList<Pipe> pipes = logic.getPipes();
        if (pipes != null){
            for(int i = 0 ; i < pipes.size(); i++){
                Pipe pipe = pipes.get(i);
                g.drawImage(pipe.getImage(), pipe.getPosX(), pipe.getPosY(), pipe.getWidth(), pipe.getHeight(), null);
            }
        }

        if (logic.isGameOver()) {
            if (gameOverImage != null) {
                int imgWidth = gameOverImage.getWidth(null);
                int imgHeight = gameOverImage.getHeight(null);
                int x = (width - imgWidth) / 2;
                int y = (height - imgHeight) / 2 - 50; // agak naik sedikit biar pas
                g.drawImage(gameOverImage, x, y, null);
            } else {
                // fallback kalau gambar gak ketemu
                g.setColor(Color.red);
                g.setFont(new Font("Arial", Font.BOLD, 48));
                FontMetrics fm = g.getFontMetrics();
                String gameOverText = "Game Over";
                g.drawString(gameOverText, (width - fm.stringWidth(gameOverText)) / 2, height / 2 - 50);
            }

            g.setColor(Color.WHITE);
            g.setFont(new Font("Arial", Font.PLAIN, 24));
            FontMetrics fm = g.getFontMetrics();
            String restartText = "Press 'R' to restart";
            g.drawString(restartText, (width - fm.stringWidth(restartText)) / 2, height / 2 + 50);
        }
    }

}
