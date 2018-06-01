/****
 *
 * Noty functions for using a single standard
 *
 */

 //alert
function notyAlert(varMessage=NULL, varkill=true){
    new Noty({
        theme: 'bootstrap-v4',
        type: 'alert',
        layout: 'topCenter',
        text: varMessage,
        killer: varkill
    }).show();

}

 //Success
function notySuccess(varMessage=NULL, varkill=true){
    new Noty({
        theme: 'bootstrap-v4',
        type: 'success',
        layout: 'topCenter',
        text: varMessage,
        killer: varkill
    }).show();

}

 //Warning
 function notyWarning(varMessage=NULL, varkill=true){
    new Noty({
        theme: 'bootstrap-v4',
        type: 'warning',
        layout: 'topCenter',
        text: varMessage,
        killer: varkill
    }).show();

}

 //error
 function notyError(varMessage=NULL, varkill=true){
    new Noty({
        theme: 'bootstrap-v4',
        type: 'error',
        layout: 'topCenter',
        text: varMessage,
        killer: varkill
    }).show();

}

 //Info
 function notyInfo(varMessage=NULL, varkill=true){
    new Noty({
        theme: 'bootstrap-v4',
        type: 'info',
        layout: 'topCenter',
        text: varMessage,
        killer: varkill
    }).show();

}
