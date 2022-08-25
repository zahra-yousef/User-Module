const pageIds = [];
 
function toggleButtton(){
    document.getElementById("editButton").style.display = "none";
    document.getElementById("saveButton").style.display = "block";

     for (let i = 0; i < pageIds.length; i++) {
        var disabled = document.getElementById(pageIds[i]).disabled;

        if (disabled) {
            document.getElementById(pageIds[i]).disabled = false;
        }
        else {
            document.getElementById(pageIds[i]).disabled = true;
        }
    }
};


function getComponentsIds(ids){
    for(var i=0; i<ids.length; i++){
 		pageIds[i] = ids[i];
    }
    
    toggleButtton();
}
