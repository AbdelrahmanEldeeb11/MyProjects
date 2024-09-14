// -----------------------------------------------------
//Comp 249
// Assignment3
// Written by: (Ali Eldeeb 40237796 AND AbdelRahman ELdeeb 40245477)
// -----------------------------------------------------
import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.io.ObjectOutputStream;
import java.util.ArrayList;
import java.io.BufferedWriter;
import java.io.FileOutputStream;
import java.util.LinkedList;
import java.util.Scanner;
public class DriverAssignment {

	public static void main(String[] args) {
		 // Declaration of variables and data structures
		BufferedReader Reader;
		ArrayList<Book> errorlist= new ArrayList<>();
		LinkedList<Book> correctlist = new LinkedList<>();
		BookList bookList = new BookList();
		
		try {
			   // Reading data from a file and processing it line by line
			Reader = new BufferedReader(new FileReader("Books.txt"));
			
						
			String Line;
			while((Line = Reader.readLine())!=null)
				{
				  // Extracting data from the line and creating Book objects
				 String[] data = Line.split(",");
				 String title,name,letters;
				 double price;
				 long serial;
				 int year;
				 if(data.length==6)
				 {
					 title = data[0].trim();
					 name = data[1].trim();
					 price = Double.parseDouble(data[2].trim());
					 serial = Long.parseLong(data[3].trim());
					 letters = data[4].trim();
					 try {
						 year = Integer.parseInt(data[5].trim());
						 if(year<1900 || year>2023)
						 { 
							 Book b=new Book(title,name,price,serial,letters,year);
							 errorlist.add(b);
				        	 throw new incorrectYear("Incorrect year.....");
						 }else {
							 Book b=new Book(title,name,price,serial,letters,year);
							 correctlist.add(b);
							 bookList.addToStart(b);
						 }
						 
					 }catch(incorrectYear e)
						 {  // Exception handling for incorrect year
							 System.out.print("");
						 }	 
					 }
				 
				 
				 
				  }
			
		} catch (FileNotFoundException e) {
			System.out.println("FileNotFoundException.");
			
		} catch (IOException e) {
			System.out.println("IOExcepection.");
		}
		System.out.println("DIPLAYING CONTENT AFTER STORING THE BOOKLIST\n");
	    
		bookList.displayContent();  // Displaying the contents of the bookList
	
		  // Converting the errorlist to an array and storing it in a file
		Book []bees= new Book[errorlist.size()]; 
		errorlist.toArray(bees);
		showListDetails(errorlist);
	
		try {
			BufferedWriter errors = new BufferedWriter(new FileWriter("YearErr.txt"));
			String h;
			
			for(int i=0;i<errorlist.size();i++)
				{
				   // Writing each Book object in the errorlist to the file
				 h = "" + bees[i];
					errors.write(h);
					errors.newLine();
				}
			errors.close();  // Closing the error file writer
		} catch (IOException e) {
			e.printStackTrace();
		}
		Scanner kb = new Scanner(System.in);
		boolean end=false;
		/**
		 * Process user commands using a loop until the user chooses to stop.
		 * The loop displays a list of options and executes the corresponding action based on user input.
		 */
		while(end!=true)  
		{
			System.out.println("\n \n Here is the list of options:");
			System.out.println("1) Give me a year# and I will extract all the records from that year and store them in a file for that year.");
			System.out.println("2) Ask me to delete all consecutive records.");
			System.out.println("3) Give me an author name and I will create a new list with the records of the author and display them.");
			System.out.println("4) Give me an ISBN number and a Book object, and I will insert Node with the book before the record with this ISBN");
			System.out.println("5) Give me 2 ISBN numbers and a Book object, and I will insert a Node between them, if I find them! ");
			System.out.println("6) Give me 2 ISBN and i will swap them in the list for rearrangement of records; of if they exist!");
			System.out.println("7) Tell me to STOP TALKING.");
			System.out.println("Enter option number:");
			int op=kb.nextInt();
			if(op==1) // Option 1: Extract records from a specific year and store them in a file
			{
				System.out.println("Enter year number: ");
				int yr=kb.nextInt();
				bookList.storeRecordsByYear(yr);
				System.out.println("File "+yr+".txt has been created \n");
			}
			else if(op==2) // Option 2: Delete all consecutive records with the same data
			{
				bookList.delConsecutiveRepeatedRecords();
				System.out.println("DISPLAYING CONTENT AFTER USING delConsecutiveRepeatedRecords!!! \n");
				bookList.displayContent();
			}
			else if(op==3) // Option 3: Create a new list with records of a specific author and display them
			{
				System.out.println("Enter author name: ");
				String h =kb.nextLine();
				String ath=kb.nextLine();
				System.out.println("Displaying content of the author ");
				bookList.extractAuthList(ath).displayContent();
				System.out.println();	
			}
			else if(op==4)  // Option 4: Insert a new Book object before a record with a specific ISBN
			{
				  // ... (code to read and create Book object from user input)
				System.out.println("Enter Isbn for the method: ");
				long isbn=kb.nextLong();
				
				System.out.println("Enter the fields of the book: ");
				System.out.println("Enter book title (String): ");
				String f = kb.nextLine();
				String tit=kb.nextLine();
				System.out.println("Enter author name (String): ");
				String nam=kb.nextLine();
				System.out.println("Enter book's price (double): ");
				double pri=kb.nextDouble();
				System.out.println("Enter ISBN for the book (long): ");
				long isbnBook=kb.nextLong();
				System.out.println("Enter genre (String): ");
				String f2 = kb.nextLine();
				String gen=kb.nextLine();
				System.out.println("Enter book's year (int): ");
				int yer=kb.nextInt();
				Book bull=new Book(tit,nam,pri,isbnBook,gen,yer);
				bookList.insertBefore(isbn, bull);
				System.out.println("DISPLAYING CONTENT AFTER USING INSERTBEFORE!!! \n");
				bookList.displayContent();	
			}
			else if(op==5)// Option 5: Insert a new Book object between two records with specific ISBNs
			{
				 // ... (code to read and create Book object from user input)
				System.out.println("Enter Isbn1 for the method: ");
				long isbn1=kb.nextLong();
				System.out.println("Enter Isbn2 for the method: ");
				long isbn2=kb.nextLong();
				System.out.println("Enter the fields of the book: ");
				System.out.println("Enter book title (String): ");
				String f = kb.nextLine();
				String tit=kb.nextLine();
				System.out.println("Enter author name (String): ");
				String nam=kb.nextLine();
				System.out.println("Enter book's price (double): ");
				double pri=kb.nextDouble();
				System.out.println("Enter ISBN for the book (long): ");
				long isbnBook=kb.nextLong();
				System.out.println("Enter genre (String): ");
				String f2 = kb.nextLine();
				String gen=kb.nextLine();
				System.out.println("Enter book's year (int): ");
				int yer=kb.nextInt();
				
				Book bull=new Book(tit,nam,pri,isbnBook,gen,yer);
				
				bookList.insertBetween(isbn1, isbn2, bull);
				System.out.println("DISPLAYING CONTENT AFTER USING INSERTBETWEEN!!! \n");
				bookList.displayContent();
			}
			else if(op==6)  // Option 6: Swap the positions of two records with specific ISBNs
			{
				 // ... (code to read and create Book object from user input)
				System.out.println("Enter Isbn1 for the method: ");
				long isbn1=kb.nextLong();
				System.out.println("Enter Isbn2 for the method: ");
				long isbn2=kb.nextLong();
				
				bookList.swap(isbn1, isbn2);
				System.out.println("DISPLAYING CONTENT AFTER USING SWAP METHOD!!! \n");
				bookList.displayContent();
			}
			else if(op==7) // Option 7: terminating the program
			{
				System.out.println("The program has terminated!");
				System.exit(0);
			}
			
			
			System.out.println("Do you want to continue: yes or no");
			String answer=kb.next();
			if(answer.equalsIgnoreCase("YES"))
			{
				end=false;
			}
			else
				end=true;
				
			
			
		}
		System.out.println("The program has terminated!");
		
		
	
}

	
	

public static void showListDetails(ArrayList<Book> al)  // Method to display details of books in an ArrayList
{
	int i = 0;
	System.out.println("\nDisplaying the content of the arraylist with the incorrect year");
	for(Book c : al)
	{
		System.out.println("\nHere is the information of the Book at index #: " + i++);
		System.out.println("================================================");
		System.out.println(c);
	}
}




}