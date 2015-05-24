package resto.selenium.test;


public class Run {
	
	public static void main(String[] args) throws Exception {
				
		String testUserEmail = "test@test1.eeew";
		
		
		new TestCommon();
		TestCommon.beforeTestSuite();
		TestCommon.connection = new DBConnection();
		TestCommon.connection.createConnection("localhost", "bronrestdata", "root", ""); //set up your db data				
		
		User adminUser = new User("admin@test.jfjffj", "Olga12345");//set up your admin data	
		User testUser = new User(testUserEmail, "Test123", "Test Test", "+4838338484");
		Reservation reserv1 = new Reservation("2020-06-05", "20:00", "2", "Test");		
		
		try
		{	
			User.createUser(testUser); 
			Reservation.makeReservation(testUser, reserv1);		
			Reservation.checkReservation(reserv1, testUser);							
		}
		
		finally{
			
			User.deleteUser(testUserEmail, adminUser);			
			TestCommon.stop();
		}	
	}

}
