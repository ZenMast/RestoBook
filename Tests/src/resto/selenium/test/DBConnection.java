package resto.selenium.test;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.ResultSetMetaData;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;



public class DBConnection {
	public static Connection conn;
	
	public void createConnection(String IP, String dbname, String user, String pass) throws ClassNotFoundException
	{
		try {
			Class.forName("com.mysql.jdbc.Driver"); 
		    conn =  DriverManager.getConnection("jdbc:mysql://" + IP + "/" + dbname , user, pass);	
	
		} catch (SQLException ex) {
		    // handle any errors
		    System.out.println("SQLException: " + ex.getMessage());
		    System.out.println("SQLState: " + ex.getSQLState());
		    System.out.println("VendorError: " + ex.getErrorCode());
		}
	}
	
	public List<String> sqlQuery(String query)
	{
		List<String> results = new ArrayList<String>();	
		try {
		Statement stmt = conn.createStatement();		
		ResultSet rs = stmt.executeQuery(query);
		ResultSetMetaData metadata = rs.getMetaData();
		int numberOfColumns = metadata.getColumnCount();
		while (rs.next()) {              
	        int i = 1;
	        while(i <= numberOfColumns) {
	        	results.add(rs.getString(i++));
	        }
		}

		} catch (Exception e) {
			e.printStackTrace();
		}
		return results;					
	}

	public static Connection getConn() {
		return conn;
	}

	public static void setConn(Connection conn) {
		DBConnection.conn = conn;
	}


}
