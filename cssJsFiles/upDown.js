$( "#downloadAllSelectedFlle" ).click(function() { // function Execute if clicked on delete button at button group
    var numOfISelectedItems = $('.selected').length;
    if (numOfISelectedItems) // looping through all the file cards
    {
        $("#loadingIcon").removeClass('d-none');
        $("#filePrintUnderThisTag").addClass('d-none');
        let currentPath= $("#currentPath").text(); // current directory path
        let pathAfterRoot=currentPath.substring(5,); // path after 'Root//'
        let files=[];
        $('.selected').each((index, element) => {
            files.push($(element).data('filename'));
        });     
        $.ajax({                        //AJAX request
            url: "allPhpFiles/multipleFileDownload.php",           // Get request
            data: {downloadPath: pathAfterRoot ,fileNames:files},
            success: function (response) {
                $("#loadingIcon").addClass('d-none');
                $("#filePrintUnderThisTag").removeClass('d-none');
                }
        }).then(function() {  // reload 
            let url = 'allPhpFiles/zipDownload.php?pathAfterRootFromMultiDownload='+pathAfterRoot; // downlad zi
            window.location=url; 
            });
    }
});


$( ".downloadFile" ).click(function() { // function Execute if clicked on delete button at button group
    let dirAfterRoot = $(this).data('currentdir').trim();
    let fileNameToDownload = $(this).data('filename').trim();
    
    let url = 'allPhpFiles/singleFileDownload.php?downloadPath='+dirAfterRoot+'&downloadFileName='+fileNameToDownload; // downlad zi
    window.location=url; 
});
