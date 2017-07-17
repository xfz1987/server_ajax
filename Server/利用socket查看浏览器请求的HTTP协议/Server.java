import java.net.*;
import java.io.*;

public class Server
{
	private ServerSocket serverSocket;

	public Server(){
		try{
			serverSocket = new ServerSocket(8088);
			System.out.println("Server create listen port...");
		}catch(Exception e){
			e.printStackTrace();
		}
	}

	public void start(){
		try{
			System.out.println("wait for connection...");
			Socket s = serverSocket.accept();
			System.out.println("Client is connected!");
			BufferedReader br = new BufferedReader(new InputStreamReader(s.getInputStream(),"UTF-8"));
			System.out.println("Client say:");
			String line = "";
			while((line = br.readLine()) != null){
				System.out.println(line);	
			}
			
		}catch(Exception e){
			e.printStackTrace();
		}
	}

	public static void main(String[] args){
		Server server = new Server();
		server.start();
	}

}