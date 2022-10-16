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

                    let data = new FormData
                    data.append('sound',blob)
       
                    fetch('api/sound', {
                    method: 'POST',
                    body:data,
                    headers: {
                        'X-CSRF-TOKEN': +'${tokenn}'
                    }})
                    .then(res =>
                        {
                          if (res.status>=200 && res.status <300) 
                          return res.json()
                          else
                          throw new Error();
                        }
                            ).then(data=>
                            {
                                let request = new FormData ; 
                                request.append('conversation_id',response_conversation_id);
                                request.append('body',data);
                                // request.append('messageType','audio');
                                request.append('type','audio');
                                // request.append('type','peer');
                                request.append('user_id',userId);

                                fetch('api/messages', {
                                method: 'POST',
                                body:request,
                                headers: {  'X-CSRF-TOKEN': +'${tokenn}'}
                                });

                                var record =` <audio style="   border: 5px solid #2787F5; border-radius: 50px;"controls><source src="${data}" type="audio/WAV"></audio>  `
                                var date =  moment();
                                var msg={'body':record  ,'created_at':date ,'id':100000};
                                // addMessage(msg,'message-out',true,true,true,record,date);//false
                                addMessage(msg,'message-out',true,false);
                            }
                    );    
  
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