$("#button").click(function() { 
        
        let sortedArrayOfElemnt = $("li").sort((a,b) =>
        {
            let aElementValue= $(a).data('size');
            let bElementValue= $(b).data('size');
            
           return aElementValue>bElementValue ? 1 : -1;
        }).appendTo('#sortable');
        console.log(sortedArrayOfElemnt);
        
    }
);
