/*!
* jquery.counterup.js 1.0
*
* Copyright 2013, Benjamin Intal http://gambit.ph @bfintal
* Released under the GPL v2 License
*
* Date: Nov 26, 2013
*/
!function(a){"use strict";a.fn.counterUp=function(b){var c=a.extend({time:400,delay:10},b);return this.each(function(){var b=a(this),d=c,e=function(){var a=[],c=d.time/d.delay,e=b.text(),f=/[0-9]+,[0-9]+/.test(e);e=e.replace(/,/g,"");for(var g=(e.split(".")[1]||[]).length,h=c;h>=1;h--){var i=parseFloat(e/c*h).toFixed(g);if(f)for(;/(\d+)(\d{3})/.test(i.toString());)i=i.toString().replace(/(\d+)(\d{3})/,"$1,$2");a.unshift(i)}b.data("counterup-nums",a),b.text("0");var j=function(){b.text(b.data("counterup-nums").shift()),b.data("counterup-nums").length?setTimeout(b.data("counterup-func"),d.delay):(delete b.data("counterup-nums"),b.data("counterup-nums",null),b.data("counterup-func",null))};b.data("counterup-func",j),setTimeout(b.data("counterup-func"),d.delay)};b.waypoint(e,{offset:"100%",triggerOnce:!0})})}}(jQuery);