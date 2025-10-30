import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;
import java.util.ArrayList;


public class Logic implements ActionListener, KeyListener {
    int frameWidth = 360;
    int frameHeight = 640;

    int playerStartPosX = frameWidth / 8;
    int playerStartPosY = frameHeight / 2;

    int playerWidth = 34;
    int playerHeight = 24;

    int pipeStartPosX = frameWidth;
    int pipeStartPosY = 0;
    int pipeWidth = 64;
    int pipeHeight = 512;

    View view;
    Image birdImage;
    Player player;

    Image lowerPipeImage;
    Image upperPipeImage;
    ArrayList<Pipe> pipes;

    Timer gameLoop;
    Timer pipesCooldown;
    int gravity = 1;

    int pipeVelocityX = -4;

    boolean gameOver = false;
    double score = 0;
    JLabel scoreLabel;

    public Logic(){
        pipes = new ArrayList<>();

        birdImage = new ImageIcon(getClass().getResource("assets/bird.png")).getImage();
        player = new Player(playerStartPosX, playerStartPosY, playerWidth, playerHeight, birdImage);

        lowerPipeImage = new ImageIcon(getClass().getResource("assets/lowerPipe.png")).getImage();
        upperPipeImage = new ImageIcon(getClass().getResource("assets/upperPipe.png")).getImage();

        scoreLabel = new JLabel("Score : 0");
        scoreLabel.setForeground(Color.white);
        scoreLabel.setFont(new Font("arial", Font.BOLD, 24));
        scoreLabel.setHorizontalAlignment(JLabel.CENTER);
        scoreLabel.setOpaque(false);

        pipesCooldown = new Timer(1500, new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent actionEvent) {
                if(!gameOver){
                    placePipes();
                }
            }
        });
        pipesCooldown.start();

        gameLoop = new Timer(1000/60, this);
        gameLoop.start();
    }

    public void setView(View view){
        this.view = view;
    }

    public Player getPlayer() {
        return player;
    }

    public  ArrayList<Pipe> getPipes(){
        return pipes;
    }

    public JLabel getScoreLabel() {
        return scoreLabel;
    }

    public boolean isGameOver() {
        return gameOver;
    }


    public void placePipes(){
        int randomPosY = (int)  (pipeStartPosY - pipeHeight / 4 - Math.random() * (pipeHeight / 2));
        int openingSpace = frameHeight / 4;

        Pipe upperPipe = new Pipe(pipeStartPosX, randomPosY, pipeWidth, pipeHeight, upperPipeImage);
        pipes.add(upperPipe);

        Pipe lowerPipe = new Pipe(pipeStartPosX, (randomPosY + openingSpace + pipeHeight), pipeWidth, pipeHeight, lowerPipeImage);
        pipes.add(lowerPipe);
    }

    @Override
    public void actionPerformed(ActionEvent e){
        if(!gameOver){
            move();
            scoreLabel.setText("Score: " + (int)score);
        }
        if(view != null){
            view.repaint();
        }
    }

    @Override
    public void keyTyped(KeyEvent e){}

    public void keyPressed(KeyEvent e){
        if(e.getKeyCode() == KeyEvent.VK_SPACE){
            player.setVelocityY(-10); //lompat sir
        }

        if(e.getKeyCode() == KeyEvent.VK_R && gameOver){
            restartGame(); //r for restart
        }
    }
    public void keyReleased(KeyEvent e){}

    public void move(){
        player.setVelocityY(player.getVelocityY() + gravity);
        player.setPosY(player.getPosY() + player.getVelocityY());
        player.setPosY(Math.max(player.getPosY(), 0)); //batas atas

        if(player.getPosY() + player.getHeight() >= frameHeight){
            gameOver=true;
        }

        for(int i = 0 ; i < pipes.size() ;i++){
            Pipe pipe = pipes.get(i);
            pipe.setPosX(pipe.getPosX() + pipeVelocityX);

            if(!pipe.getPassed() && player.getPosX() > pipe.getPosX() + pipe.getWidth()){
                score += 0.5; //.5 karena pipa kan sepasang
                pipe.setPassed(true);
            }

            if(collision(player, pipe)){
                gameOver = true;
            }
        }

        //stop the game jika gameover
        if(gameOver){
            gameLoop.stop();
            pipesCooldown.stop();
        }
    }

    public boolean collision(Player p, Pipe pipe){
        return p.getPosX() < pipe.getPosX() + pipe.getWidth() &&
                p.getPosX() + p.getWidth() > pipe.getPosX() &&
                p.getPosY() < pipe.getPosY() + pipe.getHeight() &&
                p.getPosY() + p.getHeight() > pipe.getPosY();
    }

    public void restartGame(){
        player.setPosX(playerStartPosX);
        player.setPosY(playerStartPosY);
        player.setVelocityY(0);

        pipes.clear();

        score = 0;
        scoreLabel.setText("Score: 0");

        gameOver = false;
        gameLoop.start();
        pipesCooldown.start();
    }
}
