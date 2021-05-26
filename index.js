var upload_field = document.getElementsByClassName("body-upload")[0];
var list_field = document.getElementsByClassName("body-list")[0];
var ifrm = document.getElementById("ifrm");
var check_selection = True;
var check_addDirectory = True;
startSelection();



function showContent(dosya) {
    document.getElementById('ifrm').src = "uploads/" + dosya;
}

function startSelection() {
    list = document.getElementsByClassName('checkbox');
    len = list.length;
    if (check_selection) {
        for (let index = 0; index < len; index++) {
            list[index].style.display = "none";
        }
    } else {
        for (let index = 0; index < len; index++) {
            list[index].style.display = "inline";
        }
    }
    check_selection = !check_selection
}

function hideDeleteArea() {
    document.getElementById('areYouSure').style.display = "none";
    document.getElementsByClassName("body-list")[0].style.opacity = "1";
    document.getElementsByClassName("body-main")[0].style.opacity = "1";
    document.getElementsByClassName("header-A")[0].style.opacity = "1";
}

//
function areYouSure(yes = false, cancel = false, file = "") {
    document.getElementById('areYouSure').style.display = "block";
    document.getElementsByClassName("body-list")[0].style.opacity = ".3";
    //document.getElementsByClassName("body-list")[0].style.zIndex = "-20";
    document.getElementsByClassName("body-main")[0].style.opacity = ".3";
    document.getElementsByClassName("header-A")[0].style.opacity = ".3";
    document.getElementById('areYouSure').style.opacity = "1";

    if (yes) {
        _file = showSelected();
        if (_file != "") {
            window.location.replace('delete.php?file=' + _file);
        } else hideDeleteArea();
    } else if (cancel) {
        hideDeleteArea();
    }

}



function showSelected(rt = 0) {
    var form = document.getElementById("checkboxform");
    inputs = form.getElementsByTagName("input");
    arr = [];
    arr_str = "";
    for (var i = 0, max = inputs.length; i < max; i += 1) {
        // Take only those inputs which are checkbox
        if (inputs[i].type === "checkbox" && inputs[i].checked) {
            val = inputs[i].value;
            valu = val.replace("/", "");
            arr.push(valu);
            arr_str += valu + ",";
        }
    }
    //alert(arr_str);
    if (rt == 1) return arr;
    else return arr_str;
}

function showAddDirBtn() {
    if (!check_addDirectory) {
        document.getElementById('createDirectory').style.display = "block";
    } else {
        document.getElementById('createDirectory').style.display = "none";
    }
    check_addDirectory = !check_addDirectory;

}