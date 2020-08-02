<style media="screen">
    .btn-md {
        padding: 1rem 2.4rem;
        font-size: .94rem;
        display: none;
    }

    .swal2-popup {
        font-family: inherit;
        font-size: 1.2rem;
    }
</style>
<section class='content' id="demo-content">
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box'>
                <div class='box-header'></div>
                <div class='box-body'>
                    <?php
                    $attributes = array('id' => 'button');
                    echo form_open('scan/cek_id', $attributes); ?>
                    <div id="sourceSelectPanel" style="display:none">
                        <label for="sourceSelect">Change video source:</label>
                        <select id="sourceSelect" style="max-width:400px"></select>
                    </div>
                    <div>
                        <video id="video" width="100%" height="100%" style="border: 1px solid gray"></video>
                    </div>
                    <textarea hidden="" name="id_karyawan" id="result" readonly></textarea>
                    <span> <input type="submit" id="button" class="btn btn-success btn-md" value="Cek Kehadiran"></span>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/zxing/zxing.min.js"></script>
<script type="text/javascript">
    window.addEventListener('load', function() {
        let selectedDeviceId;
        let audio = new Audio("assets/audio/beep.mp3");
        const codeReader = new ZXing.BrowserQRCodeReader()
        console.log('ZXing code reader initialized')
        codeReader.getVideoInputDevices()
            .then((videoInputDevices) => {
                const sourceSelect = document.getElementById('sourceSelect')
                selectedDeviceId = videoInputDevices[0].deviceId
                if (videoInputDevices.length >= 1) {
                    videoInputDevices.forEach((element) => {
                        const sourceOption = document.createElement('option')
                        sourceOption.text = element.label
                        sourceOption.value = element.deviceId
                        sourceSelect.appendChild(sourceOption)
                    })
                    sourceSelect.onchange = () => {
                        selectedDeviceId = sourceSelect.value;
                    };
                    const sourceSelectPanel = document.getElementById('sourceSelectPanel')
                    sourceSelectPanel.style.display = 'block'
                }
                codeReader.decodeFromInputVideoDevice(selectedDeviceId, 'video').then((result) => {
                    console.log(result)
                    document.getElementById('result').textContent = result.text
                    if (result != null) {
                        audio.play();
                    }
                    $('#button').submit();
                }).catch((err) => {
                    console.error(err)
                    document.getElementById('result').textContent = err
                })
                console.log(`Started continous decode from camera with id ${selectedDeviceId}`)
            })
            .catch((err) => {
                console.error(err)
            })
    })
</script>