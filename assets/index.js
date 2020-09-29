(() => {
  'use strict';
  const TWILIO_DOMAIN = location.host; //unique to user, will be website to visit for video app
  const ROOM_NAME = 'tf';
  const Video = Twilio.Video;
  let videoRoom, localStream;
  const video = document.getElementById("video");
  const switchCameraButton = document.getElementById("button-switch-camera");
  const select = document.getElementById('select');
  let currentStream;

  function stopMediaTracks(stream) {
    stream.getTracks().forEach(track => {
      track.stop();
    });
  }



  function gotDevices(mediaDevices) {
    select.innerHTML = '';
    select.appendChild(document.createElement('option'));
    let count = 1;
    mediaDevices.forEach(mediaDevice => {
      if (mediaDevice.kind === 'videoinput') {
        const option = document.createElement('option');
        option.value = mediaDevice.deviceId;
        const label = mediaDevice.label || `Camera ${count++}`;
        const textNode = document.createTextNode(label);
        option.appendChild(textNode);
        select.appendChild(option);
      }
    });
  }
  // preview screen

  /*navigator.mediaDevices.enumerateDevices().then(devices => {
    var videoInput = devices.find(device => device.kind === 'videoinput');
    return createLocalTracks({ audio: true, video: { deviceId: videoInput.deviceId } });
  }).then(localTracks => {
    return connect('my-token', { name: 'my-room-name', tracks: localTracks });
  }).then(room => {
    console.log('Connected to room ' + room.name);
  });*/

  switchCameraButton.addEventListener('click', event => {
    if (typeof currentStream !== 'undefined') {
      stopMediaTracks(currentStream);
    }
    const videoConstraints = {};
    if (select.value === '') {
      videoConstraints.facingMode = 'environment';
    } else {
      videoConstraints.deviceId = {
        exact: select.value
      };
    }

    const constraints = {
      video: true,
      audio: true
    };
    navigator.mediaDevices.getUserMedia(constraints).then(vid => {
        video.srcObject = vid;
        //localStream = vid;
      })
      .catch(error => {
        console.error(error);
      });
  });

  // buttons
  const joinRoomButton = document.getElementById("button-join");
  const leaveRoomButton = document.getElementById("button-leave");
  var site = `https://${TWILIO_DOMAIN}/video-token`;
  console.log(`site ${site}`);
  joinRoomButton.onclick = () => {
    // get access token
    axios.get(`https://${TWILIO_DOMAIN}/video-token`).then(async (body) => {
      const token = body.data.token;
      console.log(token);
      //connect to room

      Video.connect(token, {
        name: ROOM_NAME
      }).then((room) => {
        console.log(`Connected to Room ${room.name}`);
        videoRoom = room;

        room.participants.forEach(participantConnected);
        room.on("participantConnected", participantConnected);

        room.on("participantDisconnected", participantDisconnected);
        room.once("disconnected", (error) =>
          room.participants.forEach(participantDisconnected)
        );
        joinRoomButton.disabled = true;
        leaveRoomButton.disabled = false;
      });
    });
  };
  // leave room
  leaveRoomButton.onclick = () => {
    videoRoom.disconnect();
    console.log(`Disconnected from Room ${videoRoom.name}`);
    joinRoomButton.disabled = false;
    leaveRoomButton.disabled = true;
  };
  /*switchCameraButton.onclick = () => {
    console.log('Switching camera');
    // does nothing
  };*/
  navigator.mediaDevices.enumerateDevices().then(gotDevices);
})();

// connect participant
const participantConnected = (participant) => {
  console.log(`Participant ${participant.identity} connected'`);

  const div = document.createElement('div'); //create div for new participant
  div.id = participant.sid;

  participant.on('trackSubscribed', track => trackSubscribed(div, track));
  participant.on('trackUnsubscribed', trackUnsubscribed);

  participant.tracks.forEach(publication => {
    if (publication.isSubscribed) {
      trackSubscribed(div, publication.track);
    }
  });
  document.body.appendChild(div);
}

const participantDisconnected = (participant) => {
  console.log(`Participant ${participant.identity} disconnected.`);
  document.getElementById(participant.sid).remove();
}

const trackSubscribed = (div, track) => {
  div.appendChild(track.attach());
}

const trackUnsubscribed = (track) => {
  track.detach().forEach(element => element.remove());
}
