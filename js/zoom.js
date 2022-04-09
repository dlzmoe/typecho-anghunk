function zoom(mask, bigimg, smallimg) {
	this.bigimg = bigimg;
	this.smallimg = smallimg;
	this.mask = mask
}
zoom.prototype = {
	init: function() {
		var that = this;
		this.smallimgClick();
		this.maskClick();
		this.mouseWheel()
	},
	smallimgClick: function() {
		var that = this;
		$("." + that.smallimg).click(function() {
			$("." + that.bigimg).css({
				height: $("." + that.smallimg).height() * 1.5,
				width: $("." + that.smallimg).width() * 1.5
			});
			$("." + that.mask).fadeIn();
			$("." + that.bigimg).attr("src", $(this).attr("src")).fadeIn()
		})
	},
	maskClick: function() {
		var that = this;
		$("." + that.mask).click(function() {
			$("." + that.bigimg).fadeOut();
			$("." + that.mask).fadeOut()
		})
	},
	mouseWheel: function() {
		function mousewheel(obj, upfun, downfun) {
			if (document.attachEvent) {
				obj.attachEvent("onmousewheel", scrollFn)
			} else {
				if (document.addEventListener) {
					obj.addEventListener("mousewheel", scrollFn, false);
					obj.addEventListener("DOMMouseScroll", scrollFn, false)
				}
			}
			function scrollFn(e) {
				var ev = e || window.event;
				var dir = ev.wheelDelta || ev.detail;
				if (ev.preventDefault) {
					ev.preventDefault()
				} else {
					ev.returnValue = false
				}
				if (dir == -3 || dir == 120) {
					upfun()
				} else {
					downfun()
				}
			}
		}
		var that = this;
		mousewheel($("." + that.bigimg)[0], function() {
			if ($("." + that.bigimg).innerWidth() > $("body").width() - 20) {
				return
			}
			if ($("." + that.bigimg).innerHeight() > $("body").height() - 50) {
				return
			}
			var zoomHeight = $("." + that.bigimg).innerHeight() * 1.03;
			var zoomWidth = $("." + that.bigimg).innerWidth() * 1.03;
			$("." + that.bigimg).css({
				height: zoomHeight + "px",
				width: zoomWidth + "px"
			})
		}, function() {
			if ($("." + that.bigimg).innerWidth() < 100) {
				return
			}
			if ($("." + that.bigimg).innerHeight() < 100) {
				return
			}
			var zoomHeight = $("." + that.bigimg).innerHeight() / 1.03;
			var zoomWidth = $("." + that.bigimg).innerWidth() / 1.03;
			$("." + that.bigimg).css({
				height: zoomHeight + "px",
				width: zoomWidth + "px"
			})
		})
	}
};
