# Full stack Laravel Developer Assessment
    
    
## Installation
follow the following commands to get it started:

* git clone https://github.com/Drebakare/codingtest.git
* composer update , to install all the dependencies used in package.json
*mysql database is used for this accessment, so there is a need to migrate all the tables created for this project in to the database
* migrate tables using "php artisan migrate" (after configuring the .env file)

## Documentation

API Documentation
There are 4 internal endppoints and 1 external endpoint for the API

The internal endpoints includes:
* *Create* : post request to;   "servername"/api/v1/books , with *name,Isbn,authors, country, number_of_pages, publisher, release_date for the input post*

*  *Read :* get request to ; "servername"/api/v1/books , without any input
* *Update :* patch request to ; "servername"/api/v1/books , with any of *name,Isbn,authors, country, number_of_pages, publisher, release_date as the input*
* *Delete :* delete request to ; "servername"/api/v1/books/:id . Here, user needs to supply the id of the book to be deleted as an input
* *Show :* get request to ; "servername"/api/v1/books/:id . Here, user needs to supply the id of the book to be displayed as an input

The External endpoints 
* *Get books from Ice and Fire* : get request to;   "servername"/api/external-books , with *name as the only input*

Web Documentation
There are 3 endpoints(Route) to this and it includes:
* *Homepage* : get request to;   "servername"/ , with no input. The page displays  10 or less books available in the database with some action buttons to perform on each.
* *Delete* : get request to;   "servername"/delete-book/:id , with the id of the book being passed as an input. This route deletes a particular book with the book id and returns a message if successfully done.
* *Update* : post request to;   "servername"/update-book/:id , with any of *name,Isbn,authors, country, number_of_pages, publisher, release_date as the input*. This route updates a particular book and returns a message if successfully done.

#### PostMan Collection link
https://www.getpostman.com/collections/c8ed97c0fb505a40573c

## Author
*Bakare Damilare E*
