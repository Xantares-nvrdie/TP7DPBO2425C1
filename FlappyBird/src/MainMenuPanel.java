import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class MainMenuPanel extends JPanel implements ActionListener {
    private JFrame mainFrame;
    private  int frameWidth;
    private  int frameHeight;
    private Image backgroundImage;
    JButton playButton;
    JButton exitButton;

    public MainMenuPanel(JFrame frame, int width, int height){
        this.mainFrame = frame;
        this.frameHeight = height;
        this.frameWidth = width;

        setPreferredSize(new Dimension(frameWidth, frameHeight));

        try {
            backgroundImage = new ImageIcon(getClass().getResource("assets/background-night.png")).getImage();
        } catch (Exception e) {
            System.err.println("Gagal memuat background.png: " + e.getMessage());
            setBackground(Color.CYAN);
        }
        //layouting tombol
        setLayout(new GridBagLayout());
        GridBagConstraints gbc = new GridBagConstraints();
        gbc.insets = new Insets(10, 10, 10, 10); //gap antar tombol
        gbc.fill = GridBagConstraints.HORIZONTAL;
        gbc.gridx = 0;

        playButton = new JButton("  Play Game   ");
        exitButton = new JButton("  Exit Game   ");

        styleButton(playButton, new Color(76, 175, 80));
        gbc.gridy = 0;
        add(playButton, gbc);

        styleButton(exitButton, new Color(244, 67, 54));
        gbc.gridy = 1;
        add(exitButton, gbc);

    }

    private void styleButton(JButton button, Color color) {
        button.setFont(new Font("Arial", Font.BOLD, 18));
        button.setBackground(color);
        button.setForeground(Color.WHITE);
        button.setOpaque(true);
        button.setBorderPainted(false); //menghilangkan border aneh
        button.setFocusPainted(false); // menghilangkan kotak fokus saat diklik
        button.setCursor(new Cursor(Cursor.HAND_CURSOR)); // mengubah kursor jadi tangan
        button.addActionListener(this);
    }
    @Override
    protected void paintComponent(Graphics g) {
        super.paintComponent(g);
        if (backgroundImage != null) {
            g.drawImage(backgroundImage, 0, 0, getWidth(), getHeight(), this);
        }
    }

    @Override
    public void actionPerformed(ActionEvent e){
        if(e.getSource() == playButton){
            startGame(); //jika tekan play
        } else {
            System.exit(0);
        }
    }

    private void startGame(){
        //del panel
        mainFrame.remove(this);

        //buat objek ulang
        Logic logic = new Logic();
        View gameView = new View(logic);
        logic.setView(gameView);

        //tambah panel game
        mainFrame.add(gameView);

        //untuk KeyListener fungsi
        gameView.requestFocusInWindow();

        //gambar ulang frame
        mainFrame.revalidate();
        mainFrame.repaint();


    }
}