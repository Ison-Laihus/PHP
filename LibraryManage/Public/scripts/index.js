/**
 * Created by lyk on 2017/1/19 0019.
 */
// ********************
// common document area
// ********************
// var secondMenus = document.getElementsByClassName("SecondItems");
var items = document.getElementsByClassName("item");
var menuBlock = document.getElementsByClassName("MenuBlock")[0];
var contentBlock = document.getElementsByClassName("ContentBlock")[0];

var windowHeight;
var windowWidth;

// *****************************
// load events at the first time
// *****************************
$(document).ready(function(){
    // $(".itemTitle").click(function(){
    //     $(this).next().slideToggle(1000);
    // });

    // 设置菜单栏和内容栏的高度，使其能够贴合浏览器
    setMenuHeight();

    // 设置内容栏到宽度，使其能够贴合浏览器
    setContentWidth();

    // 当调整浏览器时，相应的更新大小
    window.onabort = function() {
        setMenuHeight();
    }
});

// ******************
// area for functions
// ******************
// 设置菜单栏和内容栏的高度，使其能够贴合浏览器
function setMenuHeight() {
    windowHeight = window.innerHeight>200?window.innerHeight:200;
    menuBlock.style.height = (windowHeight-80)+'px';
    contentBlock.style.height = (windowHeight-80)+'px';
}
// 设置内容栏到宽度，使其能够贴合浏览器
function setContentWidth() {
    windowWidth = window.innerWidth>600?window.innerWidth:600;
    contentBlock.style.width = (windowWidth-200)+'px';
}