var video = document.getElementById("video");
var input = document.getElementById("myimg");
var validate = document.getElementById("face_validate");
var domain = "https://www.ixambee.com/";

function cam_on() {
    Promise.all([
        faceapi.nets.tinyFaceDetector.loadFromUri(domain + "weights"),
        // faceapi.nets.faceLandmark68Net.loadFromUri(domain + 'weights'),
        // faceapi.nets.faceRecognitionNet.loadFromUri(domain + 'weights'),
        // faceapi.nets.faceExpressionNet.loadFromUri(domain + 'weights'),
        faceapi.nets.ssdMobilenetv1.loadFromUri(domain + "weights"),
    ]).then(start_cam);
}

async function start_cam() {
    var stream = null;
    stream = await navigator.mediaDevices
        .getUserMedia({
            video: { facingMode: "user" },
            audio: false,
        })
        .then((stream) => {
            video.srcObject = stream;
            video.controls = false;
            video.play();
        })
        .catch((err) => {
            console.log(err);
            alert(err);
            // alert("Please Allow Your Camera Access");
            document.getElementById("validate_body").classList.remove("d-flex");
            document.getElementById("validate_body").classList.add("d-none");
            document.getElementById("camera_error").classList.remove("d-none");
            document.getElementById("camera_error").classList.add("d-flex");
        });

    // navigator.mediaDevices.getUserMedia({    video: {}},    stream => video.srcObject = stream,    err => alert("Please Allow Your Camera Access"),);
    // console.log('Entered into the detections part');     // const canvas = document.getElementById("mycanvas");   // const displaysize = {width: input.width, height:input.height}   // faceapi.matchDimensions(canvas,displaysize)   // const detections = await faceapi.detectAllFaces(input);   // const resizedDetections = faceapi.resizeResults(detections,displaysize)   // canvas.getContext('2d').clearRect(0,0, canvas.width, canvas.height)   // faceapi.draw.drawDetections(canvas, resizedDetections)   // console.log(detections);
}
var loading = document.getElementById("camera-svg");
var checking_camera = true;
var timeinterval = 1000;
validate.addEventListener("click", () => {
    video.style.border = "solid 0px black";
    video.srcObject = null;
    video.src = domain + "check.mp4";
    validate.style.display = "none";
    timeinterval = 3000;
    checking_camera = null;
    setTimeout(() => {
        $("#validate_compatibility").modal("hide");
    }, 1200);
});

var suspendtimeout = 0;
var sent_data = false;
async function intervalexecution() {
    if (checking_camera == true) {
        const detections = await faceapi.detectAllFaces(video);
        // const resizedDetections = faceapi.resizeResults(detections,displaySize)            // canvas.getContext('2d').clearRect(0,0, canvas.width, canvas.height) // faceapi.draw.drawDetections(canvas, resizedDetections)
        loading.classList.add("d-none");
        video.classList.remove("d-none");
        if (detections.length == 1) {
            document.getElementById("face_validate").disabled = false;
            validate.classList.remove("btn-danger");
            validate.classList.add("btn-success");
        } else {
            validate.classList.remove("btn-success");
            validate.classList.add("btn-danger");
            document.getElementById("face_validate").disabled = true;
        }
        validate.style.display = "";
    } else if (checking_camera == false) {
        const detections = await faceapi.detectAllFaces(video);
        if (detections.length == 1) {
            suspendtimeout = 0;
        } else if (suspendtimeout <= 21) {
            suspendtimeout++;
            console.log(suspendtimeout);
        }
        if (suspendtimeout >= 21) {
            video.style.border = "solid 4px red";
            awaystarttime = new Date();
            awayendtime = null;
            if (sent_data == false) {
                switchmodal("face");
                switch_ajax(awaystarttime, awayendtime, "face");
            }
            sent_data = true;
        } else {
            awaystarttime = null;
            awayendtime = new Date();
            if (sent_data == true)
                switch_ajax(awaystarttime, awayendtime, "face");
            sent_data = false;
            video.style.border = "solid 2px green";
        }
    }
}

var intervalid = 0;
video.addEventListener("play", async () => {
    console.log("Camera Detection started");
    clearInterval(intervalid);
    intervalid = setInterval(intervalexecution, timeinterval);
});

var camError = document.getElementById("camera_retry");
camError.addEventListener("click", () => {
    start_cam();
    document.getElementById("validate_body").classList.remove("d-none");
    document.getElementById("validate_body").classList.add("d-flex");
    document.getElementById("camera_error").classList.remove("d-flex");
    document.getElementById("camera_error").classList.add("d-none");
});

var continuewithout = document.getElementById("cwc");
var cwc = false;
continuewithout.addEventListener("click", () => {
    $("#validate_compatibility").modal("hide");
    cwc = true;
});
