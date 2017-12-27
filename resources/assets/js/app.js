window.$ = window.jQuery = require('jquery');
$('#addBookBtn').click(function () {
    $('#bookModal').css({
        'opacity': '1',
        'z-index': '2'
    });
    $('#bookModalBg').css({
        'opacity': '1',
        'z-index': '1'
    });
});
$('#addChildBtn').click(function () {
    $('#childModal').css({
        'opacity': '1',
        'z-index': '2'
    });
    $('#childModalBg').css({
        'opacity': '1',
        'z-index': '1'
    });
});
var scanner;
window.editBook = function(id) {
    $.get('/ouders/boeken/get/'+id)
    .done(function(data) {
        console.log(data.title);
       $('#editBookForm #title').val(data.title);
       $('#editBookForm #author').val(data.author);
       $('#editBookForm #description').val(data.shortDescription);
       $('#editBookForm #numberOfPages').val(data.numberOfPages);
       $("#editBookForm").attr('action', '/ouders/boeken/wijzig/'+data.readingBook_id);
    })
    .fail(function() {
        alert( "error" );
    });

    $('#editbookModal').css({
        'opacity': '1',
        'z-index': '2'
    });
    $('#editbookModalBg').css({
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
        $.post(content)
            .done(function(data) {
                alert(data);
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
window.loadscanner = function(){
    if(scanner){
        scanner.stop();
    }

    $('.QRscan').addClass('show');
    scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
    scanner.addListener('scan', function (content) {
        console.log(content);
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
    }