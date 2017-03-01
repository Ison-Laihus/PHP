/**
 *  for vt.html
 */
var pics = document.getElementsByClassName("pics")[0];
var pic = pics.getElementsByClassName("pic");
var pixs = document.getElementsByClassName("pixs")[0];
var pix = pixs.getElementsByClassName("pix");
var winH = window.innerHeight;
var index = 0;
var flag = 0;

/* 自动执行动画 */
window.onload = AutoScroll();

function AutoScroll() {
    if ( !flag ) {
        var timer = setInterval(function(){
            if ( index <5 ) {
                scrollNext();
                changeOn();
            } else {
                flag = 1;
                clearInterval(timer);
            }
        }, 3000);
    }
}


/* 监听鼠标的滚动事件，来确定图片的切换 */
window.onmousewheel = function(e) {
    if ( flag ) {
        var distance;
        if ( e.wheelDelta ) {
            distance = e.wheelDelta/4;
        } else if ( e.detail ) {
            distance = e.detail;
        }
        if ( distance >= 30 ) {
            // 换下一张图片
            scrollPrev();
        } else if ( distance <= -30 ) {
            // 换上一张图片
            scrollNext();
        }
        changeOn();
    }
};
// 换下一张图片
var scrollNext = function() {
    if ( index<5 ) {
        index ++;
        pic[0].style.marginTop = -index*winH + 'px';
    }
};
// 换上一张图片
var scrollPrev = function() {
    if ( index>0 ) {
        index --;
        pic[0].style.marginTop = -index*winH + 'px';
    }
};
/* 按照index的值设置切换点的状态 */
var changeOn = function() {
    for ( var i=0; i<pix.length; i++ ) {
        pix[i].id = '';
    }
    pix[index].id = 'on';
};

/* 点击切换点进行图片的切换 */
for ( var i=0; i<pix.length; i++ ) {
    if ( flag ) {
        (function(arg){
            pix[arg].onclick = function() {
				console.log('The anchor index : '+arg);
                index = arg;
                pic[0].style.marginTop = -index*winH + 'px';
                changeOn();
            }
        })(i);
    }


}
/**
 * Created by Administrator on 2016/10/16 0016.
 */