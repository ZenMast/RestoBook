package resto.selenium.test;


import com.relevantcodes.extentreports.ExtentReports;

public class Run {
	static final ExtentReports extent = ExtentReports.get(Run.class); 	
	
	public static void main(String[] args) throws Exception {
				
		String testUserEmail = "test@test1.eeew";
		
		new TestCommon();
		TestCommon.beforeTestSuite();
		
		User adminUser = new User("admin@test.jfjffj", "Olga12345");// // set up your admin data	
		User testUser = new User(testUserEmail, "Test123", "Test Test", "+4838338484");
		new Reservation();		
		
		try
		{				
			User.createUser(testUser); 
			Reservation.makeReservation(testUser);			
									
		}
		
		finally{
			
			User.deleteUser(testUserEmail, adminUser);			
			TestCommon.stop();
		}	
	}

}
