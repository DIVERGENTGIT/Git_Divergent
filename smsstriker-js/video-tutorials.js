var player1,player2,player3,player4,player5,player6,player7,player8,player9,
    time_update_interval1 = 0, time_update_interval2 = 0,time_update_interval3 = 0, time_update_interval4 = 0, time_update_interval5 = 0, time_update_interval6 = 0, time_update_interval7 = 0, time_update_interval8 = 0, time_update_interval9 = 0;

function onYouTubeIframeAPIReady() {
    player1 = new YT.Player('videodiv1', {
        //width: 100,
        height: 400,
        videoId: '-gVRvhV32eA',
        playerVars: {
            color: 'white',
           // playlist: 'taJ60kskkns,FG0fTKAqZ5g'
        },
        events: {
            onReady: initialize1
        }
    });
	player2 = new YT.Player('videodiv2', {
        width: 600,
        height: 400,
        videoId: '5_NRPxBrLZ4',
        playerVars: {
            color: 'white',
           // playlist: 'taJ60kskkns,FG0fTKAqZ5g'
        },
        events: {
            onReady: initialize2
        }
    });
	player3 = new YT.Player('videodiv3', {
        width: 600,
        height: 400,
        videoId: 'PRnNXZ3IZ2Q',
        playerVars: {
            color: 'white',
           // playlist: 'taJ60kskkns,FG0fTKAqZ5g'
        },
        events: {
            onReady: initialize3
        }
    });
	player4 = new YT.Player('videodiv4', {
        width: 600,
        height: 400,
        videoId: 'bBym2PjurXM',
        playerVars: {
            color: 'white',
           // playlist: 'taJ60kskkns,FG0fTKAqZ5g'
        },
        events: {
            onReady: initialize4
        }
    });
	player5 = new YT.Player('videodiv5', {
        width: 600,
        height: 400,
        videoId: 'fFqos-Hcb4Q',
        playerVars: {
            color: 'white',
           // playlist: 'taJ60kskkns,FG0fTKAqZ5g'
        },
        events: {
            onReady: initialize5
        }
    });
	player6 = new YT.Player('videodiv6', {
        width: 600,
        height: 400,
        videoId: '0xZ5MHINOe0',
        playerVars: {
            color: 'white',
           // playlist: 'taJ60kskkns,FG0fTKAqZ5g'
        },
        events: {
            onReady: initialize6
        }
    });
	player7 = new YT.Player('videodiv7', {
        width: 600,
        height: 400,
        videoId: '3kDuIwCR1nQ',
        playerVars: {
            color: 'white',
           // playlist: 'taJ60kskkns,FG0fTKAqZ5g'
        },
        events: {
            onReady: initialize7
        }
    });
	player8 = new YT.Player('videodiv8', {
        width: 600,
        height: 400,
        videoId: '3dAM2voBzOQ',
        playerVars: {
            color: 'white',
           // playlist: 'taJ60kskkns,FG0fTKAqZ5g'
        },
        events: {
            onReady: initialize8
        }
    });
	player9 = new YT.Player('videodiv9', {
        width: 600,
        height: 400,
        videoId: 'PcuG89OYKHc',
        playerVars: {
            color: 'white',
           // playlist: 'taJ60kskkns,FG0fTKAqZ5g'
        },
        events: {
            onReady: initialize9
        }
    });	
					
}

function initialize1(){

    // Update the controls on load
    updateTimerDisplay();
    updateProgressBar();

    // Clear any old interval.
    clearInterval(time_update_interval1);

    // Start interval to update elapsed time display and
    // the elapsed part of the progress bar every second.
    time_update_interval1 = setInterval(function () {
        updateTimerDisplay();
        updateProgressBar();
    }, 1000);


    $('#volume-input').val(Math.round(player1.getVolume()));
}
function initialize2(){

    // Update the controls on load
    updateTimerDisplay2();
    updateProgressBar2();

    // Clear any old interval.
    clearInterval(time_update_interval2);

    // Start interval to update elapsed time display and
    // the elapsed part of the progress bar every second.
    time_update_interval2 = setInterval(function () {
        updateTimerDisplay2();
        updateProgressBar2();
    }, 1000);


    $('#volume-input').val(Math.round(player2.getVolume()));
}
function initialize3(){

    // Update the controls on load
    updateTimerDisplay3();
    updateProgressBar3();

    // Clear any old interval.
    clearInterval(time_update_interval3);

    // Start interval to update elapsed time display and
    // the elapsed part of the progress bar every second.
    time_update_interval3 = setInterval(function () {
        updateTimerDisplay3();
        updateProgressBar3();
    }, 1000);


    $('#volume-input').val(Math.round(player3.getVolume()));
}
function initialize4(){

    // Update the controls on load
    updateTimerDisplay4();
    updateProgressBar4();

    // Clear any old interval.
    clearInterval(time_update_interval4);

    // Start interval to update elapsed time display and
    // the elapsed part of the progress bar every second.
    time_update_interval4 = setInterval(function () {
        updateTimerDisplay4();
        updateProgressBar4();
    }, 1000);


    $('#volume-input').val(Math.round(player4.getVolume()));
}
function initialize5(){

    // Update the controls on load
    updateTimerDisplay5();
    updateProgressBar5();

    // Clear any old interval.
    clearInterval(time_update_interval5);

    // Start interval to update elapsed time display and
    // the elapsed part of the progress bar every second.
    time_update_interval5 = setInterval(function () {
        updateTimerDisplay5();
        updateProgressBar5();
    }, 1000);


    $('#volume-input').val(Math.round(player5.getVolume()));
}
function initialize6(){

    // Update the controls on load
    updateTimerDisplay6();
    updateProgressBar6();

    // Clear any old interval.
    clearInterval(time_update_interval6);

    // Start interval to update elapsed time display and
    // the elapsed part of the progress bar every second.
    time_update_interval6 = setInterval(function () {
        updateTimerDisplay6();
        updateProgressBar6();
    }, 1000);


    $('#volume-input').val(Math.round(player6.getVolume()));
}
function initialize7(){

    // Update the controls on load
    updateTimerDisplay7();
    updateProgressBar7();

    // Clear any old interval.
    clearInterval(time_update_interval7);

    // Start interval to update elapsed time display and
    // the elapsed part of the progress bar every second.
    time_update_interval7 = setInterval(function () {
        updateTimerDisplay7();
        updateProgressBar7();
    }, 1000);


    $('#volume-input').val(Math.round(player7.getVolume()));
}

function initialize8(){

    // Update the controls on load
    updateTimerDisplay8();
    updateProgressBar8();

    // Clear any old interval.
    clearInterval(time_update_interval8);

    // Start interval to update elapsed time display and
    // the elapsed part of the progress bar every second.
    time_update_interval8 = setInterval(function () {
        updateTimerDisplay8();
        updateProgressBar8();
    }, 1000);


    $('#volume-input').val(Math.round(player8.getVolume()));
}
function initialize9(){

    // Update the controls on load
    updateTimerDisplay9();
    updateProgressBar9();

    // Clear any old interval.
    clearInterval(time_update_interval9);

    // Start interval to update elapsed time display and
    // the elapsed part of the progress bar every second.
    time_update_interval9 = setInterval(function () {
        updateTimerDisplay9();
        updateProgressBar9();
    }, 1000);


    $('#volume-input').val(Math.round(player9.getVolume()));
}


// This function is called by initialize()
function updateTimerDisplay(){
    // Update current time text display.
    $('#current-time1').text(formatTime( player1.getCurrentTime() ));
    $('#duration1').text(formatTime( player1.getDuration() ));
}


function updateTimerDisplay2(){
    // Update current time text display.
    $('#current-time2').text(formatTime( player2.getCurrentTime() ));
    $('#duration2').text(formatTime( player2.getDuration() ));
}

function updateTimerDisplay3(){
    // Update current time text display.
    $('#current-time3').text(formatTime( player3.getCurrentTime() ));
    $('#duration3').text(formatTime( player3.getDuration() ));
}

function updateTimerDisplay4(){
    // Update current time text display.
    $('#current-time4').text(formatTime( player4.getCurrentTime() ));
    $('#duration4').text(formatTime( player4.getDuration() ));
}

function updateTimerDisplay5(){
    // Update current time text display.
    $('#current-time5').text(formatTime( player5.getCurrentTime() ));
    $('#duration5').text(formatTime( player5.getDuration() ));
}

function updateTimerDisplay6(){
    // Update current time text display.
    $('#current-time6').text(formatTime( player6.getCurrentTime() ));
    $('#duration6').text(formatTime( player6.getDuration() ));
}

function updateTimerDisplay7(){
    // Update current time text display.
    $('#current-time7').text(formatTime( player7.getCurrentTime() ));
    $('#duration7').text(formatTime( player7.getDuration() ));
}

function updateTimerDisplay8(){
    // Update current time text display.
    $('#current-time8').text(formatTime( player8.getCurrentTime() ));
    $('#duration8').text(formatTime( player8.getDuration() ));
}

function updateTimerDisplay9(){
    // Update current time text display.
    $('#current-time9').text(formatTime( player9.getCurrentTime() ));
    $('#duration9').text(formatTime( player9.getDuration() ));
}




// This function is called by initialize()
function updateProgressBar(){
    // Update the value of our progress bar accordingly.
    $('#progress-bar1').val((player1.getCurrentTime() / player1.getDuration()) * 100);
}


// This function is called by initialize()
function updateProgressBar2(){
    // Update the value of our progress bar accordingly.
    $('#progress-bar2').val((player2.getCurrentTime() / player2.getDuration()) * 100);
}

// This function is called by initialize()
function updateProgressBar3(){
    // Update the value of our progress bar accordingly.
    $('#progress-bar3').val((player3.getCurrentTime() / player3.getDuration()) * 100);
}

// This function is called by initialize()
function updateProgressBar4(){
    // Update the value of our progress bar accordingly.
    $('#progress-bar4').val((player4.getCurrentTime() / player4.getDuration()) * 100);
}

// This function is called by initialize()
function updateProgressBar5(){
    // Update the value of our progress bar accordingly.
    $('#progress-bar5').val((player5.getCurrentTime() / player5.getDuration()) * 100);
}

// This function is called by initialize()
function updateProgressBar6(){
    // Update the value of our progress bar accordingly.
    $('#progress-bar6').val((player6.getCurrentTime() / player6.getDuration()) * 100);
}

// This function is called by initialize()
function updateProgressBar7(){
    // Update the value of our progress bar accordingly.
    $('#progress-bar7').val((player7.getCurrentTime() / player7.getDuration()) * 100);
}

// This function is called by initialize()
function updateProgressBar8(){
    // Update the value of our progress bar accordingly.
    $('#progress-bar8').val((player8.getCurrentTime() / player8.getDuration()) * 100);
}

// This function is called by initialize()
function updateProgressBar9(){
    // Update the value of our progress bar accordingly.
    $('#progress-bar9').val((player9.getCurrentTime() / player9.getDuration()) * 100);
}


// Playback

$(document).on('click','.play', function () {
	var videoid=$(this).attr('id');
	$('.pause').attr('class','play');
	$(this).attr('class','pause');
	player1.pauseVideo();
	player2.pauseVideo();
	player3.pauseVideo();
	player4.pauseVideo();
	player5.pauseVideo();
	player6.pauseVideo();
	player7.pauseVideo();
	player8.pauseVideo();	
	player9.pauseVideo();		
	if(videoid=='1'){
		player1.playVideo();	
		}else if(videoid=='2'){
				 player2.playVideo();	
		}else if(videoid=='3'){
				 player3.playVideo();	
		}else if(videoid=='4'){
				 player4.playVideo();	
		}else if(videoid=='5'){
				 player5.playVideo();	
		}else if(videoid=='6'){
				 player6.playVideo();	
		}else if(videoid=='7'){
				 player7.playVideo();	
		}else if(videoid=='8'){
				 player8.playVideo();	
		}
		else if(videoid=='9'){
				 player9.playVideo();	
		}
});


$(document).on('click','.pause', function () {
	$(this).attr('class','play');
	var videoid=$(this).attr('id');
	if(videoid=='1'){
    player1.pauseVideo();
	}else if(videoid=='2'){
		 player2.pauseVideo();
	}else if(videoid=='3'){
		 player3.pauseVideo();
	}else if(videoid=='4'){
		 player4.pauseVideo();
	}else if(videoid=='5'){
		 player5.pauseVideo();
	}else if(videoid=='6'){
		 player6.pauseVideo();
	}else if(videoid=='7'){
		 player7.pauseVideo();
	}else if(videoid=='8'){
		 player8.pauseVideo();
	}
	else if(videoid=='9'){
		 player9.pauseVideo();
	}
});








$(document).on('click','.mute-toggle', function () {
	$(this).attr('class','unmute-toggle');
	var mutid=$(this).attr('id');
	if(mutid=='mute1'){
		player1.mute();
	}else if(mutid=='mute2'){
		player2.mute();
	}else if(mutid=='mute3'){
		player3.mute();
	}else if(mutid=='mute4'){
		player4.mute();
	}else if(mutid=='mute5'){
		player5.mute();
	}else if(mutid=='mute6'){
		player6.mute();
	}else if(mutid=='mute7'){
		player7.mute();
	}else if(mutid=='mute8'){
		player8.mute();
	}
	else if(mutid=='mute9'){
		player9.mute();
	}
	 
});


$(document).on('click','.unmute-toggle', function () {
	$(this).attr('class','mute-toggle');
	var mutid=$(this).attr('id');
	if(mutid=='mute1'){
		 player1.unMute();
	}else if(mutid=='mute2'){
		 player2.unMute();
	}else if(mutid=='mute3'){
		 player3.unMute();
	}else if(mutid=='mute4'){
		 player4.unMute();
	}else if(mutid=='mute5'){
		 player5.unMute();
	}else if(mutid=='mute6'){
		 player6.unMute();
	}else if(mutid=='mute7'){
		 player7.unMute();
	}else if(mutid=='mute8'){
		 player8.unMute();
	}
	else if(mutid=='mute9'){
		 player9.unMute();
	}
   
});



// Helper Functions

function formatTime(time){
    time = Math.round(time);

    var minutes = Math.floor(time / 60),
        seconds = time - minutes * 60;

    seconds = seconds < 10 ? '0' + seconds : seconds;

    return minutes + ":" + seconds;
}

