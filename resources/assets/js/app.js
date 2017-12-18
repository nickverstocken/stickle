console.log('hello');
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
window.doSomethin = function(kid) {
    $('.childrenWrap').animate({
        opacity:0,
    },200, function(){
        $('.childrenWrap').css({
           position:'absolute'
        });
        $('#children').css({
            maxWidth: 280,
            height: 300
        });
        $('#' + kid).animate({
            opacity:1
        }, 200, function(){
            $('.QRscan').css({
                height:'300px'
            });
        });

    });

    var scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
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