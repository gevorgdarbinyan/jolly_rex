$(document).ready(function(){
    console.log("site index");
    //$('.left-tree-class').css('margin-left', '120px');
    
    
    var turnInRightLeftTree = function() {
        var marginLeft = Number($('.left-tree-class').css('margin-left').slice(0, -2));

        console.log(marginLeft);
        console.log('turnInRightLeftTree function called');
        //if(marginLeft >= 85 && marginLeft <= 150) {
            //$('.left-tree-class').css('margin-left', '+=20px');
        //}
        //if(marginLeft > 150){
            //$('.left-tree-class').css('margin-left', '-=70px');
        //}
    }
    
    var turnInLeftLeftTree = function() {
        console.log('turnInLeftLeftTree function called');
        $('.left-tree-class').css('margin-left', '85px');
     }

     //turnInRightLeftTree();
    setInterval(turnInRightLeftTree, 1000);
    //setInterval(turnInLeftLeftTree, 3000);

    
});





