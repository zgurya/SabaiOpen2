jQuery.fn.sortElements=function(){var a=[].sort;return function(b,c){c=c||function(){return this};var d=this.map(function(){var a=c.call(this),b=a.parentNode,d=b.insertBefore(document.createTextNode(""),a.nextSibling);return function(){if(b===this)throw new Error("You can't sort elements if any one is a descendant of another.");b.insertBefore(this,d),b.removeChild(d)}});return a.call(this,b).each(function(a){d[a].call(c.call(this))})}}();