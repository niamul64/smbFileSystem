// sorting option for files sort
$('#select2').on('change', function() { // file sort 

    let sortValue= this.value;
    let currentPath= $("#currentPath").text();
    let pathAfterRoot=currentPath.substring(5, );
    console.log("hi i am from sorting");
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
