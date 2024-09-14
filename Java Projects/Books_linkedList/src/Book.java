// -----------------------------------------------------
// Assignment3
// Written by: (Ali Eldeeb 40237796 AND AbdelRahman ELdeeb 40245477)
// -----------------------------------------------------
import java.io.Serializable;
/**
 * Represents a book with various properties such as title, author, price, ISBN, genre, and year.
 * This class implements the Serializable interface, making instances of this class serializable.
 */
public class Book implements Serializable{
	
	public String title;  /** The title of the book. */
	public String author; /** The name of the author. */
	public double price;  /** The price of the book. */
	public long ISBN;     /** The International Standard Book Number. */
	public String genre;  /** The genre of the book. */
	public int year;      /** The year of publication. */
	
	public Book(){}/** Default constructor - creates an empty Book object with default values. */ 
	 /**
     * Parameterized constructor - creates a Book object with provided values for each property.
     *
     * @param title  The title of the book.
     * @param author The name of the author.
     * @param price  The price of the book.
     * @param ISBN   The International Standard Book Number.
     * @param genre  The genre of the book.
     * @param year   The year of publication.
     */
	public Book(String title,String author,double price,long ISBN,String genre,int year)
	{  // Assigning the provided values to the corresponding properties of the Book object.
		this.title=title;
		this.author=author;
		this.price=price;
		this.ISBN=ISBN;
		this.genre=genre;
		this.year=year;	
	}
	public void setYear(int year) {   /**
	     * Sets the year of publication for the book.
	     *
	     * @param year The year of publication.
	     */
		this.year=year;
	}
	 /**
     * Returns a string representation of the Book object.
     *
     * @return A string containing the title, author, price, ISBN, genre, and year of the book.
     */
	public String toString()
	{
		return title+" "+author+" "+price+" "+ISBN+" "+genre+" "+year;
	}
	
}
	
