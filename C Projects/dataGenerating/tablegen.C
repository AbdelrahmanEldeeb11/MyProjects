#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <time.h> 

// Function to generate a random character within a specified ASCII code range
char generateRandomChar(int minAscii, int maxAscii) {
    return (char)(minAscii + rand() % (maxAscii - minAscii + 1));
}
int main() {
     system("clear");

    int ans=0;
    //Displaying menu
    printf("TableGen menu\n");
    printf("-------------\n");
    printf("1. Generate new table\n");
    printf("2. Exit\n");
    printf("Selection:");

   
    scanf("%d", &ans);
    system("clear");
   char proceed;
do{
    if(ans==2){
      
        printf("Goodbye and thanks for using TableGen\n");
         return 0;
    }  
  //Generating new table
    printf("Column Options\n");
    printf("-------------\n");
    printf("1. User ID \t 5.Phone number\n");
    printf("2. First Name \t 6.Email address\n");
    printf("3. Second Name \t 7.SIN\n");
    printf("4. Country \t 8.Password\n");

//Asking the user for column input.
    printf("Enter column list (comma-separated, no spaces):");


    char string[]="";
    char filename[]="hh";
    int count=0;
    scanf("%s", &string);
    int a[8];//MAX 8 columns


    char * token = strtok(string,",");
while(token!=NULL){
    a[count]=atoi(token);
    count++;
    token = strtok(NULL,",");
}

int c;
//Displaying the summary.
printf("\nEnter row count (1 < n < 1M)\n");
scanf("%d",&c);
printf("Enter output file name (no suffix):\n");
scanf("%s", &filename);

printf("summary of properties:\n");
printf("Columns:");
for(int i=0;i<count;i++)
{
    if(i==count-1)
        printf("%d",a[i]);
    else
        printf("%d,",a[i]);
}
printf("\nRow count: %d",c);
strcat(filename,".csv"); 
printf("\nFile name: %s \n",filename);

//Opening all the given files and a helper file.
FILE *file1 = fopen("helper.txt", "w");
FILE *file2 = fopen("countries.txt", "r");
FILE *file3 = fopen("first_names.txt", "r");
FILE *file4 = fopen("last_names.txt", "r");
FILE *file5 = fopen("email_suffixes.txt", "r");
char ch;
char arrayFirst[1000][40];
int x;

//Reading the first names and sorting them.
for(int b = 0;b<1000;b++){
    x=0;
    while((ch=fgetc(file3)) !='\n'){
        arrayFirst[b][x]=ch;
        x++;
    }
}

//Reading the last names and sorting them.
char arrayLast[1000][40];
for(int b = 0;b<1000;b++){
    x=0;
    while((ch=fgetc(file4)) !='\n'){
        arrayLast[b][x]=ch;
        x++;
    }
}

//Reading the countries and sorting them.
char arrayCountries[195][50];
for(int b = 0;b<195;b++){
    x=0;
    while((ch=fgetc(file2)) !='\n'){
        arrayCountries[b][x]=ch;
        x++;
    }
}

//Reading the emails and sorting them.
char arrayEmails[100][50];
for(int b = 0;b<100;b++){
    x=0;
    while((ch=fgetc(file5)) !='\n'){
        arrayEmails[b][x]=ch;
        x++;
    }
}
//Generating random numbers for indexies.
int random1=rand() % 1000;
int random2 =rand() % 1000;
int randomCountry;
int random3;
int random4;
int row=0;
//Putting all the possible first 3 digits of phone numbers.
int nums[]={398, 270, 925, 867, 209, 429, 908, 997,444, 219};

//Organizing the columns as requested from the user.
for(int v = 0;v<count;v++){
    if(a[v]==1){
        fprintf(file1,"User id, ");
    }
    else if(a[v]==2)
        fprintf(file1,"First Name, ");
    else if(a[v]==3)
        fprintf(file1,"Last Name, ");
    else if(a[v]==4)
        fprintf(file1,"Country, ");
    else if(a[v]==5)
        fprintf(file1,"Phone, ");
    else if(a[v]==6)
        fprintf(file1,"Email, ");
    else if(a[v]==7)
        fprintf(file1,"Sin, ");
    else if(a[v]==8)
        fprintf(file1,"Password"); 
    if(v==count-1){
        fprintf(file1,"\n");
    }
}



while(row<c)
{
for(int i=0;i<count;i++)
{
    if(a[i]==1)
        fprintf(file1,"%d",row+1);

    else if(a[i]==2)
    {
        //Writing a random first name.
        random1=rand() % 1000;
        fprintf(file1,arrayFirst[random1]);
    }
    else if(a[i]==3)
    {
        //Writing a random last name.
        random2 =rand() % 1000;
        fprintf(file1,arrayLast[random2]);
    }
    else if(a[i]==4)
    {
        //Writing a random country.
        randomCountry=rand() % 195 +1;
        fprintf(file1,arrayCountries[randomCountry]);
    }
     else if(a[i]==5)
    {
        //Writing a random Phone number.
        random4=rand() % 9000 + 1000 ;
        random3 =rand() % 10;
        fprintf(file1,"%d-",nums[random3]);
        fprintf(file1,"%d",random4);
    }
    else if(a[i]==6)
    {
        //Writing a random email.
        fprintf(file1,"%c",arrayFirst[random1][0]);
        fprintf(file1,arrayLast[random2]);
        fprintf(file1,"%s",arrayEmails[rand() % 100]);
    }
    else if(a[i]==7)
    {
        //Writing a random SIN number.
        long randomSin=rand() % 900000000 + 100000000;
        fprintf(file1,"%ld",randomSin);
    }
    else if(a[i]==8)
    {
        //Creating a random password.
        int passwordLength = 6 + rand() % 11;
        char password[17]; // +1 for the null terminator
        for (int i = 0; i < passwordLength; i++) {
            password[i] = generateRandomChar(32, 126);
            if (password[i] == ',') 
                i--;
            }
        password[passwordLength] = '\0';
        fprintf(file1,"%s",password);
    }
    if(i<count-1){
        fprintf(file1,", ");
}
}
 fprintf(file1,"\n");
row++;
}

fclose(file1);

FILE *file1reads = fopen("helper.txt", "r");
FILE *finalfile = fopen(filename, "w"); //rewriting in a sorted file.
char filearray[row+1][1000];
int som=0;

for(int a1=0;a1<row+1;a1++){
    som=0;
    while((ch=fgetc(file1reads))!='\n'){ //Writing each line in the array.
        filearray[a1][som]=ch;//when ch='\n' the array writes the next row.
        som++;
    }
    if(a1!=row+1)
        filearray[a1][som]='\n';
}

int it =0;
int commas=0;

while((filearray[0][it]!='L')){ //Counting the commas before the last name column to be able to compare the first char of the last name.
    if((filearray[0][it]==',')){
        commas++;
    }
    it++;
    if((filearray[0][it]=='\n')){//if it reaches the end of the column before finding L set commas=-1
        commas=-1;
        break;
    }
}

char temp[1000][120];//Helping 2d array to swap.
int index1 =0;//index[0] of the last name
int index2 =0;//index[0] of the last name in the next row.
int numofcommas;
int colIterator=0;
int m=0;
if(commas!=-1){//If commas is -1, there is no last name.
    for(int k=0;k<row;k++){
        for(int rowIterator=1;rowIterator<row;rowIterator++){
            numofcommas=0;
            colIterator=0;
            while(numofcommas!=commas){//When numofcommas=commas index1 will be set to index[0] of the last name.
                if(filearray[rowIterator][colIterator]==','){
                    numofcommas++;
                }
                colIterator++;
                index1=colIterator+1;
            }

            numofcommas=0;//Setting numofcommas to 0 to enter the next while loop.
            colIterator=0;

            while(numofcommas!=commas){//When numofcommas=commas index2 will be set to index[0] of the last name in the next row.
                if(filearray[rowIterator+1][colIterator]==','){
                    numofcommas++;
                }
                colIterator++;
                index2=colIterator+1;
            }

            numofcommas=0;

//Comparing index[0] of the last name on a row and the one below it.
            if(filearray[rowIterator][index1]>filearray[rowIterator+1][index2]){
                for(int copier=0;copier<120;copier++){
                    temp[rowIterator][copier] = filearray[rowIterator][copier];
                }
//swapping the two rows character by character. This was the only way that did not generate any errors.
                for(int copier=0;copier<120;copier++){
                    filearray[rowIterator][copier] =filearray[rowIterator+1][copier];
                }

                for(int copier=0;copier<120;copier++){
                    filearray[rowIterator+1][copier] =temp[rowIterator][copier];
                }
            }
        }
    }
}

for(int k=0;k<c;k++){//Printing the sorted array to the file.
    fprintf(finalfile,filearray[k]);
}
fclose(finalfile);

printf("\nPress 'c' or 'C' to continue");
char empty;
scanf("%c",&empty);//Getting the \n
scanf("%c",&proceed);//Getting the answer from the user.
}while(( (proceed == 'c') || (proceed == 'C')));//Asking the user to continue.
return 0;
}//End of code.