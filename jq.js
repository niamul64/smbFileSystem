let currentPathText = document.querySelector('#currentPath');


var selectCount=0;

window.onload = function funLoad() {  // onload the index.php page
    let path= currentPathText.textContent; // grabing the text inside the path
    let backButton = document.querySelector('#backButton'); // back button element grabbing
    if (path.length==5){
        backButton.style.display = 'none'; // if in the root directory then don't show 
    }else{
        backButton.style.display = 'block'; // if not root directory then show 
    }
}; 

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

$( "body" ).hover(function() { // hover on file cards (here we can allso use id #fileCardJsTriger)

    $( ".cardTitleSelect" ).click(function() { // select or unselect a file card 
            if ($(this).parent().parent().hasClass('selected')){
                $(this).parent().parent().removeClass("selected");// unselect a file card 
            }
            else{
                $(this).parent().parent().addClass("selected"); // select a file card 
            }
        },
    ),
    

    // $( ".fileShowCard" ).click(function() { // select or unselect a file card 
    //         if ($(this).hasClass('selected')){
    //             $(this).removeClass("selected");
    //             selectCount -=1;
    //             console.log(selectCount)
    //         }
    //         else{
    //             selectCount +=1;
    //             console.log(selectCount)
    //             $(this).addClass("selected");
    //         }
    //     },
    // ),

    $( "#markAll" ).click(function() { // function Execute if clicked on mark all button
        $('.fileShowCard').each((index, element) => {
            if (!($(element).hasClass('selected'))) // looping through all the file cards
            {
                $(element).addClass("selected"); // selecting file card
            }
        });
    }),

    $( "#unmarkAll" ).click(function() { // function Execute if clicked on unmark all button
        $('.fileShowCard').each((index, element) => {
            if ($(element).hasClass('selected')) // looping through all the file cards
            {
                $(element).removeClass("selected");// unselecting file card
            }
        });
    }),

    $( "#deleteAllSelectedfiles" ).click(function() { // function Execute if clicked on delete button at button group
        var numOfISelectedItems = $('.selected').length;
        if (numOfISelectedItems) // looping through all the file cards
        {
            Swal.fire({
                title: `Are You sure?`,
                text: "Will Delete all the selected files.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.isConfirmed) {       // if connfirmed
                    let currentPath= $("#currentPath").text(); // current directory path
                    let pathAfterRoot=currentPath.substring(5,); // path after 'Root//'
                    $('.selected').each((index, element) => {
                        let file=$(element).children().first().children().first().text();

                        $.ajax({                        //AJAX request
                            url: "index.php",           // Get request
                            data: {deletePath: pathAfterRoot ,fileName:file},
                            success: function (response) {
                                    $(element).remove();
                                }
                        });
                    });
                }
                else{
                    location.reload();
                }
              }) 
        }

    }),

    $( "#downloadAllSelectedFlle" ).click(function() { // function Execute if clicked on delete button at button group
        var numOfISelectedItems = $('.selected').length;
        if (numOfISelectedItems) // looping through all the file cards
        {
            $("#loadingIcon").toggleClass('d-none');
            $("#filePrintUnderThisTag").toggleClass('d-none');
            let currentPath= $("#currentPath").text(); // current directory path
            let pathAfterRoot=currentPath.substring(5,); // path after 'Root//'
            let files=[];
            $('.selected').each((index, element) => {
                files.push($(element).children().first().children().first().text());
            });
            console.log(files);
            $.ajax({                        //AJAX request
                url: "multipleFileDownload.php",           // Get request
                data: {downloadPath: pathAfterRoot ,fileNames:files},
                success: function (response) {
                    $("#loadingIcon").toggleClass('d-none');
                    $("#filePrintUnderThisTag").toggleClass('d-none');
                    let url = 'index.php?pathAfterRootFromMultiDownload='+pathAfterRoot;
                    window.location.assign(url);                
                    }
            });

        }

    }),

   

    $( ".deleteFile" ).hover(function() { // function Execute if hover over on delete icon on file card
        $(this).addClass("bg-danger");
    
        },
        function(){
            $(this).removeClass("bg-danger"); // function Execute if not hovering over
        }
    ),
    
    $( ".downloadFile" ).hover(function() { // function Execute if hover over on download icon on file
        $(this).addClass("bg-info");
        },
        function(){
            $(this).removeClass("bg-info"); // function Execute if not hovering over
        }
    );
}); // hover on file cards end

function renameFile($currentDir,$oldFileName){ // onclick the rename file icon this function will Execute
    console.log($currentDir,$oldFileName);
    (async () => {

        const { value: email } = await Swal.fire({
          title: 'Input email address',
          input: 'email',
          inputLabel: 'Your email address',
          inputPlaceholder: 'Enter your email address'
        })
        
        if (email) {
          Swal.fire(`Entered email: ${email}`)
        }
        else{
            location.reload();
        }
        
        })()

}

$( "#backButton" ).hover(function() { // function Execute if hover over back button
    $("#backButton").removeClass("btn-dark");
    $("#backButton").addClass("btn-success");
    },
    function(){                        // function Execute if not hovering over
        $("#backButton").removeClass("btn-success");
        $("#backButton").addClass("btn-dark"); 
    }
); // function Execute if hover over back button end


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

// delete dir
function deleteDir(path,folder){ // 'on click' applied on index.php by passing the path after root and folderName 
    Swal.fire({                  // popUP to have user confirmation
        title: ` Delete: ${folder}`,
        text: "Are You sure?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {      
        if (result.isConfirmed) {    // if connfirmed
        $.ajax({                     // AJAX request
            url: "index.php",        // Get request
            data: {deletePath: path,folderName:folder},
            success: function (response) {
                Swal.fire({           // show success message
                    icon: 'success',
                    title: 'Folder Deleted',
                    showConfirmButton: false,
                    timer: 1500
                  }).then(function() { // reload 
                    let url = 'index.php?reloadPath='+path;
                    window.location.assign(url);
                });
                }
        });
        }
        else{
            let url = 'index.php?reloadPath='+path;
                    window.location.assign(url);
        }
      })   
}
// delete dir end

// delete file
function deletefile(path,file){ // 'on click' applied on index.php by passing the path after root and folderName
    Swal.fire({
        title: ` Delete: ${file}`,
        text: "Are You sure?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {       // if connfirmed
        $.ajax({                        //AJAX request
            url: "index.php",           // Get request
            data: {deletePath: path ,fileName:file},
            success: function (response) {
                Swal.fire({             // show success message
                    icon: 'success',
                    title: 'File Deleted',
                    showConfirmButton: false,
                    timer: 1500
                  }).then(function() {  // reload 
                    let url = 'index.php?reloadPath='+path;
                    window.location.assign(url);
                });
                }
        });
        }
        else{
            let url = 'index.php?reloadPath='+path;
                    window.location.assign(url);
        }
      })      
}
// delete file end

// sorting option for directories sort
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
                // console.log(response);
                $("#dirPrintUnderThisTag").html(response);
               
            },
        });
    }else{
        let url = 'index.php?reloadPath='+pathAfterRoot;
        window.location.assign(url);
    }
});
// sorting option for directories sort end

// sorting option for files sort
$('#select2').on('change', function() { // file sort 
    let sortValue= this.value;
    let currentPath= $("#currentPath").text();
    let pathAfterRoot=currentPath.substring(5, );
    console.log(this.value);
    if (sortValue==2){
        $.ajax({
            type: "POST",
            url: "fileSortByTime.php",
            data: {path:pathAfterRoot},
            success: function (response) {
                $("#filePrintUnderThisTag").html(response);
            },
        });
    }
    else if (sortValue==3){
        $.ajax({
            type: "POST",
            url: "fileSortBySize.php",
            data: {path:pathAfterRoot},
    
            success: function (response) {
                $("#filePrintUnderThisTag").html(response);
                
            },
            
        });
    }
    else{
        let url = 'index.php?reloadPath='+pathAfterRoot;
        window.location.assign(url);
    }
});
// sorting option for files sort end


// Ajax form submit post section start

// function called from submit button2
function keepBothOrReplaceFile(formData, reloadUrl){
    Swal.fire({
        title: 'Same file already exists.',
        text: "If you want to replace the old file with new one then press the 'Replace' button and if you want to keep both files then press 'Keep Both' button",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Keep Both',
        denyButtonText: `Replace`,
      }).then((result) => {
     
        if (result.isConfirmed) { // keep both option
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
          
        } else if (result.isDenied) { // replace option
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


$("#submit_form2").on("submit", function(e){ // submit button2: for file upload 
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

        if (fileExits){                 // if file already exits in the directory

            keepBothOrReplaceFile(formData,reloadUrl); // call function to let the user choose a option
        }
        else{                           // If file uploadedd successfully (file is new) 
            let url = 'index.php?reloadPath='+reloadUrl;
            window.location.assign(url);// reload the page 
        }
    });
})

$("#submit_form").on("submit", function(e){ // submit for folder/file creating 
    e.preventDefault(); // prevent form submit to php file

    let reloadUrl='';   // variable to keep path after root
    var formData = new FormData(this); // grab the form value
    $.ajax({
        type: "POST",                   // send post request to make file or dir
        url: "fileOrdirectoryCreate.php",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            return response;
        },
        
    }).then(function(response) {        // grab response
        let queryArry = response.split("|");
        reloadUrl=queryArry[0];         // grab path after root
        let directoryExists=parseInt(queryArry[1]); // if directory with same name already exists the value 1
        let newCreatingFile=parseInt(queryArry[2]); // if file with same name already exists the value 1
        if (directoryExists && newCreatingFile){    // if file and dir both already exists
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'The file and directory already exist. Please choose another name and try again.',
               
              }).then(function(response) {
                let url = 'index.php?reloadPath='+reloadUrl;
                window.location.assign(url);
            })
        }else if(directoryExists){                  // if dir already exists
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'The directory already exists. Please choose another name and try again.',
               
              }).then(function(response) {
                let url = 'index.php?reloadPath='+reloadUrl;
                window.location.assign(url);
            })
        }
        else if(newCreatingFile){                   // if file already exists
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'The file already exists. Please choose another name and try again.',
               
              }).then(function(response) {
                let url = 'index.php?reloadPath='+reloadUrl;
                window.location.assign(url);
            })
        }
        else{                                       // if file or dir created successfully then just reload
        
            let url = 'index.php?reloadPath='+reloadUrl;
            window.location.assign(url);
        }
    });
})

