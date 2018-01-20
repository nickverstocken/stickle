window.$ = window.jQuery = require('jquery');
$('#addBookBtn').click(function () {
    $('#bookModal').css({
        'opacity': '1',
        'z-index': '4'
    });
    $('#bookModalBg').css({
        'opacity': '1',
        'z-index': '1'
    });
});
$('#addChildBtn').click(function () {
    $('#childModal').css({
        'opacity': '1',
        'z-index': '4'
    });
    $('#childModalBg').css({
        'opacity': '1',
        'z-index': '1'
    });
});
var scanner;
window.editBook = function(data) {
       $('#editBookForm #title').val(data.title);
       $('#editBookForm #author').val(data.author);
       $('#editBookForm #description').val(data.shortDescription);
       $('#editBookForm #numberOfPages').val(data.numberOfPages);
       $("#editBookForm").attr('action', '/ouders/boeken/wijzig/'+data.readingBook_id);
    $("#deleteButton").attr('onclick', 'window.location = "/ouders/boeken/verwijder/'+ +data.readingBook_id + '"');

    $('#editbookModal').css({
        'opacity': '1',
        'z-index': '4'
    });
    $('#editbookModalBg').css({
        'opacity': '1',
        'z-index': '1'
    });    
}
window.openBook = function(book_id) {
    console.log(book_id);
    $.get('/ouders/boeken/open/'.book_id, function(data) {
            console.log(data.first);
            //$('#openbookModal#bookTitle').val(data.book.title);
            $('#openbookModal').css({
                'opacity': '1',
                'z-index': '4'
                });
                $('#openbookModalBg').css({
                'opacity': '1',
                'z-index': '1'
            });
        }).fail(function() {
            alert( "Server error" );
    });
    
}
window.openLastPageRead = function(book_id, name, numberOfPages) {
    $('#lastPageText').text('Geef de laatste pagina in die '+name+' heeft gelezen (van in totaal '+numberOfPages+').');
    $('#child_id').val(child_id);
    $('#child_id').val(book_id);

    $('#lastPageReadModal').css({
        'opacity': '1',
        'z-index': '4'
    });
    $('#lastPageReadModalBg').css({
        'opacity': '1',
        'z-index': '1'
    });
    
}
window.editChild = function(data) {
    $('#editKidForm #firstName').val(data.firstName);
    $('#editKidForm #lastName').val(data.lastName);    
    $('#editKidForm #dateOfBirth').val(data.dateOfBirth);
    $("#editKidForm").attr('action', '/ouders/kinderen/wijzig/'+data.child_id);
    $("#deleteButton").attr('onclick', 'window.location = "/ouders/kinderen/verwijder/'+ data.child_id + '"');
    if(data.gender == 'male'){
        $('#editKidForm #maleGender').attr("checked","checked");
    } else{
        $('#editKidForm #femaleGender').attr("checked","checked");;
    }

    $('#editChildModal').css({
        'opacity': '1',
        'z-index': '4'
    });
    $('#editChildModalBg').css({
        'opacity': '1',
        'z-index': '1'
    });
 
}

window.selectChild = function(childId) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    if(scanner){
        scanner.stop();
    }
    $('#children').animate({
       height:600
    }, 200);
    $('.childrenWrap').animate({
        opacity:0,
    },200, function(){
        $('.childrenWrap').css({
           display:'none',
            opacity:0
        });

        $('.childrenWrap .image').css({
            width:'130px',
        height:'130px'
        });


        $('.heading').animate({
            height:0
        });
        $('#child' + childId).animate({
            opacity:1
        }, 200, function(){
            $('.QRscan').addClass('show');
            $('#children').addClass('smaller');
            $('#child' + childId).addClass('childSelected');
        });
        $('.animal-bg').addClass('show');
        $('.backbtn').addClass('show');
    });
    scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
    scanner.addListener('scan', function (content) {
        console.log(content);
        $.post(content,
            { childId: childId}
            )
            .done(function(data) {
                if(data.success){
                    window.location = data.url;
                }else{
                    alert(data.error);
                }
            })
            .fail(function() {
                alert( "not a valid QR code" );
            });
    });
    Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            console.error('No cameras found.');
        }
    }).catch(function (e) {
        console.error(e);
    });

}
window.backChildLogin = function(){
    if(scanner){
        scanner.stop();
    }
    $('#children').css({
        height:'auto'
    });
    $('.childrenWrap').animate({
        opacity:1,
    },200, function(){
        $('.childrenWrap').css({
            display:'block'
        });
        $('#children').removeClass('smaller');
        $('.childrenWrap .image').css({
            width:'170px',
            height:'170px'
        });
        $('.heading').css({
            height:'auto'
        });
            $('.QRscan').removeClass('show');
            $('.childrenWrap').removeClass('childSelected');

        $('.animal-bg').removeClass('show');
        $('.backbtn').removeClass('show');
    });
}
window.loadscanner = function(childId){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    if(scanner){
        scanner.stop();
    }

    $('.QRscan').addClass('show');
    scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
    scanner.addListener('scan', function (content) {
        $.post(content,
            { childId: childId}
        )
            .done(function(data) {
                if(data.success){
                    window.location = data.url;
                }else{
                    alert(data.error);
                }
            })
            .fail(function() {
                alert( "not a valid QR code" );
            });
    });
    Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            console.error('No cameras found.');
        }
    }).catch(function (e) {
        console.error(e);
    });
}
window.closeModal = function($event){
        $('.modalContainer').css({
            'opacity': '0'
        });
        $('.modalBg').css({
            'opacity': '0'
        });
        $('.modalContainer').delay(2000).css({
            'z-index': '-1'
        });
        $('.modalBg').delay(2000).css({
            'z-index': '-1'
        });
    };
window.searchBooks = function(event, child_id){

    delay(function(){
        console.log($(event.target).val());
        var searchVal = $(event.target).val();
        $('#bookSearch' + child_id).empty();
        if(searchVal){
            $.get('/ouders/zoekboeken',
                { searchVal: searchVal}
            )
                .done(function(data) {

                    if(data.success){
                        books = data.books;
                        if(books.length != 0 ){
                            for (index = 0; index < books.length; ++index) {
                                $('#bookSearch' + child_id).append(
                                    `<li>
                                       <div onclick="linkBookToChild(${books[index].readingBook_id}, ${child_id})" ><img src="${books[index].coverPath ? books[index].coverPath : '/images/books/nocover.png'}"></div>
                                       <div onclick="linkBookToChild(${books[index].readingBook_id}, ${child_id})">
                                       <div><h2>${books[index].title}</h2></div>
                                        <div>Auteur : ${books[index].author}</div>
                                         <div>Pagina's : ${books[index].numberOfPages}</div>
                                        </div>
                                        <div class="openBookButton">
                                            <a class="openBookBtn" onclick="openBook(${books[index].readingBook_id})"> <img class="poster" src="/images/icons/view.svg"
                                                                                    alt="Watch Book"></a
                                        </div>
                                    </li>`);
                            }
                        }else{
                            $('#bookSearch' + child_id).append('<li><span>Geen boeken gevonden</span></li>');
                        }

                    }else{
                        alert(data.error);
                    }
                })
                .fail(function() {
                    alert( "Server error" );
                });
        }else{
            $('#bookSearch' + child_id).empty();
        }
    }, 250 );
}
window.linkBookToChild = function(book_id, child_id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    console.log('book_id : ' + book_id);
    console.log('child_id : ' + child_id);
    $.post('/ouders/boeken/linknaarkind',
        { childId: child_id, bookId: book_id}
    )
        .done(function(data) {
            if(data.success){
                document.location.reload();
            }else{
                alert(data.error);
            }
        })
        .fail(function() {
            alert( "Something went wrong!" );
        });
}
window.removeBookLink = function(event,childrenReadingBook_id){
    event.preventDefault();
///ouders/boeken/verwijderLink/{childrenReadingBook_id}
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.post('/ouders/boeken/verwijderLink/' + childrenReadingBook_id)
        .done(function(data) {
            if(data.success){
                console.log(data);
                document.location.reload();
            }else{
                alert(data.error);
            }
        })
        .fail(function() {
            alert( "Something went wrong!" );
        });
}
var delay = (function(){
    var timer = 0;
    return function(callback, ms){
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
    };
})();
window.checkCanBuyPrice = function(childId, coins,rewardId, price){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $.post('/kind/koopprijs',
            { childId: childId, rewardPrice: price, rewardId: rewardId}
        )
            .done(function(data) {
                if(data.success){
                    window.location = data.url;
                }else{
                    alert(data.error);
                }
            })
            .fail(function() {
                alert( "Something went wrong!" );
            });

}
window.showKeyPad = function(event){
    $('.parentcode').toggleClass('show');
}
