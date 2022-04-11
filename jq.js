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


//////////
//ajax form post
function keepBothOrReplaceFile(formData,fileExits,dirExists, newCreateFile,reloadUrl){


    Swal.fire({
        title: 'Same file exits. Select a option:',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Keep Both',
        denyButtonText: `Replace`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
                $.ajax({
                type: "POST",
                url: "indexFileUpKeepBoth.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response);
                },
                }).then(function(response) {
                    Swal.fire('Saved!', '', 'success').then(function(response) {
                        let url = 'index.php?reloadPath='+reloadUrl;
                        window.location.assign(url);
                    });
                })
          
        } else if (result.isDenied) {
            $.ajax({
                type: "POST",
                url: "index_up_replace.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response);
                },
                }).then(function(response) {
                    Swal.fire('Changes are not saved', '', 'info').then(function(response) {
                        let url = 'index.php?reloadPath='+reloadUrl;
                        window.location.assign(url);
                    });
                })
          
        }
      })
}


$("#submit_form").on("submit", function(e){ //first method
    e.preventDefault();
    let reloadUrl='';
    var formData = new FormData(this);
    $.ajax({
        type: "POST",
        url: "index_file_up_on_condition.php",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            return response;
        },
        
    }).then(function(response) {
        let queryArry = response.split("|");
        reloadUrl=queryArry[0];
        let fileExits=parseInt(queryArry[1]);
        let dirExists=parseInt(queryArry[2]);
        let newCreateFile=parseInt(queryArry[3]);

        if (fileExits || dirExists || newCreateFile){
            // console.log('pass');
           
                // console.log('pass');
            keepBothOrReplaceFile(formData,fileExits,dirExists, newCreateFile,reloadUrl);
        }
        else{
            let url = 'index.php?reloadPath='+reloadUrl;
            window.location.assign(url);
        }

    });

})

