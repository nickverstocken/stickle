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
$('.next').click(function(){
    var far = $( '.scrollcontainer' ).width() - 30;
    var pos = $('.scrollcontainer').scrollLeft() + far;
    $('.scrollcontainer').animate( { scrollLeft: pos }, 500 );
});
$('.prev').click(function(){
    var far = $( '.scrollcontainer' ).width() - 30;
    var pos = $('.scrollcontainer').scrollLeft() - far;
    $('.scrollcontainer').animate( { scrollLeft: pos }, 500 );
});
var scanner;
window.editBook = function(data) {
       $('#editBookForm #title').val(data.title);
       $('#editBookForm #author').val(data.author);
       $('#editBookForm #description').val(data.shortDescription);
       $('#editBookForm #numberOfPages').val(data.numberOfPages);
       $("#editBookForm").attr('action', '/ouders/boeken/wijzig/'+data.readingBook_id);
    $("#deleteButton").attr('onclick', 'window.location = "/ouders/boeken/verwijder/'+ +data.readingBook_id + '"');
    $('#editBookForm #imgBook').attr('src', data.coverPath ? data.coverPath : '/images/books/nocover.png');
    $('#editbookModal').css({
        'opacity': '1',
        'z-index': '4'
    });
    $('#editbookModalBg').css({
        'opacity': '1',
        'z-index': '1'
    });    
}
window.handleInputChange = function(event){
    console.log('input changed');
    const file = event.dataTransfer ? event.dataTransfer.files[0] : event.target.files[0];

    const pattern = /image-*/;
    if (!file.type.match(pattern)) {
        showError('Upload fout', 'Alleen afbeeldingen uploaden a.u.b.');
        return;
    }
    $('.inputImage').animate({
        opacity:0
    }, 200);
    const reader = new FileReader();
    reader.onload = _handleReaderLoaded.bind(this);
    reader.readAsDataURL(file);
}
function _handleReaderLoaded(e) {
    const reader = e.target;
    $('.inputImage').attr('src',reader.result );
    $('.inputImage').animate({
        opacity:1
    }, 500);
}
window.openBook = function(book) {
    console.log(book);
    $('#openbookModal').css({
        'opacity': '1',
        'z-index': '4'
    });
    $('#openbookModalBg').css({
        'opacity': '1',
        'z-index': '1'
    });
    $('#openbookModal #bookTitle').text(book.title);
    $('#openbookModal #bookTitletext').text('Titel : ' + book.title);
    $('#openbookModal #author').text('Auteur : ' + book.author);
    $('#openbookModal #pages').text("Aantal pagina's : " + book.numberOfPages);
    $('#openbookModal #description').text(book.shortDescription);
    $('#openbookModal #bookImage').attr('src', book.coverPath ? book.coverPath : '/images/books/nocover.png');

}
window.openLastPageRead = function(book, name) {
   $('#lastPageText').text('Geef de laatste pagina in die '+ name +' heeft gelezen (van in totaal '+ book.book.numberOfPages+').');
    $('#lastPageReadModal #bookTitle').text(book.book.title);

    $('#lastPageReadModal').css({
        'opacity': '1',
        'z-index': '4'
    });
    $('#lastPageReadModalBg').css({
        'opacity': '1',
        'z-index': '1'
    });
    $("#changeLastPage").attr('onclick', `changeLastPageRead(${book.childrenReadingBook_id})`);
}
window.changeLastPageRead = function(childrenReadingBook_id) {
    var lastpage = $('#lastPageReadModal #newLastPageRead').val();
    var childrenReadingBookId = childrenReadingBook_id;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.post('/ouders/boeken/veranderlaatstepagina/',
        { last_page: lastpage, childReadingBookId: childrenReadingBookId}
    )
        .done(function(data) {
            if(data.success){
               document.location.reload();
            }else{
                showError('Pagina fout', data.error);
            }
        })
        .fail(function(erorr) {
            showError('Pagina fout','Er is iets msigelopen probeer het mlater opnieuw');
        });
}
window.editChild = function(data) {
    $('#editKidForm #firstName').val(data.firstName);
    $('#editKidForm #lastName').val(data.lastName);    
    $('#editKidForm #dateOfBirth').val(data.dateOfBirth);
    $('#editKidForm #imgChild').attr('src', data.picturePath ? data.picturePath : '/images/kids/defaultprofile-1.png');
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
                   showError('Login error', data.error);
                }
            })
            .fail(function() {
                showError('Login error',"not a valid QR code");
            });
    });
    Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            showError('Camera fout', "Geen camera's gevonden");
        }
    }).catch(function (e) {
        showError('Camera fout', e);
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
                    showError('Sticker fout', data.error);
                }
            })
            .fail(function() {
                showError('Sticker fout', "Geen geldig QR code...");
            });
    });
    Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            showError('Camera fout', "Geen camera gevonden...");
        }
    }).catch(function (e) {
        showError('Camera fout', e);
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
window.closeError = function($event){
    $('.errorContainer').css({
        'opacity': '0'
    });
    $('.errorModalBg').css({
        'opacity': '0'
    });
    $('.errorContainer').delay(2000).css({
        'z-index': '-1'
    });
    $('.errorModalBg').delay(2000).css({
        'z-index': '-1'
    });
};
window.searchBooks = function(event, child_id){

    delay(function(){
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
                                            <a id="openBook${index}" class="openBookBtn"> <img class="poster" src="/images/icons/view.svg"
                                                                                    alt="Watch Book"></a
                                        </div>
                                    </li>`);
                                var element = document.getElementById('openBook' + index);
                               element.onclick = function() {
                                   openBook(books[this.id.split('openBook')[1]]);
                               }
                            }
                        }else{
                            $('#bookSearch' + child_id).append('<li><span>Geen boeken gevonden</span></li>');
                        }

                    }else{
                        showError('Boeken fout', data.error);
                        alert(data.error);
                    }
                })
                .fail(function() {
                    showError('Boeken fout', "Er ging iets mis ");
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
    $.post('/ouders/boeken/linknaarkind',
        { childId: child_id, bookId: book_id}
    )
        .done(function(data) {
            if(data.success){
                document.location.reload();
            }else{
                showError('Boeken link fout', data.error);
            }
        })
        .fail(function() {
            showError('Boeken link fout', "Er ging iets mis probeer het later opnieuw...");
        });
}
window.removeBookLink = function(event,childrenReadingBook_id){
    event.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.post('/ouders/boeken/verwijderLink/' + childrenReadingBook_id)
        .done(function(data) {
            if(data.success){
                document.location.reload();
            }else{
                showError('Boeken link fout', data.error);
            }
        })
        .fail(function() {
            showError('Boeken link fout', "Er ging iets mis probeer het later opnieuw...");
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
                    showError('Koop prijs fout', data.error);
                }
            })
            .fail(function() {
                showError('Boeken link fout', "Er ging iets mis probeer het later opnieuw...");
            });

}
window.showKeyPad = function(event){
    $('.parentcode').toggleClass('show');
    $('.backgroundAnimalsCode').toggleClass('show');
    $('#keycode').toggleClass('show');
};
window.showRegisterKeyPad = function(event){
    if( $("#firstname").val() && $("#lastname").val() && $("#email").val() && $("#password").val() && $("#password_comfirmation").val()) {
        $('.parentcode').toggleClass('show');
        $('#keycode').toggleClass('show');
        $('.backgroundAnimalsCode').toggleClass('show');
    } else{
        showError('Fout', 'Alle velden moeten ingevuld zijn.');
    }    
};
window.showEditKeyPad = function(event){
        $('.parentcode').toggleClass('show');
        $('.backgroundAnimalsCode').toggleClass('show');
};

keycode = [];
keyCodeToComfirm = [];
window.pushCode = function(event, key){
    $(event.target).addClass('flash');
    setTimeout(function() {
        $(event.target).removeClass('flash');
    }, 200);
    if(!isNaN(key)){
        if(this.keycode.length < 4 ){
            this.keycode.push(key);
            $(`#codeString span:nth-child(${this.keycode.length})`).css({
                background: '#EE7418'
            });
            $('#doneKey').removeClass('orange');
        }
        if(this.keycode.length === 4){
            $('#doneKey').addClass('orange');
        }
    }else{
        switch (key){
            case 'back':{
                $(`#codeString span:nth-child(${this.keycode.length})`).css({
                    background: '#1F2C3D'
                });
                this.keycode.pop();
                $('#doneKey').removeClass('orange');
                break;
            }
            case 'clear': {
                this.keycode = [];
                $(`#codeString span`).css({
                    background: '#1F2C3D'
                });
                $('#doneKey').removeClass('orange');
                break;
            }
            case 'cancel': {
                this.keycode = [];
                $(`#codeString span`).css({
                    background: '#1F2C3D'
                });
                $('#doneKey').removeClass('orange');
                $('.parentcode').removeClass('show');
                $('#keycode').removeClass('show');
                $('.backgroundAnimalsCode').removeClass('show');
                break;
            }
            case 'done' : {
                if(this.keycode.length === 4){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.post('/kind/checkouderspincode',
                        { code: this.keycode.join('')}
                    )
                        .done(function(data) {
                            if(data.success){
                                window.location = data.url;
                            }else{

                                $('#doneKey').removeClass('orange');
                                showError('Pincode fout', data.error);
                            }
                        })
                        .fail(function() {
                            showError('Pincode fout', "Er ging iets mis probeer het later opnieuw...");
                        });
                }
                this.keycode =[];
                $(`#codeString span`).css({
                    background: '#1F2C3D'
                });
                break;
            }
            case 'check' : {
                if(this.keycode.length === 4){
                    this.keyCodeToComfirm = this.keycode;
                    $('#doneKey').removeClass('orange');
                    this.keycode =[];
                    $(`#codeString span`).css({
                        background: '#1F2C3D'
                    });
                    $("#doneKey").attr("onclick","pushCode(event,'comfirm')");
                    $("#doneKey").text("Bevestig");
                    $("#pincode").val(this.keyCodeToComfirm.join(''));
                    $("#pincodeText").text('Bevestig je pincode.');
                }
                break;
            }
            case 'comfirm' : {
                if(this.keycode.length === 4){
                    if(this.keyCodeToComfirm.join('') === this.keycode.join('')){                        	
                        $( "#frmRegister" ).submit();
                    } else{
                        this.keyCodeToComfirm = [];
                        $('#doneKey').removeClass('orange');
                        this.keycode =[];
                        $(`#codeString span`).css({
                            background: '#1F2C3D'
                        });
                        $("#doneKey").attr("onclick","pushCode(event,'check')");
                        $("#doneKey").text("Klaar");
                        $("#pincodeText").text('Je pincode was niet hetzelfde. Geef opnieuw in.');
                    }              
                }
                break;
            }
            case 'old' : {
                if(this.keycode.length === 4){
                    console.log('binnen');
                    if($("#oldPincode").val() === this.keycode.join('')){
                        $('#doneKey').removeClass('orange');
                        this.keycode =[];
                        $(`#codeString span`).css({
                            background: '#1F2C3D'
                        });
                        $("#doneKey").attr("onclick","pushCode(event,'checkEdit')");
                        $("#doneKey").text("Klaar");
                        $("#pincode").val(this.keyCodeToComfirm.join(''));
                        $("#pincodeText").text('Voer je nieuwe pincode in.');
                    } else{
                        $('#doneKey').removeClass('orange');
                        this.keycode =[];
                        $(`#codeString span`).css({
                            background: '#1F2C3D'
                        });
                        showError('Pincode fout', 'Je pincode klopt niet.');
                    }              
                }
                break;
            }
            case 'checkEdit' : {
                if(this.keycode.length === 4){
                    this.keyCodeToComfirm = this.keycode;
                    $('#doneKey').removeClass('orange');
                    this.keycode =[];
                    $(`#codeString span`).css({
                        background: '#1F2C3D'
                    });
                    $("#doneKey").attr("onclick","pushCode(event,'comfirmEdit')");
                    $("#doneKey").text("Bevestig");
                    $("#pincodeText").text('Bevestig je nieuwe pincode');
                }
                break;
            }
            case 'comfirmEdit' : {
                if(this.keycode.length === 4){
                    if(this.keyCodeToComfirm.join('') === this.keycode.join('')){
                        console.log(this.keycode.join(''));
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });                        	
                        $.post('/pincodewijzigen',
                            { code: this.keycode.join('')}
                        ).done(function(data) {
                            showError('Pincode wijzigen', 'Je pincode is gewijzigd.');
                            pushCode(event,'cancelEdit');
                        }).fail(function(data) {
                            showError('Pincode fout', "Er ging iets mis probeer het later opnieuw...");
                            pushCode(event,'cancelEdit');
                        });
                    } else{
                        this.keyCodeToComfirm = [];
                        $('#doneKey').removeClass('orange');
                        this.keycode =[];
                        $(`#codeString span`).css({
                            background: '#1F2C3D'
                        });
                        $("#doneKey").attr("onclick","pushCode(event,'checkEdit')");
                        $("#doneKey").text("Klaar");
                        $("#pincodeText").text('Voer je nieuwe pincode in.');
                        showError('Pincode fout', 'Je pincode was niet hetzelfde. Geef opnieuw in.');
                    }              
                }
                break;
            }
            case 'cancelRegister': {
                this.keycode = [];
                $(`#codeString span`).css({
                    background: '#1F2C3D'
                });
                $('#doneKey').removeClass('orange');
                $('.parentcode').removeClass('show');
                $('#keycode').removeClass('show');
                $('.backgroundAnimalsCode').removeClass('show');
                setTimeout(function() {
                    $("#pincodeText").text('Kies een Parental Control pincode.');
                    $("#doneKey").attr("onclick","pushCode(event,'check')");
                    $("#doneKey").text("Klaar");
                }, 1000);
                
                break;
            }
            case 'cancelEdit': {
                this.keycode = [];
                $(`#codeString span`).css({
                    background: '#1F2C3D'
                });
                $('#doneKey').removeClass('orange');
                $('.parentcode').removeClass('show');
                $('#keycode').removeClass('show');
                $('.backgroundAnimalsCode').removeClass('show');
                setTimeout(function() {
                    $("#pincodeText").text('Voer je oude pincode in.');
                    $("#doneKey").attr("onclick","pushCode(event,'old')");
                }, 1000);
                
                break;
            }
            
        }
    }
}
window.openParentSettings = function() {
 $('#editParentModal').css({
     'opacity': '1',
     'z-index': '4'
 });
 $('#editParentModalBg').css({
     'opacity': '1',
     'z-index': '1'
 });
 
}
window.showError = function(title, msg){
    $('.errorContainer').css({
        'opacity': '1',
        'z-index': '5'
    });
    $('.errorModalBg').css({
        'opacity': '1',
        'z-index': '1'
    });
    $('.errorTitle').text(title);
    $('.errorMsg').append($.parseHTML(msg));
}
