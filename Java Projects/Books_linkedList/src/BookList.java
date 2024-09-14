// -----------------------------------------------------
// Assignment3
// Written by: (Ali Eldeeb 40237796 AND AbdelRahman ELdeeb 40245477)
// -----------------------------------------------------
import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.util.ArrayList;
import java.util.LinkedList;
public class BookList extends Book{
	
	// Nested class representing a node in the circular linked list
	private class node{
		private Book b;
		private node next;
		public node(Book b,node next) {
			this.b = b;
			this.next = next;
		}
		public node(Book b) {
			this.b = b;
			next = null;
		}
		public node() {}
		}
	
	
	node head;	// Reference to the head node of the circular linked list
	
	public BookList()  // Constructor to initialize the BookList
	{
		head = null;
	}
	
	
	
	public void addToStart(Book b) // Method to add a new Book node at the start of the list
	{
	
		 node newNode = new node(b);
	        if (head == null) {
	            head = newNode;
	            head.next = head; // Circular reference
	        } else {
	            newNode.next = head.next;
	            head.next = newNode; 
	        }
		
	}
	
	
	  // Method to store records of a specific year in a file
	public void storeRecordsByYear(int yr) {
        node current = head;
        boolean foundRecords = false;

        try {
            FileWriter writer = new FileWriter(yr + ".txt");

            do {
                if (current.b.year == yr) {   
                	// Writing book details to the file for the specified year
                    writer.write(current.b.title + " , ");
                    writer.write(current.b.author + " , ");
                    writer.write(current.b.price + " , ");
                    writer.write(current.b.ISBN + " , ");
                    writer.write(current.b.genre + " , ");
                    writer.write(current.b.year + ", \n");
                    foundRecords = true;
                }
                current = current.next;
            } while (current != head);

            writer.close();
        } catch (IOException e) {
        	System.out.println("IOException");
        }
        if (!foundRecords) {
            System.out.println("No records found for year " + yr);
        }
    }
	
	
	
	  // Method to insert a new Book node before a node with a given ISBN
	public boolean insertBefore(long ISBN, Book b)
	 {
        node newNode = new node(b);

        if (head == null) {
            // If the list is empty, cannot insert before any node.
            return false;
        }

        node current = head;
        node prev = null;

        do {
            if (current.b.ISBN == ISBN) {
                if (prev == null) {
                    // If the node to insert before is the head, update head and newNode's next.
                    newNode.next = head;
                    head = newNode;
                } else {
                    // Insert newNode before the current node.
                    prev.next = newNode;
                    newNode.next = current;
                }
                return true;
            } prev = current;
            current = current.next;
        } while (current != head);

        // If ISBN is not found, return false.
        return false;
    }
	
	
	 // Method to insert a new Book node between two nodes with given ISBNs
	public boolean insertBetween(long ISBN1,long ISBN2, Book b)
	 {
        node newNode = new node(b);

        if (head == null) {
            // If the list is empty, cannot insert before any node.
            return false;
        }

        node current = head;
        node prev = null;

        do {
            if (current.b.ISBN == ISBN2) {
                if (prev.b.ISBN == ISBN1) {
                    // Insert newNode before the current node.
                    prev.next = newNode;
                    newNode.next = current;
                }
                return true;
            } prev = current;
            current = current.next;
        } while (current != head);

        // If ISBN is not found, return false.
        return false;
    }
	

	
	// Method to display the contents of the BookList
	 public void displayContent() {
	        if (head == null) {// If the list is empty, cannot insert before any node.
	            System.out.println("The list is empty.");
	            return;
	        }

	        node current = head;
	        do {
	            System.out.println(current.b.title+", " +current.b.author+", " 
	        +current.b.price+", " +current.b.ISBN+", " +current.b.genre+", " +current.b.year +" ==> ");
	            current = current.next;
	        } while (current != head);  
	    }
	 // Method to delete consecutive repeated records in the list
		public boolean delConsecutiveRepeatedRecords()
		{
			boolean key=false;
			  if (head == null)
			  {  
		            System.out.println("The list is empty.");
		            return false;
		      }
			  node current = head;
			  node current2=null;
			  do { // Insert newNode before the current node.
				 current2=current;
				 current=current.next;
				 
				  if((current.b.ISBN==current2.b.ISBN) && (current.b.year == current2.b.year) && (current.b.price == current2.b.price) &&(current.b.author.equalsIgnoreCase(current2.b.author)) &&(current.b.genre.equalsIgnoreCase(current2.b.genre)))
				  {
					  current2.next=current.next;
					  key=true;
				  }

			  }while(current!=head);  
			  return key;
		}
		
		
		public BookList extractAuthList(String aut) {
			BookList bookOfAuther = new BookList();
			  if (head == null)
			  {  
		            System.out.println("The list is empty.");
		      }
			  node current = head;
			  do {
				 //current=current.next;
				 
				  if(current.b.author.equalsIgnoreCase(aut))
				  {
					 bookOfAuther.addToStart(current.b);
				  }
				  current=current.next;
				  
			  }while(current!=head); 
			 return bookOfAuther;
		}
			
			
		public boolean swap(long ISBN1, long ISBN2)
		{  
			
		node prev1 = null;
		node current1 = head;
		
		while(current1 != null && current1.b.ISBN != ISBN1) {
			prev1 = current1;
			current1=current1.next;
		}
		node prev2 = null;
		node current2 = head;
		
		while(current2 != null && current2.b.ISBN != ISBN2) {
			prev2 = current2;
			current2=current2.next;
		}
		
		if(current1 == null || current2 == null)
			return false;
		if(prev1 != null) {
			prev1.next=current2;
		}
		else {
			head = current2;
		}
		if(prev2 != null) {
			prev2.next=current1;
		}
		else {
			head = current1;
		}
			node temp =current1.next;
			current1.next=current2.next;
			current2.next=temp;
			
			return true;
	
		}
		
			
			
		}
		
		
		
	

