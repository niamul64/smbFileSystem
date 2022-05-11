$( "body" ).hover(function() { // hover on file cards (here we can allso use id #fileCardJsTriger)

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
    });
}); // hover on file cards end
