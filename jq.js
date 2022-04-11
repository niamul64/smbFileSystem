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


$( "#submitButton" ).hover(function() { // function Execute if hover over
    $("#submitButton").removeClass("btn-secondary");
    $("#submitButton").addClass("btn-success");
    },
    function(){
        $("#submitButton").removeClass("btn-success");
        $("#submitButton").addClass("btn-secondary"); // function Execute if not hovering over
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
function keepBothOrReplaceFile(formData, reloadUrl){
    Swal.fire({
        title: 'Same file already exists.',
        text: "If you want to replace the old file with new one then press the 'Replace' button and if you want to keep both files then press 'Keep Both' button",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Keep Both',
        denyButtonText: `Replace`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) { // keep both
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
                    Swal.fire('Saved!', 'New file name: '+response, 'success').then(function(response) {
                        let url = 'index.php?reloadPath='+reloadUrl;
                        window.location.assign(url);
                    });
                })
          
        } else if (result.isDenied) { // replace 
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


                    Swal.fire('File replaced','','success').then(function(response) {
                        let url = 'index.php?reloadPath='+reloadUrl;
                        window.location.assign(url);
                    });
                })
        }
      })
}


$("#submit_form2").on("submit", function(e){ //first method
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

        if (fileExits){

            keepBothOrReplaceFile(formData,reloadUrl);
        }
        else{
            let url = 'index.php?reloadPath='+reloadUrl;
            window.location.assign(url);
        }

    });

})

$("#submit_form").on("submit", function(e){ //first method
    e.preventDefault();

    let reloadUrl='';
    var formData = new FormData(this);
    $.ajax({
        type: "POST",
        url: "fileOrdirectoryCreate.php",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            return response;
        },
        
    }).then(function(response) {
        let queryArry = response.split("|");
        reloadUrl=queryArry[0];
        let directoryExists=parseInt(queryArry[1]);
        let newCreatingFile=parseInt(queryArry[2]);
        if (directoryExists && newCreatingFile){
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'The file and directory already exist. Please choose another name and try again.',
               
              }).then(function(response) {
                let url = 'index.php?reloadPath='+reloadUrl;
                window.location.assign(url);
            })
        }else if(directoryExists){
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'The directory already exists. Please choose another name and try again.',
               
              }).then(function(response) {
                let url = 'index.php?reloadPath='+reloadUrl;
                window.location.assign(url);
            })
        }
        else if(newCreatingFile){
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'The file already exists. Please choose another name and try again.',
               
              }).then(function(response) {
                let url = 'index.php?reloadPath='+reloadUrl;
                window.location.assign(url);
            })
        }
        else{
        
            let url = 'index.php?reloadPath='+reloadUrl;
            window.location.assign(url);
        }
    });
})

// sorting option
$('#select1').on('change', function() { // folder sort 
    let sortValue= this.value;
    let currentPath= $("#currentPath").text();
    let pathAfterRoot=currentPath.substring(5,);

    if (sortValue==2){
        $.ajax({
            type: "POST",
            url: "folderSort.php",
            data: {path:pathAfterRoot},
            success: function (response) {
                console.log(response);
            },
        });
    }else{
        let url = 'index.php?reloadPath='+pathAfterRoot;
        window.location.assign(url);
    }
});

$('#select2').on('change', function() { // file sort 
    let sortValue= this.value;
    let currentPath= $("#currentPath").text();
    let pathAfterRoot=currentPath.substring(5, );

    if (sortValue==2){
        $.ajax({
            type: "POST",
            url: "fileSort.php",
            data: {path:pathAfterRoot},
    
            success: function (response) {
                return response;
            },
            
        });
    }
    else if (sortValue==3){
        $.ajax({
            type: "POST",
            url: "fileSort.php",
            data: {path:pathAfterRoot},
    
            success: function (response) {
                return response;
            },
            
        });
    }
    else{
        let url = 'index.php?reloadPath='+pathAfterRoot;
        window.location.assign(url);
    }
});
