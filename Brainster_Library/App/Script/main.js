$(document).ready(function () {
    getNewQuote();

    async function getNewQuote() {
        try {
            let fetchQuote = await fetch("http://api.quotable.io/random");
            if (fetchQuote.ok) {
                let quoteData = await fetchQuote.json();
                publishQuoteToPage(quoteData, true);
            }
        } catch (err) {
            publishQuoteToPage(null);
        }
    }

    function publishQuoteToPage(quoteData, status = false) {
        let quoteHTML;
        if (status) {
            quoteHTML = `<q>${quoteData.content}</q><em> - ${quoteData.author}</em>`;
        } else {
            quoteHTML = `Copyright &copy; Vladimir Nachevski`;
        }
        $("#quote").html(quoteHTML);
    }

    $("body").on("click", function (e) {
        e.stopPropagation();
        if (e.target.id != "notificationIcon" && e.target.parentElement.id != "notificationIcon") {
            if (!$("#notificationWindow").hasClass('invisible')) {
                $("#notificationWindow").addClass("invisible");
            }
        }
        const modal = document.querySelector('.ModalWindowForm')
        if (e.target.id == 'editWindow' ||
            e.target.id == 'newBookWindow' ||
            e.target.id == 'newAuthorWindow' ||
            e.target.id == 'newCategoryWindow' ||
            e.target.id == 'commentsWindow' ||
            e.target.id == 'newCommentWindow' ||
            e.target.id == 'myNotes') {
            if ($('.ModalWindowForm').hasClass('show')) {
                hideModalWindow()
            }
        }
    })

    if (localStorage.getItem("notifications")) {
        $("#notificationWindow").removeClass("invisible");
        localStorage.removeItem("notifications")
    }

    // SHOW COMMENTS NOTIFICATION WINDOW
    $("#notificationIcon").on("click", function (event) {
        setTimeout(function () {
            $("#notificationWindow").toggleClass("invisible")
        }, 50)
        if (localStorage.getItem("notifications")) {
            localStorage.removeItem("notifications")
        } else {
            localStorage.setItem("notifications", "active");
        }
    })
    // BUTTONS LISTENERS
    //SHOW COMMENT WINDOW FOR EDITING COMMENTS
    $(".BTN-CommentEdit").on("click", function (e) {
        let activeID = e.target.dataset.id;
        $.get('Processing/API/getComment.php?commentID=' + activeID, function (data) {
            $("#bookName").val(data.title)
            $("#userName").val(data.username)
            $("#newComment").val(data.comment)
            $("#dateCreated").val(data.dateCreated)
            $("#commentForApprove").val(data.id);
        }, 'json')

        showEditWindow()
    })

    $('.BTN-ShowComments').on('click', function () {
        $("#commentsWindow").removeClass("hide")
        setTimeout(function () {
            $("#commentsWindow").addClass("dim")
            $("#commentsWindow .ModalWindowForm").addClass("show")
        }, 50)
    })

    // NEW COMMENT WINDOW
    $('#BTN-newComment').on('click', function () {
        $("#newCommentWindow").removeClass("hide")
        setTimeout(function () {
            $("#newCommentWindow").addClass("dim")
            $("#newCommentWindow .ModalWindowForm").addClass("show")
        }, 50)
    })

    // MODIFY BOOK WINDOW
    $('.BTN-ModifyBook').on('click', function (e) {
        let targetBookID = e.target.dataset.id
        $.get('Processing/API/getBookByID.php?bookID=' + targetBookID,
            function (bookData) {
                $.get('Processing/API/getAuthors.php?authors',
                    function (authorsData) {
                        $.get('Processing/API/getCategories.php?categories',
                            function (categoriesData) {
                                $('#modifyBookForm .selectedBookID').val(bookData.id)
                                $('#modifyBookForm .bookName').val(bookData.title)
                                $('#editWindow .bookImageURL').val(bookData.imgUrl)
                                $('#editWindow .bookCoverIMG').attr('src', bookData.imgUrl);
                                $('#modifyBookForm .bookReleaseYear').val(bookData.releaseYear)
                                $('#modifyBookForm .bookPages').val(bookData.pages)
                                $('#authorID').empty()
                                let authorFound = false;
                                let categoryFound = false;
                                let option;
                                authorsData.forEach((author) => {
                                    if (author.id == bookData.author_id) {
                                        option = `<option name="author_id" value="${author.id}" selected>${author.firstname} ${author.lastname}</option>`;
                                        authorFound = true;
                                    } else {
                                        option = `<option name="author_id" value="${author.id}">${author.firstname} ${author.lastname}</option>`;
                                    }
                                    $('#modifyBookForm .authorID').append(option)
                                })
                                if (!authorFound) {
                                    option = `<option name="author_id" value="0" selected>Please Select</option>`
                                    $('#modifyBookForm .authorID').append(option)
                                }
                                $('#modifyBookForm .bookCategory').empty()
                                categoriesData.forEach((category) => {
                                    let option;
                                    if (category.id == bookData.category_id) {
                                        option = `<option name="category_id" value="${category.id}" selected>${category.categoryName}</option>`;
                                        categoryFound = true
                                    } else {
                                        option = `<option name="category_id" value="${category.id}">${category.categoryName}</option>`;
                                    }
                                    $('#modifyBookForm .bookCategory').append(option)
                                })
                                if (!categoryFound) {
                                    option = `<option name="category_id" value="0" selected>Please Select</option>`
                                    $('#modifyBookForm .bookCategory').append(option)
                                }
                            }, 'json')
                    }, 'json')
            }, 'json')
        showEditWindow()
        $('#editWindow .bookImageURL').on('input', function (e) {
            const coverIMG = $('#editWindow .bookCoverIMG');
            $('#editWindow .bookCoverIMG').attr('src', $('#editWindow .bookImageURL').val());
            coverIMG.on("error", function () {
                $(this).attr('src', './Imgs/errorLoad.jpg');
            });
        })
    })

    function showEditWindow() {
        $("#editWindow").removeClass("hide")
        setTimeout(function () {
            $("#editWindow").addClass("dim")
            $(".ModalWindowForm").addClass("show")
        }, 50)
    }

    // NEW BOOK WINDOW
    $('#BTN-NewBook').on('click', function () {
        const activeWindow = $("#newBookWindow");
        const modalWindow = $(".ModalWindowForm")
        activeWindow.removeClass("hide")
        setTimeout(function () {
            activeWindow.addClass("dim")
            modalWindow.addClass("show")
        }, 50)
        $('#newBookWindow .bookImageURL').on('input', function (e) {
            const coverIMG = $('#newBookWindow .bookCoverIMG');
            coverIMG.attr('src', $('#newBookWindow .bookImageURL').val());
            coverIMG.on("error", function () {
                $(this).attr('src', './Imgs/errorLoad.jpg');
            });

        })
    })

    //WINDOW FOR MODIFYING AUTHOR
    $('.BTN-ModifyAuthor').on('click', function (e) {
        let targetAuthorID = e.target.dataset.id
        const inputFirstName = $('#modifyAuthorForm #authorFirstName')
        const inputLastName = $('#modifyAuthorForm #authorLastName')
        const authorBiography = $('#modifyAuthorForm #authorBiography')
        const authorID = $('#modifyAuthorForm #authorID')

        $.get('Processing/API/getAuthors.php?authorID=' + targetAuthorID, function (data) {
            inputFirstName.val(data.firstname)
            inputLastName.val(data.lastname)
            authorBiography.val(data.shortBiography)
            authorID.val(targetAuthorID)
        }, 'json')
        showEditWindow()
    })

    // NEW AUTHOR WINDOW
    $('#BTN-NewAuthor').on('click', function (e) {
        const activeWindow = $("#newAuthorWindow")
        const modalWindow = $(".ModalWindowForm")
        activeWindow.removeClass("hide")
        setTimeout(function () {
            activeWindow.addClass("dim")
            modalWindow.addClass("show")
        }, 50)
    })

    //MODIFYING CATEGORY WINDOW
    $('.BTN-ModifyCategory').on('click', function (e) {
        let targetAuthorID = e.target.dataset.id
        const categoryName = $('#modifyCategoryForm .categoryName')
        const authorID = $('#modifyCategoryForm #categoryID')

        $.get('Processing/API/getCategories.php?categoryID=' + targetAuthorID, function (data) {
            categoryName.val(data.categoryName)
            authorID.val(data.id)
        }, 'json')
        showEditWindow()
    })

// WINDOW CANCEL BUTTON
    $(".btnCancel").on("click", function (e) {
        hideModalWindow()
    })

    function hideModalWindow() {
        const modalWindow = $(".ModalWindowForm")
        modalWindow.parent().removeClass("dim")
        modalWindow.removeClass("show")
        setTimeout(function () {
            modalWindow.parent().addClass("hide")
        }, 300)
        $('input').removeClass('validateFail')
        $('textarea').removeClass('validateFail')
    }

//     FORMS
//     MODIFY BOOK FORM
    $('#modifyBookForm').submit(function (e) {
        e.preventDefault()
        const bookName = $('#modifyBookForm .bookName');
        const bookImageURL = $('#modifyBookForm .bookImageURL');
        const authorID = $('#modifyBookForm .authorID');
        const bookReleaseYear = $('#modifyBookForm .bookReleaseYear');
        const bookPages = $('#modifyBookForm .bookPages');
        const bookCategory = $('#modifyBookForm .bookCategory');
        const selectedBookID = $('#modifyBookForm .selectedBookID');

        let formData = $('#modifyBookForm');
        $.post("Processing/API/validateInputData.php",
            formData.serialize(), function (data) {
                if (!data.success) {
                    if ('bookName' in data.errors) {
                        bookName.addClass('validateFail')
                        bookName.attr('placeholder', data.errors.bookName)
                    } else {
                        bookName.removeClass('validateFail')
                    }
                    if ('bookImageURL' in data.errors) {
                        bookImageURL.addClass('validateFail')
                        bookImageURL.attr('placeholder', data.errors.bookImageURL)
                    } else {
                        bookImageURL.removeClass('validateFail')
                    }
                    if ('authorID' in data.errors) {
                        authorID.addClass('validateFail')
                        authorID.attr('placeholder', data.errors.authorID)
                    } else {
                        authorID.removeClass('validateFail')
                    }
                    if ('bookReleaseYear' in data.errors) {
                        bookReleaseYear.addClass('validateFail')
                        bookReleaseYear.attr('placeholder', data.errors.bookReleaseYear)
                    } else {
                        bookReleaseYear.removeClass('validateFail')
                    }
                    if ('bookPages' in data.errors) {
                        bookPages.addClass('validateFail')
                        bookPages.attr('placeholder', data.errors.bookPages)
                    } else {
                        bookPages.removeClass('validateFail')
                    }
                    if ('bookCategory' in data.errors) {
                        bookCategory.addClass('validateFail')
                        bookCategory.attr('placeholder', data.errors.bookCategory)
                    } else {
                        bookCategory.removeClass('validateFail')
                    }
                    if ('selectedBookID' in data.errors) {
                        selectedBookID.addClass('validateFail')
                        selectedBookID.attr('placeholder', data.errors.selectedBookID)
                    } else {
                        selectedBookID.removeClass('validateFail')
                    }
                    return false
                }
                formData.unbind('submit').submit()
            }, 'json');
    })

    // NEW BOOK FORM
    $('#newBookForm').submit(function (e) {
        e.preventDefault()
        const bookName = $('#newBookForm .bookName');
        const bookImageURL = $('#newBookForm .bookImageURL');
        const authorID = $('#newBookForm .authorID');
        const bookReleaseYear = $('#newBookForm .bookReleaseYear');
        const bookPages = $('#newBookForm .bookPages');
        const bookCategory = $('#newBookForm .bookCategory');
        const selectedBookID = $('#newBookForm .selectedBookID');

        let formData = $('#newBookForm');
        $.post("Processing/API/validateInputData.php",
            formData.serialize(), function (data) {
                if (!data.success) {
                    if ('bookName' in data.errors) {
                        bookName.addClass('validateFail')
                        bookName.attr('placeholder', data.errors.bookName)
                    } else {
                        bookName.removeClass('validateFail')
                    }
                    if ('bookImageURL' in data.errors) {
                        bookImageURL.addClass('validateFail')
                        bookImageURL.attr('placeholder', data.errors.bookImageURL)
                    } else {
                        bookImageURL.removeClass('validateFail')
                    }
                    if ('authorID' in data.errors) {
                        authorID.addClass('validateFail')
                        authorID.attr('placeholder', data.errors.authorID)
                    } else {
                        authorID.removeClass('validateFail')
                    }
                    if ('bookReleaseYear' in data.errors) {
                        bookReleaseYear.addClass('validateFail')
                        bookReleaseYear.attr('placeholder', data.errors.bookReleaseYear)
                    } else {
                        bookReleaseYear.removeClass('validateFail')
                    }
                    if ('bookPages' in data.errors) {
                        bookPages.addClass('validateFail')
                        bookPages.attr('placeholder', data.errors.bookPages)
                    } else {
                        bookPages.removeClass('validateFail')
                    }
                    if ('bookCategory' in data.errors) {
                        bookCategory.addClass('validateFail')
                        bookCategory.attr('placeholder', data.errors.bookCategory)
                    } else {
                        bookCategory.removeClass('validateFail')
                    }
                    if ('selectedBookID' in data.errors) {
                        selectedBookID.addClass('validateFail')
                        selectedBookID.attr('placeholder', data.errors.selectedBookID)
                    } else {
                        selectedBookID.removeClass('validateFail')
                    }
                    return false
                }
                formData.unbind('submit').submit()
            }, 'json');
    })

// AUTHOR MODIFY FORM
    $('#modifyAuthorForm').submit(function (e) {
        e.preventDefault()
        const authorFirstName = $('#modifyAuthorForm #authorFirstName');
        const authorLastName = $('#modifyAuthorForm #authorLastName');
        const authorBiography = $('#modifyAuthorForm #authorBiography');

        let formData = $('#modifyAuthorForm').serialize();
        $.post("Processing/API/validateInputData.php",
            formData, function (data) {
                if (!data.success) {
                    if ('authorFirstName' in data.errors) {
                        authorFirstName.addClass('validateFail')
                        authorFirstName.attr('placeholder', data.errors.authorFirstName)
                    } else {
                        authorFirstName.removeClass('validateFail')
                    }
                    if ('authorLastName' in data.errors) {
                        authorLastName.addClass('validateFail')
                        authorLastName.attr('placeholder', data.errors.authorLastName)
                    } else {
                        authorLastName.removeClass('validateFail')
                    }
                    if ('authorBiography' in data.errors) {
                        authorBiography.addClass('validateFail')
                        authorBiography.val('')
                        authorBiography.attr('placeholder', data.errors.authorBiography)
                    } else {
                        authorBiography.removeClass('validateFail')
                    }
                    return false
                }
                $('#modifyAuthorForm').unbind('submit').submit()
            }, 'json');
    })

// NEW AUTHOR FORM
    $('#newAuthorForm').submit(function (e) {
        e.preventDefault()
        const authorFirstName = $('#newAuthorWindow #authorFirstName');
        const authorLastName = $('#newAuthorWindow #authorLastName');
        const authorBiography = $('#newAuthorWindow #authorBiography');
        let formData = $('#newAuthorForm');

        $.post("./App/Processing/API/validateInputData.php",
            formData.serialize(), function (data) {
                if (!data.success) {
                    if ('authorFirstName' in data.errors) {
                        authorFirstName.addClass('validateFail')
                        authorFirstName.attr('placeholder', data.errors.authorFirstName)
                    } else {
                        authorFirstName.removeClass('validateFail')
                    }
                    if ('authorLastName' in data.errors) {
                        authorLastName.addClass('validateFail')
                        authorLastName.attr('placeholder', data.errors.authorLastName)
                    } else {
                        authorLastName.removeClass('validateFail')
                    }
                    if ('authorBiography' in data.errors) {
                        authorBiography.addClass('validateFail')
                        authorBiography.attr('placeholder', data.errors.authorBiography)
                    } else {
                        authorBiography.removeClass('validateFail')
                    }
                    return false
                }
                formData.unbind('submit').submit()
            }, 'json');
    })


    // EDIT COMMENT FORM
    $('#modifyCommentForm').submit(function (e) {
        e.preventDefault()
        const commentFor = $('#modifyCommentForm #commentForApprove');
        let formData = $('#modifyCommentForm');

        $.post("Processing/API/validateInputData.php",
            formData.serialize(), function (data) {
                if (!data.success) {
                    if ('commentForApprove' in data.errors) {
                        commentForApprove.addClass('validateFail')
                        commentForApprove.attr('placeholder', data.errors.commentForApprove)
                    } else {
                        commentForApprove.removeClass('validateFail')
                    }
                    return false
                }
                formData.unbind('submit').submit()
            }, 'json');
    })

    // NEW CATEGORY FORM
    $('#newCategoryForm').submit(function (e) {
        e.preventDefault()
        const categoryName = $('#newCategoryForm .categoryName');
        let formData = $('#newCategoryForm');

        $.post("Processing/API/validateInputData.php",
            formData.serialize(), function (data) {
                if (!data.success) {
                    if ('categoryName' in data.errors) {
                        categoryName.addClass('validateFail')
                        categoryName.attr('placeholder', data.errors.categoryName)
                    } else {
                        categoryName.removeClass('validateFail')
                    }
                    return false
                }
                formData.unbind('submit').submit()
            }, 'json');
    })

    // NEW COMMENT FORM
    $('#createCommentForm').submit(function (e) {
        e.preventDefault()
        const comment = $('#createCommentForm #createComment');
        let formData = $('#createCommentForm');

        $.post("App/Processing/API/validateInputData.php",
            formData.serialize(), function (data) {
                if (!data.success) {
                    if ('comment' in data.errors) {
                        comment.addClass('validateFail')
                        comment.attr('placeholder', data.errors.comment)
                    } else {
                        comment.removeClass('validateFail')
                    }
                    return false
                }
                formData.unbind('submit').submit()
            }, 'json');
    })

    // MODIFYING CATEGORY FORM
    $('#modifyCategoryForm').submit(function (e) {
        e.preventDefault()
        const categoryName = $('#modifyCategoryForm .categoryName');
        let formData = $('#modifyCategoryForm');

        $.post("Processing/API/validateInputData.php",
            formData.serialize(), function (data) {
                if (!data.success) {
                    if ('categoryName' in data.errors) {
                        categoryName.addClass('validateFail')
                        categoryName.attr('placeholder', data.errors.categoryName)
                    } else {
                        categoryName.removeClass('validateFail')
                    }
                    return false
                }
                formData.unbind('submit').submit()
            }, 'json');
    })

    // LOGIN BUTTONS
    $('#BTN-Login').on('click', function (e) {
        const activeWindow = $("#loginWindow")
        const modalWindow = $("#loginWindow .ModalWindowForm")
        activeWindow.removeClass("hide")
        setTimeout(function () {
            activeWindow.addClass("dim")
            modalWindow.addClass("show")
        }, 50)
    })

    // NEW CATEGORY WINDOW
    $('#BTN-NewCategory').on('click', function (e) {
        const activeWindow = $("#newCategoryWindow")
        const modalWindow = $(".ModalWindowForm")
        activeWindow.removeClass("hide")
        setTimeout(function () {
            activeWindow.addClass("dim")
            modalWindow.addClass("show")
        }, 50)
    })

    // MY NOTES WINDOW
    $('#BTN-MyNotes').on('click', function (e) {
        const activeWindow = $("#myNotes")
        const modalWindow = $("#myNotes .ModalWindowForm")
        updateNotes()
        activeWindow.removeClass("hide")
        setTimeout(function () {
            activeWindow.addClass("dim")
            modalWindow.addClass("show")
        }, 50)
    })

    // ADD NEW NOTE WINDOW
    $('#BTN-AddNewNote').on('click', function (e) {
        const activeWindow = $("#newNote")
        const modalWindow = $("#newNote .ModalWindowForm")
        $('#createNewNote #createNote').val('');
        activeWindow.removeClass("hide")
        setTimeout(function () {
            activeWindow.addClass("dim")
            modalWindow.addClass("show")
        }, 50)
    })


    // NEW NOTE FORM
    $('#createNewNote').submit(function (e) {
        e.preventDefault()
        const note = $('#createNewNote #createNote');
        let formData = $('#createNewNote');

        $.post("./App/Processing/API/validateInputData.php",
            formData.serialize(), function (data) {
                if (!data.success) {
                    if ('createNote' in data.errors) {
                        note.addClass('validateFail')
                        note.attr('placeholder', data.errors.createNote)
                    } else {
                        note.removeClass('validateFail')
                    }
                    return false
                } else {
                    $.post("./App/Processing/API/myNotes.php",
                        formData.serialize(), function (data) {
                            updateNotes()
                            closeNewNoteWindow()
                        }, 'json');
                }
            }, 'json');
    })
    $('.btnCloseNewNote').on('click', closeNewNoteWindow)

    function closeNewNoteWindow() {
        const activeWindow = $("#newNote")
        const modalWindow = $("#newNote .ModalWindowForm")
        activeWindow.addClass("hide")
        setTimeout(function () {
            activeWindow.removeClass("dim")
            modalWindow.removeClass("show")
        }, 50)
    }

    function closeEditNoteWindow() {
        const activeWindow = $("#EditNote")
        const modalWindow = $("#EditNote .ModalWindowForm")
        activeWindow.addClass("hide")
        setTimeout(function () {
            activeWindow.removeClass("dim")
            modalWindow.removeClass("show")
        }, 50)
    }

    // FUNCTION TO UPDATE NEW NOTES
    function updateNotes() {
        const bookID = $("#newNote #activeBookID").val()
        const notesContainer = $('#myNotes .ModalWindowForm .comments-container');
        let newNote;
        $.get("./App/Processing/API/myNotes.php?bookID=" + bookID, function (notes) {
            if (notes.length != 0) {
                notesContainer.empty();
                notes.forEach((note) => {
                    newNote = `<div class="note p-15 mb-10 border-radius-15">
                            <div>
                                <p>${note.note}</p>
                            </div>
                            <form class="m-0 text-right">
                                <input type="text" value="${note.id}" name="deleteNoteID" hidden>
                                <div data-noteid="${note.id}"  class="BTN-EDITMyNote btn btn-edit">Edit</div>
                                <button data-noteid="${note.id}" type="submit" class="BTN-DeleteMyNote btn btn-danger">Delete</button>
                            </form>
                        </div>`;
                    notesContainer.append(newNote)
                })

                $('.BTN-DeleteMyNote').on('click', function (e) {
                    const noteID = $(this).data('noteid')
                    const form = $(this).parent('form');
                    e.preventDefault();
                    Swal.fire({
                        title: `Are you sure you want to delete this Note?`,
                        text: "You will not be able to recover this!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false,
                        background: '#000000',
                        color: 'white'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.post("./App/Processing/API/myNotes.php", form.serialize(), function (result) {
                                updateNotes();
                            }, 'json');
                        }
                    });
                })
                // Edit NOTE WINDOW
                $('.BTN-EDITMyNote').on('click', function (e) {
                    e.preventDefault()
                    const activeWindow = $("#EditNote")
                    const modalWindow = $("#EditNote .ModalWindowForm")
                    const noteID = $(this).data('noteid')

                    $.get("./App/Processing/API/myNotes.php?noteID=" + noteID, function (notes) {
                        $('#editNote').val(notes.note);
                        $('#selectedNoteID').val(notes.id)
                    }, 'json');

                    activeWindow.removeClass("hide")
                    setTimeout(function () {
                        activeWindow.addClass("dim")
                        modalWindow.addClass("show")
                    }, 50)
                    $('')
                    $('.btnCloseNewNote').on('click', closeEditNoteWindow)

                })
            } else {
                notesContainer.empty()
                const empty = `<div class="d-flex justify-content-center align-items-center h-100 bg-black">
                                        <h2>No notes found for this book!</h2>
                                      </div>`
                notesContainer.append(empty)
            }

        }, 'json');
    }

    $('#EditNoteForm').submit(function (e) {
        e.preventDefault()
        const note = $('#EditNoteForm #editNote');
        let formData = $('#EditNoteForm');

        $.post("./App/Processing/API/validateInputData.php",
            formData.serialize(), function (data) {
                if (!data.success) {
                    if ('createNote' in data.errors) {
                        note.addClass('validateFail')
                        note.attr('placeholder', data.errors.createNote)
                    } else {
                        note.removeClass('validateFail')
                    }
                    return false
                } else {
                    $.post("./App/Processing/API/myNotes.php",
                        formData.serialize(), function (data) {
                            updateNotes()
                            closeEditNoteWindow()
                        }, 'json');
                }
            }, 'json');
    })


    $('#loginForm').submit(function (e) {
        e.preventDefault()
        const username = $('#loginForm .username');
        const password = $('#loginForm .password');
        let formData = $('#loginForm');

        $.post("./App/Processing/API/validateLogin.php",
            formData.serialize(), function (data) {
                if (!data.success) {
                    if ('username' in data.errors) {
                        username.addClass('validateFail')
                        username.val('')
                        username.attr('placeholder', data.errors.username)
                    } else {
                        username.removeClass('validateFail')
                    }
                    if ('password' in data.errors) {
                        password.addClass('validateFail')
                        password.val('')
                        password.attr('placeholder', data.errors.password)
                    } else {
                        password.removeClass('validateFail')
                    }
                    return false
                } else {
                    location.reload();
                }
            }, 'json');
    })

    $('#signupForm').submit(function (e) {
        e.preventDefault()
        const firstName = $('#signupForm .firstName');
        const lastName = $('#signupForm .lastName');
        const username = $('#signupForm .username');
        const password = $('#signupForm .password');
        let formData = $('#signupForm');

        $.post("./App/Processing/API/validateNewUser.php",
            formData.serialize(), function (data) {
                if (!data.success) {
                    if ('firstName' in data.errors) {
                        firstName.addClass('validateFail')
                        firstName.val('')
                        firstName.attr('placeholder', data.errors.firstName)
                    } else {
                        firstName.removeClass('validateFail')
                    }
                    if ('lastName' in data.errors) {
                        lastName.addClass('validateFail')
                        lastName.val('')
                        lastName.attr('placeholder', data.errors.lastName)
                    } else {
                        lastName.removeClass('validateFail')
                    }
                    if (('username' in data.errors)) {
                        username.addClass('validateFail')
                        username.val('')
                        username.attr('placeholder', data.errors.username)
                    } else {
                        username.removeClass('validateFail')
                    }
                    if ('password' in data.errors) {
                        password.addClass('validateFail')
                        password.val('')
                        password.attr('placeholder', data.errors.password)
                    } else {
                        password.removeClass('validateFail')
                    }
                    return false
                } else {
                    location.reload()
                }
            }, 'json');
    })


//     LOGIN BTNS
    $('.login').on('click', function () {
        if (!$('.login').hasClass('active')) {
            $('.login').addClass('active')
            $('.signup').removeClass('active')
            $('#loginForm').removeClass('hide')
            $('#signupForm').addClass('hide')
        }
    })
    $('.signup').on('click', function () {
        if (!$('.signup').hasClass('active')) {
            $('.signup').addClass('active')
            $('.login').removeClass('active')
            $('#signupForm').removeClass('hide')
            $('#loginForm').addClass('hide')
        }
    })

//     FILTERS
    let activeFilters = []

    $('.categoryOption').on('change', function (e) {
        if (!activeFilters.includes(e.target.dataset.categoryname)) {
            activeFilters.push(e.target.dataset.categoryname);
        } else {
            activeFilters.splice(activeFilters.indexOf(e.target.dataset.categoryname), 1);  //deleting
        }

        if (activeFilters.length == 0) {
            resetCards()
        } else {
            resetCards()
            updateCards()
        }
    })

    function resetCards() {
        $('.card-container').removeClass('hide')
    }

    function updateCards() {
        $('.card-container').each(function (i, e) {
            let activeCategory = $(this).data('category')
            if (!activeFilters.includes(activeCategory)) {
                $(this).addClass('hide')
            }
        })
    }
})
// AAAAND THATS IT... :D
