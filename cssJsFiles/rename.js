$( "#renameFile" ).click(function() { // onclick the rename file icon this function will Execute
    let currentDir = $(this).data('currentDir');
    let oldFileName = $(this).data('oldfilename');
    (async () => { // will take user input for new name file name
        const { value: text } = await Swal.fire({
          title: `Rename: ${oldFileName}`,
          input: 'text',
          inputLabel: 'Enter new name for the file, with extention',
          inputPlaceholder: 'Enter your email address',
          showCancelButton: true
        })
        if (text) { // grab the user input in 'text'
            $.ajax({                        //AJAX request
                url: "fileRename.php",           // Get request
                data: {path: currentDir, oldName: oldFileName, newName: text},
                success: function (response) {
                        if (response=='error'){
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops. rename unsuccessful',
                                text: 'please choose another name for the file',
                            }).then(function() { // reload 
                                location.reload();
                            });    
                        }
                        else{
                            location.reload();
                        }              
                    }
            });
        }
    })()
});