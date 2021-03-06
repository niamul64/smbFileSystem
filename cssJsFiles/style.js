let currentPathText = document.querySelector('#currentPath');

window.onload = function funLoad() {  // onload the index.php page
    let path= currentPathText.textContent; // grabing the text inside the path
    let backButton = document.querySelector('#backButton'); // back button element grabbing
    if (path.length==5){
        backButton.style.display = 'none'; // if in the root directory then don't show 
    }else{
        backButton.style.display = 'block'; // if not root directory then show 
    }
}; 
$( "#backButton" ).hover(function() { // function Execute if hover over back button
    $("#backButton").removeClass("btn-dark");
    $("#backButton").addClass("btn-success");
    },
    function(){                        // function Execute if not hovering over
        $("#backButton").removeClass("btn-success");
        $("#backButton").addClass("btn-dark"); 
    }
); // function Execute if hover over back button end

$( "#dirPrintUnderThisTag" ).hover(function() { // hover on Directories/Folders
    $( ".folderDelete" ).hover(function() { // function Execute if hover over delete button
        $(this).addClass("bg-warning");
        $(this).removeClass("bg-info");
        },
        function(){                         // function Execute if not hovering over delete button
            $(this).removeClass("bg-warning"); 
            $(this).addClass("bg-info");
        }),
    $( ".folderId" ).hover(function() { // function Execute if hover over folder name
        $(this).addClass("bg-info");
        },
        function(){                     // function Execute if not hovering over folder name
            $(this).removeClass("bg-info"); 
        });
}); // hover on Directories/Folders End

$("body").on("click", ".cardTitleSelect", function () {// select or unselect a file card 
    //or we can use $(".checkbox").on("click", function () {}) 
    $(this).parent().parent().toggleClass('selected');
});

$( "#markAll" ).click(function() { // function Execute if clicked on mark all button
    $('.fileShowCard').each((index, element) => {
        if (!($(element).hasClass('selected'))) // looping through all the file cards
        {
            $(element).addClass("selected"); // selecting file card
        }
    });
});

$( "#unmarkAll" ).click(function() { // function Execute if clicked on unmark all button
    $('.fileShowCard').each((index, element) => {
        if ($(element).hasClass('selected')) // looping through all the file cards
        {
            $(element).removeClass("selected");// unselecting file card
        }
    });
});

$( "#submitButton" ).hover(function() { // function Execute if hover over
    $("#submitButton").removeClass("btn-secondary");
    $("#submitButton").addClass("btn-success");
    },
    function(){                         // function Execute if not hovering over dir and file submit button
        $("#submitButton").removeClass("btn-success");
        $("#submitButton").addClass("btn-secondary");
    }
);

$( "#submitButton2" ).hover(function() { // function Execute if hover over
    $("#submitButton2").removeClass("btn-secondary");
    $("#submitButton2").addClass("btn-success");
    },
    function(){
        $("#submitButton2").removeClass("btn-success");
        $("#submitButton2").addClass("btn-secondary"); // function Execute if not hovering over
    }
);

$( "#gotoHome" ).hover(function() { // function Execute if hover over Goto home dir button
    $(this).addClass("bg-warning");
    $(this).removeClass("bg-info");
    },
    function(){                     // function Execute if not hovering over
        $(this).removeClass("bg-warning"); 
        $(this).addClass("bg-info");
    }
);
    
$( ".deleteFile" ).hover(function() { // function Execute if hover over on delete icon on file card
    $(this).addClass("bg-danger");
    },
    function(){
        $(this).removeClass("bg-danger"); // function Execute if not hovering over
    }
);

$( ".downloadFile" ).hover(function() { // function Execute if hover over on download icon on file
    $(this).addClass("bg-info");
    },
    function(){
        $(this).removeClass("bg-info"); // function Execute if not hovering over
    }
);