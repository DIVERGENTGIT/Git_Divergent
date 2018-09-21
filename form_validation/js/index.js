

element = document.getElementById("scalability-bn");


element.addEventListener("click", function(e) {
  e.preventDefault;
  
  // -> removing the class
  element.classList.remove("bounce");
  
  // -> triggering reflow /* The actual magic */
  // without this it wouldn't work. Try uncommenting the line and the transition won't be retriggered.
  element.offsetWidth = element.offsetWidth;
  
  // -> and re-adding the class
  element.classList.add("bounce");
}, false);

element2 = document.getElementById("cloud-bn");


element2.addEventListener("click", function(e) {
  e.preventDefault;
  
  // -> removing the class
  element2.classList.remove("bounce");
  
  // -> triggering reflow /* The actual magic */
  // without this it wouldn't work. Try uncommenting the line and the transition won't be retriggered.
  element2.offsetWidth = element2.offsetWidth;
  
  // -> and re-adding the class
  element2.classList.add("bounce");
}, false);

element3 = document.getElementById("multi-bn");


element3.addEventListener("click", function(e) {
  e.preventDefault;
  
  // -> removing the class
  element3.classList.remove("bounce");
  
  // -> triggering reflow /* The actual magic */
  // without this it wouldn't work. Try uncommenting the line and the transition won't be retriggered.
  element3.offsetWidth = element3.offsetWidth;
  
  // -> and re-adding the class
  element3.classList.add("bounce");
}, false);

element4 = document.getElementById("redun-bn");


element4.addEventListener("click", function(e) {
  e.preventDefault;
  
  // -> removing the class
  element4.classList.remove("bounce");
  
  // -> triggering reflow /* The actual magic */
  // without this it wouldn't work. Try uncommenting the line and the transition won't be retriggered.
  element4.offsetWidth = element4.offsetWidth;
  
  // -> and re-adding the class
  element4.classList.add("bounce");
}, false);