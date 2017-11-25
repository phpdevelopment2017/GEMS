/**
 *  This function render options to a particular combo via a particular array
 *  dataArray - is the array which is used to generate options, this array is a two dimensional array with
 *  one key and on value, we need its key as the value of our option object and its value as the text
 *  of our option object
 *  comboId - is the id of the combo to which the generated options are to be appended
 *  
 *  TODO  name it renderOptions
 */
function renderOptionsForTwoDimensionalArray(dataArray, comboId, notDisplay, notDisplayId) {
    if (!dataArray) {
        return false;
    }
    $('#' + comboId).html('<option value="">&nbsp;</option>');
    var data = {};
    var optionResult = "";
    $.each(dataArray, function (index, dataObject) {
        if (notDisplay && index == notDisplayId) {
            return true;
        }
        data = {"value_field": index, 'text_field': dataObject};
        optionResult = optionTemplate(data);
        $("#" + comboId).append(optionResult);
    });
}

function validateEmail(email) {
    var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
    if (filter.test(email)) {
        return true;
    } else {
        return false;
    }
}

/**
 *  This function checks if a value of an object is numeric or not
 *  if the value is not numeric then the value of the object is set to blank
 */
function checkNumeric(obj) {
    if (!$.isNumeric(obj.val())) {
        obj.val('');
    }
}

function roundOff(obj) {
    var amount = obj.val();
    if ($.isNumeric(amount)) {
        amount = Math.abs(amount);
        obj.val(parseFloat(amount).toFixed(2));
    }
}

(function ($) {
    $.fn.serializeFormJSON = function () {

        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push($.trim(this.value) || '');
            } else {
                o[this.name] = $.trim(this.value) || '';
            }
        });
        return o;
    };
})(jQuery);