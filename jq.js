let currentPathText = document.querySelector('#currentPath');




window.onload = function funLoad() { 
    let path= currentPathText.textContent; // grabing the text inside the path
    let backButton = document.querySelector('#backButton'); // back button element grabbing
    console.log(path.length);
    if (path.length==5){
        backButton.style.display = 'none'; // if in the root directory then don't show 
    }else{
        backButton.style.display = 'block'; // if not root directory then show 
    }
} 


$( "#backButton" ).hover(function() { // function Execute if hover over
    $("#backButton").removeClass("btn-dark");
    $("#backButton").addClass("btn-success");
    },
    function(){
        $("#backButton").removeClass("btn-success");
        $("#backButton").addClass("btn-dark"); // function Execute if not hovering over
    }
);

$( "#submitForm" ).hover(function() { // function Execute if hover over
    $("#submitForm").removeClass("btn-secondary");
    $("#submitForm").addClass("btn-success");
    },
    function(){
        $("#submitForm").removeClass("btn-success");
        $("#submitForm").addClass("btn-secondary"); // function Execute if not hovering over
    }
);





