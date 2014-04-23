﻿(function(g,f,b,d,c,e,z){/*! Jssor */
$Jssor$=g.$Jssor$=g.$Jssor$||{};new(function(){});var m=function(){var b=this,a={};b.$On=b.addEventListener=function(b,c){if(typeof c!="function")return;if(!a[b])a[b]=[];a[b].push(c)};b.$Off=b.removeEventListener=function(e,d){var b=a[e];if(typeof d!="function")return;else if(!b)return;for(var c=0;c<b.length;c++)if(d==b[c]){b.splice(c,1);return}};b.e=function(e){var c=a[e],d=[];if(!c)return;for(var b=1;b<arguments.length;b++)d.push(arguments[b]);for(var b=0;b<c.length;b++)try{c[b].apply(g,d)}catch(f){}}},h;(function(){h=function(a,b){this.x=typeof a=="number"?a:0;this.y=typeof b=="number"?b:0};})();var l=g.$JssorEasing$={$EaseLinear:function(a){return a},$EaseGoBack:function(a){return 1-b.abs(2-1)},$EaseSwing:function(a){return-b.cos(a*b.PI)/2+.5},$EaseInQuad:function(a){return a*a},$EaseOutQuad:function(a){return-a*(a-2)},$EaseInOutQuad:function(a){return(a*=2)<1?1/2*a*a:-1/2*(--a*(a-2)-1)},$EaseInCubic:function(a){return a*a*a},$EaseOutCubic:function(a){return(a-=1)*a*a+1},$EaseInOutCubic:function(a){return(a*=2)<1?1/2*a*a*a:1/2*((a-=2)*a*a+2)},$EaseInQuart:function(a){return a*a*a*a},$EaseOutQuart:function(a){return-((a-=1)*a*a*a-1)},$EaseInOutQuart:function(a){return(a*=2)<1?1/2*a*a*a*a:-1/2*((a-=2)*a*a*a-2)},$EaseInQuint:function(a){return a*a*a*a*a},$EaseOutQuint:function(a){return(a-=1)*a*a*a*a+1},$EaseInOutQuint:function(a){return(a*=2)<1?1/2*a*a*a*a*a:1/2*((a-=2)*a*a*a*a+2)},$EaseInSine:function(a){return 1-b.cos(a*b.PI/2)},$EaseOutSine:function(a){return b.sin(a*b.PI/2)},$EaseInOutSine:function(a){return-1/2*(b.cos(b.PI*a)-1)},$EaseInExpo:function(a){return a==0?0:b.pow(2,10*(a-1))},$EaseOutExpo:function(a){return a==1?1:-b.pow(2,-10*a)+1},$EaseInOutExpo:function(a){return a==0||a==1?a:(a*=2)<1?1/2*b.pow(2,10*(a-1)):1/2*(-b.pow(2,-10*--a)+2)},$EaseInCirc:function(a){return-(b.sqrt(1-a*a)-1)},$EaseOutCirc:function(a){return b.sqrt(1-(a-=1)*a)},$EaseInOutCirc:function(a){return(a*=2)<1?-1/2*(b.sqrt(1-a*a)-1):1/2*(b.sqrt(1-(a-=2)*a)+1)},$EaseInElastic:function(a){if(!a||a==1)return a;var c=.3,d=.075;return-(b.pow(2,10*(a-=1))*b.sin((a-d)*2*b.PI/c))},$EaseOutElastic:function(a){if(!a||a==1)return a;var c=.3,d=.075;return b.pow(2,-10*a)*b.sin((a-d)*2*b.PI/c)+1},$EaseInOutElastic:function(a){if(!a||a==1)return a;var c=.45,d=.1125;return(a*=2)<1?-.5*b.pow(2,10*(a-=1))*b.sin((a-d)*2*b.PI/c):b.pow(2,-10*(a-=1))*b.sin((a-d)*2*b.PI/c)*.5+1},$EaseInBack:function(a){var b=1.70158;return a*a*((b+1)*a-b)},$EaseOutBack:function(a){var b=1.70158;return(a-=1)*a*((b+1)*a+b)+1},$EaseInOutBack:function(a){var b=1.70158;return(a*=2)<1?1/2*a*a*(((b*=1.525)+1)*a-b):1/2*((a-=2)*a*(((b*=1.525)+1)*a+b)+2)},$EaseInBounce:function(a){return 1-l.$EaseOutBounce(1-a)},$EaseOutBounce:function(a){return a<1/2.75?7.5625*a*a:a<2/2.75?7.5625*(a-=1.5/2.75)*a+.75:a<2.5/2.75?7.5625*(a-=2.25/2.75)*a+.9375:7.5625*(a-=2.625/2.75)*a+.984375},$EaseInOutBounce:function(a){return a<1/2?l.$EaseInBounce(a*2)*.5:l.$EaseOutBounce(a*2-1)*.5+.5},$EaseInWave:function(a){return 1-b.cos(a*b.PI*2)},$EaseOutWave:function(a){return b.sin(a*b.PI*2)},$EaseOutJump:function(a){return 1-((a*=2)<1?(a=1-a)*a*a:(a-=1)*a*a)},$EaseInJump:function(a){return(a*=2)<1?a*a*a:(a=2-a)*a*a}},i={Me:function(a){return(a&3)==1},Ne:function(a){return(a&3)==2},Ae:function(a){return(a&12)==4},Be:function(a){return(a&12)==8}},q={De:37,Se:39},o,n={Ze:0,bf:1,cf:2,Te:3,We:4,Ve:5},y=1,u=2,w=3,v=4,x=5,j,a=new function(){var i=this,m=n.Ze,j=0,q=0,P=0,t=0,cb=navigator.appName,k=navigator.userAgent;function D(){if(!m)if(cb=="Microsoft Internet Explorer"&&!!g.attachEvent&&!!g.ActiveXObject){var d=k.indexOf("MSIE");m=n.bf;q=parseFloat(k.substring(d+5,k.indexOf(";",d)));/*@cc_on P=@_jscript_version@*/;j=f.documentMode||q}else if(cb=="Netscape"&&!!g.addEventListener){var c=k.indexOf("Firefox"),a=k.indexOf("Safari"),h=k.indexOf("Chrome"),b=k.indexOf("AppleWebKit");if(c>=0){m=n.cf;j=parseFloat(k.substring(c+8))}else if(a>=0){var i=k.substring(0,a).lastIndexOf("/");m=h>=0?n.We:n.Te;j=parseFloat(k.substring(i+1,a))}if(b>=0)t=parseFloat(k.substring(b+12))}else{var e=/(opera)(?:.*version|)[ \/]([\w.]+)/i.exec(k);if(e){m=n.Ve;j=parseFloat(e[2])}}}function l(){D();return m==y}function G(){return l()&&(j<6||f.compatMode=="BackCompat")}function V(){D();return m==u}function M(){D();return m==w}function hb(){D();return m==v}function ib(){D();return m==x}function R(){return M()&&t>534&&t<535}function s(){return l()&&j<9}var B;function r(a){if(!B){p(["transform","WebkitTransform","msTransform","MozTransform","OTransform"],function(b){if(!i.Vb(a.style[b])){B=b;return c}});B=B||"transform"}return B}function ab(a){return Object.prototype.toString.call(a)}var J;function p(a,c){if(ab(a)=="[object Array]"){for(var b=0;b<a.length;b++)if(c(a[b],b,a))break}else for(var d in a)if(c(a[d],d,a))break}function jb(){if(!J){J={};p(["Boolean","Number","String","Function","Array","Date","RegExp","Object"],function(a){J["[object "+a+"]"]=a.toLowerCase()})}return J}function A(a){return a==d?String(a):jb()[ab(a)]||"object"}function bb(b,a){setTimeout(b,a||0)}function I(b,d,c){var a=!b||b=="inherit"?"":b;p(d,function(c){var b=c.exec(a);if(b){var d=a.substr(0,b.index),e=a.substr(b.lastIndex+1,a.length-(b.lastIndex+1));a=d+e}});a=c+(a.indexOf(" ")!=0?" ":"")+a;return a}function W(b,a){if(j<9)b.style.filter=a}function fb(b,a,c){if(P<9){var e=b.style.filter,g=new RegExp(/[\s]*progid:DXImageTransform\.Microsoft\.Matrix\([^\)]*\)/g),f=a?"progid:DXImageTransform.Microsoft.Matrix(M11="+a[0][0]+", M12="+a[0][1]+", M21="+a[1][0]+", M22="+a[1][1]+", SizingMethod='auto expand')":"",d=I(e,[g],f);W(b,d);i.Tc(b,c.y);i.Yc(b,c.x)}}i.Pb=l;i.Qb=hb;i.Tb=ib;i.Db=s;i.Cb=function(){return j};i.kc=function(){return t};i.$Delay=bb;i.S=function(a){if(i.hc(a))a=f.getElementById(a);return a};i.Sb=function(a){return a?a:g.event};i.yc=function(a){a=i.Sb(a);var b=new h;if(a.type=="DOMMouseScroll"&&V()&&j<3){b.x=a.screenX;b.y=a.screenY}else if(typeof a.pageX=="number"){b.x=a.pageX;b.y=a.pageY}else if(typeof a.clientX=="number"){b.x=a.clientX+f.body.scrollLeft+f.documentElement.scrollLeft;b.y=a.clientY+f.body.scrollTop+f.documentElement.scrollTop}return b};i.Re=function(b){if(l()&&q<9){var a=/opacity=([^)]*)/.exec(b.style.filter||"");return a?parseFloat(a[1])/100:1}else return parseFloat(b.style.opacity||"1")};i.Wb=function(c,a,f){if(l()&&q<9){var h=c.style.filter||"",i=new RegExp(/[\s]*alpha\([^\)]*\)/g),e=b.round(100*a),d="";if(e<100||f)d="alpha(opacity="+e+") ";var g=I(h,[i],d);W(c,g)}else c.style.opacity=a==1?"":b.round(a*100)/100};function O(g,c){var f=c.$Rotate||0,e=c.sc||1;if(s()){var k=i.Ce(f/180*b.PI,e,e);fb(g,!f&&e==1?d:k,i.Ee(k,c.X,c.U))}else{var h=r(g);if(h){var j="rotate("+f%360+"deg) scale("+e+")";if(a.Qb()&&t>535)j+=" perspective(2000px)";g.style[h]=j}}}i.Ge=function(b,a){if(R())bb(i.r(d,O,b,a));else O(b,a)};i.Fe=function(b,c){var a=r(b);if(a)b.style[a+"Origin"]=c};i.ye=function(a,c){if(l()&&q<9||q<10&&G())a.style.zoom=c==1?"":c;else{var b=r(a);if(b){var f="scale("+c+")",e=a.style[b],g=new RegExp(/[\s]*scale\(.*?\)/g),d=I(e,[g],f);a.style[b]=d}}};i.xe=function(a){if(!a.style[r(a)]||a.style[r(a)]=="none")a.style[r(a)]="perspective(2000px)"};i.d=function(a,c,d,b){a=i.S(a);if(a.addEventListener){c=="mousewheel"&&a.addEventListener("DOMMouseScroll",d,b);a.addEventListener(c,d,b)}else if(a.attachEvent){a.attachEvent("on"+c,d);b&&a.setCapture&&a.setCapture()}};i.Oe=function(a,c,d,b){a=i.S(a);if(a.removeEventListener){c=="mousewheel"&&a.removeEventListener("DOMMouseScroll",d,b);a.removeEventListener(c,d,b)}else if(a.detachEvent){a.detachEvent("on"+c,d);b&&a.releaseCapture&&a.releaseCapture()}};i.Ie=function(b,a){i.d(s()?f:g,"mouseup",b,a)};i.ab=function(a){a=i.Sb(a);a.preventDefault&&a.preventDefault();a.cancel=c;a.returnValue=e};i.r=function(e,d){for(var b=[],a=2;a<arguments.length;a++)b.push(arguments[a]);var c=function(){for(var c=b.concat([]),a=0;a<arguments.length;a++)c.push(arguments[a]);return d.apply(e,c)};return c};i.Ke=function(a,c){var b=f.createTextNode(c);i.zc(a);a.appendChild(b)};i.zc=function(a){a.innerHTML=""};i.Z=function(c){for(var b=[],a=c.firstChild;a;a=a.nextSibling)a.nodeType==1&&b.push(a);return b};function N(a,c,b,f){if(!b)b="u";for(a=a?a.firstChild:d;a;a=a.nextSibling)if(a.nodeType==1){if(a.getAttribute(b)==c)return a;if(f){var e=N(a,c,b,f);if(e)return e}}}i.q=N;function S(a,c,e){for(a=a?a.firstChild:d;a;a=a.nextSibling)if(a.nodeType==1){if(a.tagName==c)return a;if(e){var b=S(a,c,e);if(b)return b}}}i.Pe=S;i.Qe=function(b,a){return b.getElementsByTagName(a)};i.h=function(c){for(var b=1;b<arguments.length;b++){var a=arguments[b];if(a)for(var d in a)c[d]=a[d]}return c};i.Vb=function(a){return A(a)=="undefined"};i.Ye=function(a){return A(a)=="function"};i.Nb=Array.isArray||function(a){return A(a)=="array"};i.hc=function(a){return A(a)=="string"};i.af=function(a){return!isNaN(parseFloat(a))&&isFinite(a)};i.f=p;i.xb=function(a){return i.nc("DIV",a)};i.Xe=function(a){return i.nc("SPAN",a)};i.nc=function(b,a){a=a||f;return a.createElement(b)};i.db=function(){};i.E=function(a,b){return a.getAttribute(b)};i.Ue=function(b,c,a){b.setAttribute(c,a)};i.Vc=function(a){return a.className};i.ed=function(b,a){b.className=a?a:""};i.Jc=function(a){return a.style.display};i.kb=function(b,a){b.style.display=a||""};i.T=function(b,a){b.style.overflow=a};i.V=function(a){return a.parentNode};i.B=function(a){i.kb(a,"none")};i.p=function(a,b){i.kb(a,b==e?"none":"")};i.nd=function(a){return a.style.position};i.t=function(b,a){b.style.position=a};i.Gc=function(a){return parseInt(a.style.top,10)};i.n=function(a,b){a.style.top=b+"px"};i.Ic=function(a){return parseInt(a.style.left,10)};i.m=function(a,b){a.style.left=b+"px"};i.i=function(a){return parseInt(a.style.width,10)};i.F=function(c,a){c.style.width=b.max(a,0)+"px"};i.g=function(a){return parseInt(a.style.height,10)};i.R=function(c,a){c.style.height=b.max(a,0)+"px"};i.qc=function(a){return a.style.cssText};i.Hb=function(b,a){b.style.cssText=a};i.jc=function(b,a){b.removeAttribute(a)};i.Yc=function(b,a){b.style.marginLeft=a+"px"};i.Tc=function(b,a){b.style.marginTop=a+"px"};i.Ib=function(a){return parseInt(a.style.zIndex)||0};i.bb=function(c,a){c.style.zIndex=b.ceil(a)};i.Dc=function(b,a){b.style.backgroundColor=a};i.yd=function(){return l()&&j<10};i.rd=function(d,c){if(c)d.style.clip="rect("+b.round(c.$Top)+"px "+b.round(c.$Right)+"px "+b.round(c.$Bottom)+"px "+b.round(c.$Left)+"px)";else{var g=i.qc(d),f=[new RegExp(/[\s]*clip: rect\(.*?\)[;]?/i),new RegExp(/[\s]*cliptop: .*?[;]?/i),new RegExp(/[\s]*clipright: .*?[;]?/i),new RegExp(/[\s]*clipbottom: .*?[;]?/i),new RegExp(/[\s]*clipleft: .*?[;]?/i)],e=I(g,f,"");a.Hb(d,e)}};i.y=function(){return+new Date};i.w=function(b,a){b.appendChild(a)};i.fd=function(b,a){p(a,function(a){i.w(b,a)})};i.Bb=function(c,b,a){c.insertBefore(b,a)};i.cb=function(b,a){b.removeChild(a)};i.hd=function(b,a){p(a,function(a){i.cb(b,a)})};i.zd=function(a){i.hd(a,i.Z(a))};i.he=function(b,a){return parseInt(b,a||10)};i.Lc=function(a){return parseFloat(a)};i.Sc=function(b,a){var c=f.body;while(a&&b!=a&&c!=a)try{a=a.parentNode}catch(d){return e}return b==a};i.v=function(b,a){return b.cloneNode(a)};function L(b,a,c){a.onload=d;a.abort=d;b&&b(a,c)}i.jb=function(e,b){if(i.Tb()&&j<11.6||!e)L(b,d);else{var a=new Image;a.onload=i.r(d,L,b,a);a.onabort=i.r(d,L,b,a,c);a.src=e}};i.je=function(e,b,f){var d=e.length+1;function c(a){d--;if(b&&a&&a.src==b.src)b=a;!d&&f&&f(b)}a.f(e,function(b){a.jb(b.src,c)});c()};i.Ac=function(d,k,j,i){if(i)d=a.v(d,c);for(var h=a.Qe(d,k),f=h.length-1;f>-1;f--){var b=h[f],e=a.v(j,c);a.ed(e,a.Vc(b));a.Hb(e,a.qc(b));var g=a.V(b);a.Bb(g,e,b);a.cb(g,b)}return d};var C;function lb(b){var g=this,h,d,j;function f(){var c=h;if(d)c+="dn";else if(j)c+="av";a.ed(b,c)}function k(){C.push(g);d=c;f()}g.ie=function(){d=e;f()};g.Ec=function(a){j=a;f()};b=i.S(b);if(!C){i.Ie(function(){var a=C;C=[];p(a,function(a){a.ie()})});C=[]}h=i.Vc(b);a.d(b,"mousedown",k)}i.Eb=function(a){return new lb(a)};var Z={$Opacity:i.Re,$Top:i.Gc,$Left:i.Ic,Fb:i.i,ub:i.g,I:i.nd,ce:i.Jc,$ZIndex:i.Ib},F={$Opacity:i.Wb,$Top:i.n,$Left:i.m,Fb:i.F,ub:i.R,ce:i.kb,$Clip:i.rd,ng:i.Yc,mg:i.Tc,wb:i.Ge,I:i.t,$ZIndex:i.bb};function H(){return F}function U(){H();F.wb=F.wb;return F}i.we=H;i.ve=U;i.ue=function(c,b){H();var a={};p(b,function(d,b){if(Z[b])a[b]=Z[b](c)});return a};i.J=function(c,b){var a=H();p(b,function(d,b){a[b]&&a[b](c,d)})};o=new function(){var a=this;function b(d,g){for(var j=d[0].length,i=d.length,h=g[0].length,f=[],c=0;c<i;c++)for(var k=f[c]=[],b=0;b<h;b++){for(var e=0,a=0;a<j;a++)e+=d[c][a]*g[a][b];k[b]=e}return f}a.Gb=function(d,c){var a=b(d,[[c.x],[c.y]]);return new h(a[0][0],a[1][0])}};i.Ce=function(d,a,c){var e=b.cos(d),f=b.sin(d);return[[e*a,-f*c],[f*a,e*c]]};i.Ee=function(d,c,a){var e=o.Gb(d,new h(-c/2,-a/2)),f=o.Gb(d,new h(c/2,-a/2)),g=o.Gb(d,new h(c/2,a/2)),i=o.Gb(d,new h(-c/2,a/2));return new h(b.min(e.x,f.x,g.x,i.x)+c/2,b.min(e.y,f.y,g.y,i.y)+a/2)}};j=function(n,m,g,O,z,x){n=n||0;var f=this,r,o,p,y,A=0,C,M,L,D,j=0,t=0,E,k=n,i,h,q,u=[],B;function I(b){i+=b;h+=b;k+=b;j+=b;t+=b;a.f(u,function(a){a,a.$Shift(b)})}function N(a,b){var c=a-i+n*b;I(c);return h}function w(w,G){var n=w;if(q&&(n>=h||n<=i))n=((n-i)%q+q)%q+i;if(!E||y||G||j!=n){var p=b.min(n,h);p=b.max(p,i);if(!E||y||G||p!=t){if(x){var e=x;if(z){var s=(p-k)/(m||1);if(g.qe&&a.Qb()&&m)s=b.round(s*m/16)/m*16;if(g.$Reverse)s=1-s;e={};for(var o in x){var R=M[o]||1,J=L[o]||[0,1],l=(s-J[0])/J[1];l=b.min(b.max(l,0),1);l=l*R;var H=b.floor(l);if(l!=H)l-=H;var Q=C[o]||C.O,I=Q(l),r,K=z[o],F=x[o];if(a.af(F))r=K+(F-K)*I;else{r=a.h({L:{}},z[o]);a.f(F.L,function(c,b){var a=c*I;r.L[b]=a;r[b]+=a})}e[o]=r}}if(z.$Zoom)e.wb={$Rotate:e.$Rotate||0,sc:e.$Zoom,X:g.X,U:g.U};if(x.$Clip&&g.$Move){var v=e.$Clip.L,D=(v.$Top||0)+(v.$Bottom||0),A=(v.$Left||0)+(v.$Right||0);e.$Left=(e.$Left||0)+A;e.$Top=(e.$Top||0)+D;e.$Clip.$Left-=A;e.$Clip.$Right-=A;e.$Clip.$Top-=D;e.$Clip.$Bottom-=D}if(e.$Clip&&a.yd()&&!e.$Clip.$Top&&!e.$Clip.$Left&&e.$Clip.$Right==g.X&&e.$Clip.$Bottom==g.U)e.$Clip=d;a.f(e,function(b,a){B[a]&&B[a](O,b)})}f.Rb(t-k,p-k)}t=p;a.f(u,function(b,c){var a=w<j?u[u.length-c-1]:b;a.x(w,G)});var P=j,N=w;j=n;E=c;f.pb(P,N)}}function F(a,c){c&&a.qb(h,1);h=b.max(h,a.H());u.push(a)}function H(){if(r){var d=a.y(),e=b.min(d-A,a.Tb()?80:20),c=j+e*p;A=d;if(c*p>=o*p)c=o;w(c);if(!y&&c*p>=o*p)J(D);else a.$Delay(H,g.$Interval)}}function v(d,e,g){if(!r){r=c;y=g;D=e;d=b.max(d,i);d=b.min(d,h);o=d;p=o<j?-1:1;f.ad();A=a.y();H()}}function J(a){if(r){y=r=D=e;f.bd();a&&a()}}f.$Play=function(a,b,c){v(a?j+a:h,b,c)};f.dd=function(b,a,c){v(b,a,c)};f.D=function(){J()};f.Vd=function(a){v(a)};f.Q=function(){return j};f.Kc=function(){return o};f.ob=function(){return t};f.x=w;f.Ub=function(){w(i,c)};f.$Move=function(a){w(j+a)};f.$IsPlaying=function(){return r};f.Wd=function(a){q=a};f.qb=N;f.$Shift=I;f.M=function(a){F(a,0)};f.Jb=function(a){F(a,1)};f.H=function(){return h};f.pb=a.db;f.ad=a.db;f.bd=a.db;f.Rb=a.db;f.Kb=a.y();g=a.h({$Interval:15},g);q=g.Pc;B=a.h({},a.we(),g.Qc);i=k=n;h=n+m;var M=g.$Round||{},L=g.$During||{};C=a.h({O:a.Ye(g.$Easing)&&g.$Easing||l.$EaseSwing},g.$Easing)};var r;new function(){;function n(o,Wb){var k=this;function rc(){var a=this;j.call(a,-1e8,2e8);a.Td=function(){var c=a.ob(),d=b.floor(c),f=v(d),e=c-b.floor(c);return{N:f,Ud:d,I:e}};a.pb=function(d,a){var e=b.floor(a);if(e!=a&&a>d)e++;Lb(e,c);k.e(n.$EVT_POSITION_CHANGE,v(a),v(d),a,d)}}function qc(){var b=this;j.call(b,0,0,{Pc:t});a.f(B,function(a){i.$Loop&&a.Wd(t);b.Jb(a);a.$Shift(rb/Rb)})}function pc(){var a=this,b=Kb.$Elmt;j.call(a,-1,2,{$Easing:l.$EaseLinear,Qc:{I:Qb},Pc:t},b,{I:1},{I:-1});a.mb=b}function ec(o,m){var a=this,f,g,h,l,b;j.call(a,-1e8,2e8);a.ad=function(){M=c;Q=d;k.e(n.$EVT_SWIPE_START,v(x.Q()),x.Q())};a.bd=function(){M=e;l=e;var a=x.Td();k.e(n.$EVT_SWIPE_END,v(x.Q()),x.Q());!a.I&&tc(a.Ud,r)};a.pb=function(d,c){var a;if(l)a=b;else{a=g;if(h)a=i.$SlideEasing(c/h)*(g-f)+f}x.x(a)};a.sb=function(b,d,c,e){f=b;g=d;h=c;x.x(b);a.x(0);a.dd(c,e)};a.Bd=function(e){l=c;b=e;a.$Play(e,d,c)};a.Cd=function(a){b=a};x=new rc;x.M(o);x.M(m)}function fc(){var c=this,b=Pb();a.bb(b,0);c.$Elmt=b;c.nb=function(){a.B(b);a.zc(b)}}function oc(p,o){var f=this,s,w,G,x,g,y=[],X,q,bb,F,T,E,l,u,h;j.call(f,-C,C+1,{});function D(a){w&&w.dc();s&&s.dc();ab(p,a);s=new H.$Class(p,H,1);w=new H.$Class(p,H);w.Ub();s.Ub()}function db(){s.Kb<H.Kb&&D()}function M(o,q,m){if(!F){F=c;if(g&&m){var d=m.width,b=m.height,l=d,j=b;if(d&&b&&i.$FillMode){if(i.$FillMode&3){var h=e,p=L/K*b/d;if(i.$FillMode&1)h=p>1;else if(i.$FillMode&2)h=p<1;l=h?d*K/b:L;j=h?K:b*L/d}a.F(g,l);a.R(g,j);a.n(g,(K-j)/2);a.m(g,(L-l)/2)}a.t(g,"absolute");k.e(n.$EVT_LOAD_END,Ub)}}a.B(q);o&&o(f)}function cb(b,c,d,e){if(e==Q&&r==o&&N)if(!sc){var a=v(b);z.Pd(a,o,c,f,d);c.Ld();U.qb(a,1);U.x(a);A.sb(b,b,0)}}function eb(b){if(b==Q&&r==o){if(!l){var a=d;if(z)if(z.N==o)a=z.Yd();else z.nb();db();l=new mc(o,a,f.Md(),f.Hd());l.oc(h)}!l.$IsPlaying()&&l.Yb()}}function W(e,c){if(e==o){if(e!=c)B[c]&&B[c].Id();h&&h.$Enable();var j=Q=a.y();f.jb(a.r(d,eb,j))}else{var g=b.abs(o-e);(!T||g<=i.$LazyLoading||t-g<=i.$LazyLoading)&&f.jb()}}function fb(){if(r==o&&l){l.D();h&&h.$Quit();h&&h.$Disable();l.Bc()}}function gb(){r==o&&l&&l.D()}function S(b){if(P)a.ab(b);else k.e(n.$EVT_CLICK,o,b)}function R(){h=u.pInstance;l&&l.oc(h)}f.jb=function(e,b){b=b||x;if(y.length&&!F){a.p(b);if(!bb){bb=c;k.e(n.$EVT_LOAD_START);a.f(y,function(b){if(!b.src){b.src=a.E(b,"src2");a.kb(b,b["display-origin"])}})}a.je(y,g,a.r(d,M,e,b))}else M(e,b)};f.ne=function(){if(z){var b=z.Od(t);if(b){var f=Q=a.y(),c=o+1,e=B[v(c)];return e.jb(a.r(d,cb,c,e,b,f),x)}}V(r+i.$AutoPlaySteps)};f.Xb=function(){W(o,o)};f.Id=function(){h&&h.$Quit();h&&h.$Disable();f.tc();l&&l.se();l=d;D()};f.Ld=function(){a.B(p)};f.tc=function(){a.p(p)};f.te=function(){h&&h.$Enable()};function ab(b,f,d){d=d||0;if(!E){if(b.tagName=="IMG"){y.push(b);if(!b.src){T=c;b["display-origin"]=a.Jc(b);a.B(b)}}a.Db()&&a.bb(b,a.Ib(b)+1);if(a.kc()>0)(!I||a.kc()<534||!Z)&&a.xe(b)}var h=a.Z(b);a.f(h,function(h){var j=a.E(h,"u");if(j=="player"&&!u){u=h;if(u.pInstance)R();else a.d(u,"dataavailable",R)}if(j=="caption"){if(!a.Pb()&&!f){var i=a.v(h,c);a.Bb(b,i,h);a.cb(b,h);h=i;f=c}}else if(!E&&!d&&!g&&a.E(h,"u")=="image"){g=h;if(g){if(g.tagName=="A"){X=g;a.J(X,O);q=a.v(g,e);a.d(q,"click",S);a.J(q,O);a.kb(q,"block");a.Wb(q,0);a.Dc(q,"#000");g=a.Pe(g,"IMG")}g.border=0;a.J(g,O)}}ab(h,f,d+1)})}f.Rb=function(c,b){var a=C-b;Qb(G,a)};f.Md=function(){return s};f.Hd=function(){return w};f.N=o;m.call(f);var J=a.q(p,"thumb");if(J){f.de=a.v(J,c);a.B(J)}a.p(p);x=a.v(Y,c);a.bb(x,1e3);a.d(p,"click",S);D(c);E=c;f.Fc=g;f.xc=q;f.mb=G=p;a.w(G,x);k.$On(203,W);k.$On(22,gb);k.$On(24,fb)}function mc(h,q,v,u){var b=this,m=0,x=0,o,g,d,f,l,s,w,t,p=B[h];j.call(b,0,0);function y(){a.zd(J);Vb&&l&&p.xc&&a.w(J,p.xc);a.p(J,l||!p.Fc)}function A(){if(s){s=e;k.e(n.$EVT_ROLLBACK_END,h,d,m,g,d,f);b.x(g)}b.Yb()}function C(a){t=a;b.D();b.Yb()}b.Yb=function(){var a=b.ob();if(!F&&!M&&!t&&(a!=d||N&&(!Nb||S))&&r==h){if(!a){if(o&&!l){l=c;b.Bc(c);k.e(n.$EVT_SLIDESHOW_START,h,m,x,o,f)}y()}var e,i=n.$EVT_STATE_CHANGE;if(a==f){d==f&&b.x(g);return p.ne()}else if(a==d)e=f;else if(a==g)e=d;else if(!a)e=g;else if(a>d){s=c;e=d;i=n.$EVT_ROLLBACK_START}else e=b.Kc();k.e(i,h,a,m,g,d,f);b.dd(e,A)}};b.se=function(){z&&z.N==h&&z.nb();var a=b.ob();a<f&&k.e(n.$EVT_STATE_CHANGE,h,-a-1,m,g,d,f)};b.Bc=function(b){q&&a.T(cb,b&&q.hb.$Outside?"":"hidden")};b.Rb=function(b,a){if(l&&a>=o){l=e;y();p.tc();z.nb();k.e(n.$EVT_SLIDESHOW_END,h,m,x,o,f)}k.e(n.$EVT_PROGRESS_CHANGE,h,a,m,g,d,f)};b.oc=function(a){if(a&&!w){w=a;a.$On($JssorPlayer$.Sd,C)}};q&&b.Jb(q);o=b.H();b.H();b.Jb(v);g=v.H();d=g+i.$AutoPlayInterval;u.$Shift(d);b.M(u);f=b.H()}function Qb(c,g){var f=w>0?w:i.$PlayOrientation,d=b.round(vb*g*(f&1)),e=b.round(wb*g*(f>>1&1));if(a.Pb()&&a.Cb()>=10&&a.Cb()<11)c.style.msTransform="translate("+d+"px, "+e+"px)";else if(a.Qb()&&a.Cb()>=30){c.style.WebkitTransition="transform 0s";c.style.WebkitTransform="translate3d("+d+"px, "+e+"px, 0px) perspective(2000px)"}else{a.m(c,d);a.n(c,e)}}function lc(a){P=0;!G&&ic()&&kc(a)}function kc(b){kb=M;F=c;ub=e;Q=d;a.d(f,hb,Sb);a.y();Db=A.Kc();A.D();if(!kb)w=0;if(I){var h=b.touches[0];pb=h.clientX;qb=h.clientY}else{var g=a.yc(b);pb=g.x;qb=g.y;a.ab(b)}E=0;X=0;bb=0;D=x.Q();k.e(n.$EVT_DRAG_START,v(D),D,b)}function Sb(e){if(F&&(!a.Db()||e.button)){var f;if(I){var n=e.touches;if(n&&n.length>0)f=new h(n[0].clientX,n[0].clientY)}else f=a.yc(e);if(f){var l=f.x-pb,m=f.y-qb;if(b.floor(D)!=D)w=i.$PlayOrientation&G;if((l||m)&&!w){if(G==3)if(b.abs(m)>b.abs(l))w=2;else w=1;else w=G;if(I&&w==1&&b.abs(m)-b.abs(l)>3)ub=c}if(w){var d=m,k=wb;if(w==1){d=l;k=vb}if(!i.$Loop){if(d>0){var g=k*r,j=d-g;if(j>0)d=g+b.sqrt(j)*5}if(d<0){var g=k*(t-C-r),j=-d-g;if(j>0)d=-g-b.sqrt(j)*5}}if(E-X<-2)bb=1;else if(E-X>2)bb=0;X=E;E=d;mb=D-E/k/(gb||1);if(E&&w&&!ub){a.ab(e);if(!M)A.Bd(mb);else A.Cd(mb)}else a.Db()&&a.ab(e)}}}else zb(e)}function zb(h){gc();if(F){F=e;a.y();a.Oe(f,hb,Sb);P=E;P&&a.ab(h);A.D();var d=x.Q();k.e(n.$EVT_DRAG_END,v(d),d,v(D),D,h);var c=b.floor(D);if(b.abs(E)>=i.$MinDragOffsetToSlide){c=b.floor(d);c+=bb}if(!i.$Loop)c=b.min(t-C,b.max(c,0));var g=b.abs(c-d);g=1-b.pow(1-g,5);if(!P&&kb)A.Vd(Db);else if(d==c){nb.te();nb.Xb()}else A.sb(d,c,g*Mb)}}function dc(a){B[r];r=v(a);nb=B[r];Lb(a);return r}function tc(a,b){w=0;dc(a);k.e(n.$EVT_PARK,v(a),b)}function Lb(b,c){a.f(R,function(a){a.cc(v(b),b,c)})}function ic(){var a=n.Cc||0;n.Cc|=i.$DragOrientation;return G=i.$DragOrientation&~a}function gc(){if(G){n.Cc&=~i.$DragOrientation;G=0}}function Pb(){var b=a.xb();a.J(b,O);a.t(b,"absolute");return b}function v(a){return(a%t+t)%t}function ac(b,a){V(b,i.$SlideDuration,a)}function tb(){a.f(R,function(a){a.gc(a.yb.$ChanceToShow>S)})}function Yb(b){b=a.Sb(b);var c=b.target?b.target:b.srcElement,d=b.relatedTarget?b.relatedTarget:b.toElement;if(!a.Sc(o,c)||a.Sc(o,d))return;S=1;tb();B[r].Xb()}function Xb(){S=0;tb()}function Zb(){O={Fb:L,ub:K,$Top:0,$Left:0};a.f(T,function(b){a.J(b,O);a.t(b,"absolute");a.T(b,"hidden");a.B(b)});a.J(Y,O)}function eb(b,a){V(b,a,c)}function V(h,g,l){if(Jb&&(!F||i.$NaviQuitDrag)){M=c;F=e;A.D();if(a.Vb(g))g=Mb;var f=Ab.ob(),d=h;if(l){d=f+h;if(h>0)d=b.ceil(d);else d=b.floor(d)}if(!i.$Loop)d=b.max(0,b.min(d,t-C));var k=(d-f)%t;d=f+k;var j=f==d?0:g*b.abs(k);j=b.min(j,g*C*1.5);A.sb(f,d,j)}}k.$PlayTo=V;k.$GoTo=function(a){V(a,0)};k.$Next=function(){eb(1)};k.$Prev=function(){eb(-1)};k.$Pause=function(){N=e};k.$Play=function(){if(!N){N=c;B[r]&&B[r].Xb()}};k.$SetSlideshowTransitions=function(a){i.$SlideshowOptions.$Transitions=a};k.$SetCaptionTransitions=function(b){H.$CaptionTransitions=b;H.Kb=a.y()};k.$SlidesCount=function(){return T.length};k.$CurrentIndex=function(){return r};k.$IsAutoPlaying=function(){return N};k.$IsDragging=function(){return F};k.$IsSliding=function(){return M};k.$IsMouseOver=function(){return!S};k.$LastDragSucceded=function(){return P};k.$GetOriginalWidth=function(){return a.i(u||o)};k.$GetOriginalHeight=function(){return a.g(u||o)};k.$GetScaleWidth=function(){return a.i(o)};k.$GetScaleHeight=function(){return a.g(o)};k.$SetScaleWidth=function(c){if(!u){var b=a.v(o,e);a.jc(b,"id");a.t(b,"relative");a.n(b,0);a.m(b,0);a.T(b,"visible");u=a.v(o,e);a.jc(u,"id");a.Hb(u,"");a.t(u,"absolute");a.n(u,0);a.m(u,0);a.F(u,a.i(o));a.R(u,a.g(o));a.Fe(u,"0 0");a.w(u,b);var d=a.Z(o);a.w(o,u);a.fd(b,d);a.p(b);a.p(u)}gb=c/a.i(u);a.ye(u,gb);a.F(o,c);a.R(o,gb*a.g(u))};k.rc=function(a){var d=b.ceil(v(rb/Rb)),c=v(a-r+d);if(c>C){if(a-r>t/2)a-=t;else if(a-r<=-t/2)a+=t}else a=r+c-d;return a};m.call(this);k.$Elmt=o=a.S(o);var i=a.h({$FillMode:0,$LazyLoading:1,$StartIndex:0,$AutoPlay:e,$Loop:c,$NaviQuitDrag:c,$AutoPlaySteps:1,$AutoPlayInterval:3e3,$PauseOnHover:3,$HwaMode:1,$SlideDuration:500,$SlideEasing:l.$EaseOutQuad,$MinDragOffsetToSlide:20,$SlideSpacing:0,$DisplayPieces:1,$ParkingPosition:0,$UISearchMode:1,$PlayOrientation:1,$DragOrientation:1},Wb),ab=i.$SlideshowOptions,H=a.h({$Class:s,$PlayInMode:1,$PlayOutMode:1},i.$CaptionSliderOptions),ob=i.$NavigatorOptions,jb=i.$DirectionNavigatorOptions,W=i.$ThumbnailNavigatorOptions,db=i.$UISearchMode,u,y=a.q(o,"slides",d,db),Y=a.q(o,"loading",d,db)||a.xb(f),Gb=a.q(o,"navigator",d,db),Cb=a.q(o,"thumbnavigator",d,db),cc=a.i(y),bc=a.g(y);if(!i.$Loop)i.$ParkingPosition=0;if(i.$DisplayPieces>1||i.$ParkingPosition)i.$DragOrientation&=i.$PlayOrientation;var O,T=a.Z(y),r=-1,nb,t=T.length,L=i.$SlideWidth||cc,K=i.$SlideHeight||bc,Ob=i.$SlideSpacing,vb=L+Ob,wb=K+Ob,Rb=i.$PlayOrientation==1?vb:wb,C=b.min(i.$DisplayPieces,t),cb,w,G,ub,I,R=[],Tb,Eb,Ib,Vb,sc,N,Nb=i.$PauseOnHover,Mb=i.$SlideDuration,lb,Z,rb,Jb=C<t,jc=Jb&&i.$DragOrientation,P,S=1,M,F,Q,pb=0,qb=0,E,X,bb,Ab,x,U,A,Kb=new fc,gb;N=i.$AutoPlay;k.yb=Wb;Zb();o["jssor-slider"]=c;a.bb(y,a.Ib(y));a.t(y,"absolute");cb=a.v(y);a.Bb(a.V(y),cb,y);if(ab){Vb=ab.$ShowLink;lb=ab.$Class;Z=C==1&&t>1&&lb&&(!a.Pb()||a.Cb()>=8)}rb=Z||C>=t?0:i.$ParkingPosition;var sb=y,B=[],z,J,yb="mousedown",hb="mousemove",Bb="mouseup",fb,D,kb,Db,mb;if(g.navigator.msPointerEnabled){yb="MSPointerDown";hb="MSPointerMove";Bb="MSPointerUp";fb="MSPointerCancel";if(i.$DragOrientation){var xb="none";if(i.$DragOrientation==1)xb="pan-y";else if(i.$DragOrientation==2)xb="pan-x";a.Ue(sb.style,"-ms-touch-action",xb)}}else if("ontouchstart"in g||"createTouch"in f){I=c;yb="touchstart";hb="touchmove";Bb="touchend";fb="touchcancel"}U=new pc;if(Z)z=new lb(Kb,L,K,ab,I);a.w(cb,U.mb);a.T(y,"hidden");J=Pb();a.Dc(J,"#000");a.Wb(J,0);a.Bb(sb,J,sb.firstChild);for(var ib=0;ib<T.length;ib++){var nc=T[ib],Ub=new oc(nc,ib);B.push(Ub)}a.B(Y);Ab=new qc;A=new ec(Ab,U);if(jc){a.d(y,yb,lc);a.d(f,Bb,zb);fb&&a.d(f,fb,zb)}Nb&=I?2:1;if(Gb&&ob){Tb=new ob.$Class(Gb,ob);R.push(Tb)}if(jb){Eb=new jb.$Class(o,jb,i.$UISearchMode);R.push(Eb)}if(Cb&&W){W.$StartIndex=i.$StartIndex;Ib=new W.$Class(Cb,W);R.push(Ib)}a.f(R,function(a){a.fc(t,B,Y);a.$On(p.Ab,ac)});a.d(o,"mouseout",Yb);a.d(o,"mouseover",Xb);tb();i.$ArrowKeyNavigation&&a.d(f,"keydown",function(a){if(a.keyCode==q.De)eb(-1);else a.keyCode==q.Se&&eb(1)});k.$SetScaleWidth(k.$GetOriginalWidth());A.sb(i.$StartIndex,i.$StartIndex,0)}n.$EVT_CLICK=21;n.$EVT_DRAG_START=22;n.$EVT_DRAG_END=23;n.$EVT_SWIPE_START=24;n.$EVT_SWIPE_END=25;n.$EVT_LOAD_START=26;n.$EVT_LOAD_END=27;n.$EVT_POSITION_CHANGE=202;n.$EVT_PARK=203;n.$EVT_SLIDESHOW_START=206;n.$EVT_SLIDESHOW_END=207;n.$EVT_PROGRESS_CHANGE=208;n.$EVT_STATE_CHANGE=209;n.$EVT_ROLLBACK_START=210;n.$EVT_ROLLBACK_END=211;g.$JssorSlider$=r=n};var p={Ab:1};g.$JssorNavigator$=function(e,B){var g=this;m.call(g);e=a.S(e);var s,t,r,q,k=0,f,l,j,x,y,i,h,o,n,A=[],z=[];function w(a){a!=-1&&z[a].Ec(a==k)}function u(a){g.e(p.Ab,a*l)}g.$Elmt=e;g.cc=function(a){if(a!=q){var d=k,c=b.floor(a/l);k=c;q=a;w(d);w(c)}};g.gc=function(b){a.p(e,b)};var v;g.fc=function(E){if(!v){s=b.ceil(E/l);k=0;var q=o+x,w=n+y,p=b.ceil(s/j)-1;t=o+q*(!i?p:j-1);r=n+w*(i?p:j-1);a.F(e,t);a.R(e,r);f.$AutoCenter&1&&a.m(e,(a.i(a.V(e))-t)/2);f.$AutoCenter&2&&a.n(e,(a.g(a.V(e))-r)/2);for(var g=0;g<s;g++){var D=a.Xe();a.Ke(D,g+1);var m=a.Ac(h,"NumberTemplate",D,c);a.t(m,"absolute");var B=g%(p+1);a.m(m,!i?q*B:g%j*q);a.n(m,i?w*B:b.floor(g/(p+1))*w);a.w(e,m);A[g]=m;f.$ActionMode&1&&a.d(m,"click",a.r(d,u,g));f.$ActionMode&2&&a.d(m,"mouseover",a.r(d,u,g));z[g]=a.Eb(m)}v=c}};g.yb=f=a.h({$SpacingX:0,$SpacingY:0,$Orientation:1,$ActionMode:1},B);h=a.q(e,"prototype");o=a.i(h);n=a.g(h);a.cb(e,h);l=f.$Steps||1;j=f.$Lanes||1;x=f.$SpacingX;y=f.$SpacingY;i=f.$Orientation-1};g.$JssorDirectionNavigator$=function(i,t,o){var e=this;m.call(e);var b=a.q(i,"arrowleft",d,o),f=a.q(i,"arrowright",d,o),h,j,n=a.i(i),l=a.g(i),r=a.i(b),q=a.g(b);function k(a){e.e(p.Ab,a,c)}e.cc=function(b,a,c){if(c);};e.gc=function(c){a.p(b,c);a.p(f,c)};var s;e.fc=function(c){if(!s){if(h.$AutoCenter&1){a.m(b,(n-r)/2);a.m(f,(n-r)/2)}if(h.$AutoCenter&2){a.n(b,(l-q)/2);a.n(f,(l-q)/2)}a.d(b,"click",a.r(d,k,-j));a.d(f,"click",a.r(d,k,j));a.Eb(b);a.Eb(f)}};e.yb=h=a.h({$Steps:1},t);j=h.$Steps};g.$JssorThumbnailNavigator$=function(i,A){var h=this,x,l,d,u=[],y,w,f,n,o,t,s,k,q,g,j;m.call(h);i=a.S(i);function z(n,e){var g=this,b,m,k;function o(){m.Ec(l==e)}function i(){if(!q.$LastDragSucceded()){var a=(f-e%f)%f,b=q.rc((e+a)/f),c=b*f-a;h.e(p.Ab,c)}}g.N=e;g.Nc=o;k=n.de||n.Fc||a.xb();g.mb=b=a.Ac(j,"ThumbnailTemplate",k,c);m=a.Eb(b);d.$ActionMode&1&&a.d(b,"click",i);d.$ActionMode&2&&a.d(b,"mouseover",i)}h.cc=function(c,d,e){var a=l;l=c;a!=-1&&u[a].Nc();u[c].Nc();!e&&q.$PlayTo(q.rc(b.floor(d/f)))};h.gc=function(b){a.p(i,b)};var v;h.fc=function(F,D){if(!v){x=F;b.ceil(x/f);l=-1;k=b.min(k,D.length);var h=d.$Orientation&1,p=t+(t+n)*(f-1)*(1-h),m=s+(s+o)*(f-1)*h,C=p+(p+n)*(k-1)*h,A=m+(m+o)*(k-1)*(1-h);a.t(g,"absolute");a.T(g,"hidden");d.$AutoCenter&1&&a.m(g,(y-C)/2);d.$AutoCenter&2&&a.n(g,(w-A)/2);a.F(g,C);a.R(g,A);var j=[];a.f(D,function(l,e){var i=new z(l,e),d=i.mb,c=b.floor(e/f),k=e%f;a.m(d,(t+n)*k*(1-h));a.n(d,(s+o)*k*h);if(!j[c]){j[c]=a.xb();a.w(g,j[c])}a.w(j[c],d);u.push(i)});var E=a.h({$AutoPlay:e,$NaviQuitDrag:e,$SlideWidth:p,$SlideHeight:m,$SlideSpacing:n*h+o*(1-h),$MinDragOffsetToSlide:12,$SlideDuration:200,$PauseOnHover:3,$PlayOrientation:d.$Orientation,$DragOrientation:d.$DisableDrag?0:d.$Orientation},d);q=new r(i,E);v=c}};h.yb=d=a.h({$SpacingX:3,$SpacingY:3,$DisplayPieces:1,$Orientation:1,$AutoCenter:3,$ActionMode:1},A);y=a.i(i);w=a.g(i);g=a.q(i,"slides");j=a.q(g,"prototype");a.cb(g,j);f=d.$Lanes||1;n=d.$SpacingX;o=d.$SpacingY;t=a.i(j);s=a.g(j);k=d.$DisplayPieces};function s(){j.call(this,0,0);this.dc=a.db}g.$JssorCaptionSlider$=function(p,k,g){var d=this,h,f=k.$CaptionTransitions,o={hb:"t",$Delay:"d",$Duration:"du",$ScaleHorizontal:"x",$ScaleVertical:"y",$Rotate:"r",$Zoom:"z",$Opacity:"f",P:"b"},e={O:function(b,a){if(!isNaN(a.K))b=a.K;else b*=a.md;return b},$Opacity:function(b,a){return this.O(b-1,a)}};e.$Zoom=e.$Opacity;j.call(d,0,0);function m(r,n){var l=[],i,j=[],c=[];function h(c,d){var b={};a.f(o,function(g,h){var e=a.E(c,g+(d||""));if(e){var f={};if(g=="t")f.K=e;else if(e.indexOf("%")+1)f.md=a.Lc(e)/100;else f.K=a.Lc(e);b[h]=f}});return b}function p(){return f[b.floor(b.random()*f.length)]}function d(g){var h;if(g=="*")h=p();else if(g){var e=f[a.he(g)]||f[g];if(a.Nb(e)){if(g!=i){i=g;c[g]=0;j[g]=e[b.floor(b.random()*e.length)]}else c[g]++;e=j[g];if(a.Nb(e)){e=e.length&&e[c[g]%e.length];if(a.Nb(e))e=e[b.floor(b.random()*e.length)]}}h=e;if(a.hc(h))h=d(h)}return h}var q=a.Z(r);a.f(q,function(b){var c=[];c.$Elmt=b;var f=a.E(b,"u")=="caption";a.f(g?[0,3]:[2],function(o,p){if(f){var l,i;if(o!=2||!a.E(b,"t3")){i=h(b,o);if(o==2&&!i.hb){i.$Delay=i.$Delay||{K:0};i=a.h(h(b,0),i)}}if(i&&i.hb){l=d(i.hb.K);if(l){var j=a.h({$Delay:0,$ScaleHorizontal:1,$ScaleVertical:1},l);a.f(i,function(c,a){var b=(e[a]||e.O).apply(e,[j[a],i[a]]);if(!isNaN(b))j[a]=b});if(!p)if(i.P)j.P=i.P.K||0;else if((g?k.$PlayInMode:k.$PlayOutMode)&2)j.P=0}}c.push(j)}if(n%2&&!p)c.vd=m(b,n+1)});l.push(c)});return l}function n(E,d,F){var h={$Easing:d.$Easing,$Round:d.$Round,$During:d.$During,$Reverse:g&&!F,qe:c},k=E,y=a.V(E),o=a.i(k),n=a.g(k),u=a.i(y),t=a.g(y),f={},l={},m=d.$ScaleClip||1;if(d.$Opacity)f.$Opacity=2-d.$Opacity;h.X=o;h.U=n;if(d.$Zoom||d.$Rotate){f.$Zoom=d.$Zoom?d.$Zoom-1:1;if(a.Db()||a.Tb())f.$Zoom=b.min(f.$Zoom,2);l.$Zoom=1;var s=d.$Rotate||0;if(s==c)s=1;f.$Rotate=s*360;l.$Rotate=0}else if(d.$Clip){var z={$Top:0,$Right:o,$Bottom:n,$Left:0},D=a.h({},z),e=D.L={},C=d.$Clip&4,v=d.$Clip&8,A=d.$Clip&1,x=d.$Clip&2;if(C&&v){e.$Top=n/2*m;e.$Bottom=-e.$Top}else if(C)e.$Bottom=-n*m;else if(v)e.$Top=n*m;if(A&&x){e.$Left=o/2*m;e.$Right=-e.$Left}else if(A)e.$Right=-o*m;else if(x)e.$Left=o*m;h.$Move=d.$Move;f.$Clip=D;l.$Clip=z}var p=d.$FlyDirection,q=0,r=0,w=d.$ScaleHorizontal,B=d.$ScaleVertical;if(i.Me(p))q-=u*w;else if(i.Ne(p))q+=u*w;if(i.Ae(p))r-=t*B;else if(i.Be(p))r+=t*B;if(q||r||h.$Move){f.$Left=q+a.Ic(k);f.$Top=r+a.Gc(k)}var G=d.$Duration;l=a.h(l,a.ue(k,f));h.Qc=a.ve();return new j(d.$Delay,G,h,k,l,f)}function l(b,c){a.f(c,function(c){var f,i=c.$Elmt,e=c[0],j=c[1];if(e){f=n(i,e);b=f.qb(a.Vb(e.P)?b:e.P,1)}b=l(b,c.vd);if(j){var g=n(i,j,1);g.qb(b,1);d.M(g);h.M(g)}f&&d.M(f)});return b}d.dc=function(){d.x(d.H()*(g||0));h.Ub()};h=new j(0,0);l(0,m(p,1))}})(window,document,Math,null,true,false)