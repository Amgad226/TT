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
                                }).then(res =>
                                    {
                                        $('.sended').css("visibility", "");
                                    }
                                );

                                var record =` 
                               
                                <audio style="   border: 5px solid #2787F5; border-radius: 50px;"controls><source src="${data}" type="audio/WAV"></audio>
                                 
                                <span class="sended" style="position:absolute;right:23px; z-index:120;visibility:hidden"> 
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="12px" height="12px" viewBox="0 0 78.369 78.369" style="enable-background:new 0 0 78.369 78.369;" xml:space="preserve"><g>
                                   <path fill="#2787F5" d="M78.049,19.015L29.458,67.606c-0.428,0.428-1.121,0.428-1.548,0L0.32,40.015c-0.427-0.426-0.427-1.119,0-1.547l6.704-6.704 c0.428-0.427,1.121-0.427,1.548,0l20.113,20.112l41.113-41.113c0.429-0.427,1.12-0.427,1.548,0l6.703,6.704 C78.477,17.894,78.477,18.586,78.049,19.015z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                                </svg>
                                </span>
                        `
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