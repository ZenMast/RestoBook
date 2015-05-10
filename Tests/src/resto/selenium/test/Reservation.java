package resto.selenium.test;


import org.openqa.selenium.By;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.Select;
import org.openqa.selenium.support.ui.WebDriverWait;

import com.relevantcodes.extentreports.LogStatus;


public class Reservation extends  TestCommon{
	   
	public static void makeReservation(User user)
	{
		extent.startTest("Making reservation");				
		extent.log(LogStatus.INFO, "Reservation", "Predifined user will make reservation in restoraunt for tomorrow");  
        
		driver.get(testSite);        		
		User.loginWithUser(user);
		
		if (driver.findElements(By.cssSelector("a[href*='table_selection']")).size() > 0)
		{				
			driver.findElement(By.cssSelector("a[href*='table_selection']")).click(); 
			(new WebDriverWait(driver, 10)).until(ExpectedConditions.elementToBeClickable(By.id("reservation-people")));
			
			if(driver.findElements(By.id("reservation-people")).size() > 0)
			{
				extent.log(LogStatus.PASS, "Selecting Table", "Table selection page was opened");
				driver.findElement(By.id("reservation-date")).sendKeys("2020-05-11");
				driver.findElement(By.id("reservation-time")).sendKeys("21:30");
				Select select = new Select(driver.findElement(By.id("reservation-tables")));  
				select.selectByIndex(0);
				driver.findElement(By.id("reservation-people")).sendKeys("2");
				driver.findElement(By.className("btn-primary")).click();
			
				(new WebDriverWait(driver, 10)).until(ExpectedConditions.elementToBeClickable(By.id("reservation-comment")));
				
				if(driver.findElements(By.id("reservation-comment")).size() > 0)
				{
					extent.log(LogStatus.PASS, "User details page opening", "Page was succesfully loaded");
					if (driver.findElement(By.id("reservation-name")).getText() == user.getName())
						extent.log(LogStatus.PASS, "User details", "Name was prefilled with users name");
					else
						extent.log(LogStatus.FAIL, "User details", "Name was not prefilled with users name, it was: " + driver.findElement(By.id("reservation-name")).getText());
					
					if (driver.findElement(By.id("reservation-email")).getText() == user.getEmail())
						extent.log(LogStatus.PASS, "User details", "Name was prefilled with users email");
					else
						extent.log(LogStatus.FAIL, "User details", "Name was not prefilled with users email");
					
					if (driver.findElement(By.id("reservation-phone")).getText() == user.getPhone())
						extent.log(LogStatus.PASS, "User details", "Name was prefilled with users phone");
					else
						extent.log(LogStatus.FAIL, "User details", "Name was not prefilled with users phone");
					
					driver.findElement(By.id("reservation-comment")).sendKeys("Test");
					
					driver.findElement(By.className("btn-primary")).click();
					
					new WebDriverWait(driver, 10);
					
					//if (driver.findElements(By.cssSelector(": 2015-05-08")).size() > 0 )
						//extent.log(LogStatus.PASS, "Confirmation details", "Correct date is shown");
					//else
						//extent.log(LogStatus.FAIL, "Confirmation details", "Incorrect date is shown");
					
					//if (driver.findElements(By.cssSelector(": 22:27")).size() > 0 )
						//extent.log(LogStatus.PASS, "Confirmation details", "Correct time is shown");
					//else
						//extent.log(LogStatus.FAIL, "Confirmation details", "Incorrect time is shown");
					
					driver.findElement(By.className("btn-primary")).click();
				
					new WebDriverWait(driver, 10);
					
					//if (driver.findElements(By.cssSelector("Your booking is done.Thank you for choosing KVN!")).size() > 0 )
						//extent.log(LogStatus.PASS, "Booking finishing", "Passed, confirmation shown");
					//else
						//extent.log(LogStatus.FAIL, "Booking finishing", "Confirmation not shown");
				}
				
				else
					extent.log(LogStatus.FAIL, "User details page opening", "Page ws not loaded");
		
				
			}
			else
				extent.log(LogStatus.FAIL, "Selecting Table", "Table selection page was not opened");
				
				
		}
		else
			extent.log(LogStatus.INFO, "Selecting Restoraunt", "No restaurants were found in min page"); 
		
      
	}
	
	public void checkReservation()
	{
		
	}

}