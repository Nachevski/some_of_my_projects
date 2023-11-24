const inputForm = document.forms["bookInputs"];
const booksTable = document.getElementById("booksTable");
let books = [];

// LISTENER FOR SUBMIT BUTTON
inputForm.addEventListener("submit", createNewBook);

// CREATING ARRAY OF OBJECTS AND PRINT THEM
const booksList = document.querySelector(".booksList");
books.push(new Book("The Lord of the Rings", "J.R.R. Tolkien", 155, 250));
books.push(new Book("The Great Gatsby", "F. Scott Fitzgerald", 495, 495));
books.push(new Book("To Kill a Mockingbird", "Harper Lee", 136, 680));
books.push(new Book("The Diary Of A Young Girl", "Anne Frank", 500, 500));
books.push(new Book("The Hobbit", "J.R.R. Tolkien", 380, 510));
books.forEach((book, index) => {
  insertInList(book);
  insertInTable(book);
});

function insertInList(book) {
  booksList.innerHTML += book.appendBookToList();
}

function insertInTable(book) {
  booksTable.innerHTML += book.appendBookToTable();
}

// GETTING VALUES FROM FORM AFTER SUBMIT AND CREATING NEW OBJECT
function createNewBook(e) {
  e.preventDefault();
  let title = this.title.value;
  let author = this.author.value;
  let onPage = parseInt(this.onPage.value);
  let maxPage = parseInt(this.maxPage.value);

  if (validateData(title, author, onPage, maxPage)) {
    let newBook = new Book(title, author, onPage, maxPage);
    books.push(newBook);
    insertInList(newBook);
    insertInTable(newBook);
  } else {
    alert("You have some validation errors in inputs, Try Again");
  }
  resetFields();
}

// RESETING INPUTS
function resetFields() {
  document.querySelectorAll("input").forEach((input) => {
    input.value = "";
  });
}

// VALIDATING INPUT DATA
function validateData(title, author, onPage, maxPage) {
  if (title != "" && author != "" && !isNaN(onPage) && !isNaN(maxPage) && maxPage >= onPage) return true;
  return false;
}
