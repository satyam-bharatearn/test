<!DOCTYPE html>
<html>

<head>
    <title>WebRTC Laravel + Python</title>
    <style>
        video {
            width: 45%;
            margin: 10px;
            border: 1px solid #000;
        }
    </style>
</head>

<body>
    <h2>WebRTC Video Call</h2>
    <input id="yourName" placeholder="Your Name" />
    <input id="targetName" placeholder="Call To" />
    <button onclick="login()">Login</button>
    <button onclick="startCall()">Call</button>
    <video id="localVideo" autoplay muted></video>
    <video id="remoteVideo" autoplay></video>

    <script>
        let targetUser = "";
        const ws = new WebSocket('https://zs67v4w7-3000.inc1.devtunnels.ms/');
        ws.onopen = () => {
            console.log("✅ WebSocket connected");
        };

        ws.onclose = () => {
            console.warn("❌ WebSocket closed");
        };

        ws.onerror = (err) => {
            console.error("⚠️ WebSocket error:", err);
        };
        let localStream, yourConn, name;
        let candidateQueue = [];
        let isRemoteDescSet = false;

        ws.onmessage = (msg) => {
            let data = JSON.parse(msg.data);
            switch (data.type) {
                case "login":
                    if (data.success) startPeer();
                    break;
                case "offer":
                    handleOffer(data.offer, data.name);
                    break;
                case "answer":
                    yourConn.setRemoteDescription(new RTCSessionDescription(data.answer));
                    break;
                case "candidate":
                    const candidate = new RTCIceCandidate(data.candidate);
                    if (isRemoteDescSet) {
                        yourConn.addIceCandidate(candidate);
                    } else {
                        candidateQueue.push(candidate);
                    }
                    break;
            }
        };

        function send(msg) {
            if (ws.readyState === WebSocket.OPEN) {
                console.log("🔼 Sending:", msg);
                ws.send(JSON.stringify(msg));
            } else {
                console.error('WebSocket not open:', ws.readyState);
            }
        }

        function login() {
            name = document.getElementById("yourName").value;

            if (ws.readyState === WebSocket.OPEN) {
                send({ type: "login", name });
            } else {
                ws.onopen = () => {
                    send({ type: "login", name });
                };
            }
        }


        function startPeer() {
            navigator.mediaDevices.getUserMedia({ video: true, audio: true }).then((stream) => {
                document.getElementById("localVideo").srcObject = stream;
                localStream = stream;

                yourConn = new RTCPeerConnection({
                    iceServers: [
                        {
                            urls: "stun:stun.relay.metered.ca:80",
                        },
                        {
                            urls: "turn:global.relay.metered.ca:80",
                            username: "f0eab38cc136dc7bb7f547d8",
                            credential: "i3xgGYMCJNMC7Dju",
                        },
                        {
                            urls: "turn:global.relay.metered.ca:80?transport=tcp",
                            username: "f0eab38cc136dc7bb7f547d8",
                            credential: "i3xgGYMCJNMC7Dju",
                        },
                        {
                            urls: "turn:global.relay.metered.ca:443",
                            username: "f0eab38cc136dc7bb7f547d8",
                            credential: "i3xgGYMCJNMC7Dju",
                        },
                        {
                            urls: "turns:global.relay.metered.ca:443?transport=tcp",
                            username: "f0eab38cc136dc7bb7f547d8",
                            credential: "i3xgGYMCJNMC7Dju",
                        },
                    ],
                });

                yourConn.onicecandidate = (e) => {
                    if (e.candidate && targetUser) {
                        send({ type: "candidate", candidate: e.candidate, target: targetUser });
                    }
                };

                yourConn.ontrack = (e) => {
                    document.getElementById("remoteVideo").srcObject = e.streams[0];
                };

                localStream.getTracks().forEach(track => yourConn.addTrack(track, localStream));
            });
        }

        function startCall() {
            targetUser = document.getElementById("targetName").value;
            yourConn.createOffer().then((offer) => {
                yourConn.setLocalDescription(offer);
                send({ type: "offer", offer, target: targetUser });
            });
        }

        function handleOffer(offer, callerName) {
            targetUser = callerName;
            startPeer();
            setTimeout(() => {
                yourConn.setRemoteDescription(new RTCSessionDescription(offer)).then(() => {
                    isRemoteDescSet = true;
                    candidateQueue.forEach(c => yourConn.addIceCandidate(c));
                    candidateQueue = [];
                });

                yourConn.createAnswer().then((answer) => {
                    yourConn.setLocalDescription(answer);
                    send({ type: "answer", answer, target: callerName });
                });
            }, 300);
        }
    </script>
</body>

</html>