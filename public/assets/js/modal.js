/*
 MIT-style license
 @author		Harald Kirschner <mail [at] digitarald.de>
 @author		Rouven Weßling <me [at] rouvenwessling.de>
 @copyright	Author
 */
var SqueezeBox={presets:{onOpen:function(){},onClose:function(){},onUpdate:function(){},onResize:function(){},onMove:function(){},onShow:function(){},onHide:function(){},size:{x:600,y:450},sizeLoading:{x:200,y:150},marginInner:{x:20,y:20},marginImage:{x:50,y:75},handler:false,target:null,closable:true,closeBtn:true,zIndex:65555,overlayOpacity:.7,classWindow:"",classOverlay:"",overlayFx:{},resizeFx:{},contentFx:{},parse:false,parseSecure:false,shadow:true,overlay:true,document:null,ajaxOptions:{}},initialize:function(e){if(this.options)return this;this.presets=Object.merge(this.presets,e);this.doc=this.presets.document||document;this.options={};this.setOptions(this.presets).build();this.bound={window:this.reposition.bind(this,[null]),scroll:this.checkTarget.bind(this),close:this.close.bind(this),key:this.onKey.bind(this)};this.isOpen=this.isLoading=false;return this},build:function(){this.overlay=new Element("div",{id:"sbox-overlay","aria-hidden":"true",styles:{zIndex:this.options.zIndex},tabindex:-1});this.win=new Element("div",{id:"sbox-window",role:"dialog","aria-hidden":"true",styles:{zIndex:this.options.zIndex+2}});if(this.options.shadow){if(Browser.chrome||Browser.safari&&Browser.version>=3||Browser.opera&&Browser.version>=10.5||Browser.firefox&&Browser.version>=3.5||Browser.ie&&Browser.version>=9){this.win.addClass("shadow")}else if(!Browser.ie6){var e=(new Element("div",{"class":"sbox-bg-wrap"})).inject(this.win);var t=function(e){this.overlay.fireEvent("click",[e])}.bind(this);["n","ne","e","se","s","sw","w","nw"].each(function(n){(new Element("div",{"class":"sbox-bg sbox-bg-"+n})).inject(e).addEvent("click",t)})}}this.content=(new Element("div",{id:"sbox-content"})).inject(this.win);this.closeBtn=(new Element("a",{id:"sbox-btn-close",href:"#",role:"button"})).inject(this.win);this.closeBtn.setProperty("aria-controls","sbox-window");this.fx={overlay:(new Fx.Tween(this.overlay,Object.merge({property:"opacity",onStart:Events.prototype.clearChain,duration:250,link:"cancel"},this.options.overlayFx))).set(0),win:new Fx.Morph(this.win,Object.merge({onStart:Events.prototype.clearChain,unit:"px",duration:750,transition:Fx.Transitions.Quint.easeOut,link:"cancel",unit:"px"},this.options.resizeFx)),content:(new Fx.Tween(this.content,Object.merge({property:"opacity",duration:250,link:"cancel"},this.options.contentFx))).set(0)};document.id(this.doc.body).adopt(this.overlay,this.win)},assign:function(e,t){return(document.id(e)||$$(e)).addEvent("click",function(){return!SqueezeBox.fromElement(this,t)})},open:function(e,t){this.initialize();if(this.element!=null)this.trash();this.element=document.id(e)||false;this.setOptions(Object.merge(this.presets,t||{}));if(this.element&&this.options.parse){var n=this.element.getProperty(this.options.parse);if(n&&(n=JSON.decode(n,this.options.parseSecure)))this.setOptions(n)}this.url=(this.element?this.element.get("href"):e)||this.options.url||"";this.assignOptions();var r=r||this.options.handler;if(r)return this.setContent(r,this.parsers[r].call(this,true));var i=false;return this.parsers.some(function(e,t){var n=e.call(this);if(n){i=this.setContent(t,n);return true}return false},this)},fromElement:function(e,t){return this.open(e,t)},assignOptions:function(){this.overlay.addClass(this.options.classOverlay);this.win.addClass(this.options.classWindow)},close:function(e){var t=typeOf(e)=="domevent";if(t)e.stop();if(!this.isOpen||t&&!Function.from(this.options.closable).call(this,e))return this;this.fx.overlay.start(0).chain(this.toggleOverlay.bind(this));this.win.setProperty("aria-hidden","true");this.fireEvent("onClose",[this.content]);this.trash();this.toggleListeners();this.isOpen=false;return this},trash:function(){this.element=this.asset=null;this.content.empty();this.options={};this.removeEvents().setOptions(this.presets).callChain()},onError:function(){this.asset=null;this.setContent("string",this.options.errorMsg||"An error occurred")},setContent:function(e,t){if(!this.handlers[e])return false;this.content.className="sbox-content-"+e;this.applyTimer=this.applyContent.delay(this.fx.overlay.options.duration,this,this.handlers[e].call(this,t));if(this.overlay.retrieve("opacity"))return this;this.toggleOverlay(true);this.fx.overlay.start(this.options.overlayOpacity);return this.reposition()},applyContent:function(e,t){if(!this.isOpen&&!this.applyTimer)return;this.applyTimer=clearTimeout(this.applyTimer);this.hideContent();if(!e){this.toggleLoading(true)}else{if(this.isLoading)this.toggleLoading(false);this.fireEvent("onUpdate",[this.content],20)}if(e){if(["string","array"].contains(typeOf(e))){this.content.set("html",e)}else {this.content.adopt(e)}}this.callChain();if(!this.isOpen){this.toggleListeners(true);this.resize(t,true);this.isOpen=true;this.win.setProperty("aria-hidden","false");this.fireEvent("onOpen",[this.content])}else{this.resize(t)}},resize:function(e,t){this.showTimer=clearTimeout(this.showTimer||null);var n=this.doc.getSize(),r=this.doc.getScroll();this.size=Object.merge(this.isLoading?this.options.sizeLoading:this.options.size,e);var i=self.getSize();if(this.size.x==i.x){this.size.y=this.size.y-50;this.size.x=this.size.x-20}if(n.x>979){var s={width:this.size.x,height:this.size.y,left:(r.x+(n.x-this.size.x-this.options.marginInner.x)/2).toInt(),top:(r.y+(n.y-this.size.y-this.options.marginInner.y)/2).toInt()}}else{var s={width:n.x-40,height:n.y,left:(r.x+10).toInt(),top:(r.y+20).toInt()}}this.hideContent();if(!t){this.fx.win.start(s).chain(this.showContent.bind(this))}else{this.win.setStyles(s);this.showTimer=this.showContent.delay(50,this)}return this.reposition()},toggleListeners:function(e){var t=e?"addEvent":"removeEvent";this.closeBtn[t]("click",this.bound.close);this.overlay[t]("click",this.bound.close);this.doc[t]("keydown",this.bound.key)[t]("mousewheel",this.bound.scroll);this.doc.getWindow()[t]("resize",this.bound.window)[t]("scroll",this.bound.window)},toggleLoading:function(e){this.isLoading=e;this.win[e?"addClass":"removeClass"]("sbox-loading");if(e){this.win.setProperty("aria-busy",e);this.fireEvent("onLoading",[this.win])}},toggleOverlay:function(e){if(this.options.overlay){var t=this.doc.getSize().x;this.overlay.set("aria-hidden",e?"false":"true");this.doc.body[e?"addClass":"removeClass"]("body-overlayed");if(e){this.scrollOffset=this.doc.getWindow().getSize().x-t}else{this.doc.body.setStyle("margin-right","")}}},showContent:function(){if(this.content.get("opacity"))this.fireEvent("onShow",[this.win]);this.fx.content.start(1)},hideContent:function(){if(!this.content.get("opacity"))this.fireEvent("onHide",[this.win]);this.fx.content.cancel().set(0)},onKey:function(e){switch(e.key){case"esc":this.close(e);case"up":case"down":return false}},checkTarget:function(e){return e.target!==this.content&&this.content.contains(e.target)},reposition:function(){var e=this.doc.getSize(),t=this.doc.getScroll(),n=this.doc.getScrollSize();var r=this.overlay.getStyles("height");var i=parseInt(r.height);if(n.y>i&&e.y>=i){this.overlay.setStyles({width:n.x+"px",height:n.y+"px"});this.win.setStyles({left:(t.x+(e.x-this.win.offsetWidth)/2-this.scrollOffset).toInt()+"px",top:(t.y+(e.y-this.win.offsetHeight)/2).toInt()+"px"})}return this.fireEvent("onMove",[this.overlay,this.win])},removeEvents:function(e){if(!this.$events)return this;if(!e)this.$events=null;else if(this.$events[e])this.$events[e]=null;return this},extend:function(e){return Object.append(this,e)},handlers:new Hash,parsers:new Hash};SqueezeBox.extend(new Events(function(){})).extend(new Options(function(){})).extend(new Chain(function(){}));SqueezeBox.parsers.extend({image:function(e){return e||/\.(?:jpg|png|gif)$/i.test(this.url)?this.url:false},clone:function(e){if(document.id(this.options.target))return document.id(this.options.target);if(this.element&&!this.element.parentNode)return this.element;var t=this.url.match(/#([\w-]+)$/);return t?document.id(t[1]):e?this.element:false},ajax:function(e){return e||this.url&&!/^(?:javascript|#)/i.test(this.url)?this.url:false},iframe:function(e){return e||this.url?this.url:false},string:function(e){return true}});SqueezeBox.handlers.extend({image:function(e){var t,n=new Image;this.asset=null;n.onload=n.onabort=n.onerror=function(){n.onload=n.onabort=n.onerror=null;if(!n.width){this.onError.delay(10,this);return}var e=this.doc.getSize();e.x-=this.options.marginImage.x;e.y-=this.options.marginImage.y;t={x:n.width,y:n.height};for(var r=2;r--;){if(t.x>e.x){t.y*=e.x/t.x;t.x=e.x}else if(t.y>e.y){t.x*=e.y/t.y;t.y=e.y}}t.x=t.x.toInt();t.y=t.y.toInt();this.asset=document.id(n);n=null;this.asset.width=t.x;this.asset.height=t.y;this.applyContent(this.asset,t)}.bind(this);n.src=e;if(n&&n.onload&&n.complete)n.onload();return this.asset?[this.asset,t]:null},clone:function(e){if(e)return e.clone();return this.onError()},adopt:function(e){if(e)return e;return this.onError()},ajax:function(e){var t=this.options.ajaxOptions||{};this.asset=(new Request.HTML(Object.merge({method:"get",evalScripts:false},this.options.ajaxOptions))).addEvents({onSuccess:function(e){this.applyContent(e);if(t.evalScripts!==null&&!t.evalScripts)Browser.exec(this.asset.response.javascript);this.fireEvent("onAjax",[e,this.asset]);this.asset=null}.bind(this),onFailure:this.onError.bind(this)});this.asset.send.delay(10,this.asset,[{url:e}])},iframe:function(e){var t=this.doc.getSize();if(t.x>979){var n=this.options.size.x;var r=this.options.size.y}else{var n=t.x;var r=t.y-50}this.asset=new Element("iframe",Object.merge({src:e,frameBorder:0,width:n,height:r},this.options.iframeOptions));if(this.options.iframePreload){this.asset.addEvent("load",function(){this.applyContent(this.asset.setStyle("display",""))}.bind(this));this.asset.setStyle("display","none").inject(this.content);return false}return this.asset},string:function(e){return e}});SqueezeBox.handlers.url=SqueezeBox.handlers.ajax;SqueezeBox.parsers.url=SqueezeBox.parsers.ajax;SqueezeBox.parsers.adopt=SqueezeBox.parsers.clone;