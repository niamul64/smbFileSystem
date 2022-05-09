// sorting option for files sort
$('#select2').on('change', function() { // file sort 

    let sortValue= this.value;
    let currentPath= $("#currentPath").text();
    let pathAfterRoot=currentPath.substring(5, );
    if (sortValue==2){
        
        $(".fileShowCard").sort((a,b) =>
        {
            let aElementValue= $(a).data('timedate');
            let bElementValue= $(b).data('timedate');
                
            // console.log($(b));
            return aElementValue>bElementValue ? 1 : -1;
        }).appendTo('#filePrintUnderThisTag');

        
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

$("#button").click(function() { 
        
    let sortedArrayOfElemnt = $("li").sort((a,b) =>
    {
        let aElementValue= $(a).data('size');
        let bElementValue= $(b).data('size');
        
        return aElementValue>bElementValue ? 1 : -1;
    }).appendTo('#sortable');
}
);
