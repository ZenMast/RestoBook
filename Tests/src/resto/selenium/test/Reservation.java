package resto.selenium.test;

import java.util.List;

import org.openqa.selenium.By;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.Select;
import org.openqa.selenium.support.ui.WebDriverWait;

import com.relevantcodes.extentreports.LogStatus;


public class Reservation extends TestCommon{
	public String date;
	public String time;
	public String guests;
	public String table;
	public String comment;
	
	public Reservation(String date, String time, String guests, String comment ){
		this.date = date;
		this.time = time;
		this.guests = guests;
		this.comment = comment;
	}
	
	public Reservation(String date, String time, String guests, String comment, String table){
		this.date = date;
		this.time = time;
		this.guests = guests;
		this.table = table;
	}
	
	
	public static void makeReservation(User user, Reservation reserv)
	{
		extent.startTest("Make reservation");		
		extent.log(LogStatus.INFO, "Reservation", "Seleted user will make reservation");
        
		try{
			driver.get(testSite);        		
			User.loginWithUser(user);
			
			if (driver.findElements(By.cssSelector("a[href*='table_selection']")).size() > 0)
			{				
				driver.findElement(By.cssSelector("a[href*='table_selection']")).click(); 
				(new WebDriverWait(driver, 10)).until(ExpectedConditions.elementToBeClickable(By.id("reservation-people")));
				
				if(driver.findElements(By.id("reservation-people")).size() > 0)
				{
					extent.log(LogStatus.PASS, "Selecting Table", "Table selection page was opened");
					driver.findElement(By.id("reservation-date")).sendKeys(reserv.getDate());
					driver.findElement(By.id("reservation-time")).sendKeys(reserv.getTime());
					Select select = new Select(driver.findElement(By.id("reservation-tables")));  
					select.selectByIndex(0);
					driver.findElement(By.id("reservation-people")).sendKeys("2");
					driver.findElement(By.className("btn-primary")).click();
				
					(new WebDriverWait(driver, 10)).until(ExpectedConditions.elementToBeClickable(By.id("reservation-comment")));
					
					if(driver.findElements(By.id("reservation-comment")).size() > 0)
					{
						extent.log(LogStatus.PASS, "User details page opening", "Page was succesfully loaded");
						if (driver.findElement(By.id("reservation-name")).getAttribute("value").equals(user.getName()))
							extent.log(LogStatus.PASS, "User details", "Name was prefilled with users name");
						else
							extent.log(LogStatus.FAIL, "User details", "Name was not prefilled with users name, Actual: " + driver.findElement(By.id("reservation-name")).getAttribute("value") + " Expected: " + user.getName());
						
						if (driver.findElement(By.id("reservation-email")).getAttribute("value").equals(user.getEmail()))
							extent.log(LogStatus.PASS, "User details", "Email was prefilled with users email");
						else
							extent.log(LogStatus.FAIL, "User details", " Actual: " + driver.findElement(By.id("reservation-email")).getAttribute("value") + " Expected: " + user.getEmail());
						
						if (driver.findElement(By.id("reservation-phone")).getAttribute("value").equals(user.getPhone()))
							extent.log(LogStatus.PASS, "User details", "Phone was prefilled with users phone");
						else
							extent.log(LogStatus.FAIL, "User details", "Phone was prefilled with users email, Actual: " + driver.findElement(By.id("reservation-phone")).getAttribute("value") + " Expected: " + user.getPhone());
						
						driver.findElement(By.id("reservation-comment")).sendKeys(reserv.getComment());
						
						driver.findElement(By.className("btn-primary")).click();
						
						(new WebDriverWait(driver, 10)).until(ExpectedConditions.elementToBeClickable(By.className("btn-primary")));
						
						List<WebElement> list = driver.findElements(By.xpath("//*[@class='confirmation-list']/li")); 
						
						compareTwoValues(list.get(0).getText(), "Date: " + reserv.getDate(), "Date correctness in confirmation page");
						compareTwoValues(list.get(1).getText(), "Time: " + reserv.getTime(), "Time corretcness in confirmation page");
						compareTwoValues(list.get(2).getText(), "Name: " + user.getName(), "Name correctness in confirmation page");
						compareTwoValues(list.get(3).getText(), "Phone: " + user.getPhone(), "Phone correctness in confirmation page");
						compareTwoValues(list.get(5).getText(), "People: " + reserv.getGuests(), "People correctness in confirmation page");
						compareTwoValues(list.get(6).getText(), "Comment: " + reserv.getComment(), "Comment correctness in confirmation page");
								
						
						driver.findElement(By.className("btn-primary")).click();
					
						(new WebDriverWait(driver, 10)).until(ExpectedConditions.titleContains("booking_finish"));
						
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
		catch(Exception e){
			extent.log(LogStatus.FAIL, "General", "Exception appered" + e.toString());	
		}
		
      
	}
	
	public static void checkReservation(Reservation reservation, User user)
	{
		extent.startTest("Reservation correctness check");
		List<String> result =  TestCommon.connection.sqlQuery("select date, time, people, comment, booking_time from bookings where user_id=" + user.getId());
		compareTwoValues(result.get(0), reservation.getDate(), "Reservation check in DB - Date correctness");
		compareTwoValues(result.get(1).substring(0, result.get(1).length() - 3), reservation.getTime(), "Reservation check in DB - Time correctness");
		compareTwoValues(result.get(2), reservation.getGuests(), "Reservation check in DB - People correctness");
		compareTwoValues(result.get(3), reservation.getComment(), "Reservation check in DB - Comment correctness");
	}


	public String getDate() {
		return date;
	}

	public void setDate(String date) {
		this.date = date;
	}

	public String getTime() {
		return time;
	}

	public void setTime(String time) {
		this.time = time;
	}

	public String getGuests() {
		return guests;
	}

	public void setGuests(String guests) {
		this.guests = guests;
	}

	public String getTable() {
		return table;
	}

	public void setTable(String table) {
		this.table = table;
	}

	public String getComment() {
		return comment;
	}

	public void setComment(String comment) {
		this.comment = comment;
	}

}