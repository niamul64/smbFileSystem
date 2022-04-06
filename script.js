let currentPathText = document.querySelector('#currentPath');




window.onload = function funLoad() { 
    let path= currentPathText.textContent; // grabing the text inside the path
    let backButton = document.querySelector('#backButton'); // back button element grabbing

    if (path.length==4){
        backButton.style.display = 'none'; // if in the root directory then don't show 
    }else{
        backButton.style.display = 'block'; // if not root directory then show 
    }
    
} 


$( "#backButton" ).hover(function() { // function Execute if hover over
    $(this).css("color","blue");
    },
    function(){
        $(this).css("color","black"); // function Execute if not hovering over
    }
);
