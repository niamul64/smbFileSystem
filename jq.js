let currentPathText = document.querySelector('#currentPath');




window.onload = function funLoad() { 
    let path= currentPathText.textContent; // grabing the text inside the path
    let backButton = document.querySelector('#backButton'); // back button element grabbing
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


$( ".folderId" ).hover(function() { // function Execute if hover over
    $(this).addClass("bg-info");
    },
    function(){
        $(this).removeClass("bg-info"); // function Execute if not hovering over
    }
);

$( ".folderId" ).hover(function() { // function Execute if hover over
    $(this).addClass("bg-info");
    },
    function(){
        $(this).removeClass("bg-info"); // function Execute if not hovering over
    }
);


$( "#gotoHome" ).hover(function() { // function Execute if hover over
    $(this).addClass("bg-warning");
    $(this).removeClass("bg-info");
    },
    function(){
        $(this).removeClass("bg-warning"); // function Execute if not hovering over
        $(this).addClass("bg-info");
    }
);

$( ".deleteFile" ).hover(function() { // function Execute if hover over
    $(this).addClass("bg-danger");

    },
    function(){
        $(this).removeClass("bg-danger"); // function Execute if not hovering over
    }
);

$( ".downloadFile" ).hover(function() { // function Execute if hover over
    $(this).addClass("bg-info");
    },
    function(){
        $(this).removeClass("bg-info"); // function Execute if not hovering over
    }
);


$( ".folderDelete" ).hover(function() { // function Execute if hover over
    $(this).addClass("bg-warning");
    $(this).removeClass("bg-info");
    },
    function(){
        $(this).removeClass("bg-warning"); // function Execute if not hovering over
        $(this).addClass("bg-info");
    }
);

function deleteDir(path,folder){
    if (confirm(`Are you sure: Delete ${folder} folder`)){
        $.ajax({//AJAX request

            url: "index.php",
            data: {deletePath: path,folderName:folder},
            success: function (response) {
                window.location.reload();
                }
        });

    }
    
}

function deletefile(path,file){
    if (confirm(`Are you sure: Delete ${file} folder`)){
        $.ajax({//AJAX request
            url: "index.php",
            data: {deletePath: path ,fileName:file},
            success: function (response) {
                console.log(response);
                window.location.reload();
                }
        });

    }
    
}