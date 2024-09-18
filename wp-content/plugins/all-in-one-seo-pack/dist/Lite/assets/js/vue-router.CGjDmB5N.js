import{s as nt,u as W,d as rt,i as q,n as ot,e as qe,r as st,f as N,h as ze,p as le,g as ct,w as it}from"./runtime-dom.esm-bundler.DKw-RQqs.js";/*!
  * vue-router v4.4.0
  * (c) 2024 Eduardo San Martin Morote
  * @license MIT
  */const G=typeof document<"u";function at(e){return e.__esModule||e[Symbol.toStringTag]==="Module"}const w=Object.assign;function ue(e,t){const n={};for(const r in t){const o=t[r];n[r]=L(o)?o.map(e):e(o)}return n}const F=()=>{},L=Array.isArray,Ge=/#/g,lt=/&/g,ut=/\//g,ft=/=/g,ht=/\?/g,Ke=/\+/g,pt=/%5B/g,dt=/%5D/g,Ue=/%5E/g,mt=/%60/g,Ve=/%7B/g,gt=/%7C/g,De=/%7D/g,vt=/%20/g;function ge(e){return encodeURI(""+e).replace(gt,"|").replace(pt,"[").replace(dt,"]")}function yt(e){return ge(e).replace(Ve,"{").replace(De,"}").replace(Ue,"^")}function pe(e){return ge(e).replace(Ke,"%2B").replace(vt,"+").replace(Ge,"%23").replace(lt,"%26").replace(mt,"`").replace(Ve,"{").replace(De,"}").replace(Ue,"^")}function Rt(e){return pe(e).replace(ft,"%3D")}function Et(e){return ge(e).replace(Ge,"%23").replace(ht,"%3F")}function Pt(e){return e==null?"":Et(e).replace(ut,"%2F")}function X(e){try{return decodeURIComponent(""+e)}catch{}return""+e}const wt=/\/$/,St=e=>e.replace(wt,"");function fe(e,t,n="/"){let r,o={},a="",d="";const g=t.indexOf("#");let c=t.indexOf("?");return g<c&&g>=0&&(c=-1),c>-1&&(r=t.slice(0,c),a=t.slice(c+1,g>-1?g:t.length),o=e(a)),g>-1&&(r=r||t.slice(0,g),d=t.slice(g,t.length)),r=Ct(r??t,n),{fullPath:r+(a&&"?")+a+d,path:r,query:o,hash:X(d)}}function _t(e,t){const n=t.query?e(t.query):"";return t.path+(n&&"?")+n+(t.hash||"")}function _e(e,t){return!t||!e.toLowerCase().startsWith(t.toLowerCase())?e:e.slice(t.length)||"/"}function bt(e,t,n){const r=t.matched.length-1,o=n.matched.length-1;return r>-1&&r===o&&K(t.matched[r],n.matched[o])&&Qe(t.params,n.params)&&e(t.query)===e(n.query)&&t.hash===n.hash}function K(e,t){return(e.aliasOf||e)===(t.aliasOf||t)}function Qe(e,t){if(Object.keys(e).length!==Object.keys(t).length)return!1;for(const n in e)if(!kt(e[n],t[n]))return!1;return!0}function kt(e,t){return L(e)?be(e,t):L(t)?be(t,e):e===t}function be(e,t){return L(t)?e.length===t.length&&e.every((n,r)=>n===t[r]):e.length===1&&e[0]===t}function Ct(e,t){if(e.startsWith("/"))return e;if(!e)return t;const n=t.split("/"),r=e.split("/"),o=r[r.length-1];(o===".."||o===".")&&r.push("");let a=n.length-1,d,g;for(d=0;d<r.length;d++)if(g=r[d],g!==".")if(g==="..")a>1&&a--;else break;return n.slice(0,a).join("/")+"/"+r.slice(d).join("/")}const j={path:"/",name:void 0,params:{},query:{},hash:"",fullPath:"/",matched:[],meta:{},redirectedFrom:void 0};var Z;(function(e){e.pop="pop",e.push="push"})(Z||(Z={}));var Y;(function(e){e.back="back",e.forward="forward",e.unknown=""})(Y||(Y={}));function At(e){if(!e)if(G){const t=document.querySelector("base");e=t&&t.getAttribute("href")||"/",e=e.replace(/^\w+:\/\/[^\/]+/,"")}else e="/";return e[0]!=="/"&&e[0]!=="#"&&(e="/"+e),St(e)}const Ot=/^[^#]+#/;function xt(e,t){return e.replace(Ot,"#")+t}function Mt(e,t){const n=document.documentElement.getBoundingClientRect(),r=e.getBoundingClientRect();return{behavior:t.behavior,left:r.left-n.left-(t.left||0),top:r.top-n.top-(t.top||0)}}const te=()=>({left:window.scrollX,top:window.scrollY});function It(e){let t;if("el"in e){const n=e.el,r=typeof n=="string"&&n.startsWith("#"),o=typeof n=="string"?r?document.getElementById(n.slice(1)):document.querySelector(n):n;if(!o)return;t=Mt(o,e)}else t=e;"scrollBehavior"in document.documentElement.style?window.scrollTo(t):window.scrollTo(t.left!=null?t.left:window.scrollX,t.top!=null?t.top:window.scrollY)}function ke(e,t){return(history.state?history.state.position-t:-1)+e}const de=new Map;function Lt(e,t){de.set(e,t)}function Nt(e){const t=de.get(e);return de.delete(e),t}let Tt=()=>location.protocol+"//"+location.host;function We(e,t){const{pathname:n,search:r,hash:o}=t,a=e.indexOf("#");if(a>-1){let g=o.includes(e.slice(a))?e.slice(a).length:1,c=o.slice(g);return c[0]!=="/"&&(c="/"+c),_e(c,"")}return _e(n,e)+r+o}function $t(e,t,n,r){let o=[],a=[],d=null;const g=({state:l})=>{const u=We(e,location),P=n.value,S=t.value;let k=0;if(l){if(n.value=u,t.value=l,d&&d===P){d=null;return}k=S?l.position-S.position:0}else r(u);o.forEach(C=>{C(n.value,P,{delta:k,type:Z.pop,direction:k?k>0?Y.forward:Y.back:Y.unknown})})};function c(){d=n.value}function f(l){o.push(l);const u=()=>{const P=o.indexOf(l);P>-1&&o.splice(P,1)};return a.push(u),u}function h(){const{history:l}=window;l.state&&l.replaceState(w({},l.state,{scroll:te()}),"")}function i(){for(const l of a)l();a=[],window.removeEventListener("popstate",g),window.removeEventListener("beforeunload",h)}return window.addEventListener("popstate",g),window.addEventListener("beforeunload",h,{passive:!0}),{pauseListeners:c,listen:f,destroy:i}}function Ce(e,t,n,r=!1,o=!1){return{back:e,current:t,forward:n,replaced:r,position:window.history.length,scroll:o?te():null}}function jt(e){const{history:t,location:n}=window,r={value:We(e,n)},o={value:t.state};o.value||a(r.value,{back:null,current:r.value,forward:null,position:t.length-1,replaced:!0,scroll:null},!0);function a(c,f,h){const i=e.indexOf("#"),l=i>-1?(n.host&&document.querySelector("base")?e:e.slice(i))+c:Tt()+e+c;try{t[h?"replaceState":"pushState"](f,"",l),o.value=f}catch(u){console.error(u),n[h?"replace":"assign"](l)}}function d(c,f){const h=w({},t.state,Ce(o.value.back,c,o.value.forward,!0),f,{position:o.value.position});a(c,h,!0),r.value=c}function g(c,f){const h=w({},o.value,t.state,{forward:c,scroll:te()});a(h.current,h,!0);const i=w({},Ce(r.value,c,null),{position:h.position+1},f);a(c,i,!1),r.value=c}return{location:r,state:o,push:g,replace:d}}function Ht(e){e=At(e);const t=jt(e),n=$t(e,t.state,t.location,t.replace);function r(a,d=!0){d||n.pauseListeners(),history.go(a)}const o=w({location:"",base:e,go:r,createHref:xt.bind(null,e)},t,n);return Object.defineProperty(o,"location",{enumerable:!0,get:()=>t.location.value}),Object.defineProperty(o,"state",{enumerable:!0,get:()=>t.state.value}),o}function pn(e){return e=location.host?e||location.pathname+location.search:"",e.includes("#")||(e+="#"),Ht(e)}function Bt(e){return typeof e=="string"||e&&typeof e=="object"}function Fe(e){return typeof e=="string"||typeof e=="symbol"}const Ye=Symbol("");var Ae;(function(e){e[e.aborted=4]="aborted",e[e.cancelled=8]="cancelled",e[e.duplicated=16]="duplicated"})(Ae||(Ae={}));function U(e,t){return w(new Error,{type:e,[Ye]:!0},t)}function T(e,t){return e instanceof Error&&Ye in e&&(t==null||!!(e.type&t))}const Oe="[^/]+?",qt={sensitive:!1,strict:!1,start:!0,end:!0},zt=/[.+*?^${}()[\]/\\]/g;function Gt(e,t){const n=w({},qt,t),r=[];let o=n.start?"^":"";const a=[];for(const f of e){const h=f.length?[]:[90];n.strict&&!f.length&&(o+="/");for(let i=0;i<f.length;i++){const l=f[i];let u=40+(n.sensitive?.25:0);if(l.type===0)i||(o+="/"),o+=l.value.replace(zt,"\\$&"),u+=40;else if(l.type===1){const{value:P,repeatable:S,optional:k,regexp:C}=l;a.push({name:P,repeatable:S,optional:k});const E=C||Oe;if(E!==Oe){u+=10;try{new RegExp(`(${E})`)}catch(I){throw new Error(`Invalid custom RegExp for param "${P}" (${E}): `+I.message)}}let _=S?`((?:${E})(?:/(?:${E}))*)`:`(${E})`;i||(_=k&&f.length<2?`(?:/${_})`:"/"+_),k&&(_+="?"),o+=_,u+=20,k&&(u+=-8),S&&(u+=-20),E===".*"&&(u+=-50)}h.push(u)}r.push(h)}if(n.strict&&n.end){const f=r.length-1;r[f][r[f].length-1]+=.7000000000000001}n.strict||(o+="/?"),n.end?o+="$":n.strict&&(o+="(?:/|$)");const d=new RegExp(o,n.sensitive?"":"i");function g(f){const h=f.match(d),i={};if(!h)return null;for(let l=1;l<h.length;l++){const u=h[l]||"",P=a[l-1];i[P.name]=u&&P.repeatable?u.split("/"):u}return i}function c(f){let h="",i=!1;for(const l of e){(!i||!h.endsWith("/"))&&(h+="/"),i=!1;for(const u of l)if(u.type===0)h+=u.value;else if(u.type===1){const{value:P,repeatable:S,optional:k}=u,C=P in f?f[P]:"";if(L(C)&&!S)throw new Error(`Provided param "${P}" is an array but it is not repeatable (* or + modifiers)`);const E=L(C)?C.join("/"):C;if(!E)if(k)l.length<2&&(h.endsWith("/")?h=h.slice(0,-1):i=!0);else throw new Error(`Missing required param "${P}"`);h+=E}}return h||"/"}return{re:d,score:r,keys:a,parse:g,stringify:c}}function Kt(e,t){let n=0;for(;n<e.length&&n<t.length;){const r=t[n]-e[n];if(r)return r;n++}return e.length<t.length?e.length===1&&e[0]===80?-1:1:e.length>t.length?t.length===1&&t[0]===80?1:-1:0}function Xe(e,t){let n=0;const r=e.score,o=t.score;for(;n<r.length&&n<o.length;){const a=Kt(r[n],o[n]);if(a)return a;n++}if(Math.abs(o.length-r.length)===1){if(xe(r))return 1;if(xe(o))return-1}return o.length-r.length}function xe(e){const t=e[e.length-1];return e.length>0&&t[t.length-1]<0}const Ut={type:0,value:""},Vt=/[a-zA-Z0-9_]/;function Dt(e){if(!e)return[[]];if(e==="/")return[[Ut]];if(!e.startsWith("/"))throw new Error(`Invalid path "${e}"`);function t(u){throw new Error(`ERR (${n})/"${f}": ${u}`)}let n=0,r=n;const o=[];let a;function d(){a&&o.push(a),a=[]}let g=0,c,f="",h="";function i(){f&&(n===0?a.push({type:0,value:f}):n===1||n===2||n===3?(a.length>1&&(c==="*"||c==="+")&&t(`A repeatable param (${f}) must be alone in its segment. eg: '/:ids+.`),a.push({type:1,value:f,regexp:h,repeatable:c==="*"||c==="+",optional:c==="*"||c==="?"})):t("Invalid state to consume buffer"),f="")}function l(){f+=c}for(;g<e.length;){if(c=e[g++],c==="\\"&&n!==2){r=n,n=4;continue}switch(n){case 0:c==="/"?(f&&i(),d()):c===":"?(i(),n=1):l();break;case 4:l(),n=r;break;case 1:c==="("?n=2:Vt.test(c)?l():(i(),n=0,c!=="*"&&c!=="?"&&c!=="+"&&g--);break;case 2:c===")"?h[h.length-1]=="\\"?h=h.slice(0,-1)+c:n=3:h+=c;break;case 3:i(),n=0,c!=="*"&&c!=="?"&&c!=="+"&&g--,h="";break;default:t("Unknown state");break}}return n===2&&t(`Unfinished custom RegExp for param "${f}"`),i(),d(),o}function Qt(e,t,n){const r=Gt(Dt(e.path),n),o=w(r,{record:e,parent:t,children:[],alias:[]});return t&&!o.record.aliasOf==!t.record.aliasOf&&t.children.push(o),o}function Wt(e,t){const n=[],r=new Map;t=Le({strict:!1,end:!0,sensitive:!1},t);function o(i){return r.get(i)}function a(i,l,u){const P=!u,S=Ft(i);S.aliasOf=u&&u.record;const k=Le(t,i),C=[S];if("alias"in i){const I=typeof i.alias=="string"?[i.alias]:i.alias;for(const B of I)C.push(w({},S,{components:u?u.record.components:S.components,path:B,aliasOf:u?u.record:S}))}let E,_;for(const I of C){const{path:B}=I;if(l&&B[0]!=="/"){const $=l.record.path,M=$[$.length-1]==="/"?"":"/";I.path=l.record.path+(B&&M+B)}if(E=Qt(I,l,k),u?u.alias.push(E):(_=_||E,_!==E&&_.alias.push(E),P&&i.name&&!Ie(E)&&d(i.name)),Ze(E)&&c(E),S.children){const $=S.children;for(let M=0;M<$.length;M++)a($[M],E,u&&u.children[M])}u=u||E}return _?()=>{d(_)}:F}function d(i){if(Fe(i)){const l=r.get(i);l&&(r.delete(i),n.splice(n.indexOf(l),1),l.children.forEach(d),l.alias.forEach(d))}else{const l=n.indexOf(i);l>-1&&(n.splice(l,1),i.record.name&&r.delete(i.record.name),i.children.forEach(d),i.alias.forEach(d))}}function g(){return n}function c(i){const l=Zt(i,n);n.splice(l,0,i),i.record.name&&!Ie(i)&&r.set(i.record.name,i)}function f(i,l){let u,P={},S,k;if("name"in i&&i.name){if(u=r.get(i.name),!u)throw U(1,{location:i});k=u.record.name,P=w(Me(l.params,u.keys.filter(_=>!_.optional).concat(u.parent?u.parent.keys.filter(_=>_.optional):[]).map(_=>_.name)),i.params&&Me(i.params,u.keys.map(_=>_.name))),S=u.stringify(P)}else if(i.path!=null)S=i.path,u=n.find(_=>_.re.test(S)),u&&(P=u.parse(S),k=u.record.name);else{if(u=l.name?r.get(l.name):n.find(_=>_.re.test(l.path)),!u)throw U(1,{location:i,currentLocation:l});k=u.record.name,P=w({},l.params,i.params),S=u.stringify(P)}const C=[];let E=u;for(;E;)C.unshift(E.record),E=E.parent;return{name:k,path:S,params:P,matched:C,meta:Xt(C)}}e.forEach(i=>a(i));function h(){n.length=0,r.clear()}return{addRoute:a,resolve:f,removeRoute:d,clearRoutes:h,getRoutes:g,getRecordMatcher:o}}function Me(e,t){const n={};for(const r of t)r in e&&(n[r]=e[r]);return n}function Ft(e){return{path:e.path,redirect:e.redirect,name:e.name,meta:e.meta||{},aliasOf:void 0,beforeEnter:e.beforeEnter,props:Yt(e),children:e.children||[],instances:{},leaveGuards:new Set,updateGuards:new Set,enterCallbacks:{},components:"components"in e?e.components||null:e.component&&{default:e.component}}}function Yt(e){const t={},n=e.props||!1;if("component"in e)t.default=n;else for(const r in e.components)t[r]=typeof n=="object"?n[r]:n;return t}function Ie(e){for(;e;){if(e.record.aliasOf)return!0;e=e.parent}return!1}function Xt(e){return e.reduce((t,n)=>w(t,n.meta),{})}function Le(e,t){const n={};for(const r in e)n[r]=r in t?t[r]:e[r];return n}function Zt(e,t){let n=0,r=t.length;for(;n!==r;){const a=n+r>>1;Xe(e,t[a])<0?r=a:n=a+1}const o=Jt(e);return o&&(r=t.lastIndexOf(o,r-1)),r}function Jt(e){let t=e;for(;t=t.parent;)if(Ze(t)&&Xe(e,t)===0)return t}function Ze({record:e}){return!!(e.name||e.components&&Object.keys(e.components).length||e.redirect)}function en(e){const t={};if(e===""||e==="?")return t;const r=(e[0]==="?"?e.slice(1):e).split("&");for(let o=0;o<r.length;++o){const a=r[o].replace(Ke," "),d=a.indexOf("="),g=X(d<0?a:a.slice(0,d)),c=d<0?null:X(a.slice(d+1));if(g in t){let f=t[g];L(f)||(f=t[g]=[f]),f.push(c)}else t[g]=c}return t}function Ne(e){let t="";for(let n in e){const r=e[n];if(n=Rt(n),r==null){r!==void 0&&(t+=(t.length?"&":"")+n);continue}(L(r)?r.map(a=>a&&pe(a)):[r&&pe(r)]).forEach(a=>{a!==void 0&&(t+=(t.length?"&":"")+n,a!=null&&(t+="="+a))})}return t}function tn(e){const t={};for(const n in e){const r=e[n];r!==void 0&&(t[n]=L(r)?r.map(o=>o==null?null:""+o):r==null?r:""+r)}return t}const nn=Symbol(""),Te=Symbol(""),ne=Symbol(""),ve=Symbol(""),me=Symbol("");function Q(){let e=[];function t(r){return e.push(r),()=>{const o=e.indexOf(r);o>-1&&e.splice(o,1)}}function n(){e=[]}return{add:t,list:()=>e.slice(),reset:n}}function H(e,t,n,r,o,a=d=>d()){const d=r&&(r.enterCallbacks[o]=r.enterCallbacks[o]||[]);return()=>new Promise((g,c)=>{const f=l=>{l===!1?c(U(4,{from:n,to:t})):l instanceof Error?c(l):Bt(l)?c(U(2,{from:t,to:l})):(d&&r.enterCallbacks[o]===d&&typeof l=="function"&&d.push(l),g())},h=a(()=>e.call(r&&r.instances[o],t,n,f));let i=Promise.resolve(h);e.length<3&&(i=i.then(f)),i.catch(l=>c(l))})}function he(e,t,n,r,o=a=>a()){const a=[];for(const d of e)for(const g in d.components){let c=d.components[g];if(!(t!=="beforeRouteEnter"&&!d.instances[g]))if(rn(c)){const h=(c.__vccOpts||c)[t];h&&a.push(H(h,n,r,d,g,o))}else{let f=c();a.push(()=>f.then(h=>{if(!h)return Promise.reject(new Error(`Couldn't resolve component "${g}" at "${d.path}"`));const i=at(h)?h.default:h;d.components[g]=i;const u=(i.__vccOpts||i)[t];return u&&H(u,n,r,d,g,o)()}))}}return a}function rn(e){return typeof e=="object"||"displayName"in e||"props"in e||"__vccOpts"in e}function $e(e){const t=q(ne),n=q(ve),r=N(()=>{const c=W(e.to);return t.resolve(c)}),o=N(()=>{const{matched:c}=r.value,{length:f}=c,h=c[f-1],i=n.matched;if(!h||!i.length)return-1;const l=i.findIndex(K.bind(null,h));if(l>-1)return l;const u=je(c[f-2]);return f>1&&je(h)===u&&i[i.length-1].path!==u?i.findIndex(K.bind(null,c[f-2])):l}),a=N(()=>o.value>-1&&an(n.params,r.value.params)),d=N(()=>o.value>-1&&o.value===n.matched.length-1&&Qe(n.params,r.value.params));function g(c={}){return cn(c)?t[W(e.replace)?"replace":"push"](W(e.to)).catch(F):Promise.resolve()}return{route:r,href:N(()=>r.value.href),isActive:a,isExactActive:d,navigate:g}}const on=qe({name:"RouterLink",compatConfig:{MODE:3},props:{to:{type:[String,Object],required:!0},replace:Boolean,activeClass:String,exactActiveClass:String,custom:Boolean,ariaCurrentValue:{type:String,default:"page"}},useLink:$e,setup(e,{slots:t}){const n=st($e(e)),{options:r}=q(ne),o=N(()=>({[He(e.activeClass,r.linkActiveClass,"router-link-active")]:n.isActive,[He(e.exactActiveClass,r.linkExactActiveClass,"router-link-exact-active")]:n.isExactActive}));return()=>{const a=t.default&&t.default(n);return e.custom?a:ze("a",{"aria-current":n.isExactActive?e.ariaCurrentValue:null,href:n.href,onClick:n.navigate,class:o.value},a)}}}),sn=on;function cn(e){if(!(e.metaKey||e.altKey||e.ctrlKey||e.shiftKey)&&!e.defaultPrevented&&!(e.button!==void 0&&e.button!==0)){if(e.currentTarget&&e.currentTarget.getAttribute){const t=e.currentTarget.getAttribute("target");if(/\b_blank\b/i.test(t))return}return e.preventDefault&&e.preventDefault(),!0}}function an(e,t){for(const n in t){const r=t[n],o=e[n];if(typeof r=="string"){if(r!==o)return!1}else if(!L(o)||o.length!==r.length||r.some((a,d)=>a!==o[d]))return!1}return!0}function je(e){return e?e.aliasOf?e.aliasOf.path:e.path:""}const He=(e,t,n)=>e??t??n,ln=qe({name:"RouterView",inheritAttrs:!1,props:{name:{type:String,default:"default"},route:Object},compatConfig:{MODE:3},setup(e,{attrs:t,slots:n}){const r=q(me),o=N(()=>e.route||r.value),a=q(Te,0),d=N(()=>{let f=W(a);const{matched:h}=o.value;let i;for(;(i=h[f])&&!i.components;)f++;return f}),g=N(()=>o.value.matched[d.value]);le(Te,N(()=>d.value+1)),le(nn,g),le(me,o);const c=ct();return it(()=>[c.value,g.value,e.name],([f,h,i],[l,u,P])=>{h&&(h.instances[i]=f,u&&u!==h&&f&&f===l&&(h.leaveGuards.size||(h.leaveGuards=u.leaveGuards),h.updateGuards.size||(h.updateGuards=u.updateGuards))),f&&h&&(!u||!K(h,u)||!l)&&(h.enterCallbacks[i]||[]).forEach(S=>S(f))},{flush:"post"}),()=>{const f=o.value,h=e.name,i=g.value,l=i&&i.components[h];if(!l)return Be(n.default,{Component:l,route:f});const u=i.props[h],P=u?u===!0?f.params:typeof u=="function"?u(f):u:null,k=ze(l,w({},P,t,{onVnodeUnmounted:C=>{C.component.isUnmounted&&(i.instances[h]=null)},ref:c}));return Be(n.default,{Component:k,route:f})||k}}});function Be(e,t){if(!e)return null;const n=e(t);return n.length===1?n[0]:n}const un=ln;function dn(e){const t=Wt(e.routes,e),n=e.parseQuery||en,r=e.stringifyQuery||Ne,o=e.history,a=Q(),d=Q(),g=Q(),c=nt(j);let f=j;G&&e.scrollBehavior&&"scrollRestoration"in history&&(history.scrollRestoration="manual");const h=ue.bind(null,s=>""+s),i=ue.bind(null,Pt),l=ue.bind(null,X);function u(s,m){let p,v;return Fe(s)?(p=t.getRecordMatcher(s),v=m):v=s,t.addRoute(v,p)}function P(s){const m=t.getRecordMatcher(s);m&&t.removeRoute(m)}function S(){return t.getRoutes().map(s=>s.record)}function k(s){return!!t.getRecordMatcher(s)}function C(s,m){if(m=w({},m||c.value),typeof s=="string"){const y=fe(n,s,m.path),O=t.resolve({path:y.path},m),D=o.createHref(y.fullPath);return w(y,O,{params:l(O.params),hash:X(y.hash),redirectedFrom:void 0,href:D})}let p;if(s.path!=null)p=w({},s,{path:fe(n,s.path,m.path).path});else{const y=w({},s.params);for(const O in y)y[O]==null&&delete y[O];p=w({},s,{params:i(y)}),m.params=i(m.params)}const v=t.resolve(p,m),b=s.hash||"";v.params=h(l(v.params));const A=_t(r,w({},s,{hash:yt(b),path:v.path})),R=o.createHref(A);return w({fullPath:A,hash:b,query:r===Ne?tn(s.query):s.query||{}},v,{redirectedFrom:void 0,href:R})}function E(s){return typeof s=="string"?fe(n,s,c.value.path):w({},s)}function _(s,m){if(f!==s)return U(8,{from:m,to:s})}function I(s){return M(s)}function B(s){return I(w(E(s),{replace:!0}))}function $(s){const m=s.matched[s.matched.length-1];if(m&&m.redirect){const{redirect:p}=m;let v=typeof p=="function"?p(s):p;return typeof v=="string"&&(v=v.includes("?")||v.includes("#")?v=E(v):{path:v},v.params={}),w({query:s.query,hash:s.hash,params:v.path!=null?{}:s.params},v)}}function M(s,m){const p=f=C(s),v=c.value,b=s.state,A=s.force,R=s.replace===!0,y=$(p);if(y)return M(w(E(y),{state:typeof y=="object"?w({},b,y.state):b,force:A,replace:R}),m||p);const O=p;O.redirectedFrom=m;let D;return!A&&bt(r,v,p)&&(D=U(16,{to:O,from:v}),we(v,v,!0,!1)),(D?Promise.resolve(D):ye(O,v)).catch(x=>T(x)?T(x,2)?x:ce(x):se(x,O,v)).then(x=>{if(x){if(T(x,2))return M(w({replace:R},E(x.to),{state:typeof x.to=="object"?w({},b,x.to.state):b,force:A}),m||O)}else x=Ee(O,v,!0,R,b);return Re(O,v,x),x})}function Je(s,m){const p=_(s,m);return p?Promise.reject(p):Promise.resolve()}function re(s){const m=ee.values().next().value;return m&&typeof m.runWithContext=="function"?m.runWithContext(s):s()}function ye(s,m){let p;const[v,b,A]=fn(s,m);p=he(v.reverse(),"beforeRouteLeave",s,m);for(const y of v)y.leaveGuards.forEach(O=>{p.push(H(O,s,m))});const R=Je.bind(null,s,m);return p.push(R),z(p).then(()=>{p=[];for(const y of a.list())p.push(H(y,s,m));return p.push(R),z(p)}).then(()=>{p=he(b,"beforeRouteUpdate",s,m);for(const y of b)y.updateGuards.forEach(O=>{p.push(H(O,s,m))});return p.push(R),z(p)}).then(()=>{p=[];for(const y of A)if(y.beforeEnter)if(L(y.beforeEnter))for(const O of y.beforeEnter)p.push(H(O,s,m));else p.push(H(y.beforeEnter,s,m));return p.push(R),z(p)}).then(()=>(s.matched.forEach(y=>y.enterCallbacks={}),p=he(A,"beforeRouteEnter",s,m,re),p.push(R),z(p))).then(()=>{p=[];for(const y of d.list())p.push(H(y,s,m));return p.push(R),z(p)}).catch(y=>T(y,8)?y:Promise.reject(y))}function Re(s,m,p){g.list().forEach(v=>re(()=>v(s,m,p)))}function Ee(s,m,p,v,b){const A=_(s,m);if(A)return A;const R=m===j,y=G?history.state:{};p&&(v||R?o.replace(s.fullPath,w({scroll:R&&y&&y.scroll},b)):o.push(s.fullPath,b)),c.value=s,we(s,m,p,R),ce()}let V;function et(){V||(V=o.listen((s,m,p)=>{if(!Se.listening)return;const v=C(s),b=$(v);if(b){M(w(b,{replace:!0}),v).catch(F);return}f=v;const A=c.value;G&&Lt(ke(A.fullPath,p.delta),te()),ye(v,A).catch(R=>T(R,12)?R:T(R,2)?(M(R.to,v).then(y=>{T(y,20)&&!p.delta&&p.type===Z.pop&&o.go(-1,!1)}).catch(F),Promise.reject()):(p.delta&&o.go(-p.delta,!1),se(R,v,A))).then(R=>{R=R||Ee(v,A,!1),R&&(p.delta&&!T(R,8)?o.go(-p.delta,!1):p.type===Z.pop&&T(R,20)&&o.go(-1,!1)),Re(v,A,R)}).catch(F)}))}let oe=Q(),Pe=Q(),J;function se(s,m,p){ce(s);const v=Pe.list();return v.length?v.forEach(b=>b(s,m,p)):console.error(s),Promise.reject(s)}function tt(){return J&&c.value!==j?Promise.resolve():new Promise((s,m)=>{oe.add([s,m])})}function ce(s){return J||(J=!s,et(),oe.list().forEach(([m,p])=>s?p(s):m()),oe.reset()),s}function we(s,m,p,v){const{scrollBehavior:b}=e;if(!G||!b)return Promise.resolve();const A=!p&&Nt(ke(s.fullPath,0))||(v||!p)&&history.state&&history.state.scroll||null;return ot().then(()=>b(s,m,A)).then(R=>R&&It(R)).catch(R=>se(R,s,m))}const ie=s=>o.go(s);let ae;const ee=new Set,Se={currentRoute:c,listening:!0,addRoute:u,removeRoute:P,clearRoutes:t.clearRoutes,hasRoute:k,getRoutes:S,resolve:C,options:e,push:I,replace:B,go:ie,back:()=>ie(-1),forward:()=>ie(1),beforeEach:a.add,beforeResolve:d.add,afterEach:g.add,onError:Pe.add,isReady:tt,install(s){const m=this;s.component("RouterLink",sn),s.component("RouterView",un),s.config.globalProperties.$router=m,Object.defineProperty(s.config.globalProperties,"$route",{enumerable:!0,get:()=>W(c)}),G&&!ae&&c.value===j&&(ae=!0,I(o.location).catch(b=>{}));const p={};for(const b in j)Object.defineProperty(p,b,{get:()=>c.value[b],enumerable:!0});s.provide(ne,m),s.provide(ve,rt(p)),s.provide(me,c);const v=s.unmount;ee.add(s),s.unmount=function(){ee.delete(s),ee.size<1&&(f=j,V&&V(),V=null,c.value=j,ae=!1,J=!1),v()}}};function z(s){return s.reduce((m,p)=>m.then(()=>re(p)),Promise.resolve())}return Se}function fn(e,t){const n=[],r=[],o=[],a=Math.max(t.matched.length,e.matched.length);for(let d=0;d<a;d++){const g=t.matched[d];g&&(e.matched.find(f=>K(f,g))?r.push(g):n.push(g));const c=e.matched[d];c&&(t.matched.find(f=>K(f,c))||o.push(c))}return[n,r,o]}function mn(){return q(ne)}function gn(e){return q(ve)}export{pn as a,Ht as b,dn as c,mn as d,gn as u};
