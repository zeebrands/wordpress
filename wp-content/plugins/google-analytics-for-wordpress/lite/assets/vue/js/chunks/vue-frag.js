var h=Symbol(),c=Symbol(),g=Symbol(),d=Symbol(),v=function(r){return"frag"in r},x={get:function(){return this[c]||this.parentElement},configurable:!0},f=function(r,e){c in r||(r[c]=e,Object.defineProperty(r,"parentNode",x))},P={get:function(){var r=this.parentNode.childNodes,e=r.indexOf(this);return e>-1&&r[e+1]||null}},u=function(r){g in r||(r[g]=!0,Object.defineProperty(r,"nextSibling",P))},O=function(r,e){for(;r.parentNode!==e;){var i=r,n=i.parentNode;n&&(r=n)}return r},p,N=function(r){if(!p){var e=Object.getOwnPropertyDescriptor(Node.prototype,"childNodes");p=e.get}var i=p.apply(r),n=Array.from(i).map(function(a){return O(a,r)});return n.filter(function(a,o){return a!==n[o-1]})},S={get:function(){return this.frag||N(this)}},E={get:function(){return this.childNodes[0]||null}};function F(){return this.childNodes.length>0}var m=function(r){d in r||(r[d]=!0,Object.defineProperties(r,{childNodes:S,firstChild:E}),r.hasChildNodes=F)};function _(){var t;(t=this.frag[0]).before.apply(t,arguments)}function A(){var t=this.frag,r=t.splice(0,t.length);r.forEach(function(e){e.remove()})}var $=function t(r){var e;return(e=Array.prototype).concat.apply(e,r.map(function(i){return v(i)?t(i.frag):i}))},j=function(r,e){var i=r[h];e.before(i),f(i,r),r.frag.unshift(i)};function y(t){if(v(this)){var r=this.frag.indexOf(t);if(r>-1){var e=this.frag.splice(r,1),i=e[0];this.frag.length===0&&j(this,i),t.remove()}}else{var n=N(this),a=n.indexOf(t);a>-1&&t.remove()}return t}function b(t,r){var e=this,i=t.frag||[t];if(v(this)){if(t[c]===this&&t.parentElement)return t;var n=this.frag;if(r){var a=n.indexOf(r);a>-1&&(n.splice.apply(n,[a,0].concat(i)),r.before.apply(r,i))}else{var o=n[n.length-1];n.push.apply(n,i),o.after.apply(o,i)}C(this)}else r?this.childNodes.includes(r)&&r.before.apply(r,i):this.append.apply(this,i);i.forEach(function(l){f(l,e)});var s=i[i.length-1];return u(s),t}function D(t){if(t[c]===this&&t.parentElement)return t;var r=this.frag,e=r[r.length-1];return e.after(t),f(t,this),C(this),r.push(t),t}var C=function(r){var e=r[h];r.frag[0]===e&&(r.frag.shift(),e.remove())},L={set:function(r){var e=this;if(this.frag[0]!==this[h]&&this.frag.slice().forEach(function(n){return e.removeChild(n)}),r){var i=document.createElement("div");i.innerHTML=r,Array.from(i.childNodes).forEach(function(n){e.appendChild(n)})}},get:function(){return""}},T={inserted:function(r){var e=r.parentNode,i=r.nextSibling,n=r.previousSibling,a=Array.from(r.childNodes),o=document.createComment("");a.length===0&&a.push(o),r.frag=a,r[h]=o;var s=document.createDocumentFragment();s.append.apply(s,$(a)),r.replaceWith(s),a.forEach(function(l){f(l,r),u(l)}),m(r),Object.assign(r,{remove:A,appendChild:D,insertBefore:b,removeChild:y,before:_}),Object.defineProperty(r,"innerHTML",L),e&&(Object.assign(e,{removeChild:y,insertBefore:b}),f(r,e),m(e)),i&&u(r),n&&u(n)},unbind:function(r){r.remove()}},H={name:"Fragment",directives:{frag:T},render:function(r){return r("div",{directives:[{name:"frag"}]},this.$slots.default)}};export{H as f};
