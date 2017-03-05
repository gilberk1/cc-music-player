/* Function checks size of artwork and submits or rejects */

function submitArtwork() {
    //check whether browser fully supports all File API
    if (window.File && window.FileReader && window.FileList && window.Blob)
    {
        //get the file size and file type from file input field
        var fsize = $('#artwork')[0].files[0].size;
        
        if(fsize>1048576) //do something if file size more than 1 mb (1048576)
        {
            var k = 1000;
            var dm = 0 + 1 || 3;
            var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
            var i = Math.floor(Math.log(fsize) / Math.log(k));
            alert(parseFloat((fsize / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i] +" bytes\nToo big! Please try again!");
        }
        else {
            $("button[name='album_submit']").prop("type", "submit");
        }
    }else{
        alert("Please upgrade your browser, because your current browser lacks some new features we need!");
    }
}

/* Function checks size of artwork and updates or rejects */

function updateArtwork() {
    //check whether browser fully supports all File API
    if (window.File && window.FileReader && window.FileList && window.Blob)
    {
        //get the file size and file type from file input field
        if (($("#artwork"))[0].files.length > 0) {
            var fsize = $('#artwork')[0].files[0].size;
            if(fsize>1048576) //do something if file size more than 1 mb (1048576)
            {
                var k = 1000;
                var dm = 0 + 1 || 3;
                var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
                var i = Math.floor(Math.log(fsize) / Math.log(k));
                alert(parseFloat((fsize / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i] +" bytes\nToo big! Please try again!");
            }
            else {
                $("button[name='album_update']").prop("type", "submit");
            }
        }
        else {
            $("button[name='album_update']").prop("type", "submit");
        }
    }else{
        alert("Please upgrade your browser, because your current browser lacks some new features we need!");
    }
}

$(document).ready(function() {
    $('#album_submit').click(submitArtwork);
    $('#album_update').click(updateArtwork);
});