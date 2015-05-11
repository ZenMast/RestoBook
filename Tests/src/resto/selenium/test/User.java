package resto.selenium.test;


import org.openqa.selenium.Alert;
import org.openqa.selenium.By;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.Select;
import org.openqa.selenium.support.ui.WebDriverWait;

import com.relevantcodes.extentreports.LogStatus;


public class User extends  TestCommon{
	public String email;
	public String password;
	public String name;
	public String phone;
	public String id;
	 
	
	public User(String email, String pass){
		this.email = email;
		this.password = pass;
	}
	
	public User(){
		this.email = "";
		this.password = "";
	}
	
	public User(String email, String pass, String name, String phone){
		this.email = email;
		this.password = pass;
		this.name = name;
		this.phone = phone;
	}
	
	public static void loginWithUser(User user)
	{	
	
	   driver.get(testSite);  
			
	   Boolean loggedIn = false;
	   if (driver.findElements(By.partialLinkText("Login")).size() > 0 == false)
	   {
		   if(driver.findElements(By.partialLinkText("Logout (" + user.getEmail() + ")")).size() > 0 == false)		   
			   driver.findElement(By.partialLinkText("Logout ")).click(); 
		   else
		   {
			   loggedIn = true;
			   extent.log(LogStatus.INFO, "Login", "User already looged in");
		   }
	   }
		
	  if (!loggedIn)
	  {
		  driver.findElement(By.partialLinkText("Login")).click(); 
		  driver.findElement(By.id("loginform-email")).sendKeys(user.getEmail()); 
		  driver.findElement(By.id("loginform-password")).sendKeys(user.getPassword()); 	
		  driver.findElement(By.name("login-button")).click();  
	        
	       (new WebDriverWait(driver, 10)).until(ExpectedConditions.elementToBeClickable(By.partialLinkText("Logout (" + user.getEmail() + ")")));
	        
	       extent.log(LogStatus.INFO, "Login", "User was logged in");
	  }
		
	}
		
	public static void createUser(User user)
	{
		extent.startTest("Create User");		
		extent.log(LogStatus.INFO, "User creation", "Predifined user will be created and logged in");
               
        driver.get(testSite);   
        
            
        driver.findElement(By.partialLinkText("Signup")).click();   
        
        (new WebDriverWait(driver, 10)).until(ExpectedConditions.elementToBeClickable(By.id("signupform-email")));   
        driver.findElement(By.id("signupform-email")).sendKeys(user.getEmail());
        driver.findElement(By.id("signupform-password")).sendKeys(user.getPassword()); 
        driver.findElement(By.id("signupform-password2")).sendKeys(user.getPassword()); 
        driver.findElement(By.id("signupform-name")).sendKeys(user.getName()); 
        driver.findElement(By.id("signupform-phone")).sendKeys(user.getPhone());         
        driver.findElement(By.name("signup-button")).click();               
        
        
        WebElement element = (new WebDriverWait(driver, 10)).until(ExpectedConditions.elementToBeClickable(By.partialLinkText("Logout (" + user.getEmail() + ")")));
       
       if (element.isDisplayed())
    	   extent.log(LogStatus.PASS, "Checks if user was creted and logged in after registration", "OK");
        else
        	extent.log(LogStatus.FAIL, "Checks if user was creted and logged in after registration", "Something went wrong, user was not created");
	
        
	}
	
	public static void deleteUser(String testUsersEmail, User adminuser) throws InterruptedException
	{
		extent.startTest("Delete User");	
		
		loginWithUser(adminuser);
		
        driver.findElement(By.partialLinkText("Users")).click();  
        
        driver.findElement(By.name("UserSearch[email]")).sendKeys(testUsersEmail);        
        Select select = new Select(driver.findElement(By.name("UserSearch[status]")));   
        select.selectByVisibleText("Active");
            
        if(driver.findElements(By.className("empty")).size() > 0)
        	extent.log(LogStatus.FAIL, "Trying to delete user", "User was not found");        
        else
        {
        	driver.findElement(By.className("glyphicon-trash")).click();
        	Alert alertDialog = driver.switchTo().alert();        	
        	//Click the OK button on the alert.
        	alertDialog.accept();
        	
        	driver.findElement(By.name("UserSearch[email]")).sendKeys(testUsersEmail);        
            select = new Select(driver.findElement(By.name("UserSearch[status]")));   
            select.selectByVisibleText("Active");
        	if(driver.findElements(By.className("empty")).size() > 0)
            	extent.log(LogStatus.PASS, "Trying to delete user", "User was succesfully deleted"); 
        	else
        		extent.log(LogStatus.PASS, "Trying to delete user", "Something happened, user was not deleted"); 
        }   
        
	}

	public String getId(){
		 return TestCommon.connection.sqlQuery("select id from user where email='" + email + "'").get(0);		
	}
	
	public String getEmail() {
		return email;
	}

	public String getPassword() {
		return password;
	}

	public void setPassword(String password) {
		this.password = password;
	}

	public void setEmail(String email) {
		this.email = email;
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public String getPhone() {
		return phone;
	}

	public void setPhone(String phone) {
		this.phone = phone;
	}
	
	

	

}