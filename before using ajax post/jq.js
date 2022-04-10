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

// function deleteDir(path,folder){
//     if (confirm(`Are you sure: Delete " ${folder} " folder?`)){
        
//         $.ajax({//AJAX request
            
//             url: "index.php",
//             data: {deletePath: path,folderName:folder},
//             success: function (response) {
//                 window.location.reload();
//                 }
//         });
//     }
    
// }

function deleteDir(path,folder){
    Swal.fire({
        title: ` Delete: ${folder}`,
        text: "Are You sure?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
        $.ajax({//AJAX request
            url: "index.php",
            data: {deletePath: path,folderName:folder},
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Folder Deleted',
                    showConfirmButton: false,
                    timer: 1500
                  }).then(function() {
                    let url = 'index.php?reloadPath='+path;
                    window.location.assign(url);
                });
                }
        });
        }
      })   
}

// function deletefile(path,file){
//     if (confirm(`Are you sure: Delete "${file}" file?`)){
//         window.location.reload();
//         $.ajax({//AJAX request
//             url: "index.php",
//             data: {deletePath: path ,fileName:file},
//             success: function (response) {
//                 window.location.reload();
//                 }
//         });

//     }
    
// }

function deletefile(path,file){
    
    Swal.fire({
        title: ` Delete: ${file}`,
        text: "Are You sure?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
        $.ajax({//AJAX request
            url: "index.php",
            data: {deletePath: path ,fileName:file},
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'File Deleted',
                    showConfirmButton: false,
                    timer: 1500
                  }).then(function() {
                    let url = 'index.php?reloadPath='+path;
                    window.location.assign(url);
                });
                }
        });
        }
      })      
}

