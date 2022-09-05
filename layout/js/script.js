let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.navbar');

menu.onclick = () =>{
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
}

window.onscroll = () =>{
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
}
/*sign up form js*/

/* chatbot javaScript */
const popup = document.querySelector('.chat-popup');
const chatBtn = document.querySelector('.chat-btn');
const submitBtn = document.querySelector('.submit');
const chatArea = document.querySelector('.chat-area');
const inputElm = document.querySelector('input');
const emojiBtn = document.querySelector('#emoji-btn');
const picker = new EmojiButton();
// Emoji selection  
window.addEventListener('DOMContentLoaded', () => {
    picker.on('emoji', emoji => {
      document.querySelector('input').value += emoji;
    });  
    emojiBtn.addEventListener('click', () => {
      picker.togglePicker(emojiBtn);
    });
  });        
//   chat button toggler 
chatBtn.addEventListener('click', ()=>{
    popup.classList.toggle('show');
})
// send msg 
submitBtn.addEventListener('click', ()=>{

    let userInput = inputElm.value;
    let time = new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
    let temp = `<div class="d-flex flex-row justify-content-end mb-4 pt-1">
    <div>
    <h2 class="large p-2 me-3 mb-1 text-white rounded-3 bg-primary">
    <span class="msg name="user_msg">${userInput}</span></h2>
    <p class="small me-3 mb-3 rounded-3 text-muted d-flex justify-content-end">${time}</p>
    </div>
    <img src="https://lh3.googleusercontent.com/a-/AOh14GhooIuQgQf9tiMRvQpCPfyA7GI7VO3u2l8qwnFRRkA=s96-c"
    alt="user"
    style="width: 15%; height: 100%; border-radius: 50%; border: 0.5px solid #e84118;">
    </div>`;
    chatArea.insertAdjacentHTML("beforeend", temp);
    inputElm.value = '';
})

// get user location by Geolocation API Ajax
$(document).ready(function(){
  if(navigator.geolocation){
      navigator.geolocation.getCurrentPosition(showLocation);
  }else{ 
      $('#location').html('Geolocation is not supported by this browser.');
  }
});

function showLocation(position){
  var latitude = position.coords.latitude;
  var longitude = position.coords.longitude;
  $.ajax({
      type:'POST',
      url:'getLocation.php',
      data:'latitude='+latitude+'&longitude='+longitude,
      success:function(msg){
          if(msg){
            $("#location").html(msg);
          }else{
              $("#location").html('Not Available');
          }
      }
  });
}
function sendmsg(){

var msg =  document.getElementById("chat_msg").value
let time = new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
let pataintmsg = `<div class="d-flex flex-row justify-content-end mb-4 pt-1">
<div>
<h2 class="large p-2 me-3 mb-1 text-white rounded-3 bg-primary">
<span class="msg name="user_msg">${msg}</span></h2>
<p class="small me-3 mb-3 rounded-3 text-muted d-flex justify-content-end">${time}</p>
</div>
<img src="https://lh3.googleusercontent.com/a-/AOh14GhooIuQgQf9tiMRvQpCPfyA7GI7VO3u2l8qwnFRRkA=s96-c"
alt="user"
style="width: 15%; height: 100%; border-radius: 50%; border: 0.5px solid #e84118;">
</div>`;
chatArea.insertAdjacentHTML("beforeend", pataintmsg);
inputElm.value = '';
console.log(msg)
  $.ajax({
    type:'POST',
    url:'sendmsg.php',
    data:'user_msg='+msg,
    success:function(response){
      console.log(response)
      let botmsg = `<div class="d-flex flex-row justify-content-start">
      <img src="layout/images/Asset 1@5x.png"
      alt="bot" style="width: 15%; height: 100%; border-radius: 50%; border: 0.5px solid #e84118;">
  <div>
  <h2 class=" large p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;">
  <span class="msg">${response}</span></h2>`
  chatArea.insertAdjacentHTML("beforeend", botmsg);

}
});
  
}

