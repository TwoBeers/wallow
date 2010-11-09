//Wallow v0.40 - Animations
window.addEvent("domready",function(){$moo("mainmenu").getChildren("li.menu-item").each(function(c){var e=50;var b=e+"px";var d=c.getElement("ul.sub-menu")
;if(d){var a=new Fx.Morph(d,{duration:200,wait:false});d.setStyle("opacity","0");d.setStyle("margin-top",b);c.addEvents({mouseenter:function(){if(d.getStyle("margin-top").toInt()>19){d.setStyle("margin-top",b);
a.cancel();a.start({"margin-top":0,opacity:1})}},mouseleave:function(){a.cancel();a.start({"margin-top":20,opacity:0})}});d.setStyle("display","block")}});
$moo("quickbar").getElements("div.footer_wig").each(function(c){var e=50;var b=e+"px";var d=c.getElement("ul.fw_pul");if(d){var a=new Fx.Morph(d,{duration:200,wait:false});
d.setStyle("opacity","0");d.setStyle("margin-bottom",b);c.addEvents({mouseenter:function(){if(d.getStyle("margin-bottom").toInt()>19){d.setStyle("margin-bottom",b);
a.cancel();a.start({"margin-bottom":0,opacity:1})}},mouseleave:function(){a.cancel();a.start({"margin-bottom":20,opacity:0})}});d.setStyle("display","block")}});
$moo(document.body).getElements("li.comment").each(function(a){var b=new Fx.Morph(a,{duration:200,wait:false});a.addEvent("mouseenter",function(){b.start({"margin-left":5,"margin-right":-5})});
a.addEvent("mouseleave",function(){b.start({"margin-left":0,"margin-right":0})})})});