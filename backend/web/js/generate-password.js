$(".generate-rnd-password").click(function(){
    $("#user-password").val('');
    setTimeout(function(){
        var rndPassword = generatePassword();
        $("#user-password").val(rndPassword);
    }, 1000);
    
});

function generatePassword() {
    var length = 8,
        charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
        retVal = "";
    for (var i = 0, n = charset.length; i < length; ++i) {
        retVal += charset.charAt(Math.floor(Math.random() * n));
    }
    return retVal;
}