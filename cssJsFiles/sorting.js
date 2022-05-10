// sorting option for directories sort
$('#select1').on('change', function() { // folder sort 
    let sortValue= this.value;
    let currentPath= $("#currentPath").text();
    let pathAfterRoot=currentPath.substring(5,);

    if (sortValue==2){// sorting based on dir lst modified time
        $(".eachDir").sort((a,b) => 
        {
            let aElementValue= $(a).data('timedatefordir');
            let bElementValue= $(b).data('timedatefordir');
                
            // console.log($(b));
            return aElementValue>bElementValue ? -1 : 1;
        }).appendTo('#dirPrintUnderThisTag'); // reflecting to 

    }else if(sortValue==1){// sorting based on dir lst modified time
        $(".eachDir").sort((a,b) => 
        {
            let aElementValue= $(a).data('filenameofdir');
            let bElementValue= $(b).data('filenameofdir');
                
            // console.log($(b));
            return aElementValue>bElementValue ? 1 : -1;
        }).appendTo('#dirPrintUnderThisTag'); // reflecting to 
    }
});
// sorting option for directories sort end

// sorting option for files sort
$('#select2').on('change', function() { // file sort 

    let sortValue= this.value;
    let currentPath= $("#currentPath").text();
    let pathAfterRoot=currentPath.substring(5, );
    if (sortValue==3){
        
        $(".fileShowCard").sort((a,b) => // sorting based on file size
        {
            let aElementValue= $(a).data('timedate');
            let bElementValue= $(b).data('timedate');
                
            // console.log($(b));
            return aElementValue>bElementValue ? -1 : 1;
        }).appendTo('#filePrintUnderThisTag'); // reflecting to 
    }

    else if (sortValue==5){
        $(".fileShowCard").sort((a,b) => // sorting based on file size
        {
            let aElementValue= $(a).data('filesize');
            let bElementValue= $(b).data('filesize');
                
            // console.log($(b));
            return aElementValue>bElementValue ? -1 : 1;
        }).appendTo('#filePrintUnderThisTag'); // reflecting to 
    }
    else if (sortValue==1){
        $(".fileShowCard").sort((a,b) => // sorting based on file size
        {
            let aElementValue= $(a).data('filename');
            let bElementValue= $(b).data('filename');
                
            // console.log($(b));
            return aElementValue>bElementValue ? 1 : -1;
        }).appendTo('#filePrintUnderThisTag'); // reflecting to 
    }
});
// sorting option for files sort end

