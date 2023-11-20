console.log('working');


// Assuming you have an element with the class "alert"
const alertElement = document.querySelector(".alert");

// Delay for 7000 milliseconds (7 seconds)
setTimeout(function() {
    // Fade out over 1 second
    alertElement.style.transition = "opacity 1s";
    alertElement.style.opacity = 0;

    // Optionally, you can remove the element from the DOM after fading out
    setTimeout(function() {
        alertElement.parentNode.removeChild(alertElement);
    }, 1000); // Wait for the fade out duration before removing the element
}, 7000);
