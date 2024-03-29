jQuery(document).ready(function () {
    var $ = jQuery;
    var myRecorder = {
        objects: {
            context: null,
            stream: null,
            recorder: null
        },
        init: function () {
            if (null === myRecorder.objects.context) {
                myRecorder.objects.context = new (
                        window.AudioContext || window.webkitAudioContext
                        );
            }
        },
        start: function () {
            var options = {audio: true, video: false};
            navigator.mediaDevices.getUserMedia(options).then(function (stream) {
                myRecorder.objects.stream = stream;
                myRecorder.objects.recorder = new Recorder(
                        myRecorder.objects.context.createMediaStreamSource(stream),
                        {numChannels: 1}
                );
                myRecorder.objects.recorder.record();
            }).catch(function (err) {});
        },
        stop: function (listObject) {
            if (null !== myRecorder.objects.stream) {
                myRecorder.objects.stream.getAudioTracks()[0].stop();
            }
            if (null !== myRecorder.objects.recorder) {
                myRecorder.objects.recorder.stop();

                // Validate object
                if (null !== listObject
                        && 'object' === typeof listObject
                        && listObject.length > 0) {
                    // Export the WAV file
                    myRecorder.objects.recorder.exportWAV(function (blob) {

                        var url = (window.URL || window.webkitURL).createObjectURL(blob);

                        sendVoiceToApi(url,blob)


                    });

                }
            }
        }
    };

    // Prepare the recordings list
    var listObject = $('[data-role="recordings"]');

    // Prepare the record button
    $('[data-role="controls"] > button').click(function () {
        // Initialize the recorder
        myRecorder.init();

        // Get the button state
        var buttonState = !!$(this).attr('data-recording');

        // Toggle
        if (!buttonState) {
            $(this).attr('data-recording', 'true');
            myRecorder.start();
            $('.ss').addClass('rr')
            // $(this).css('width','1200px')

        } else {
            $(this).attr('data-recording', '');
            myRecorder.stop(listObject);
            // $(this).css('width','')
            $('.ss').removeClass('rr')




        }
    });
});




function sendVoiceToApi(url,blob){
    var random_class_to_add_message_id=makeid(5);
    var deleteAction =makeid(5);
    var classDeletMessage=makeid(5);
    var random=makeid(8);

    console.log(url)
    // var record=url;
    var date =  moment();
    var msg={
        // 'body':record  ,
        'body':url,
        'deleteAction':deleteAction,
        'classDeletMessage':classDeletMessage,
        'created_at':date ,
        'id':100000,
        'random_class_to_add_message_id':random_class_to_add_message_id,
        'type':'audio',
    };
    // addMessage(msg,'message-out',true,true,true,record,date);//false
    addMessage(msg,'message-out',true,true,'visibilty-hidden');





}
