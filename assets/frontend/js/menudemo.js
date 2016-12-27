$(document).ready(function () {


    var shading = 'rgba(170,170,170,0.5)';
    var color = 'skin-blue-dark';
    var speed = 600;
    var easing = 'ease-in';
    var hoverIn = 'flipInX';
    var hoverOut = 'slideUp';
    var vertical = false;
    var clickable = false;
    var responsive = true;

    $('#txtShading').val(shading);
    $('#txtSpeed').val(speed);
    $('#ddlEasing').val(easing);
    $('#ddlHoverIn').val(hoverIn);
    $('#ddlHoverOut').val(hoverOut);
    $('.color-selected').val(color);
    $('#ckbVertical').prop('checked', vertical);
    $('#ckbClickable').prop('checked', clickable);
    $('#ckbResponsive').prop('checked', responsive);

    if ($.cookie("hoverIn") != 'null' && $.cookie("hoverIn") != null && $.cookie("hoverIn") != undefined && $.cookie("hoverIn") != 'undefined') {
        var cookieVertical = false;
        if ($.cookie("vertical") == 'true') cookieVertical = true;

        var cookieClickable = false;
        if ($.cookie("clickable") == 'true') cookieClickable = true;

        var cookieResponsive = false;
        if ($.cookie("responsive") == 'true') cookieResponsive = true;

        $('#ckbVertical').prop('checked', cookieVertical);
        $('#ckbClickable').prop('checked', cookieClickable);
        $('#ckbResponsive').prop('checked', cookieResponsive);
        $('#txtShading').val($.cookie("shading"));
        $('#txtSpeed').val($.cookie("speed"));
        $('#ddlEasing').val($.cookie("easing"));
        $('#ddlHoverIn').val($.cookie("hoverIn"));
        $('#ddlHoverOut').val($.cookie("hoverOut"));
        $('.dd-selected-value').val($.cookie("color"));
        $('.color-selected').val($.cookie("color"));
    }

    var ddData = [
                {
                    text: "BROWN LIGHT",
                    value: 'skin-brown-light',
                    selected: 'skin-brown-light' == $('.color-selected').val(),
                    color: '#CC9933'
                },
                {
                    text: "BROWN DARK",
                    value: 'skin-brown-dark',
                    selected: 'skin-brown-dark' == $('.color-selected').val(),
                    color: '#AD8042'
                },
                {
                    text: "GREEN LIGHT",
                    value: 'skin-green-light',
                    selected: 'skin-green-light' == $('.color-selected').val(),
                    color: '#77CC33'
                },
                {
                    text: "GREEN DARK",
                    value: 'skin-green-dark',
                    selected: 'skin-green-dark' == $('.color-selected').val(),
                    color: '#7A997A'
                },
                {
                    text: "RED LIGHT",
                    value: 'skin-red-light',
                    selected: 'skin-red-light' == $('.color-selected').val(),
                    color: '#FF7373'
                },
                {
                    text: "RED DARK",
                    value: 'skin-red-dark',
                    selected: 'skin-red-dark' == $('.color-selected').val(),
                    color: '#E84C3D'
                },
                {
                    text: "ORANGE LIGHT",
                    value: 'skin-orange-light',
                    selected: 'skin-orange-light' == $('.color-selected').val(),
                    color: '#F39C11'
                },
                {
                    text: "ORANGE DARK",
                    value: 'skin-orange-dark',
                    selected: 'skin-orange-dark' == $('.color-selected').val(),
                    color: '#D16400'
                },
                {
                    text: "BLUE LIGHT",
                    value: 'skin-blue-light',
                    selected: 'skin-blue-light' == $('.color-selected').val(),
                    color: '#33B4D4'
                },
                {
                    text: "BLUE DARK",
                    value: 'skin-blue-dark',
                    selected: 'skin-blue-dark' == $('.color-selected').val(),
                    color: '#2888D2'
                },
                {
                    text: "GRAY",
                    value: 'skin-gray',
                    selected: 'skin-gray' == $('.color-selected').val(),
                    color: '#4D5766'
                },
                {
                    text: "BLACK",
                    value: 'skin-black',
                    selected: 'skin-black' == $('.color-selected').val(),
                    color: '#000000'
                },
                {
                    text: "PINK LIGHT",
                    value: 'skin-pink-light',
                    selected: 'skin-pink-light' == $('.color-selected').val(),
                    color: '#EA4C89'
                },
                {
                    text: "PINK DARK",
                    value: 'skin-pink-dark',
                    selected: 'skin-pink-dark' == $('.color-selected').val(),
                    color: '#CC3399'
                },
                {
                    text: "VIOLET DARK",
                    value: 'skin-violet-dark',
                    selected: 'skin-violet-dark' == $('.color-selected').val(),
                    color: '#52689A'
                },
                {
                    text: "VIOLET LIGHT",
                    value: 'skin-violet-light',
                    selected: 'skin-violet-light' == $('.color-selected').val(),
                    color: '#A252B1'
                }
            ];



    //Dropdown plugin data
    $('#colorTheme').ddslick({
        data: ddData,
        imagePosition: "left",
        width: 240,
        selectText: "Select a color",
        onSelected: function (data) {

        }
    });







    $('#menuMega').menu3d({
        shading: $('#txtShading').val(),
        skin: $('.dd-selected-value').val(),
        speed: $('#txtSpeed').val(),
        easing: $('#ddlEasing').val(),
        hoverIn: $('#ddlHoverIn').val(),
        hoverOut: $('#ddlHoverOut').val(),
        vertical: $('#ckbVertical').is(":checked"),
        clickable: $('#ckbClickable').is(":checked"),
        responsive: $('#ckbResponsive').is(":checked")
    });






});


function setMenu() {
    $.cookie("shading", $('#txtShading').val());
    $.cookie("color", $('.dd-selected-value').val());
    $.cookie("speed", $('#txtSpeed').val());
    $.cookie("easing", $('#ddlEasing').val());
    $.cookie("hoverIn", $('#ddlHoverIn').val());
    $.cookie("hoverOut", $('#ddlHoverOut').val());
    $.cookie("vertical", $('#ckbVertical').is(":checked"));
    $.cookie("clickable", $('#ckbClickable').is(":checked"));
    $.cookie("responsive", $('#ckbResponsive').is(":checked"));

    
    
    $('#menuMega').menu3d({
        shading: $('#txtShading').val(),
        skin: $('.dd-selected-value').val(),
        speed: $('#txtSpeed').val(),
        easing: $('#ddlEasing').val(),
        hoverIn: $('#ddlHoverIn').val(),
        hoverOut: $('#ddlHoverOut').val(),
        vertical: $('#ckbVertical').is(":checked"),
        clickable: $('#ckbClickable').is(":checked"),
        responsive: $('#ckbResponsive').is(":checked")
    });

    window.location.reload(true);
}