const VideoPlayer = (function () {
	const mainVideoBlock = document.querySelector('.broadcast-video');
	const onlineClubList = document.querySelector('.online---archive.online-club-list');

	const init = function () {
		document.addEventListener('DOMContentLoaded', startVideo);
	};

	const startVideo = function () {
		if (mainVideoBlock) {
			mainVideoBlock.addEventListener('click', function (evt) {
				evt.preventDefault();
				mainVideoBlock.style.paddingTop = 0;

				createScriptYoutube();
			});
            startOnlineClubList();
            const videoIdm = document.getElementById("player").dataset.video;
            changeComments(videoIdm);
            
		}
	};

	const startOnlineClubList = function () {
		if (onlineClubList) {
			onlineClubList.addEventListener('click', function (evt) {
				evt.preventDefault();

				if (evt.target.tagName === 'A') {
					const videoId = evt.target.dataset.video;
 					// destroyPlayer();
                    mainVideoBlock.click();
					showVideoArchive(videoId); 
					changeComments(videoId);
				} 

			});
		}
	};

	const createScriptYoutube = function () {
		const tag = document.createElement('script');
		tag.src = "https://www.youtube.com/iframe_api";
		document.body.appendChild(tag);
	}

	const createIframeChat = function (videoId) {
		const frame = document.createElement('iframe');
		frame.src = `https://www.youtube.com/live_chat?v=${videoId}&embed_domain=${window.location.hostname}`;
		frame.width = '100%';
		frame.height = '100%';
		frame.id = "chat-embed";
		document.querySelector('.broadcast__comments .comments--youtube').appendChild(frame);
	}

	const destroyPlayer = function () {
		player.destroy();
	};

	const showVideoArchive = function (videoId) {
        let current = 5;

          let timerId = setInterval(function() {
            player.loadVideoById({
                videoId: videoId,
                'suggestedQuality': 'large'
            });
            if (current == 10) {
              clearInterval(timerId);
            }
            current++;
          }, 200);
	};

	const changeComments = function (videoId) {

		$.ajax({
			url: kabAjax.ajaxurl,
			method: 'POST',
			dataType: 'html',
			data: {
				action: 'ajax_change_commnets',
				video_id: videoId
			},
			// processData: false,
			// contentType: false,
			success: function (response) {
				$('.broadcast__comments .comments--youtube').replaceWith(response);
			}
		});

	}

	const getVideoInfo = function (videoId) {
		$.ajax({
			url: kabAjax.ajaxurl,
			method: 'POST',
			dataType: 'json',
			data: {
				action: 'video_data',
				video_id: videoId
			},
			// processData: false,
			// contentType: false,
			success: function (response) {
				window.videoInfo = response;
				// $('.broadcast__comments .comments--youtube').replaceWith(response);
			}
		});
	}


	return {
		init,
		changeComments,
		getVideoInfo,
		createIframeChat
	}
})();

VideoPlayer.init();

function onYouTubeIframeAPIReady(video) {
	window.player = new YT.Player('player', {
		height: '430',
		width: '788',
		// videoId: videoId,
		events: {
			'onReady': onPlayerReady,
			'onStateChange': onPlayerStateChange
		}
	});
}


// 4. The API will call this function when the video player is ready.
// function onPlayerReady(event) {
// 	const videoId = document.getElementById('player').dataset.video;
//
// 	event.target.loadVideoById({
// 		videoId: videoId,
// 		'suggestedQuality': 'large'
// 	});
//
// 	// event.target.loadPlaylist({
// 	// 	listType: 'playlist',
// 	// 	list: 'PL3s9Wy5W7M-P3mX8eqilxa3bc1xXWHMLX',
// 	// 	suggestedQuality: 'large'
// 	// });
// }


// 5. The API calls this function when the player's state changes.
//    The function indicates that when playing a video (state=1),
//    the player should play for six seconds and then stop.
// var done = false;
let video_id = '';

function onPlayerStateChange(event) {
	let videoData = event.target.getVideoData();
	video_id = videoData.video_id;
	VideoPlayer.getVideoInfo(video_id);

	if (event.data == YT.PlayerState.PLAYING && video_id !== '') {

		if (window.videoInfo.data.data.snippet.liveBroadcastContent === 'live') {
			VideoPlayer.createIframeChat(video_id);
		} else {
			VideoPlayer.changeComments(video_id);
		}

	}

	// if (event.data == YT.PlayerState.PLAYING && !done) {
	//   setTimeout(stopVideo, 6000);
	//   done = true;
	// }
}