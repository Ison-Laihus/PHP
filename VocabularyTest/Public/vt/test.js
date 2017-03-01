/* for vt.php */
var addnum = document.getElementById("addnum");
var get = document.getElementById("get");
var addboxs = document.getElementsByClassName("addbox");
var testarea = document.getElementsByClassName("testarea")[0];
var addbox = addboxs[0];


get.onclick = function() {
    var num = addnum.value;
    var len = addboxs.length - 1;
    if ( num>len ) {
        num -= len;
        var flag = document.getElementsByClassName("addsubmit")[0];
        for ( var i=0; i<num; i++ ) {
            var dupli = addbox.cloneNode();
            var in1 = document.createElement("input");
            in1.type = 'text';
            in1.name = 'adden' + (len + i);
            in1.placeholder="请输入英文单词";
            dupli.appendChild(in1);
            var in2 = document.createElement("input");
            in2.type = 'text';
            in2.name = 'addzh' + (len + i);
            in2.placeholder="请输入单词示意";
            dupli.appendChild(in2);
            testarea.insertBefore(dupli, flag);
        }
    } else if ( num<len ) {
        do{
            testarea.removeChild(addboxs[len-1]);
            len --;
        } while ( len>num );
    }
}/**
 * Created by Administrator on 2016/10/16 0016.
 */
