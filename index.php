<?php ini_set('display_errors', 'On');?>
<html>
    <head>
        <title>Myazumi</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script type="text/javascript">
            var baseUrl = "https://api.api.ai/v1/";
            $(document).ready(function () {
                $("#input").keypress(function (event) {
                    if (event.which === 13) {
                        event.preventDefault();
                        send();
                    }
                });
                $("#sendbtn").click(function (event) {
                    send();
                });
            });
//            var recognition;
//            function startRecognition() {
//                recognition = new webkitSpeechRecognition();
//                recognition.onstart = function (event) {
//                    updateRec();
//                };
//                recognition.onresult = function (event) {
//                    var text = "";
//                    for (var i = event.resultIndex; i < event.results.length; ++i) {
//                        text += event.results[i][0].transcript;
//                    }
//                    setInput(text);
//                    stopRecognition();
//                };
//                recognition.onend = function () {
//                    stopRecognition();
//                };
//                recognition.lang = "en-US";
//                recognition.start();
//            }
//
//            function stopRecognition() {
//                if (recognition) {
//                    recognition.stop();
//                    recognition = null;
//                }
//                updateRec();
//            }
//            function switchRecognition() {
//                if (recognition) {
//                    stopRecognition();
//                } else {
//                    startRecognition();
//                }
//            }
            function setInput(text) {
                $("#input").val(text);
                send();
            }
//            function updateRec() {
//                $("#rec").text(recognition ? "Stop" : "Speak");
//            }
            function send() {
                var text = $("#input").val();
                $.ajax({
                    type: "POST",
                    url: baseUrl + "query?v=20150910",
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    headers: {
                        "Authorization": "Bearer " + accessToken
                    },
                    //data: JSON.stringify({ query: text, lang: "en", sessionId: "somerandomthing" }),
                    data: JSON.stringify({query: text, lang: "en", sessionId: "unset"}),
                    success: function (data) {
                        //var results = data;
                        setResponse(data);
                        
                    },
                    error: function () {
                        setResponse("Internal Server Error");
                    }
                });
                setResponse("Loading...");
            }
            function setResponse(val) {
                        JSON.stringify(val);
                        $("#response").text(val.result.fulfillment.speech);   
            }
        </script>
        <style type="text/css">
            body { width: 500px; margin: 0 auto; text-align: center; margin-top: 20px; }
            div {  position: absolute; }
            input { width: 400px; }
            button { width: 50px; }
            textarea { width: 100%; }
        </style>
    </head>
    <body>
        <div>
            <input id="input" type="text" autofocus="true"> <button id="sendbtn">Send</button>
            <br>Response<br> <textarea id="response" cols="40" rows="20"></textarea>
        </div>
    </body>
</html>
