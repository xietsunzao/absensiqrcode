var audio = new Audio("assets/audio/beep.mp3");
let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
scanner.addListener('scan', function (content) {
    console.log(content);
    $('#tampil').val(content);
    $('#target').submit();
    if(content != null){
        audio.play();
    }
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
