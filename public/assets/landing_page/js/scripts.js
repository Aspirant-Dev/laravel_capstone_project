/*!
* Start Bootstrap - Small Business v5.0.3 (https://startbootstrap.com/template/small-business)
* Copyright 2013-2021 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-small-business/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project


//-----------------------------------------------------------\\

//for typing text
const typedTextSpan = document.querySelector(".typed-text");
const cursorSpan = document.querySelector(".cursor");

// const textArray = ["Web Developer","Game Developer","Programmer"];
const textArray = ["a hardware targeted to be one of the best retailers of hardware products in Marilao, located in Mc Arthur hi-way, Saog, Marilao, Bulacan. It was established on January 20, 2008. Real Value Enterprise is one of the hardware product providers in the city that serves as a well supplier in house building, various construction, erection, house maintenance, house beautification, house tools, and some industrial tools."];
const typingDelay = 50;
const erasingDelay = 0;
const newTextDelay = 0;
let textArrayIndex = 0;
let charIndex = 0;

function type(){
    if(charIndex < textArray[textArrayIndex].length){
        if(!cursorSpan.classList.contains("typing")) cursorSpan.classList.add("typing");
        typedTextSpan.textContent += textArray[textArrayIndex].charAt(charIndex);
        charIndex++;
        setTimeout(type, typingDelay);
    }
    else{
        cursorSpan.classList.remove("typing");
        // setTimeout(erase, newTextDelay);
    }
}
function erase(){
 if(charIndex > 0){
     typedTextSpan.textContent = textArray[textArrayIndex].substring(0,charIndex-1);
     charIndex--;
    setTimeout(erase, erasingDelay);
}
else{
    textArrayIndex++;
    if(textArrayIndex>=textArray.length) textArrayIndex=0;
    setTimeout(type, typingDelay + 1100);
}

}
document.addEventListener("DOMContentLoaded", function(){
   if(textArray.length) setTimeout(type, newTextDelay + 250);
});
