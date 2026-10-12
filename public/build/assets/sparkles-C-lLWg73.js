import{r as c}from"./useQuery-DafGJxbm.js";/**
 * @license lucide-react v1.52.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */const _=t=>t==null?void 0:t.replace(/([a-z0-9])([A-Z])/g,"$1-$2").toLowerCase();/**
 * @license lucide-react v1.52.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */function E(t,e,n=[]){if(e==null)throw new Error("[lucide]: iconNode is required when icon name is used");return{name:_(t),size:24,node:e,...n.length>0?{aliases:n}:{}}}/**
 * @license lucide-react v1.52.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */const I=t=>{let e="",n=!1;for(const o of t){if(o==="-"||o==="_"||o<=" "){n=e.length>0;continue}e.length===0?e+=o.toLowerCase():e+=n?o.toUpperCase():o,n=!1}return e};/**
 * @license lucide-react v1.52.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */const D=t=>{const e=I(t);return e.charAt(0).toUpperCase()+e.slice(1)};/**
 * @license lucide-react v1.52.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */const z=(...t)=>t.filter((e,n,o)=>!!e&&e.trim()!==""&&o.indexOf(e)===n).join(" ").trim();/**
 * @license lucide-react v1.52.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */const r={xmlns:"http://www.w3.org/2000/svg",width:24,height:24,viewBox:"0 0 24 24",fill:"none",stroke:"currentColor","stroke-width":2,"stroke-linecap":"round","stroke-linejoin":"round"};/**
 * @license lucide-react v1.52.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */function y(t){return t!=null}function M(t,e={}){var g,k;const n=e.attributeNames??{},o=s=>n[s]??s,l=t.size??t.width??r.width,h=t.size??t.height??r.height,u=((g=t.aliases)==null?void 0:g.filter(s=>typeof s=="string"&&s.trim()!=="").map(s=>`lucide-${s}`))??[],f=[...t.name?[`lucide-${t.name}`]:[],...u],i=((k=e.className)==null?void 0:k.split(" ").filter(Boolean))??[],w=e.includeDefaultClasses===!1?z(...i):z("lucide",...f,...i),x=e.absoluteStrokeWidth?Number(e.strokeWidth??r["stroke-width"])*Number(t.size??t.width??r.width)/Number(e.size??e.width??r.width):e.strokeWidth??r["stroke-width"];return["svg",{...Object.entries(r).reduce((s,[a,d])=>(s[o(a)]=d,s),{}),..."color"in e&&e.color&&{[o("stroke")]:e.color},..."size"in e&&y(e.size)&&{[o("width")]:e.size,[o("height")]:e.size},..."width"in e&&y(e.width)&&{[o("width")]:e.width},..."height"in e&&y(e.height)&&{[o("height")]:e.height},[o("stroke-width")]:x,...w&&{[o("class")]:w},[o("viewBox")]:`0 0 ${l} ${h}`,...e.hasA11yProp===!1?{[o("aria-hidden")]:"true"}:{},..."attributes"in e&&e.attributes},t.node.map(s=>{const[a,d,C]=s,b=e.nonScalingStroke?{[o("vector-effect")]:"non-scaling-stroke",...d}:d;return C?[a,b,C]:[a,b]})]}/**
 * @license lucide-react v1.52.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */function P(t,e={}){return M(t,{...e,attributeNames:{...e.attributeNames,class:"className","stroke-width":"strokeWidth","stroke-linecap":"strokeLinecap","stroke-linejoin":"strokeLinejoin","vector-effect":"vectorEffect"}})}/**
 * @license lucide-react v1.52.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */const R=t=>{for(const e in t)if(e.startsWith("aria-")||e==="role"||e==="title")return!0;return!1},q=c.createContext({}),F=()=>c.useContext(q),U=c.forwardRef(({color:t,size:e,width:n,height:o,strokeWidth:l,absoluteStrokeWidth:h,nonScalingStroke:u,className:f="",children:i,iconNode:w=[],icon:x={node:w,aliases:[],size:24},...m},g)=>{const{size:k=24,strokeWidth:s=2,absoluteStrokeWidth:a=!1,nonScalingStroke:d=!1,color:C="currentColor",className:b=""}=F()??{},p=!!i||R(m),[v,L,$=[]]=P(x,{color:t??C,width:n??e??k,height:o??e??k,strokeWidth:l??s,absoluteStrokeWidth:h??a,nonScalingStroke:u??d,className:z(b,f),hasA11yProp:p,attributes:m});return c.createElement(v,{ref:g,...L},[...$.map(([j,B])=>c.createElement(j,B)),...Array.isArray(i)?i:[i]])});/**
 * @license lucide-react v1.52.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */function S(t,e=[],n=[]){const o=typeof t=="string"?E(t,e,n):t,l=c.forwardRef(({className:h,...u},f)=>c.createElement(U,{ref:f,icon:o,className:h,...u}));return o.name&&(l.displayName=D(o.name)),l}/**
 * @license lucide-react v1.52.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */const N={name:"arrow-right",size:24,node:[["path",{d:"M5 12h14",key:"1ays0h"}],["path",{d:"m12 5 7 7-7 7",key:"xquz4c"}]]};N.node;const K=S(N);/**
 * @license lucide-react v1.52.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */const A={name:"shield-check",size:24,node:[["path",{d:"M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z",key:"oel41y"}],["path",{d:"m9 12 2 2 4-4",key:"dzmm74"}]]};A.node;const V=S(A);/**
 * @license lucide-react v1.52.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */const W={name:"sparkles",size:24,node:[["path",{d:"M11.017 2.814a1 1 0 0 1 1.966 0l1.051 5.558a2 2 0 0 0 1.594 1.594l5.558 1.051a1 1 0 0 1 0 1.966l-5.558 1.051a2 2 0 0 0-1.594 1.594l-1.051 5.558a1 1 0 0 1-1.966 0l-1.051-5.558a2 2 0 0 0-1.594-1.594l-5.558-1.051a1 1 0 0 1 0-1.966l5.558-1.051a2 2 0 0 0 1.594-1.594z",key:"1s2grr"}],["path",{d:"M20 2v4",key:"1rf3ol"}],["path",{d:"M22 4h-4",key:"gwowj6"}],["circle",{cx:"4",cy:"20",r:"2",key:"6kqj1y"}]],aliases:["stars"]};W.node;const Z=S(W);export{K as A,V as S,Z as a,S as c};
