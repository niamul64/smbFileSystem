
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
}), 

$( "body" ).hover(function() { // hover on file cards (here we can allso use id #fileCardJsTriger)

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

    $( "#searchFile" ).click(function() { // function Execute if clicked on search button at button group
        
            (async () => {

                const { value: fileName } = await Swal.fire({ // ask user to input the file name
                  input: 'text',
                  inputLabel: 'Search',
                  inputPlaceholder: 'File name',
                  showCancelButton: true,
                })
                if (fileName) {
                    // search on the fileName
                    // $("#loadingIconForSearching").removeClass('d-none');
                    // $("#filePrintUnderThisTag").addClass('d-none');
                    let currentPath= $("#currentPath").text(); // current directory path
                    let pathAfterRoot=currentPath.substring(5,); // path after 'Root//'
                    $.ajax({                        //AJAX request
                        type: "POST",
                        url: "allPhpFiles/searchFile.php",           // Post request sending to this file
                        data: {path: pathAfterRoot, fileName:fileName},
                            success: function (response) {
                                // $("#loadingIcon").addClass('d-none');
                                // $("#filePrintUnderThisTag").removeClass('d-none');
                                console.log(response);
                                $("#filePrintUnderThisTag").html(response); // after searching replace the current files with new search result
                            }
                    });
                }
            })()
    }),


    $( "#deleteAllSelectedFiles" ).click(function() { // function Execute if clicked on delete button at button group
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
                        let file=$(element).data('filename');

                        $.ajax({                        //AJAX request
                            url: "index.php",           // Get request
                            data: {deletePath: pathAfterRoot ,fileName:file},
                            success: function (response) {
                                    $(element).remove();
                                }
                        });
                    });
                }
              }) 
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
      })      
}
// delete file end

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
                url: "allPhpFiles/indexFileUpKeepBoth.php",
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
                url: "allPhpFiles/index_up_replace.php",
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
        url: "allPhpFiles/index_file_up_on_condition.php",
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
        url: "allPhpFiles/fileOrdirectoryCreate.php",
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
                // let url = 'index.php?reloadPath='+reloadUrl;
                // window.location.assign(url);
            })
        }else if(directoryExists){                  // if dir already exists
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'The directory already exists. Please choose another name and try again.',
               
              }).then(function(response) {
                // let url = 'index.php?reloadPath='+reloadUrl;
                // window.location.assign(url);
                window.location.reload();
            })
        }
        else if(newCreatingFile){                   // if file already exists
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'The file already exists. Please choose another name and try again.',
               
              }).then(function(response) {
                // let url = 'index.php?reloadPath='+reloadUrl;
                // window.location.assign(url);
                window.location.reload();
            })
        }
        else{                                       // if file or dir created successfully then just reload
        
            let url = 'index.php?reloadPath='+reloadUrl;
            window.location.assign(url);
        }
    });
})

