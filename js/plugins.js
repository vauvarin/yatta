

// usage: log('inside coolFunc', this, arguments);
// paulirish.com/2009/log-a-lightweight-wrapper-for-consolelog/
window.log = function f(){ log.history = log.history || []; log.history.push(arguments); if(this.console) { var args = arguments, newarr; args.callee = args.callee.caller; newarr = [].slice.call(args); if (typeof console.log === 'object') log.apply.call(console.log, console, newarr); else console.log.apply(console, newarr);}};

// make it safe to use console.log always
(function(a){function b(){}for(var c="assert,count,debug,dir,dirxml,error,exception,group,groupCollapsed,groupEnd,info,log,markTimeline,profile,profileEnd,time,timeEnd,trace,warn".split(","),d;!!(d=c.pop());){a[d]=a[d]||b;}})
(function(){try{console.log();return window.console;}catch(a){return (window.console={});}}());


// place any jQuery/helper plugins in here, instead of separate, slower script files.


/* =============================================================
 *
 * Javascript to load a larger image where necessary 
 *
 * Responsive Enhance - joshje 
 * https://github.com/joshje/Responsive-Enhance
 * 
 * ============================================================ */

var addEvent=function(){return document.addEventListener?function(a,c,d){if(a&&a.nodeName||a===window)a.addEventListener(c,d,!1);else if(a&&a.length)for(var b=0;b<a.length;b++)addEvent(a[b],c,d)}:function(a,c,d){if(a&&a.nodeName||a===window)a.attachEvent("on"+c,function(){return d.call(a,window.event)});else if(a&&a.length)for(var b=0;b<a.length;b++)addEvent(a[b],c,d)}}();

var responsiveEnhance = function(img, width, monitor) {
    if (img.length) {
        for (var i=0, len=img.length; i<len; i++) {
            responsiveEnhance(img[i], width, monitor);
        }
    } else {
        if (((' '+img.className+' ').replace(/[\n\t]/g, ' ').indexOf(' large ') == -1) && img.clientWidth > width) {
            var fullimg = new Image();
            addEvent(fullimg, 'load', function(e) {
                img.className += ' large';
                img.src = this.src;
            });
            fullimg.src = img.getAttribute('data-fullsrc');
        }
    }
    if (monitor != false) {
        addEvent(window, 'resize', function(e) {
            responsiveEnhance(img, width, false);
        });
        addEvent(img, 'load', function(e) {
            responsiveEnhance(img, width, false);
        });
    }
};





/*! jRespond.js v 0.9 | Author: Jeremy Fields [jeremy.fields@viget.com], 2013 | License: MIT */
(function(b,a,c){b.jRespond=function(l){var e=[];var g=[];var o=l;var s="";var n;var d=0;var m=100;var p=500;var j=p;var i=function(){var t=0;if(!window.innerWidth){if(!(document.documentElement.clientWidth===0)){t=document.documentElement.clientWidth}else{t=document.body.clientWidth}}else{t=window.innerWidth}return t};var h=function(v){var u=v.breakpoint;var t=v.enter||c;e.push(v);g.push(false);if(k(u)){if(t!==c){t.call()}g[(e.length-1)]=true}};var q=function(){var A=[];var z=[];for(var y=0;y<e.length;y++){var v=e[y]["breakpoint"];var t=e[y]["enter"]||c;var x=e[y]["exit"]||c;if(v==="*"){if(t!==c){A.push(t)}if(x!==c){z.push(x)}}else{if(k(v)){if(t!==c&&!g[y]){A.push(t)}g[y]=true}else{if(x!==c&&g[y]){z.push(x)}g[y]=false}}}for(var w=0;w<z.length;w++){z[w].call()}for(var u=0;u<A.length;u++){A[u].call()}};var r=function(u){var v=false;for(var t=0;t<o.length;t++){if(u>=o[t]["enter"]&&u<=o[t]["exit"]){v=true;break}}if(v&&s!==o[t]["label"]){s=o[t]["label"];q()}else{if(!v&&s!==""){s="";q()}}};var k=function(t){if(typeof t==="object"){if(t.join().indexOf(s)>=0){return true}}else{if(t==="*"){return true}else{if(typeof t==="string"){if(s===t){return true}}}}};var f=function(){var t=i();if(t!==d){j=m;r(t)}else{j=p}d=t;setTimeout(f,j)};f();return{addFunc:function(t){h(t)},getBreakpoint:function(){return s}}}}(this,this.document));

