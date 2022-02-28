/*function btn1() {
    document.getElementById("changePicture").src="img/alienForce.jpg";
}

function btn2() {
    document.getElementById("changePicture").src="img/ultimateAlien.jpg";
}

function btn3() {
    document.getElementById("changePicture").src="img/ben.jpg";
}
*/

var btn1 = document.querySelector('#alien-force');
var btn2 = document.querySelector('#ultimate-alien');
var btn3 = document.querySelector('#classic');

function changeOne() {
    document.getElementById('changePicture').src="img/alienForce.jpg";
}

function changeTwo() {
    document.getElementById('changePicture').src="img/ultimateAlien.jpg";
}

function changeThree() {
    document.getElementById('changePicture').src="img/ben.jpg";
}

btn1.addEventListener('click', changeOne);
btn2.addEventListener('click', changeTwo);
btn3.addEventListener('click', changeThree);

var showVideo = document.querySelector('#play-video');

function showModal() {
    showVideo.data-toggle="modal";
}
