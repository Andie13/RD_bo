/**
 * autoNumeric.js
 * @author: Bob Knothe
 * @author: Sokolov Yura
 * @version: 1.9.42 - 2015-11-20 GMT 3:00 PM / 15:00
 *
 * Created by Robert J. Knothe on 2010-10-25. Please report any bugs to https://github.com/BobKnothe/autoNumeric
 * Contributor by Sokolov Yura on 2010-11-07
 *
 * Copyright (c) 2011 Robert J. Knothe http://www.decorplanit.com/plugin/
 *
 * The MIT License (http://www.opensource.org/licenses/mit-license.php)
 *
 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated documentation
 * files (the "Software"), to deal in the Software without
 * restriction, including without limitation the rights to use,
 * copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following
 * conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 */
!function(e){"use strict";function t(e){var t={};if(void 0===e.selectionStart){e.focus();var a=document.selection.createRange();t.length=a.text.length,a.moveStart("character",-e.value.length),t.end=a.text.length,t.start=t.end-t.length}else t.start=e.selectionStart,t.end=e.selectionEnd,t.length=t.end-t.start;return t}function a(e,t,a){if(void 0===e.selectionStart){e.focus();var i=e.createTextRange();i.collapse(!0),i.moveEnd("character",a),i.moveStart("character",t),i.select()}else e.selectionStart=t,e.selectionEnd=a}function i(t,a){e.each(a,function(e,i){"function"==typeof i?a[e]=i(t,a,e):"function"==typeof t.autoNumeric[i]&&(a[e]=t.autoNumeric[i](t,a,e))})}function n(e,t){"string"==typeof e[t]&&(e[t]*=1)}function r(e,t){i(e,t),t.tagList=["b","caption","cite","code","dd","del","div","dfn","dt","em","h1","h2","h3","h4","h5","h6","ins","kdb","label","li","output","p","q","s","sample","span","strong","td","th","u","var"];var a=t.vMax.toString().split("."),r=t.vMin||0===t.vMin?t.vMin.toString().split("."):[];if(n(t,"vMax"),n(t,"vMin"),n(t,"mDec"),t.mDec="CHF"===t.mRound?"2":t.mDec,t.allowLeading=!0,t.aNeg=t.vMin<0?"-":"",a[0]=a[0].replace("-",""),r[0]=r[0].replace("-",""),t.mInt=Math.max(a[0].length,r[0].length,1),null===t.mDec){var o=0,s=0;a[1]&&(o=a[1].length),r[1]&&(s=r[1].length),t.mDec=Math.max(o,s)}null===t.altDec&&t.mDec>0&&("."===t.aDec&&","!==t.aSep?t.altDec=",":","===t.aDec&&"."!==t.aSep&&(t.altDec="."));var u=t.aNeg?"([-\\"+t.aNeg+"]?)":"(-?)";t.aNegRegAutoStrip=u,t.skipFirstAutoStrip=new RegExp(u+"[^-"+(t.aNeg?"\\"+t.aNeg:"")+"\\"+t.aDec+"\\d].*?(\\d|\\"+t.aDec+"\\d)"),t.skipLastAutoStrip=new RegExp("(\\d\\"+t.aDec+"?)[^\\"+t.aDec+"\\d]\\D*$");var l="-"+t.aNum+"\\"+t.aDec;return t.allowedAutoStrip=new RegExp("[^"+l+"]","gi"),t.numRegAutoStrip=new RegExp(u+"(?:\\"+t.aDec+"?(\\d+\\"+t.aDec+"\\d+)|(\\d*(?:\\"+t.aDec+"\\d*)?))"),t}function o(e,t,a){if(t.aSign)for(;e.indexOf(t.aSign)>-1;)e=e.replace(t.aSign,"");e=e.replace(t.skipFirstAutoStrip,"$1$2"),e=e.replace(t.skipLastAutoStrip,"$1"),e=e.replace(t.allowedAutoStrip,""),t.altDec&&(e=e.replace(t.altDec,t.aDec));var i=e.match(t.numRegAutoStrip);if(e=i?[i[1],i[2],i[3]].join(""):"",("allow"===t.lZero||"keep"===t.lZero)&&"strip"!==a){var n=[],r="";n=e.split(t.aDec),-1!==n[0].indexOf("-")&&(r="-",n[0]=n[0].replace("-","")),n[0].length>t.mInt&&"0"===n[0].charAt(0)&&(n[0]=n[0].slice(1)),e=r+n.join(t.aDec)}if(a&&"deny"===t.lZero||a&&"allow"===t.lZero&&t.allowLeading===!1){var o="^"+t.aNegRegAutoStrip+"0*(\\d"+("leading"===a?")":"|$)");o=new RegExp(o),e=e.replace(o,"$1$2")}return e}function s(e,t){if("p"===t.pSign){var a=t.nBracket.split(",");t.hasFocus||t.removeBrackets?(t.hasFocus&&e.charAt(0)===a[0]||t.removeBrackets&&e.charAt(0)===a[0])&&(e=e.replace(a[0],t.aNeg),e=e.replace(a[1],"")):(e=e.replace(t.aNeg,""),e=a[0]+e+a[1])}return e}function u(e,t){if(e){var a=+e;if(1e-6>a&&a>-1)e=+e,1e-6>e&&e>0&&(e=(e+10).toString(),e=e.substring(1)),0>e&&e>-1&&(e=(e-10).toString(),e="-"+e.substring(2)),e=e.toString();else{var i=e.split(".");void 0!==i[1]&&(0===+i[1]?e=i[0]:(i[1]=i[1].replace(/0*$/,""),e=i.join(".")))}}return"keep"===t.lZero?e:e.replace(/^0*(\d)/,"$1")}function l(e,t,a){return t&&"."!==t&&(e=e.replace(t,".")),a&&"-"!==a&&(e=e.replace(a,"-")),e.match(/\d/)||(e+="0"),e}function c(e,t,a){return a&&"-"!==a&&(e=e.replace("-",a)),t&&"."!==t&&(e=e.replace(".",t)),e}function h(e,t,a){return""===e||e===t.aNeg?"zero"===t.wEmpty?e+"0":"sign"===t.wEmpty||a?e+t.aSign:e:null}function p(e,t){e=o(e,t);var a=e.replace(",","."),i=h(e,t,!0);if(null!==i)return i;var n="";n=2===t.dGroup?/(\d)((\d)(\d{2}?)+)$/:4===t.dGroup?/(\d)((\d{4}?)+)$/:/(\d)((\d{3}?)+)$/;var r=e.split(t.aDec);t.altDec&&1===r.length&&(r=e.split(t.altDec));var u=r[0];if(t.aSep)for(;n.test(u);)u=u.replace(n,"$1"+t.aSep+"$2");if(0!==t.mDec&&r.length>1?(r[1].length>t.mDec&&(r[1]=r[1].substring(0,t.mDec)),e=u+t.aDec+r[1]):e=u,t.aSign){var l=-1!==e.indexOf(t.aNeg);e=e.replace(t.aNeg,""),e="p"===t.pSign?t.aSign+e:e+t.aSign,l&&(e=t.aNeg+e)}return 0>a&&null!==t.nBracket&&(e=s(e,t)),e}function g(e,t){e=""===e?"0":e.toString(),n(t,"mDec"),"CHF"===t.mRound&&(e=(Math.round(20*e)/20).toString());var a="",i=0,r="",o="boolean"==typeof t.aPad||null===t.aPad?t.aPad?t.mDec:0:+t.aPad,s=function(e){var t=0===o?/(\.(?:\d*[1-9])?)0*$/:1===o?/(\.\d(?:\d*[1-9])?)0*$/:new RegExp("(\\.\\d{"+o+"}(?:\\d*[1-9])?)0*$");return e=e.replace(t,"$1"),0===o&&(e=e.replace(/\.$/,"")),e};"-"===e.charAt(0)&&(r="-",e=e.replace("-","")),e.match(/^\d/)||(e="0"+e),"-"===r&&0===+e&&(r=""),(+e>0&&"keep"!==t.lZero||e.length>0&&"allow"===t.lZero)&&(e=e.replace(/^0*(\d)/,"$1"));var u=e.lastIndexOf("."),l=-1===u?e.length-1:u,c=e.length-1-l;if(c<=t.mDec){if(a=e,o>c){-1===u&&(a+=t.aDec);for(var h="000000";o>c;)h=h.substring(0,o-c),a+=h,c+=h.length}else c>o?a=s(a):0===c&&0===o&&(a=a.replace(/\.$/,""));if("CHF"!==t.mRound)return 0===+a?a:r+a;"CHF"===t.mRound&&(u=a.lastIndexOf("."),e=a)}var p=u+t.mDec,g=+e.charAt(p+1),d=e.substring(0,p+1).split(""),f="."===e.charAt(p)?e.charAt(p-1)%2:e.charAt(p)%2,m=!0;if(1!==f&&(f=0===f&&e.substring(p+2,e.length)>0?1:0),g>4&&"S"===t.mRound||g>4&&"A"===t.mRound&&""===r||g>5&&"A"===t.mRound&&"-"===r||g>5&&"s"===t.mRound||g>5&&"a"===t.mRound&&""===r||g>4&&"a"===t.mRound&&"-"===r||g>5&&"B"===t.mRound||5===g&&"B"===t.mRound&&1===f||g>0&&"C"===t.mRound&&""===r||g>0&&"F"===t.mRound&&"-"===r||g>0&&"U"===t.mRound||"CHF"===t.mRound)for(i=d.length-1;i>=0;i-=1)if("."!==d[i]){if("CHF"===t.mRound&&d[i]<=2&&m){d[i]=0,m=!1;break}if("CHF"===t.mRound&&d[i]<=7&&m){d[i]=5,m=!1;break}if("CHF"===t.mRound&&m?(d[i]=10,m=!1):d[i]=+d[i]+1,d[i]<10)break;i>0&&(d[i]="0")}return d=d.slice(0,p+1),a=s(d.join("")),0===+a?a:r+a}function d(e,t,a){var i=t.aDec,n=t.mDec;if(e="paste"===a?g(e,t):e,i&&n){var r=e.split(i);r[1]&&r[1].length>n&&(n>0?(r[1]=r[1].substring(0,n),e=r.join(i)):e=r[0])}return e}function f(e,t){e=o(e,t),e=d(e,t),e=l(e,t.aDec,t.aNeg);var a=+e;return a>=t.vMin&&a<=t.vMax}function m(t,a){this.settings=a,this.that=t,this.$that=e(t),this.formatted=!1,this.settingsClone=r(this.$that,this.settings),this.value=t.value}function v(t){return"string"==typeof t&&(t=t.replace(/\[/g,"\\[").replace(/\]/g,"\\]"),t="#"+t.replace(/(:|\.)/g,"\\$1")),e(t)}function y(e,t,a){var i=e.data("autoNumeric");i||(i={},e.data("autoNumeric",i));var n=i.holder;return(void 0===n&&t||a)&&(n=new m(e.get(0),t),i.holder=n),n}m.prototype={init:function(e){this.value=this.that.value,this.settingsClone=r(this.$that,this.settings),this.ctrlKey=e.ctrlKey,this.cmdKey=e.metaKey,this.shiftKey=e.shiftKey,this.selection=t(this.that),("keydown"===e.type||"keyup"===e.type)&&(this.kdCode=e.keyCode),this.which=e.which,this.processed=!1,this.formatted=!1},setSelection:function(e,t,i){e=Math.max(e,0),t=Math.min(t,this.that.value.length),this.selection={start:e,end:t,length:t-e},(void 0===i||i)&&a(this.that,e,t)},setPosition:function(e,t){this.setSelection(e,e,t)},getBeforeAfter:function(){var e=this.value,t=e.substring(0,this.selection.start),a=e.substring(this.selection.end,e.length);return[t,a]},getBeforeAfterStriped:function(){var e=this.getBeforeAfter();return e[0]=o(e[0],this.settingsClone),e[1]=o(e[1],this.settingsClone),e},normalizeParts:function(e,t){var a=this.settingsClone;t=o(t,a);var i=t.match(/^\d/)?!0:"leading";e=o(e,a,i),""!==e&&e!==a.aNeg||"deny"!==a.lZero||t>""&&(t=t.replace(/^0*(\d)/,"$1"));var n=e+t;if(a.aDec){var r=n.match(new RegExp("^"+a.aNegRegAutoStrip+"\\"+a.aDec));r&&(e=e.replace(r[1],r[1]+"0"),n=e+t)}return"zero"!==a.wEmpty||n!==a.aNeg&&""!==n||(e+="0"),[e,t]},setValueParts:function(e,t,a){var i=this.settingsClone,n=this.normalizeParts(e,t),r=n.join(""),o=n[0].length;return f(r,i)?(r=d(r,i,a),o>r.length&&(o=r.length),this.value=r,this.setPosition(o,!1),!0):!1},signPosition:function(){var e=this.settingsClone,t=e.aSign,a=this.that;if(t){var i=t.length;if("p"===e.pSign){var n=e.aNeg&&a.value&&a.value.charAt(0)===e.aNeg;return n?[1,i+1]:[0,i]}var r=a.value.length;return[r-i,r]}return[1e3,-1]},expandSelectionOnSign:function(e){var t=this.signPosition(),a=this.selection;a.start<t[1]&&a.end>t[0]&&((a.start<t[0]||a.end>t[1])&&this.value.substring(Math.max(a.start,t[0]),Math.min(a.end,t[1])).match(/^\s*$/)?a.start<t[0]?this.setSelection(a.start,t[0],e):this.setSelection(t[1],a.end,e):this.setSelection(Math.min(a.start,t[0]),Math.max(a.end,t[1]),e))},checkPaste:function(){if(void 0!==this.valuePartsBeforePaste){var e=this.getBeforeAfter(),t=this.valuePartsBeforePaste;delete this.valuePartsBeforePaste,e[0]=e[0].substr(0,t[0].length)+o(e[0].substr(t[0].length),this.settingsClone),this.setValueParts(e[0],e[1],"paste")||(this.value=t.join(""),this.setPosition(t[0].length,!1))}},skipAllways:function(e){var t=this.kdCode,a=this.which,i=this.ctrlKey,n=this.cmdKey,r=this.shiftKey;if((i||n)&&"keyup"===e.type&&void 0!==this.valuePartsBeforePaste||r&&45===t)return this.checkPaste(),!1;if(t>=112&&123>=t||t>=91&&93>=t||t>=9&&31>=t||8>t&&(0===a||a===t)||144===t||145===t||45===t||224===t)return!0;if((i||n)&&65===t)return!0;if((i||n)&&(67===t||86===t||88===t))return"keydown"===e.type&&this.expandSelectionOnSign(),(86===t||45===t)&&("keydown"===e.type||"keypress"===e.type?void 0===this.valuePartsBeforePaste&&(this.valuePartsBeforePaste=this.getBeforeAfter()):this.checkPaste()),"keydown"===e.type||"keypress"===e.type||67===t;if(i||n)return!0;if(37===t||39===t){var o=this.settingsClone.aSep,s=this.selection.start,u=this.that.value;return"keydown"===e.type&&o&&!this.shiftKey&&(37===t&&u.charAt(s-2)===o?this.setPosition(s-1):39===t&&u.charAt(s+1)===o&&this.setPosition(s+1)),!0}return t>=34&&40>=t?!0:!1},processAllways:function(){var e;return 8===this.kdCode||46===this.kdCode?(this.selection.length?(this.expandSelectionOnSign(!1),e=this.getBeforeAfterStriped(),this.setValueParts(e[0],e[1])):(e=this.getBeforeAfterStriped(),8===this.kdCode?e[0]=e[0].substring(0,e[0].length-1):e[1]=e[1].substring(1,e[1].length),this.setValueParts(e[0],e[1])),!0):!1},processKeypress:function(){var e=this.settingsClone,t=String.fromCharCode(this.which),a=this.getBeforeAfterStriped(),i=a[0],n=a[1];return t===e.aDec||e.altDec&&t===e.altDec||("."===t||","===t)&&110===this.kdCode?e.mDec&&e.aDec?e.aNeg&&n.indexOf(e.aNeg)>-1?!0:i.indexOf(e.aDec)>-1?!0:n.indexOf(e.aDec)>0?!0:(0===n.indexOf(e.aDec)&&(n=n.substr(1)),this.setValueParts(i+e.aDec,n),!0):!0:"-"===t||"+"===t?e.aNeg?(""===i&&n.indexOf(e.aNeg)>-1&&(i=e.aNeg,n=n.substring(1,n.length)),i=i.charAt(0)===e.aNeg?i.substring(1,i.length):"-"===t?e.aNeg+i:i,this.setValueParts(i,n),!0):!0:t>="0"&&"9">=t?(e.aNeg&&""===i&&n.indexOf(e.aNeg)>-1&&(i=e.aNeg,n=n.substring(1,n.length)),e.vMax<=0&&e.vMin<e.vMax&&-1===this.value.indexOf(e.aNeg)&&"0"!==t&&(i=e.aNeg+i),this.setValueParts(i+t,n),!0):!0},formatQuick:function(){var e=this.settingsClone,t=this.getBeforeAfterStriped(),a=this.value;if((""===e.aSep||""!==e.aSep&&-1===a.indexOf(e.aSep))&&(""===e.aSign||""!==e.aSign&&-1===a.indexOf(e.aSign))){var i=[],n="";i=a.split(e.aDec),i[0].indexOf("-")>-1&&(n="-",i[0]=i[0].replace("-",""),t[0]=t[0].replace("-","")),i[0].length>e.mInt&&"0"===t[0].charAt(0)&&(t[0]=t[0].slice(1)),t[0]=n+t[0]}var r=p(this.value,this.settingsClone),o=r.length;if(r){var s=t[0].split(""),u=0;for(u;u<s.length;u+=1)s[u].match("\\d")||(s[u]="\\"+s[u]);var l=new RegExp("^.*?"+s.join(".*?")),c=r.match(l);c?(o=c[0].length,(0===o&&r.charAt(0)!==e.aNeg||1===o&&r.charAt(0)===e.aNeg)&&e.aSign&&"p"===e.pSign&&(o=this.settingsClone.aSign.length+("-"===r.charAt(0)?1:0))):e.aSign&&"s"===e.pSign&&(o-=e.aSign.length)}this.that.value=r,this.setPosition(o),this.formatted=!0}};var S={init:function(t){return this.each(function(){var i=e(this),n=i.data("autoNumeric"),r=i.data(),u=i.is("input[type=text], input[type=hidden], input[type=tel], input:not([type])");if("object"==typeof n)return this;n=e.extend({},e.fn.autoNumeric.defaults,r,t,{aNum:"0123456789",hasFocus:!1,removeBrackets:!1,runOnce:!1,tagList:["b","caption","cite","code","dd","del","div","dfn","dt","em","h1","h2","h3","h4","h5","h6","ins","kdb","label","li","output","p","q","s","sample","span","strong","td","th","u","var"]}),n.aDec===n.aSep&&e.error("autoNumeric will not function properly when the decimal character aDec: '"+n.aDec+"' and thousand separator aSep: '"+n.aSep+"' are the same character"),i.data("autoNumeric",n);var d=y(i,n);if(u||"input"!==i.prop("tagName").toLowerCase()||e.error('The input type "'+i.prop("type")+'" is not supported by autoNumeric()'),-1===e.inArray(i.prop("tagName").toLowerCase(),n.tagList)&&"input"!==i.prop("tagName").toLowerCase()&&e.error("The <"+i.prop("tagName").toLowerCase()+"> is not supported by autoNumeric()"),n.runOnce===!1&&n.aForm){if(u){var m=!0;""===i[0].value&&"empty"===n.wEmpty&&(i[0].value="",m=!1),""===i[0].value&&"sign"===n.wEmpty&&(i[0].value=n.aSign,m=!1),m&&""!==i.val()&&(null===n.anDefault&&i[0].value===i.prop("defaultValue")||null!==n.anDefault&&n.anDefault.toString()===i.val())&&i.autoNumeric("set",i.val())}-1!==e.inArray(i.prop("tagName").toLowerCase(),n.tagList)&&""!==i.text()&&i.autoNumeric("set",i.text())}n.runOnce=!0,i.is("input[type=text], input[type=hidden], input[type=tel], input:not([type])")&&(i.on("keydown.autoNumeric",function(t){return d=y(i),d.settings.aDec===d.settings.aSep&&e.error("autoNumeric will not function properly when the decimal character aDec: '"+d.settings.aDec+"' and thousand separator aSep: '"+d.settings.aSep+"' are the same character"),d.that.readOnly?(d.processed=!0,!0):(d.init(t),d.skipAllways(t)?(d.processed=!0,!0):d.processAllways()?(d.processed=!0,d.formatQuick(),t.preventDefault(),!1):(d.formatted=!1,!0))}),i.on("keypress.autoNumeric",function(e){d=y(i);var t=d.processed;return d.init(e),d.skipAllways(e)?!0:t?(e.preventDefault(),!1):d.processAllways()||d.processKeypress()?(d.formatQuick(),e.preventDefault(),!1):void(d.formatted=!1)}),i.on("keyup.autoNumeric",function(e){d=y(i),d.init(e);var t=d.skipAllways(e);return d.kdCode=0,delete d.valuePartsBeforePaste,i[0].value===d.settings.aSign&&("s"===d.settings.pSign?a(this,0,0):a(this,d.settings.aSign.length,d.settings.aSign.length)),t?!0:""===this.value?!0:void(d.formatted||d.formatQuick())}),i.on("focusin.autoNumeric",function(){d=y(i);var e=d.settingsClone;if(e.hasFocus=!0,null!==e.nBracket){var t=i.val();i.val(s(t,e))}d.inVal=i.val();var a=h(d.inVal,e,!0);null!==a&&""!==a&&i.val(a)}),i.on("focusout.autoNumeric",function(){d=y(i);var e=d.settingsClone,t=i.val(),a=t;e.hasFocus=!1;var n="";"allow"===e.lZero&&(e.allowLeading=!1,n="leading"),""!==t&&(t=o(t,e,n),null===h(t,e)&&f(t,e,i[0])?(t=l(t,e.aDec,e.aNeg),t=g(t,e),t=c(t,e.aDec,e.aNeg)):t="");var r=h(t,e,!1);null===r&&(r=p(t,e)),(r!==d.inVal||r!==a)&&(i.val(r),i.change(),delete d.inVal)}))})},destroy:function(){return e(this).each(function(){var t=e(this);t.off(".autoNumeric"),t.removeData("autoNumeric")})},update:function(t){return e(this).each(function(){var a=v(e(this)),i=a.data("autoNumeric");"object"!=typeof i&&e.error("You must initialize autoNumeric('init', {options}) prior to calling the 'update' method");var n=a.autoNumeric("get");return i=e.extend(i,t),y(a,i,!0),i.aDec===i.aSep&&e.error("autoNumeric will not function properly when the decimal character aDec: '"+i.aDec+"' and thousand separator aSep: '"+i.aSep+"' are the same character"),a.data("autoNumeric",i),""!==a.val()||""!==a.text()?a.autoNumeric("set",n):void 0})},set:function(t){return null!==t?e(this).each(function(){var a=v(e(this)),i=a.data("autoNumeric"),n=t.toString(),r=t.toString(),o=a.is("input[type=text], input[type=hidden], input[type=tel], input:not([type])");return"object"!=typeof i&&e.error("You must initialize autoNumeric('init', {options}) prior to calling the 'set' method"),r!==a.attr("value")&&r!==a.text()||i.runOnce!==!1||(n=n.replace(",",".")),e.isNumeric(+n)||e.error("The value ("+n+") being 'set' is not numeric and has caused a error to be thrown"),n=u(n,i),i.setEvent=!0,n.toString(),""!==n&&(n=g(n,i)),n=c(n,i.aDec,i.aNeg),f(n,i)||(n=g("",i)),n=p(n,i),o?a.val(n):-1!==e.inArray(a.prop("tagName").toLowerCase(),i.tagList)?a.text(n):!1}):void 0},get:function(){var t=v(e(this)),a=t.data("autoNumeric");"object"!=typeof a&&e.error("You must initialize autoNumeric('init', {options}) prior to calling the 'get' method");var i="";return t.is("input[type=text], input[type=hidden], input[type=tel], input:not([type])")?i=t.eq(0).val():-1!==e.inArray(t.prop("tagName").toLowerCase(),a.tagList)?i=t.eq(0).text():e.error("The <"+t.prop("tagName").toLowerCase()+"> is not supported by autoNumeric()"),""===i&&"empty"===a.wEmpty||i===a.aSign&&("sign"===a.wEmpty||"empty"===a.wEmpty)?"":(""!==i&&null!==a.nBracket&&(a.removeBrackets=!0,i=s(i,a),a.removeBrackets=!1),(a.runOnce||a.aForm===!1)&&(i=o(i,a)),i=l(i,a.aDec,a.aNeg),0===+i&&"keep"!==a.lZero&&(i="0"),"keep"===a.lZero?i:i=u(i,a))},getString:function(){var t=!1,a=v(e(this)),i=a.serialize(),n=i.split("&"),r=e("form").index(a),o=e("form:eq("+r+")"),s=[],u=[],l=/^(?:submit|button|image|reset|file)$/i,c=/^(?:input|select|textarea|keygen)/i,h=/^(?:checkbox|radio)$/i,p=/^(?:button|checkbox|color|date|datetime|datetime-local|email|file|image|month|number|password|radio|range|reset|search|submit|time|url|week)/i,g=0;return e.each(o[0],function(e,t){""===t.name||!c.test(t.localName)||l.test(t.type)||t.disabled||!t.checked&&h.test(t.type)?u.push(-1):(u.push(g),g+=1)}),g=0,e.each(o[0],function(e,t){"input"!==t.localName||""!==t.type&&"text"!==t.type&&"hidden"!==t.type&&"tel"!==t.type?(s.push(-1),"input"===t.localName&&p.test(t.type)&&(g+=1)):(s.push(g),g+=1)}),e.each(n,function(a,i){i=n[a].split("=");var o=e.inArray(a,u);if(o>-1&&s[o]>-1){var l=e("form:eq("+r+") input:eq("+s[o]+")"),c=l.data("autoNumeric");"object"==typeof c&&null!==i[1]&&(i[1]=e("form:eq("+r+") input:eq("+s[o]+")").autoNumeric("get").toString(),n[a]=i.join("="),t=!0)}}),t||e.error("You must initialize autoNumeric('init', {options}) prior to calling the 'getString' method"),n.join("&")},getArray:function(){var t=!1,a=v(e(this)),i=a.serializeArray(),n=e("form").index(a),r=e("form:eq("+n+")"),o=[],s=[],u=/^(?:submit|button|image|reset|file)$/i,l=/^(?:input|select|textarea|keygen)/i,c=/^(?:checkbox|radio)$/i,h=/^(?:button|checkbox|color|date|datetime|datetime-local|email|file|image|month|number|password|radio|range|reset|search|submit|time|url|week)/i,p=0;return e.each(r[0],function(e,t){""===t.name||!l.test(t.localName)||u.test(t.type)||t.disabled||!t.checked&&c.test(t.type)?s.push(-1):(s.push(p),p+=1)}),p=0,e.each(r[0],function(e,t){"input"!==t.localName||""!==t.type&&"text"!==t.type&&"hidden"!==t.type&&"tel"!==t.type?(o.push(-1),"input"===t.localName&&h.test(t.type)&&(p+=1)):(o.push(p),p+=1)}),e.each(i,function(a,i){var r=e.inArray(a,s);if(r>-1&&o[r]>-1){var u=e("form:eq("+n+") input:eq("+o[r]+")"),l=u.data("autoNumeric");"object"==typeof l&&(i.value=e("form:eq("+n+") input:eq("+o[r]+")").autoNumeric("get").toString(),t=!0)}}),t||e.error("None of the successful form inputs are initialized by autoNumeric."),i},getSettings:function(){var t=v(e(this));return t.eq(0).data("autoNumeric")}};e.fn.autoNumeric=function(t){return S[t]?S[t].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof t&&t?void e.error('Method "'+t+'" is not supported by autoNumeric()'):S.init.apply(this,arguments)},e.fn.autoNumeric.defaults={aSep:",",dGroup:"3",aDec:".",altDec:null,aSign:"",pSign:"p",vMax:"9999999999999.99",vMin:"-9999999999999.99",mDec:null,mRound:"S",aPad:!0,nBracket:null,wEmpty:"empty",lZero:"allow",sNumber:!0,aForm:!0,anDefault:null}}(jQuery);