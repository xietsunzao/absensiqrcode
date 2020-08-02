$(function () {
    $('.message').keypress(function (event) {
        let keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            sendTxtMessage($(this).val());
        }
    });
    $('.btnSend').click(() => sendTxtMessage($('.message').val()));
    $('.selectVendor').click(function () {
        ChatSection(1);
        var receiver_id = $(this).attr('id');
        $('#ReciverId_txt').val(receiver_id);
        $('#ReciverName_txt').html($(this).attr('title'));
        GetChatHistory(receiver_id);
    });
    $('.upload_attachmentfile').change(() => {
        DisplayMessage('<div class="spiner"><i class="fa fa-circle-o-notch fa-spin"></i></div>');
        // ScrollDown();
        let file_data = $('.upload_attachmentfile').prop('files')[0];
        let receiver_id = $('#ReciverId_txt').val();
        let form_data = new FormData();
        form_data.append('attachmentfile', file_data);
        form_data.append('type', 'Attachment');
        form_data.append('receiver_id', receiver_id);
        $.ajax({
            url: 'chat-attachment/upload',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: () => {
                $('.upload_attachmentfile').val('');
                GetChatHistory(receiver_id);
            },
            error: (_jqXHR, _status, _err) => {
                // alert('Local error callback');
            }
        });
    });
    $('.ClearChat').click(() => {
        var receiver_id = $('#ReciverId_txt').val();
        $.ajax({
            //dataType : "json",
            url: 'chat-clear?receiver_id=' + receiver_id,
            success: _data => {
                GetChatHistory(receiver_id);
            },
            error: (_jqXHR, _status, _err) => {
                // alert('Local error callback');
            }
        });
    });
});	///end of jquery

const ViewAttachment = _message_id => {
};

const ViewAttachmentImage = (image_url, imageTitle) => {
    $('#modelTitle').html(imageTitle);
    $('#modalImgs').attr('src', image_url);
    $('#myModalImg').modal('show');
};

const ChatSection = status => {
    if (status == 0) {
        $('#chatSection :input').attr('disabled', true);
    } else {
        $('#chatSection :input').removeAttr('disabled');
    }
};

ChatSection(0);

const ScrollDown = () => {
    var elmnt = document.getElementById("content");
    var h = elmnt.scrollHeight;
    $('#content').animate({ scrollTop: h }, 1000);
};

window.onload = ScrollDown();

const DisplayMessage = message => {
    let Sender_Name = $('#Sender_Name').val();
    let Sender_ProfilePic = $('#Sender_ProfilePic').val();
    let str = '<div class="direct-chat-msg right">';
    str += `<div class="direct-chat-info clearfix">`;
    str += `<span class="direct-chat-name pull-right">${Sender_Name}`;
    str += `</span><span class="direct-chat-timestamp pull-left"></span>`; //23 Jan 2:05 pm
    str += `</div><img class="direct-chat-img" src="${Sender_ProfilePic}" alt="">`;
    str += `<div class="direct-chat-text">${message}`;
    str += `</div></div>`;
    $('#dumppy').append(str);
};

const sendTxtMessage = message => {
    var messageTxt = message.trim();
    if (messageTxt != '') {
        //console.log(message);
        DisplayMessage(messageTxt);
        var receiver_id = $('#ReciverId_txt').val();
        $.ajax({
            dataType: "json",
            type: 'post',
            data: { messageTxt: messageTxt, receiver_id: receiver_id },
            url: 'send-message',
            success: _data => GetChatHistory(receiver_id),
            error: (_jqXHR, _status, _err) => {
            }
        });
        // ScrollDown();
        $('.message').val('');
        $('.message').focus();
    } else {
        $('.message').focus();
    }
};

const GetChatHistory = receiver_id => {
    $.ajax({
        url: 'get-chat-history-vendor?receiver_id=' + receiver_id,
        success: function (data) {
            $('#dumppy').html(data);
            ScrollDown();
        },
        error: function (_jqXHR, _status, _err) {
            // alert('Local error callback');
        }
    });
};

setInterval(() => {
    var receiver_id = $('#ReciverId_txt').val();
    if (receiver_id != '') { GetChatHistory(receiver_id); }
}, 5000);
