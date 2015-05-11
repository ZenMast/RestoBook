package resto.selenium.test;

import java.io.File;
import java.io.IOException;
import java.util.UUID;

import org.openqa.selenium.OutputType;
import org.openqa.selenium.WebDriver;
import org.testng.annotations.AfterMethod;
import org.testng.annotations.BeforeSuite;

import com.relevantcodes.extentreports.DisplayOrder;
import com.relevantcodes.extentreports.ExtentReports;
import com.relevantcodes.extentreports.LogStatus;

import org.openqa.selenium.TakesScreenshot;
import org.openqa.selenium.firefox.FirefoxDriver;

public class TestCommon {
	
	 public static final ExtentReports extent = ExtentReports.get(TestCommon.class); 
	 
	 public static  String reportLocation = "C:/Tests/Reports/";
	 public static  String imageLocation = "C:/Tests/Images/";	 
	 public static WebDriver driver = new FirefoxDriver();
	 public static String testSite = "http://localhost/restobook"; //set up site, localhost or production
	 public static DBConnection connection;

	 public static String getTestSite() {
		return testSite;
	}

	public static void setTestSite(String testSite) {
		TestCommon.testSite = testSite;
	}


	public static File lDir = new File("");
	 public static String absolutePath = lDir.getAbsolutePath();

	 static File folder1 = new File(reportLocation);
 
	 public static String createScreenshot(WebDriver driver) {
		  UUID uuid = UUID.randomUUID();
		  // generate screenshot as a file object
		  File scrFile = ((TakesScreenshot)driver).getScreenshotAs(OutputType.FILE);
		  try {
		   // copy file object to designated location
		   org.apache.commons.io.FileUtils.copyFile(scrFile, new File(reportLocation + imageLocation + uuid + ".png"));
		  } catch (IOException e) {
		   System.out.println("Error while generating screenshot:\n" + e.toString());
		  }
		  return imageLocation + uuid + ".png";
		 }	 
	 
	  @BeforeSuite
	  public static void beforeTestSuite(){	
	   extent.init(reportLocation + "TestReport.html", true, DisplayOrder.BY_OLDEST_TO_LATEST);
	   extent.config().reportHeadline("Test report");
	   extent.config().useExtentFooter(false);
	  }


	 @AfterMethod
	 public static void stop() throws IOException {	 
	     driver.quit();
		 extent.endTest();

	 }
	 
	 public static void compareTwoValues(String actual, String expected, String stepName){		 
		 if (expected.equals(actual))
				extent.log(LogStatus.PASS, stepName, "OK");
		else
				extent.log(LogStatus.FAIL, stepName, "Expected: " + expected + "Actual: " + actual);
			
	 }



}
