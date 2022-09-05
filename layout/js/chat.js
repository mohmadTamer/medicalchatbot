

menu.onclick = () =>{
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
}

window.onscroll = () =>{
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
}

const chatpopup = document.querySelector('.chatbot-popup');
const chatbotBtn = document.querySelector('.chatbot-btn');





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

chatbotBtn.addEventListener('click', ()=>{
    chatpopup.classList.toggle('show');
})

// send msg 
submitBtn.addEventListener('click', ()=>{
    let userInput = inputElm.value;


    let temp = `<div class="d-flex flex-row justify-content-end mb-4 pt-1">
    <div>
    <h2 class="large p-2 me-3 mb-1 text-white rounded-3 bg-primary">
    <span class="my-msg name="user_msg">${userInput}</span></h2>
    <p class="small me-3 mb-3 rounded-3 text-muted d-flex justify-content-end">${time}</p>
    </div>
    <img src="https://lh3.googleusercontent.com/a-/AOh14GhooIuQgQf9tiMRvQpCPfyA7GI7VO3u2l8qwnFRRkA=s96-c"
    alt="user"
    style="width: 15%; height: 100%; border-radius: 50%; border: 0.5px solid #e84118;">
    </div>`;

    chatArea.insertAdjacentHTML("beforeend", temp);
    inputElm.value = '';

})
