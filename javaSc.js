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

