$('.BTN-DeleteBook').on('click', function (e) {
    let bookName = $(this).parents('.inputRow').children('.nameOfBook').text();
    const form = $(this).parent('form');
    e.preventDefault();
    Swal.fire({
        title: `Are you sure you want to delete book: "${bookName}?"`,
        text: "You will not be able to recover this book along with all the comments and user notices!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false,
        background: '#000000',
        color: 'white'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit()
        }
    });
});

$('.BTN-DeleteComment').on('click', function (e) {
    const form = $(this).parent('form');
    e.preventDefault();
    Swal.fire({
        title: `Are you sure you want to delete this comment?`,
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
            form.submit()
        }
    });
});

$('.BTN-DeleteAuthor').on('click', function (e) {
    const form = $(this).parent('form');
    e.preventDefault();
    Swal.fire({
        title: `Are you sure you want to delete this author?`,
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
            form.submit()
        }
    });
});


$('.BTN-DeleteCategory').on('click', function (e) {
    const form = $(this).parent('form');
    e.preventDefault();
    Swal.fire({
        title: `Are you sure you want to delete this Category?`,
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
            form.submit()
        }
    });
});