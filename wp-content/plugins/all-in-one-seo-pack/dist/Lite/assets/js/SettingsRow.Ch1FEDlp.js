import{G as g,a as f}from"./Row.D0941SYu.js";import{_}from"./_plugin-vue_export-helper.BN1snXvA.js";import{v as l,o as t,k as p,l as a,m as o,C as c,a as r,G as s,x as y,t as h,c as d,b as u}from"./runtime-dom.esm-bundler.DKw-RQqs.js";const B={components:{GridColumn:g,GridRow:f},props:{align:Boolean,alignSmall:Boolean,name:String,required:Boolean,noHorizontalMargin:{type:Boolean,default:!1},noVerticalMargin:{type:Boolean,default:!1},noBorder:{type:Boolean,default:!1},noRightMaxWidth:{type:Boolean,default:!1},leftSize:{type:String,default(){return"3"}},rightSize:{type:String,default(){return"9"}}}},S={key:0,class:"required-field"},z={key:0,class:"aioseo-description"},C={class:"settings-content"};function v(n,w,e,k,x,M){const i=l("grid-column"),m=l("grid-row");return t(),p(m,{class:s(["aioseo-settings-row",{"no-horizontal-margin":e.noHorizontalMargin,"no-vertical-margin":e.noVerticalMargin,"no-border":e.noBorder,"no-right-max-width":e.noRightMaxWidth}])},{default:a(()=>[o(n.$slots,"header"),c(i,{md:e.leftSize},{default:a(()=>[r("div",{class:s(["settings-name",{"no-name":!e.name&&!n.$slots.name}])},[r("div",{class:s(["name",[{align:e.align},{"align-small":e.alignSmall}]])},[o(n.$slots,"name",{},()=>[y(h(e.name)+" ",1),e.required?(t(),d("span",S," * ")):u("",!0)])],2),n.$slots.description?(t(),d("div",z,[o(n.$slots,"description")])):u("",!0)],2)]),_:3},8,["md"]),c(i,{md:e.rightSize},{default:a(()=>[r("div",C,[o(n.$slots,"content")])]),_:3},8,["md"])]),_:3},8,["class"])}const N=_(B,[["render",v]]);export{N as C};
