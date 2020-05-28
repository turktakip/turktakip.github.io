// source --> http://www.turktakip.net/wp-content/plugins/CuteSlider/js/cute.slider.js?ver=1.1.1 
function UAParser(e)
{
	var t = e || window.navigator.userAgent;
	var n = function (e)
	{
		var t;
		var n, r, i, s;
		for (n = 1; n < arguments.length; n += 2) {
			var o = arguments[n];
			var u = arguments[n + 1];
			var a = false;
			for (r = 0; r < o.length; r++) {
				var f = o[r].exec(e);
				if (!!f) {
					t = {};
					s = 1;
					for (i = 0; i < u.length; i++) {
						if (typeof u[i] === "object" && u[i].length === 2) {
							t[u[i][0]] = u[i][1];
							s -= 1
						}
						else if (typeof u[i] === "object" && u[i].length === 3) {
							t[u[i][0]] = !!f[i + s] ? f[i + s].replace(u[i][1], u[i][2]) : undefined
						}
						else {
							t[u[i]] = !!f[i + s] ? f[i + s] : undefined
						}
					}
					a = true;
					break
				}
			}
			if (!a) {
				t = {};
				for (i in u) {
					if (u.hasOwnProperty(i)) {
						if (typeof u[i] == "object") {
							t[u[i][0]] = undefined
						}
						else {
							t[u[i]] = undefined
						}
					}
				}
			}
			else {
				return t
			}
		}
		return t
	};
	var r = {
		os: {
			win: function (e, t)
			{
				switch (t.toLowerCase()) {
					case"nt 5.0":
						return "2000";
					case"nt 5.1":
					case"nt 5.2":
						return "XP";
					case"nt 6.0":
						return "Vista";
					case"nt 6.1":
						return "7";
					case"nt 6.2":
						return "8";
					default:
						return t
				}
			}
		}
	};
	this.getBrowser = function (e)
	{
		return n(e || t, [/(kindle)\/((\d+)?[\w\.]+)/i, /(lunascape|maxthon|netfront|jasmine)[\/\s]?((\d+)?[\w\.]+)/i, /(opera\smini)\/((\d+)?[\w\.-]+)/i, /(opera\smobi)\/((\d+)?[\w\.-]+)/i, /(opera).*\/((\d+)?[\w\.]+)/i, /(avant\sbrowser|iemobile|slimbrowser)[\/\s]?((\d+)?[\w\.]*)/i, /ms(ie)\s((\d+)?[\w\.]+)/i, /(chromium|flock|rockmelt|midori|epiphany)\/((\d+)?[\w\.]+)/i, /(chrome|omniweb|arora|dolfin)\/((\d+)?[\w\.]+)/i], ["name", "version", "major"], [/android.+crmo\/((\d+)?[\w\.]+)/i], [["name", "Chrome"], "version", "major"], [/(trident).+rv[:\s]((\d+)?[\w\.]+).+like\sgecko/i], [["name", "IE"], "version", "major"], [/(mobile\ssafari|safari|konqueror)\/((\d+)?[\w\.]+)/i, /(applewebkit|khtml)\/((\d+)?[\w\.]+)/i, /(iceweasel|camino|fennec|maemo|minimo)[\/\s]?((\d+)?[\w\.\+]+)/i, /(firefox|seamonkey|netscape|navigator|k-meleon|icecat|iceape)\/((\d+)?[\w\.]+)/i, /(mozilla)\/([\w\.]+).+rv\:.+gecko\/\d+/i, /(lynx|dillo|icab)[\/\s]?((\d+)?[\w\.]+)/i], ["name", "version", "major"])
	};
	this.getEngine = function (e)
	{
		return n(e || t, [/(presto)\/([\w\.]+)/i, /([aple]*webkit|trident)\/([\w\.]+)/i, /(khtml)\/([\w\.]+)/i], ["name", "version"], [/rv\:([\w\.]+).*(gecko)/i], ["version", "name"])
	};
	this.getOS = function (e)
	{
		return n(e || t, [/(windows\sphone\sos|windows)\s+([\w\.\s]+)*/i], ["name", ["version", /(nt\s[\d\.]+)/gi, r.os.win]], [/(blackberry).+version\/([\w\.]+)/i, /(android|symbianos|symbos|webos|palm\os|qnx|bada|rim\stablet\sos)[\/\s-]?([\w\.]+)*/i, /(nintendo|playstation)\s([wids3portable]+)/i, /(mint)[\/\s\(]?(\w+)*/i, /(joli|[kxln]?ubuntu|debian|[open]*suse|gentoo|arch|slackware|fedora|mandriva|centos|pclinuxos|redhat|zenwalk)[\/\s-]?([\w\.-]+)*/i, /(gnu|linux)\s?([\w\.]+)*/i], ["name", "version"], [/cros\s([\w\.\s]+)/i], [["name", "Chromium OS"], "version"], [/sunos\s?([\w\.\s]+)*/i], [["name", "Solaris"], "version"], [/\s(\w*bsd|dragonfly)\s?([\w\.]+)*/i], ["name", "version"], [/(ip[honead]+).*os\s*([\w]+)*\slike\smac/i], [["name", /.+/g, "iOS"], ["version", /_/g, "."]], [/(mac\sos)\sx\s([\w\s\.]+)/i], ["name", ["version", /_/g, "."]], [/(macintosh|unix|minix|beos)[\/\s]?()*/i], ["name", "version"])
	};
	this.getDevice = function (e)
	{
		return n(e || t, [/\((ip[honead]+|playbook);/i, /(blackberry)[\s-]?(\w+)/i, /(blackberry|benq|nokia|palm(?=\-)|sonyericsson)[\s-]?([\w-]+)*/i, /(hp)\s([\w\s]+)/i, /(hp).+(touchpad)/i, /(kindle)\/([\w\.]+)/i, /(lg)[e;\s-]+(\w+)*/i, /(nintendo|playstation)\s([wids3portable]+)/i], ["name", "version"], [/(htc)[;_\s-]+([\w\s]+(?=\))|[\w]+)*/i, /(zte)-([\w]+)*/i], ["name", ["version", /_/g, " "]], [/\s(milestone|mz601|droid[2x]?|xoom)[globa\s]*\sbuild\//i, /mot[\s-]?(\w+)*/i], [["name", "Motorola"], "version"], [/(s[cgp]h-\w+|gt-\w+|galaxy\snexus)/i, /sam[sung]*[\s-]*(\w+-?[\w-]*)*/i, /sec-(sgh\w+)/i], [["name", "Samsung"], "version"], [/sie-(\w+)*/i], [["name", "Siemens"], "version"])
	};
	this.setUA = function (e)
	{
		t = e || t;
		return this.result = {
			browser: this.getBrowser(),
			engine : this.getEngine(),
			os     : this.getOS(),
			device : this.getDevice()
		}
	};
	this.setUA(t)
}
var TWEEN = TWEEN || function ()
	{
		var e, t, n, r, i = 60, s = false, o = [], u;
		return {
			setFPS         : function (e)
			{
				i = e || 60
			}, start       : function (e)
			{
				if (arguments.length != 0) {
					this.setFPS(e)
				}
				n = setInterval(this.update, 1e3 / i)
			}, stop        : function ()
			{
				clearInterval(n)
			}, setAutostart: function (e)
			{
				s = e;
				if (s && !n) {
					this.start()
				}
			}, add         : function (e)
			{
				o.push(e);
				if (s && !n) {
					this.start()
				}
			}, getAll      : function ()
			{
				return o
			}, removeAll   : function ()
			{
				o = []
			}, remove      : function (t)
			{
				e = o.indexOf(t);
				if (e !== -1) {
					o.splice(e, 1)
				}
			}, update      : function (e)
			{
				var t = 0;
				var n = e || Date.now();
				while (t < o.length) {
					if (o[t].update(n)) {
						t++
					}
					else {
						o.splice(t, 1)
					}
				}
				if (u == 0 && s == true) {
					this.stop()
				}
			}
		}
	}();
TWEEN.Tween = function (e)
{
	var t = e, n = {}, r = {}, i = {}, s = 1e3, o = 0, u = null, a = TWEEN.Easing.Linear.EaseNone, f = null, l = null, c = null;
	this.to = function (e, n)
	{
		if (n !== null) {
			s = n
		}
		for (var r in e) {
			if (t[r] === null) {
				continue
			}
			i[r] = e[r]
		}
		return this
	};
	this.start = function (e)
	{
		TWEEN.add(this);
		u = e ? e + o : Date.now() + o;
		for (var s in i) {
			if (t[s] === null) {
				continue
			}
			n[s] = t[s];
			r[s] = i[s] - t[s]
		}
		return this
	};
	this.stop = function ()
	{
		TWEEN.remove(this);
		return this
	};
	this.delay = function (e)
	{
		o = e;
		return this
	};
	this.easing = function (e)
	{
		a = e;
		return this
	};
	this.chain = function (e)
	{
		f = e
	};
	this.onUpdate = function (e)
	{
		l = e;
		return this
	};
	this.onComplete = function (e)
	{
		c = e;
		return this
	};
	this.update = function (e)
	{
		var i, o, h;
		if (e < u) {
			return true
		}
		o = (e - u) / s;
		o = o > 1 ? 1 : o;
		h = a(o);
		for (i in r) {
			t[i] = n[i] + r[i] * h
		}
		if (l !== null) {
			l.call(t, h)
		}
		if (o == 1) {
			if (c !== null) {
				c.call(t)
			}
			if (f !== null) {
				f.start()
			}
			return false
		}
		return true
	}
};
TWEEN.Easing = {
	Linear     : {},
	Quadratic  : {},
	Cubic      : {},
	Quartic    : {},
	Quintic    : {},
	Sinusoidal : {},
	Exponential: {},
	Circular   : {},
	Elastic    : {},
	Back       : {},
	Bounce     : {}
};
TWEEN.Easing.Linear.EaseNone = function (e)
{
	return e
};
TWEEN.Easing.Quadratic.EaseIn = function (e)
{
	return e * e
};
TWEEN.Easing.Quadratic.EaseOut = function (e)
{
	return -e * (e - 2)
};
TWEEN.Easing.Quadratic.EaseInOut = function (e)
{
	if ((e *= 2) < 1) {
		return .5 * e * e;
	}
	return -.5 * (--e * (e - 2) - 1)
};
TWEEN.Easing.Cubic.EaseIn = function (e)
{
	return e * e * e
};
TWEEN.Easing.Cubic.EaseOut = function (e)
{
	return --e * e * e + 1
};
TWEEN.Easing.Cubic.EaseInOut = function (e)
{
	if ((e *= 2) < 1) {
		return .5 * e * e * e;
	}
	return .5 * ((e -= 2) * e * e + 2)
};
TWEEN.Easing.Quartic.EaseIn = function (e)
{
	return e * e * e * e
};
TWEEN.Easing.Quartic.EaseOut = function (e)
{
	return -(--e * e * e * e - 1)
};
TWEEN.Easing.Quartic.EaseInOut = function (e)
{
	if ((e *= 2) < 1) {
		return .5 * e * e * e * e;
	}
	return -.5 * ((e -= 2) * e * e * e - 2)
};
TWEEN.Easing.Quintic.EaseIn = function (e)
{
	return e * e * e * e * e
};
TWEEN.Easing.Quintic.EaseOut = function (e)
{
	return (e = e - 1) * e * e * e * e + 1
};
TWEEN.Easing.Quintic.EaseInOut = function (e)
{
	if ((e *= 2) < 1) {
		return .5 * e * e * e * e * e;
	}
	return .5 * ((e -= 2) * e * e * e * e + 2)
};
TWEEN.Easing.Sinusoidal.EaseIn = function (e)
{
	return -Math.cos(e * Math.PI / 2) + 1
};
TWEEN.Easing.Sinusoidal.EaseOut = function (e)
{
	return Math.sin(e * Math.PI / 2)
};
TWEEN.Easing.Sinusoidal.EaseInOut = function (e)
{
	return -.5 * (Math.cos(Math.PI * e) - 1)
};
TWEEN.Easing.Exponential.EaseIn = function (e)
{
	return e == 0 ? 0 : Math.pow(2, 10 * (e - 1))
};
TWEEN.Easing.Exponential.EaseOut = function (e)
{
	return e == 1 ? 1 : -Math.pow(2, -10 * e) + 1
};
TWEEN.Easing.Exponential.EaseInOut = function (e)
{
	if (e == 0) {
		return 0;
	}
	if (e == 1) {
		return 1;
	}
	if ((e *= 2) < 1) {
		return .5 * Math.pow(2, 10 * (e - 1));
	}
	return .5 * (-Math.pow(2, -10 * (e - 1)) + 2)
};
TWEEN.Easing.Circular.EaseIn = function (e)
{
	return -(Math.sqrt(1 - e * e) - 1)
};
TWEEN.Easing.Circular.EaseOut = function (e)
{
	return Math.sqrt(1 - --e * e)
};
TWEEN.Easing.Circular.EaseInOut = function (e)
{
	if ((e /= .5) < 1) {
		return -.5 * (Math.sqrt(1 - e * e) - 1);
	}
	return .5 * (Math.sqrt(1 - (e -= 2) * e) + 1)
};
TWEEN.Easing.Elastic.EaseIn = function (e)
{
	var t, n = .1, r = .4;
	if (e == 0) {
		return 0;
	}
	if (e == 1) {
		return 1;
	}
	if (!r) {
		r = .3;
	}
	if (!n || n < 1) {
		n = 1;
		t = r / 4
	}
	else {
		t = r / (2 * Math.PI) * Math.asin(1 / n);
	}
	return -(n * Math.pow(2, 10 * (e -= 1)) * Math.sin((e - t) * 2 * Math.PI / r))
};
TWEEN.Easing.Elastic.EaseOut = function (e)
{
	var t, n = .1, r = .4;
	if (e == 0) {
		return 0;
	}
	if (e == 1) {
		return 1;
	}
	if (!r) {
		r = .3;
	}
	if (!n || n < 1) {
		n = 1;
		t = r / 4
	}
	else {
		t = r / (2 * Math.PI) * Math.asin(1 / n);
	}
	return n * Math.pow(2, -10 * e) * Math.sin((e - t) * 2 * Math.PI / r) + 1
};
TWEEN.Easing.Elastic.EaseInOut = function (e)
{
	var t, n = .1, r = .4;
	if (e == 0) {
		return 0;
	}
	if (e == 1) {
		return 1;
	}
	if (!r) {
		r = .3;
	}
	if (!n || n < 1) {
		n = 1;
		t = r / 4
	}
	else {
		t = r / (2 * Math.PI) * Math.asin(1 / n);
	}
	if ((e *= 2) < 1) {
		return -.5 * n * Math.pow(2, 10 * (e -= 1)) * Math.sin((e - t) * 2 * Math.PI / r);
	}
	return n * Math.pow(2, -10 * (e -= 1)) * Math.sin((e - t) * 2 * Math.PI / r) * .5 + 1
};
TWEEN.Easing.Back.EaseIn = function (e)
{
	var t = 1.70158;
	return e * e * ((t + 1) * e - t)
};
TWEEN.Easing.Back.EaseOut = function (e)
{
	var t = 1.70158;
	return (e = e - 1) * e * ((t + 1) * e + t) + 1
};
TWEEN.Easing.Back.EaseInOut = function (e)
{
	var t = 1.70158 * 1.525;
	if ((e *= 2) < 1) {
		return .5 * e * e * ((t + 1) * e - t);
	}
	return .5 * ((e -= 2) * e * ((t + 1) * e + t) + 2)
};
TWEEN.Easing.Bounce.EaseIn = function (e)
{
	return 1 - TWEEN.Easing.Bounce.EaseOut(1 - e)
};
TWEEN.Easing.Bounce.EaseOut = function (e)
{
	if ((e /= 1) < 1 / 2.75) {
		return 7.5625 * e * e
	}
	else if (e < 2 / 2.75) {
		return 7.5625 * (e -= 1.5 / 2.75) * e + .75
	}
	else if (e < 2.5 / 2.75) {
		return 7.5625 * (e -= 2.25 / 2.75) * e + .9375
	}
	else {
		return 7.5625 * (e -= 2.625 / 2.75) * e + .984375
	}
};
TWEEN.Easing.Bounce.EaseInOut = function (e)
{
	if (e < .5) {
		return TWEEN.Easing.Bounce.EaseIn(e * 2) * .5;
	}
	return TWEEN.Easing.Bounce.EaseOut(e * 2 - 1) * .5 + .5
};
window.Aroma = {version: 2, author: "Averta group"};
Aroma.Engine = function (e)
{
	this._tweenList = [];
	this._view = e;
	this._view.engine = this;
	this.startEff = function ()
	{
		this._effect.prepare();
		this._part_duration = this._duration / (this._selector.getCount() - (1 - this._overlapping) * (this._selector.getCount() - 1));
		this._part_delay = this._part_duration * this._overlapping;
		var e = [], t, n, r = 0, i = 0, s = [], o, u = null;
		for (var a = 0, f = this._selector.getCount(); a < f; ++a) {
			e = this._selector.getPieceList();
			for (var l = 0, c = e.length; l < c; ++l) {
				s = this._effect.getToData();
				o = this._effect.getFromData();
				for (var h = 0, p = s.length; h < p; ++h) {
					n = CloneObject.clone(s[h].options);
					if (h == 0) {
						if (n.delay == null) {
							n.delay = this._part_delay + r + this._startDelay;
						}
						else {
							n.delay += this._part_delay + r + this._startDelay
						}
					}
					this.applyFromProperties(e[l], o);
					t = (new TWEEN.Tween(e[l].proxy)).delay(n.delay * 1e3 || 0).to(s[h].to, this._part_duration * s[h].time * 1e3).easing(n.ease || TWEEN.Easing.Linear.EaseNone).onUpdate(e[l].proxyUpdate);
					if (h == 0) {
						t.start();
					}
					if (u != null) {
						u.chain(t);
					}
					u = t;
					if (l + 1 == c && a + 1 == f && h + 1 == p) {
						t.onComplete(this.effComp);
					}
					this._tweenList.push(t)
				}
				u = null
			}
			r += this._part_delay
		}
		if (this._view.sort) {
			this._view.sortParts();
		}
		this._view.prepare()
	};
	this.applyFromProperties = function (e, t)
	{
		for (var n in t) {
			e.proxy[n] = t[n];
		}
		e.proxyUpdate.call(e.proxy)
	};
	this.effComp = function ()
	{
		if (this.piece.view.engine.onComplete) {
			this.piece.view.engine.onComplete.listener.call(this.piece.view.engine.onComplete.ref)
		}
	}
};
Aroma.Engine.prototype.start = function (e, t, n, r, i)
{
	this._selector = t;
	this._effect = e;
	this._duration = n;
	this._overlapping = r || .5;
	this._startDelay = i || 0;
	this._selector.setup(this._effect, this._view);
	this.startEff()
};
Aroma.Engine.prototype.reset = function ()
{
	this._selector = null;
	this._effect = null;
	this._duration = 0;
	this._overlapping = 0;
	this._startDelay = 0;
	this._tweenList = []
};
Aroma.Engine.prototype.removeTweens = function ()
{
	for (var e = 0, t = this._tweenList.length; e < t; e++) {
		TWEEN.remove(this._tweenList[e]);
		this._tweenList[e] = null
	}
};
Aroma.Engine.prototype.getView = function ()
{
	return this._view
};
Aroma.AbstractView = function (e, t)
{
	this.sort = false;
	this.col = t;
	this.row = e;
	this.part_width = 0;
	this.part_height = 0;
	this._pieceList = [];
	this.width = 0;
	this.height = 0;
	this.vpWidth = 0;
	this.vpHeight = 0;
	this.needRendering = false;
	this.extra_part_width = 0, this.extra_part_height = 0;
	this.posToID = function (e, t)
	{
		return t * this.col + e
	};
	this.getPieceBounds = function (e, t)
	{
		var n = {width: 0, height: 0, x: 0, y: 0};
		if (this.extra_part_width == 0) {
			n.x = e * this.part_width;
			n.width = this.part_width
		}
		else {
			n.width = e > this.extra_part_width ? this.part_width : this.part_width + 1;
			n.x = e > this.extra_part_width ? (this.part_width + 1) * this.extra_part_width + (e - this.extra_part_width) * this.part_width : (this.part_width + 1) * e
		}
		if (this.extra_part_height == 0) {
			n.y = t * this.part_height;
			n.height = this.part_height
		}
		else {
			n.height = t > this.extra_part_height ? this.part_height : this.part_height + 1;
			n.y = t > this.extra_part_height ? (this.part_height + 1) * this.extra_part_height + (t - this.extra_part_height) * this.part_height : (this.part_height + 1) * t
		}
		return n
	};
	this.swapchildren_col = function (e, t)
	{
		for (var n = 0, r = (t - e) / 2; n < r; ++n) {
			var i = this._pieceList[e + n];
			this._pieceList[e + n] = this._pieceList[t - n];
			this._pieceList[t - n] = i
		}
	};
	this.swapchildren_row = function (e)
	{
		for (var t = 0, n = e.length; t < n / 2; ++t) {
			var r = this._pieceList[e[t]];
			this._pieceList[e[t]] = this._pieceList[e[n - t - 1]];
			this._pieceList[e[n - t - 1]] = r
		}
	};
	this.sortInCols = function ()
	{
		if (this.col == 1) {
			return;
		}
		var e = Math.floor(this.col >> 1);
		for (var t = this._pieceList.length, n = e; n < t; n += this.col) {
			this.swapchildren_col(n, n + (this.col - e) - 1)
		}
	};
	this.sortInRows = function ()
	{
		if (this.row == 1) {
			return;
		}
		var e = Math.floor(this.row >> 1);
		var t = new Array;
		for (var n = 0; n < this.col; ++n) {
			for (var r = 0; r < this.row - e; ++r) {
				t.push(e * this.col + n + r * this.col)
			}
			this.swapchildren_row(t);
			t = new Array
		}
	}
};
Aroma.AbstractView.prototype.getCount = function ()
{
	return this.row * this.col
};
Aroma.AbstractView.prototype.prepare = function ()
{
};
Aroma.AbstractView.prototype.setSize = function (e, t)
{
	this.part_height = Math.floor(t / this.row);
	this.extra_part_height = t % this.row;
	this.part_width = Math.floor(e / this.col);
	this.extra_part_width = e % this.col;
	this.width = e;
	this.height = t
};
Aroma.AbstractView.prototype.setViewPortSize = function (e, t)
{
	this.vpWidth = e;
	this.vpHeight = t
};
Aroma.AbstractView.prototype.dispose = function ()
{
	for (var e = 0, t = this._pieceList.length; e < t; ++e) {
		if (this._pieceList[e]) {
			this._pieceList[e].dispose();
		}
		this._pieceList[e] = null
	}
	this._pieceList = []
};
Aroma.AbstractView.prototype.sortParts = function ()
{
	this.sortInCols();
	this.sortInRows()
};
window.CloneObject = window.ConcatObject || {};
CloneObject.clone = function (e)
{
	if (e == null) {
		return {};
	}
	var t = {};
	for (var n in e) {
		t[n] = e[n];
	}
	return t
};
ConcatObject = {};
ConcatObject.concat = function (e, t)
{
	for (var n in t) {
		e[n] = t[n];
	}
	return e
};
window.setOpacity = function (e, t)
{
	e.style.filter = "alpha(opacity=" + t + ")";
	e.style.opacity = t * .01;
	e.style.MozOpacity = t * .01;
	e.style.KhtmlOpacity = t * .01;
	e.style.MSOpacity = t * .01
};
Aroma.AbstractSelector = function ()
{
	this.selectNum = 1
};
Aroma.AbstractSelector.prototype.getCount = function ()
{
	return Math.floor(this.view.getCount() / this.selectNum)
};
Aroma.AbstractSelector.prototype.setup = function (e, t)
{
	this.effect = e;
	this.view = t;
	e.selector = this;
	e.view = t
};
Aroma.AbstractSelector.prototype.reset = function ()
{
};
Aroma.SerialSelector = function (e, t, n)
{
	this.row = 0;
	this.col = 0;
	this.row_len = 0;
	this.col_len = 0;
	this.selectNum = n || 1;
	this.zigzag = t;
	this.dir = e || "tlr";
	this.convertPoint = function (e, t)
	{
		switch (this.dir) {
			case"tlr":
				return {row: e, col: t};
				break;
			case"tld":
				return {row: t, col: e};
				break;
			case"trl":
				return {row: e, col: this.col_len - t - 1};
				break;
			case"trd":
				return {row: t, col: this.row_len - e - 1};
				break;
			case"brl":
				return {row: this.row_len - e - 1, col: this.col_len - t - 1};
				break;
			case"bru":
				return {row: this.col_len - t - 1, col: this.row_len - e - 1};
				break;
			case"blr":
				return {row: row_len - e - 1, col: t};
				break;
			case"blu":
				return {row: this.col_len - t - 1, col: e};
				break
		}
		return {row: e, col: t}
	}
};
Aroma.SerialSelector.prototype = new Aroma.AbstractSelector;
Aroma.SerialSelector.prototype.constructor = Aroma.SerialSelector;
Aroma.SerialSelector.prototype.getPieceList = function ()
{
	var e = [];
	var t = {};
	if (this.dir.charAt(2) == "u" || this.dir.charAt(2) == "d") {
		this.col_len = this.view.row;
		this.row_len = this.view.col
	}
	else {
		this.col_len = this.view.col;
		this.row_len = this.view.row
	}
	for (var n = 0; n < this.selectNum; n++) {
		t = this.convertPoint(this.row, this.zigzag && this.row % 2 != 0 ? this.col_len - this.col - 1 : this.col);
		e.push(this.view.getPieceAt(t.col, t.row, this.effect));
		this.col++;
		if (this.col == this.col_len) {
			this.col = 0;
			this.row++
		}
	}
	return e
};
Aroma.SerialSelector.prototype.reset = function ()
{
	this.row = 0;
	this.col = 0
};
Aroma.DiagonalSelector = function (e, t)
{
	this.selectNum = t || 1;
	this.startPoint = e || "tl";
	var n = 0, r = 0, i = 0, s = 0, o = 0, u = true;
	this.getList = function ()
	{
		var e = [];
		for (var t = 0; t < this.selectNum; t++) {
			switch (this.startPoint) {
				case"tl":
					if (u) {
						u = false
					}
					else if (r != 0 && n != this.view.row - 1) {
						r--;
						n++
					}
					else {
						r = ++i;
						if (r > this.view.col - 1) {
							n = ++o;
							r = this.view.col - 1
						}
						else {
							n = 0
						}
					}
					break;
				case"tr":
					if (u) {
						u = false;
						r = this.view.col - 1
					}
					else if (r != this.view.col - 1 && n != this.view.row - 1) {
						r++;
						n++
					}
					else {
						r = this.view.col - 1 - ++i;
						if (r < 0) {
							n = ++o;
							r = 0
						}
						else {
							n = 0
						}
					}
					break;
				case"bl":
					if (u) {
						u = false;
						n = this.view.row - 1
					}
					else if (r != 0 && n != 0) {
						r--;
						n--
					}
					else {
						r = ++i;
						if (r > this.view.col - 1) {
							n = this.view.row - 1 - ++o;
							r = this.view.col - 1
						}
						else {
							n = this.view.row - 1
						}
					}
					break;
				case"br":
					if (u) {
						u = false;
						n = this.view.row - 1;
						r = this.view.col - 1
					}
					else if (r != this.view.col - 1 && n != 0) {
						r++;
						n--
					}
					else {
						r = this.view.col - 1 - ++i;
						if (r < 0) {
							n = this.view.row - 1 - ++o;
							r = 0
						}
						else {
							n = this.view.row - 1
						}
					}
					break
			}
			e[t] = this.view.getPieceAt(r, n, this.effect)
		}
		return e
	};
	this._reset = function ()
	{
		n = 0, r = 0, i = 0, s = 0, o = 0, u = true
	}
};
Aroma.DiagonalSelector.prototype = new Aroma.AbstractSelector;
Aroma.DiagonalSelector.prototype.constructor = Aroma.DiagonalSelector;
Aroma.DiagonalSelector.TOP_LEFT = "tl";
Aroma.DiagonalSelector.BOTTOM_LEFT = "bl";
Aroma.DiagonalSelector.TOP_RIGHT = "tr";
Aroma.DiagonalSelector.BOTTOM_RIGHT = "br";
Aroma.DiagonalSelector.prototype.getPieceList = function ()
{
	return this.getList()
};
Aroma.DiagonalSelector.prototype.reset = function ()
{
	return this._reset()
};
Aroma.RandSelector = function (e)
{
	this.selectNum = e || 1;
	this.id_rand_list = [];
	this.shuffle = function (e)
	{
		var t = Math.floor(Math.random() * e.length);
		var n = e[t];
		e.splice(t, 1);
		return n
	}
};
Aroma.RandSelector.prototype = new Aroma.AbstractSelector;
Aroma.RandSelector.prototype.constructor = Aroma.RandSelector;
Aroma.RandSelector.prototype.setup = function (e, t)
{
	Aroma.AbstractSelector.prototype.setup.call(this, e, t);
	for (var n = 0, r = t.col * t.row; n < r; ++n) {
		this.id_rand_list[n] = n
	}
};
Aroma.RandSelector.prototype.getPieceList = function ()
{
	var e = [];
	var t = 0;
	for (var n = 0; n < this.selectNum; ++n) {
		t = this.shuffle(this.id_rand_list);
		e[n] = this.view.getPieceAt(Math.floor(t / this.view.row), t % this.view.row, this.effect)
	}
	return e
};
Aroma.Piece = function ()
{
	this.col = 0;
	this.row = 0;
	this.bounds = {};
	this.origin_x = 0;
	this.origin_y = 0;
	this.origin_z = 0;
	this.options = {}
};
Aroma.Effect = function ()
{
	this.pieceOptions = {};
	this.isStatic = false
};
Aroma.Effect.prototype.addFrame = function (e, t, n)
{
	this.data.push({time: e, to: t, options: n})
};
Aroma.Effect.prototype.getToData = function ()
{
	if (this.data != null && this.isStatic) {
		return this.data;
	}
	this.data = new Array;
	this.getTo();
	return this.data
};
Aroma.Effect.prototype.getFromData = function ()
{
	if (this.fromData != null && this.isStatic) {
		return this.fromData;
	}
	else if (this.isStatic) {
		this.fromData = this.getFrom();
		return this.fromData
	}
	else {
		return this.getFrom()
	}
};
Aroma.Effect.prototype.prepare = function ()
{
};
Aroma.Effect.prototype.getPieceOptions = function ()
{
	return this.pieceOptions
};
window.Cute = {version: 2.2, name: "Cute Slider", author: "Averta Group"};
Cute.Effect1 = function (e)
{
	Aroma.Effect.prototype.constructor.call(this);
	e = e || {};
	this.ease = e.ease || TWEEN.Easing.Linear;
	this.isStatic = true
};
Cute.Effect1.prototype = new Aroma.Effect;
Cute.Effect1.prototype.constructor = Cute.Effect1;
Cute.Effect1.prototype.getToVars = function ()
{
	this.addFrame(1, {opacity: 100}, {ease: this.ease.EaseOut})
};
Cute.Effect1.prototype.getFromVars = function ()
{
	return {opacity: 0, slide: 100}
};
Cute.Effect1.prototype.prepare = function ()
{
	this.getFrom = this.getFrom || this.getFromVars;
	this.getTo = this.getTo || this.getToVars
};
Cute.Effect2 = function (e)
{
	Aroma.Effect.prototype.constructor.call(this);
	e = e || {};
	this.pieceOptions.dir = e.dir || "r";
	this.pieceOptions.push = e.push;
	this.ease = e.ease || TWEEN.Easing.Linear;
	this.fade = e.fade;
	this.isStatic = true
};
Cute.Effect2.prototype = new Aroma.Effect;
Cute.Effect2.prototype.constructor = Cute.Effect2;
Cute.Effect2.prototype.getToVars = function ()
{
	this.addFrame(1, this.fade ? {opacity: 100, slide: 100} : {slide: 100}, {ease: this.ease.EaseInOut})
};
Cute.Effect2.prototype.getFromVars = function ()
{
	return this.fade ? {opacity: 0, slide: 0} : {slide: 0}
};
Cute.Effect2.prototype.prepare = function ()
{
	this.getFrom = this.getFrom || this.getFromVars;
	this.getTo = this.getTo || this.getToVars
};
Cute.Effect3 = function (e)
{
	Cute.Effect2.prototype.constructor.call(this, e);
	this.dir_name_arr = ["r", "l", "t", "b"]
};
Cute.Effect3.prototype = new Cute.Effect2;
Cute.Effect3.prototype.constructor = Cute.Effect3;
Cute.Effect3.prototype.getPieceOptions = function ()
{
	this.pieceOptions.dir = this.dir_name_arr[Math.round(parseInt(Math.random() * 3))];
	return this.pieceOptions
};
Cute.Effect4 = function (e)
{
	Cute.Effect3.prototype.constructor.call(this, e);
	this.counter = 0;
	this.rotation_dir = e.dir || "vertical"
};
Cute.Effect4.prototype = new Cute.Effect3;
Cute.Effect4.prototype.constructor = Cute.Effect4;
Cute.Effect4.prototype.getPieceOptions = function ()
{
	this.pieceOptions.dir = this.dir_name_arr[(this.counter++ % 2 ? 0 : 1) + (this.rotation_dir == "vertical" ? 2 : 0)];
	return this.pieceOptions
};
Cute.Effect5 = function (e)
{
	Aroma.Effect.prototype.constructor.call(this);
	e = e || {};
	this.side = e.side || "r";
	this.zmove = e.zmove || 0;
	this.rotation_axis = "y";
	this.rotation_dir = 1;
	this.xspace = e.xspace || 0;
	this.yspace = e.yspace || 0;
	this.stack = e.stack || false;
	this.balance = e.blance || .5;
	this.ease = e.ease || TWEEN.Easing.Linear;
	this.isStatic = false
};
Cute.Effect5.prototype = new Aroma.Effect;
Cute.Effect5.prototype.constructor = Cute.Effect5;
Cute.Effect5.prototype.createFrames = function (e, t)
{
	if (!this.stack) {
		e.z = this.zmove;
		t.z = 0;
		e.x = (this.piece.col - Math.floor(this.view.col * .5)) * this.xspace;
		e.y = (this.piece.row - Math.floor(this.view.row * .5)) * this.yspace;
		t.y = t.x = 0;
		this.addFrame(.5, e, {ease: this.ease.EaseIn});
		this.addFrame(.5, t, {ease: this.ease.EaseOut})
	}
	else {
		var n = {};
		n.x = (this.piece.col - Math.floor(this.view.col * .5)) * this.xspace;
		n.y = (this.piece.row - Math.floor(this.view.row * .5)) * this.yspace;
		n.z = this.zmove;
		this.addFrame(this.balance * .5, n, {ease: this.ease.EaseInOut});
		this.addFrame(1 - this.balance, t, {ease: this.ease.EaseInOut});
		this.addFrame(this.balance * .5, {z: 0, x: 0, y: 0}, {ease: this.ease.EaseInOut})
	}
};
Cute.Effect5.prototype.getToVars = function ()
{
	var e = {};
	var t = {};
	if (this.rotation_axis == "y") {
		e.rotationY = 45 * this.rotation_dir;
		t.rotationY = 90 * this.rotation_dir
	}
	else {
		e.rotationX = 45 * this.rotation_dir;
		t.rotationX = 90 * this.rotation_dir
	}
	this.createFrames(e, t)
};
Cute.Effect5.prototype.getFromVars = function ()
{
	return {}
};
Cute.Effect5.prototype.checkSidePos = function ()
{
	switch (this.side) {
		case"r":
			this.pieceOptions.newImageLocation = this.piece.side_dic.right;
			this.pieceOptions.depth = this.piece.bounds.width;
			this.rotation_axis = "y";
			this.rotation_dir = 1;
			break;
		case"l":
			this.pieceOptions.newImageLocation = this.piece.side_dic.left;
			this.pieceOptions.depth = this.piece.bounds.width;
			this.rotation_axis = "y";
			this.rotation_dir = -1;
			break;
		case"t":
			this.pieceOptions.newImageLocation = this.piece.side_dic.top;
			this.pieceOptions.depth = this.piece.bounds.height;
			this.rotation_axis = "x";
			this.rotation_dir = 1;
			break;
		case"b":
			this.pieceOptions.newImageLocation = this.piece.side_dic.bottom;
			this.pieceOptions.depth = this.piece.bounds.height;
			this.rotation_axis = "x";
			this.rotation_dir = -1;
			break
	}
};
Cute.Effect5.prototype.prepare = function ()
{
	this.getFrom = this.getFrom || this.getFromVars;
	this.getTo = this.getTo || this.getToVars
};
Cute.Effect5.prototype.getPieceOptions = function ()
{
	this.checkSidePos();
	return this.pieceOptions
};
Cute.Effect6 = function (e)
{
	Cute.Effect5.prototype.constructor.call(this, e);
	this.slide_name_arr = ["l", "r", "b", "t"]
};
Cute.Effect6.prototype = new Cute.Effect5;
Cute.Effect6.prototype.constructor = Cute.Effect6;
Cute.Effect6.prototype.getPieceOptions = function ()
{
	this.side = this.slide_name_arr[Math.round(parseInt(Math.random() * 3))];
	this.checkSidePos();
	return this.pieceOptions
};
Cute.Effect7 = function (e)
{
	Cute.Effect6.prototype.constructor.call(this, e);
	this.counter = 0;
	this._move = e.dir || "vertical"
};
Cute.Effect7.prototype = new Cute.Effect6;
Cute.Effect7.prototype.constructor = Cute.Effect7;
Cute.Effect7.prototype.getPieceOptions = function ()
{
	this.side = this.slide_name_arr[(this.counter++ % 2 ? 0 : 1) + (this._move == "vertical" ? 2 : 0)];
	this.checkSidePos();
	return this.pieceOptions
};
Cute.Effect8 = function (e)
{
	e = e || {};
	Cute.Effect5.prototype.constructor.call(this, e);
	this.sideColor = e.sidecolor || 0;
	this.depth = e.depth || -1;
	this.dir = e.dir || "u";
	this.rotation_axis = "x";
	this.rotation_dir = 1
};
Cute.Effect8.prototype = new Cute.Effect5;
Cute.Effect8.prototype.constructor = Cute.Effect8;
Cute.Effect8.prototype.getToVars = function ()
{
	var e = {};
	var t = {};
	if (this.rotation_axis == "y") {
		e.rotationY = 90 * this.rotation_dir;
		t.rotationY = 180 * this.rotation_dir
	}
	else {
		e.rotationX = 90 * this.rotation_dir;
		t.rotationX = 180 * this.rotation_dir
	}
	this.createFrames(e, t)
};
Cute.Effect8.prototype.updateConfig = function ()
{
	this.pieceOptions.sideColor = this.sideColor;
	this.pieceOptions.depth = this.depth <= 0 ? this.dir == "u" || this.dir == "d" ? this.piece.bounds.height : this.piece.bounds.width : this.depth;
	this.rotation_axis = this.dir == "u" || this.dir == "d" ? "x" : "y";
	this.rotation_dir = this.dir == "u" || this.dir == "r" ? 1 : -1;
	this.pieceOptions.flipX = this.pieceOptions.flipY = this.dir == "u" || this.dir == "d"
};
Cute.Effect8.prototype.getPieceOptions = function ()
{
	this.updateConfig();
	return this.pieceOptions
};
Cute.Effect9 = function (e)
{
	Cute.Effect8.prototype.constructor.call(this, e);
	this.dir_name_arr = ["l", "r", "u", "d"]
};
Cute.Effect9.prototype = new Cute.Effect8;
Cute.Effect9.prototype.constructor = Cute.Effect9;
Cute.Effect9.prototype.getPieceOptions = function ()
{
	this.dir = this.dir_name_arr[Math.round(parseInt(Math.random() * 3))];
	this.updateConfig();
	return this.pieceOptions
};
Cute.Effect10 = function (e)
{
	Cute.Effect9.prototype.constructor.call(this, e);
	this.counter = 0;
	this._move = e.dir || "vertical"
};
Cute.Effect10.prototype = new Cute.Effect9;
Cute.Effect10.prototype.constructor = Cute.Effect10;
Cute.Effect10.prototype.getPieceOptions = function ()
{
	this.dir = this.dir_name_arr[(this.counter++ % 2 ? 0 : 1) + (this._move == "vertical" ? 2 : 0)];
	this.updateConfig();
	return this.pieceOptions
};
Cute.Effect11 = function (e)
{
	Cute.Effect8.call(this, e);
	e = e || {};
	this.rotation_x = 0;
	this.rotation_y = 0;
	this.dir = e.dir || "tr";
	this.pieceOptions.flipX = this.pieceOptions.flipY = true
};
Cute.Effect11.prototype = new Cute.Effect8;
Cute.Effect11.prototype.constructor = Cute.Effect11;
Cute.Effect11.prototype.getToVars = function ()
{
	var e = {};
	var t = {};
	if (this.rotation_x != 0) {
		e.rotationX = 90 * this.rotation_x;
		t.rotationX = 180 * this.rotation_x
	}
	if (this.rotation_y != 0) {
		e.rotationY = 180 * this.rotation_y;
		t.rotationY = 360 * this.rotation_y
	}
	this.createFrames(e, t)
};
Cute.Effect11.prototype.updateConfig = function ()
{
	this.pieceOptions.sideColor = this.sideColor;
	this.pieceOptions.depth = this.depth <= 0 ? 10 : this.depth;
	switch (this.dir.charAt(0)) {
		case"t":
			this.rotation_x = -1;
			break;
		case"b":
			this.rotation_x = 1;
			break
	}
	switch (this.dir.charAt(1)) {
		case"r":
			this.rotation_y = -1;
			break;
		case"l":
			this.rotation_y = 1;
			break
	}
};
Cute.Effect12 = function (e)
{
	Cute.Effect11.prototype.constructor.call(this, e);
	this.dir_name_arr = ["tl", "tr", "bl", "br"]
};
Cute.Effect12.prototype = new Cute.Effect11;
Cute.Effect12.prototype.constructor = Cute.Effect12;
Cute.Effect12.prototype.getPieceOptions = function ()
{
	this.dir = this.dir_name_arr[Math.round(parseInt(Math.random() * 3))];
	this.updateConfig();
	return this.pieceOptions
};
(function ()
{
	function e(e)
	{
		for (var t = 0, n = window.resizeListeners.length; t < n; ++t) {
			window.resizeListeners[t].listener.call(window.resizeListeners[t].ref)
		}
	}

	window.resizeListeners = [];
	if (window.addEventListener) {
		window.addEventListener("resize", e);
	}
	else if (window.attachEvent) {
		window.attachEvent("onresize", e);
	}
	window.addResizeListener = function (e, t)
	{
		window.resizeListeners.push({listener: e, ref: t})
	};
	window.removeResizeListener = function (e, t)
	{
		for (var n = 0; n < window.resizeListeners.length; ++n) {
			if (window.resizeListeners[n].listener == e && window.resizeListeners[n].ref == t) {
				window.resizeListeners.splice(n, 1)
			}
		}
	}
})();
Averta = {};
Averta.Timer = function (e, t)
{
	this.delay = e;
	this.currentCount = 0;
	this.paused = false;
	this.onTimer = null;
	this.refrence = null;
	if (t) {
		this.start()
	}
};
Averta.Timer.prototype = {
	constructor: Averta.Timer, start: function ()
	{
		this.paused = false;
		this.lastTime = Date.now()
	}, stop    : function ()
	{
		this.paused = true
	}, reset   : function ()
	{
		this.currentCount = 0;
		this.paused = true;
		this.lastTime = Date.now()
	}, update  : function ()
	{
		if (this.paused || Date.now() - this.lastTime < this.delay) {
			return;
		}
		this.currentCount++;
		this.lastTime = Date.now();
		if (this.onTimer) {
			this.onTimer.call(this.refrence, this.getTime())
		}
	}, getTime : function ()
	{
		return this.delay * this.currentCount
	}
};
var lastTime = 0;
var vendors = ["ms", "moz", "webkit", "o"];
for (var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
	window.requestAnimationFrame = window[vendors[x] + "RequestAnimationFrame"];
	window.cancelAnimationFrame = window[vendors[x] + "CancelAnimationFrame"] || window[vendors[x] + "CancelRequestAnimationFrame"]
}
if (!window.requestAnimationFrame) {
	window.requestAnimationFrame = function (e, t)
	{
		var n = (new Date).getTime();
		var r = Math.max(0, 16 - (n - lastTime));
		var i = window.setTimeout(function ()
		{
			e(n + r)
		}, r);
		lastTime = n + r;
		return i
	};
}
if (!window.cancelAnimationFrame) {
	window.cancelAnimationFrame = function (e)
	{
		clearTimeout(e)
	};
}
Cute.Ticker = Cute.Ticker || {
	list     : [], __stoped: true, add: function (e, t)
	{
		Cute.Ticker.list.push([e, t]);
		return Cute.Ticker.list.length
	}, remove: function (e, t)
	{
		for (var n = 0, r = Cute.Ticker.list.length; n < r; ++n) {
			if (Cute.Ticker.list[n] && Cute.Ticker.list[n][0] == e && Cute.Ticker.list[n][1] == t) {
				Cute.Ticker.list.splice(n, 1)
			}
		}
	}, start : function ()
	{
		if (!Cute.Ticker.__stoped) {
			return;
		}
		Cute.Ticker.__stoped = false;
		Cute.Ticker.__tick()
	}, stop  : function ()
	{
		Cute.Ticker.__stoped = true
	}, __tick: function ()
	{
		if (Cute.Ticker.__stoped) {
			return;
		}
		for (var e = 0; e < Cute.Ticker.list.length; ++e) {
			Cute.Ticker.list[e][0].call(Cute.Ticker.list[e][1])
		}
		requestAnimationFrame(Cute.Ticker.__tick)
	}
};
Cute.FallBack = function ()
{
};
Cute.FallBack.CANVAS = "canvas";
Cute.FallBack.CSS3D = "css3d";
Cute.FallBack.DOM2D = "dom2d";
Cute.FallBack.ua = (new UAParser).result;
Cute.FallBack.prototype = {
	force: null, __result: null, getType: function ()
	{
		if (this.__result) {
			return this.__result;
		}
		if (this.force) {
			switch (this.force.toLowerCase()) {
				case"2d":
					this.__result = Cute.FallBack.DOM2D;
					break;
				case"canvas":
					this.__result = Cute.FallBack.CANVAS;
					break;
				case"css":
					this.__result = Cute.FallBack.CSS3D;
					break
			}
			if (this.__result) {
				return this.__result
			}
		}
		var e = Cute.FallBack.ua;
		var t = Cute.FallBack.DOM2D;
		var n = e.os.name.toLowerCase();
		var r = e.browser.name.toLowerCase();
		var i = false;
		switch (n) {
			case"windows":
			case"mac os":
			case"linux":
			case"ubuntu":
				if (r == "chrome" || r == "safari" || r == "chromium" || e.engine.name == "AppleWebKit") {
					t = Cute.FallBack.CSS3D;
				}
				else if (r == "ie" && parseInt(e.browser.major) >= 9 || r == "firefox" || r == "opera") {
					t = Cute.FallBack.CANVAS;
				}
				break;
			case"ios":
				t = Cute.FallBack.CSS3D;
				break;
			case"android":
				if (parseInt(e.os.version.charAt(0)) >= 4) {
					t = Cute.FallBack.CSS3D;
				}
				break;
			case"windows phone os":
				t = Cute.FallBack.DOM2D;
				break;
			default:
				i = true
		}
		if (window.Modernizr) {
			if (t == Cute.FallBack.CANVAS && !Modernizr.canvas) {
				t = Cute.FallBack.DOM2D;
			}
			else if (t == Cute.FallBack.CSS3D && !Modernizr.csstransforms3d) {
				t = Cute.FallBack.DOM2D;
			}
			else if (i) {
				if (Modernizr.csstransforms3d) {
					t = Cute.FallBack.CSS3D;
				}
				else if (Modernizr.canvas) {
					t = Cute.FallBack.CANVAS
				}
			}
		}
		if (n == "android" && r == "mobile safari") {
			t = Cute.FallBack.DOM2D;
		}
		this.__result = t;
		return t
	}
};
Cute.FallBack.isIE = Cute.FallBack.ua.browser.name == "IE";
Cute.FallBack.isIE7 = Cute.FallBack.isIE && Cute.FallBack.ua.browser.major == 7;
Cute.FallBack.isIE8 = Cute.FallBack.isIE && Cute.FallBack.ua.browser.major == 8;
Cute.FallBack.isMobileDevice = Cute.FallBack.ua.os.name.toLowerCase() == "android" || Cute.FallBack.ua.os.name.toLowerCase() == "ios" || Cute.FallBack.ua.os.name.toLowerCase() == "windows phone os", function ()
{
	if (Cute.FallBack.ua.browser.name == "IE" && parseInt(Cute.FallBack.ua.browser.major) < 9) {
		Date.now = function ()
		{
			return (new Date).getTime()
		};
		Array.prototype.indexOf = function (e)
		{
			for (var t = 0, n = this.length; t < n; ++t) {
				if (this[t] == e) {
					return t
				}
			}
			return -1
		}
	}
}();
Cute.ModuleLoader = function (e)
{
	this.fallBack = e
};
Cute.ModuleLoader.loadedModules = {css3d: false, canvas: false, dom2d: false};
Cute.ModuleLoader.css3d_files = ["" + CSSettings.pluginPath + "/js/cute.css3d.module.js"];
Cute.ModuleLoader.canvas_files = ["" + CSSettings.pluginPath + "/js/cute.canvas.module.js"];
Cute.ModuleLoader.dom2d_files = ["" + CSSettings.pluginPath + "/js/cute.2d.module.js"];
Cute.ModuleLoader.prototype = {
	onComplete: false, loadModule: function ()
	{
		var e = this.fallBack.getType();
		if (Cute.ModuleLoader.loadedModules[e]) {
			if (this.onComplete) {
				Cute.ModuleLoader.loadedModules[e] = true;
				this.onComplete.listener.call(this.onComplete.ref)
			}
			return
		}
		var t = [];
		switch (e) {
			case Cute.FallBack.CSS3D:
				t = Cute.ModuleLoader.css3d_files;
				break;
			case Cute.FallBack.CANVAS:
				t = Cute.ModuleLoader.canvas_files;
				break;
			case Cute.FallBack.DOM2D:
				t = Cute.ModuleLoader.dom2d_files;
				break
		}
		var n = this;
		yepnope.injectJs(t, function ()
		{
			if (n.onComplete) {
				Cute.ModuleLoader.loadedModules[e] = true;
				n.onComplete.listener.call(n.onComplete.ref)
			}
		})
	}
};
window.Averta = window.Averta || {};
Averta.EventDispatcher = function ()
{
	this.listeners = {}
};
Averta.EventDispatcher.extend = function (e)
{
	var t = new Averta.EventDispatcher;
	for (var n in t) {
		if (n != "constructor") {
			e[n] = Averta.EventDispatcher.prototype[n]
		}
	}
};
Averta.EventDispatcher.prototype = {
	constructor           : Averta.EventDispatcher, addEventListener: function (e, t, n)
	{
		if (!this.listeners[e]) {
			this.listeners[e] = [];
		}
		this.listeners[e].push({listener: t, ref: n})
	}, removeEventListener: function (e, t, n)
	{
		if (this.listener[e.type]) {
			for (var r = 0, i = this.listeners[e].length; r < i; ++r) {
				if (t == this.listeners[e][r].listener && n == this.listeners[e][r].ref) {
					this.listeners[e].splice(r);
				}
			}
			if (this.listeners[e].length == 0) {
				delete this.listeners[e]
			}
		}
	}, dispatchEvent      : function (e)
	{
		e.target = this;
		if (this.listeners[e.type]) {
			for (var t = 0, n = this.listeners[e.type].length; t < n; ++t) {
				this.listeners[e.type][t].listener.call(this.listeners[e.type][t].ref, e)
			}
		}
	}
};
Cute.SliderEvent = function (e)
{
	this.type = e
};
Cute.SliderEvent.CHANGE_START = "changeStart";
Cute.SliderEvent.CHANGE_END = "changeEnd";
Cute.SliderEvent.WATING = "wating";
Cute.SliderEvent.AUTOPLAY_CHANGE = "autoplayChange";
Cute.SliderEvent.CHANGE_NEXT_SLIDE = "changeNextSlide";
Cute.SliderEvent.WATING_FOR_NEXT = "watingForNextSlide";
window.Averta = window.Averta || {};
Averta.ScrollContainer = function (e, t)
{
	this.element = e;
	this.scrollStartPosY = 0;
	this.scrollStartPosX = 0;
	this.content = t;
	this.lastX = 0;
	this.lastY = 0;
	this.moved = false;
	this.isTouch = function ()
	{
		try {
			document.createEvent("TouchEvent");
			return true
		}
		catch (e) {
			return false
		}
	}
};
Averta.ScrollContainer.prototype = {
	constrcutor : Averta.ScrollContainer, setup: function ()
	{
		function e(e)
		{
			if (s) {
				i.scrollStartPosX = e.touches[0].pageX;
				i.scrollStartPosY = e.touches[0].pageY
			}
			else {
				i.scrollStartPosX = e.clientX;
				i.scrollStartPosY = e.clientY
			}
			i.mouseDown = true;
			i.moved = false;
			if (window.addEventListener) {
				e.preventDefault()
			}
		}

		function t(e)
		{
			if (!i.mouseDown) {
				return;
			}
			if (s) {
				var t = e.touches[0].pageX;
				var n = e.touches[0].pageY;
				i.move(t - i.scrollStartPosX + i.lastX, n - i.scrollStartPosY + i.lastY);
				i.scrollStartPosX = t;
				i.scrollStartPosY = n
			}
			else {
				i.move(e.clientX - i.scrollStartPosX + i.lastX, e.clientY - i.scrollStartPosY + i.lastY);
				i.scrollStartPosX = e.clientX;
				i.scrollStartPosY = e.clientY
			}
			if (window.addEventListener) {
				e.preventDefault()
			}
		}

		function n(e)
		{
			function t(e)
			{
				var t = 0;
				var n = 0;
				while (e && !isNaN(e.offsetLeft) && !isNaN(e.offsetTop)) {
					t += e.offsetLeft - e.scrollLeft;
					n += e.offsetTop - e.scrollTop;
					e = e.offsetParent
				}
				return {top: n, left: t}
			}

			var n = t(i.element).left;
			i.element.childNodes[0].style.left = -(e.clientX - n) / (i.element.offsetWidth / (i.element.childNodes[0].offsetWidth - i.element.offsetWidth)) + "px"
		}

		function r(e)
		{
			if (!i.mouseDown) {
				return;
			}
			i.mouseDown = false;
			if (window.addEventListener) {
				e.preventDefault()
			}
			if (s) {
				document.removeEventListener("touchend", i.element, false);
				return
			}
			if (document.detachEvent) {
				document.detachEvent("onmousemove", i.element);
			}
			else {
				document.removeEventListener("mousemove", i.element, false)
			}
		}

		if (Cute.FallBack.isIE7) {
			return;
		}
		var i = this;
		var s = this.isTouch();
		if (s) {
			this.element.addEventListener("touchstart", e);
			this.element.addEventListener("touchmove", t);
			return
		}
		if (window.addEventListener) {
			this.element.addEventListener("mousemove", n, false)
		}
		else {
			this.element.attachEvent("onmousemove", n, false)
		}
	}, move     : function (e, t)
	{
		this.moved = true;
		this.element.scrollTop = -t;
		this.element.scrollLeft = -e;
		this.lastX = -this.element.scrollLeft;
		this.lastY = -this.element.scrollTop
	}, translate: function (e, t)
	{
		this.move(this.lastX + (e || 0), this.lastY + (t || 0))
	}
};
Cute.ItemList = function (e)
{
	this.frame = document.createElement("div");
	this.frame.className = "il-frame";
	this.content = document.createElement("div");
	this.content.className = "il-content";
	this.type = "vertical";
	this.items = [];
	this.sc = new Averta.ScrollContainer(this.frame, this.content);
	var t = this;
	var n = 0;
	var r = false;
	var i = this.sc.isTouch();
	this.__scrollnext = function (e)
	{
		r = true;
		n = 2;
		Cute.Ticker.add(t.__scrolling, t);
		if (i) {
			e.preventDefault()
		}
	};
	this.__scrollprev = function (e)
	{
		r = true;
		n = -2;
		Cute.Ticker.add(t.__scrolling, t);
		if (i) {
			e.preventDefault()
		}
	};
	this.__stopscroll = function (e)
	{
		if (!r) {
			return;
		}
		r = false;
		Cute.Ticker.remove(t.__scrolling, t);
		t.sc.moved = false;
		if (i) {
			e.preventDefault()
		}
	};
	this.__scrolling = function ()
	{
		if (t.type == "vertical") {
			t.sc.translate(0, n);
		}
		else {
			t.sc.translate(-n, 0)
		}
	};
	this.upleft = document.createElement("div");
	this.upleft.onmousedown = this.__scrollprev;
	this.downright = document.createElement("div");
	this.downright.onmousedown = this.__scrollnext;
	document.onmouseup = this.__stopscroll;
	if (i) {
		this.upleft.addEventListener("touchstart", this.__scrollprev, false);
		this.downright.addEventListener("touchstart", this.__scrollnext, false);
		document.addEventListener("touchend", this.__stopscroll, false)
	}
	this.container = document.createElement("div");
	this.container.className = "br-thumblist-container";
	e.appendChild(this.container);
	this.container.appendChild(this.frame);
	this.container.appendChild(this.downright);
	this.container.appendChild(this.upleft);
	this.frame.appendChild(this.content);
	this.addItem = function (e)
	{
		this.content.appendChild(e);
		this.items.push(e)
	}
};
Cute.Slide = function (e)
{
	this.src = "";
	this.delay = 0;
	this.slider = e;
	this.ready = false;
	this._index = 0;
	this.autoPlay = true;
	this.pluginData = {};
	this.opacity = 100;
	this.domElement = document.createElement("div");
	this.domElement.style.width = "100%";
	this.domElement.style.height = "auto";
	this.domElement.style.overflow = "hidden";
	this.domElement.style.position = "absolute";
	this.domElement.style.zIndex = "1"
};
Cute.Slide.prototype = {
	constructor     : Cute.Slide, loadContent: function ()
	{
		if (this.src != null) {
			this.image = new Image;
			this.image.slide = this;
			this.image.onload = this.contentLoaded;
			this.image.src = this.src;
			this.image.style.width = "100%";
			this.image.style.height = "auto"
		}
		else {
			this.ready = true;
			this.onReady.listener.call(this.onReady.ref)
		}
	}, killLoading  : function ()
	{
		this.image.onload = null
	}, addContent   : function (e)
	{
		this.domElement.appendChild(e);
		this.image = e;
		this.image.style.width = "100%";
		this.image.style.height = "auto";
		this.ready = true;
		if (this.onReady) {
			this.onReady.listener.call(this.onReady.ref);
		}
		this.prepareToShow();
		this.showIsDone()
	}, showIsDone   : function ()
	{
	}, hideIsDone   : function ()
	{
	}, prepareToShow: function ()
	{
	}, prepareToHide: function ()
	{
	}, contentLoaded: function ()
	{
		this.slide.domElement.appendChild(this);
		this.slide.ready = true;
		if (this.slide.onReady) {
			this.slide.onReady.listener.call(this.slide.onReady.ref)
		}
	}, opacityUpdate: function ()
	{
		setOpacity(this.domElement, this.opacity)
	}
};
Cute.SlideManager = function ()
{
	Averta.EventDispatcher.prototype.constructor.call(this);
	this.width = 0;
	this.height = 0;
	this._timer = new Averta.Timer(100);
	this._slideList = [];
	this._currentSlideIndex = 0;
	this._delayProgress = 0;
	this._autoPlay = true;
	this._status = "";
	this.domElement = document.createElement("div");
	this.domElement.style.position = "relative";
	this._timer.onTimer = this.onTimer;
	this._timer.refrence = this
};
Cute.SlideManager.prototype = {
	constructor            : Cute.SlideManager, startTimer: function ()
	{
		if (!this._autoPlay) {
			return false;
		}
		this._timer.start();
		return true
	}, skipTimer           : function ()
	{
		this._timer.reset();
		this._delayProgress = 100;
		this.dispatchEvent(new Cute.SliderEvent(Cute.SliderEvent.WATING))
	}, onTimer             : function (e)
	{
		if (this._timer.getTime() >= this._currentSlide.delay * 1e3) {
			this._timer.stop();
			if (this._nextSlide.ready) {
				this.showSlide(this._nextSlide);
			}
			else {
				this.waitForNext()
			}
		}
		this._delayProgress = this._timer.getTime() / (this._currentSlide.delay * 10);
		this.dispatchEvent(new Cute.SliderEvent(Cute.SliderEvent.WATING))
	}, prepareTransition   : function (e)
	{
		if (this.rotator.fallBack.getType() == Cute.FallBack.DOM2D) {
			return e.transitions2D[parseInt(Math.random() * e.transitions2D.length)];
		}
		else {
			return e.transitions3D[parseInt(Math.random() * e.transitions3D.length)]
		}
	}, showSlide           : function (e)
	{
		var t = this.prepareTransition(e);
		this._oldSlide = this._currentSlide;
		this._currentSlide = e;
		this._oldSlide.prepareToHide();
		e.prepareToShow();
		if(typeof(this._viewClass) !== 'undefined'){
			this._view = new this._viewClass(t.row, t.col);
		}
		this._view.setSize(this.width, this.height);
		this._view.setViewPortSize(this.vpWidth, this.vpHeight);
		this._view.oldSource = this._oldSlide.image;
		this._view.newSource = e.image;
		this._view.setup();
		if (this._view.needRendering) {
			Cute.Ticker.add(this._view.render, this._view);
		}
		this._engine = new Aroma.Engine(this._view);
		t.selector.reset();
		this._engine.start(t.effect, t.selector, t.duration, t.overlapping, .45);
		this._engine.onComplete = {ref: this, listener: this.transitionCl};
		this._replaceTween = (new TWEEN.Tween(this._oldSlide)).to({opacity: 0}, 450).onUpdate(this._oldSlide.opacityUpdate).start();
		this._replaceTween.slider = this;
		this.newSlide = e;
		this._replaceTween.onComplete(function ()
		{
			this.slider.domElement.removeChild(this.domElement)
		});
		this.domElement.appendChild(this._view.viewport);
		this._view.viewport.style.position = "absolute";
		this._view.viewport.style.zIndex = "0";
		this._view.viewport.style.marginLeft = -(this.vpWidth - this.width) / 2 + "px";
		this._view.viewport.style.marginTop = -(this.vpHeight - this.height) / 2 + "px";
		this._currentSlideIndex = e.index;
		this._timer.reset();
		this._delayProgress = 0;
		this._status = "changing";
		this.dispatchEvent(new Cute.SliderEvent(Cute.SliderEvent.WATING));
		this.dispatchEvent(new Cute.SliderEvent(Cute.SliderEvent.CHANGE_START))
	}, transitionCl        : function ()
	{
		this._engine.reset();
		this._currentSlide.opacity = 0;
		this.domElement.appendChild(this._currentSlide.domElement);
		this._replaceTween2 = (new TWEEN.Tween(this._currentSlide)).to({opacity: 100}, 450).onUpdate(this._currentSlide.opacityUpdate);
		TWEEN.add(this._replaceTween2);
		this._replaceTween2.start();
		this._replaceTween2.onComplete(function ()
		{
			if (this.slider._view.needRendering) {
				Cute.Ticker.remove(this.slider._view.render, this.slider._view);
			}
			TWEEN.remove(this.slider._replaceTween2);
			this.slider.domElement.removeChild(this.slider._view.viewport);
			this.slider._view.dispose();
			this.slider._view = null;
			this.slider._currentSlide.showIsDone();
			this.slider._oldSlide.hideIsDone();
			this.slider._status = "wating";
			this.slider.dispatchEvent(new Cute.SliderEvent(Cute.SliderEvent.CHANGE_END))
		});
		this._engine = null;
		this.startTimer();
		this.gotoSlide(this.getNextIndex())
	}, readyToShow         : function ()
	{
		if (this._delayProgress == 100) {
			this.showSlide(this._nextSlide)
		}
	}, waitForNext         : function ()
	{
		this._status = "loading";
		this.dispatchEvent(new Cute.SliderEvent(Cute.SliderEvent.WATING_FOR_NEXT))
	}, resize              : function ()
	{
		if (this._status == "changing") {
			if (this._engine) {
				this._engine.removeTweens();
				this._engine.reset()
			}
			if (this._view) {
				if (this._view.needRendering) {
					Cute.Ticker.remove(this._view.render, this._view);
				}
				this.domElement.removeChild(this._view.viewport);
				this._view.dispose();
				this._view = null;
				this._engine = null
			}
			if (this._replaceTween2) {
				this._replaceTween2.stop();
				TWEEN.remove(this._replaceTween2)
			}
			if (!this._currentSlide.domElement.parentElement) {
				this.domElement.appendChild(this._currentSlide.domElement);
			}
			this._currentSlide.opacity = 100;
			this._currentSlide.opacityUpdate();
			this._currentSlide.showIsDone();
			if (this._replaceTween) {
				this._replaceTween.stop();
				TWEEN.remove(this._replaceTween)
			}
			if (!this._oldSlide.domElement.parentElement) {
				this.domElement.appendChild(this._oldSlide.domElement);
			}
			this._oldSlide.opacity = 0;
			this._oldSlide.opacityUpdate();
			this._oldSlide.hideIsDone();
			this._status = "wating";
			this.dispatchEvent(new Cute.SliderEvent(Cute.SliderEvent.CHANGE_END));
			this.startTimer();
			this.gotoSlide(this.getNextIndex())
		}
	}, getNextIndex        : function ()
	{
		if (this._currentSlideIndex + 1 == this._slideList.length) {
			return 0;
		}
		else {
			return this._currentSlideIndex + 1
		}
	}, getPreviousIndex    : function ()
	{
		if (this._currentSlideIndex - 1 == -1) {
			return this._slideList.length - 1;
		}
		else {
			return this._currentSlideIndex - 1
		}
	}, gotoSlide           : function (e, t)
	{
		if (t) {
			this.skipTimer();
			if (this._nextSlide && this._nextSlide.index == e) {
				if (this._nextSlide.ready) {
					this.showSlide(this._nextSlide);
				}
				else {
					this.waitForNext();
				}
				return
			}
		}
		if (this._nextSlide && this._nextSlide.index == e) {
			return;
		}
		if (this._nextSlide) {
			this._nextSlide.killLoading();
			this._nextSlide = null
		}
		this._nextSlide = this._slideList[e];
		if (!this._nextSlide.ready) {
			if (t) {
				this.waitForNext();
			}
			this._nextSlide.onReady = {listener: this.readyToShow, ref: this};
			this._nextSlide.loadContent()
		}
		else if (this._delayProgress == 100) {
			this.showSlide(this._slideList[e])
		}
		this.dispatchEvent(new Cute.SliderEvent(Cute.SliderEvent.CHANGE_NEXT_SLIDE))
	}, start               : function ()
	{
		this._currentSlide = this._slideList[this._currentSlideIndex];
		this.domElement.appendChild(this._currentSlide.domElement);
		this.dispatchEvent(new Cute.SliderEvent(Cute.SliderEvent.CHANGE_END));
		this.startTimer();
		this.gotoSlide(this.getNextIndex());
		this.vpWidth = this.vpWidth || this.width;
		this.vpHeight = this.vpHeight || this.height
	}, next                : function ()
	{
		if (this._status == "changing") {
			return;
		}
		this.gotoSlide(this.getNextIndex(), true)
	}, previous            : function ()
	{
		if (this._status == "changing") {
			return;
		}
		this.gotoSlide(this.getPreviousIndex(), true)
	}, pushSlide           : function (e)
	{
		this._slideList.push(e);
		e.index = this._slideList.length - 1;
		return this._slideList.length - 1
	}, pause               : function ()
	{
		this._timer.stop()
	}, play                : function ()
	{
		this._timer.start()
	}, getTimer            : function ()
	{
		return this._timer
	}, getSlideList        : function ()
	{
		return this._slideList
	}, getNextSlide        : function ()
	{
		return this._nextSlide
	}, getCurrentSlide     : function ()
	{
		return this._currentSlide
	}, getCurrentSlideIndex: function ()
	{
		return this._currentSlideIndex
	}, delayProgress       : function ()
	{
		return this._delayProgress
	}, getAutoPlay         : function ()
	{
		return this._autoPlay
	}, setAutoPlay         : function (e)
	{
		if (this._autoPlay == e) {
			return;
		}
		this._autoPlay = e;
		if (!this._autoPlay) {
			this._timer.stop();
		}
		else {
			this._timer.start();
		}
		this.dispatchEvent(new Cute.SliderEvent(Cute.SliderEvent.AUTOPLAY_CHANGE))
	}
};
Averta.EventDispatcher.extend(Cute.SlideManager.prototype);
Cute.rotatorControls = {};
Cute.AbstractControl = function (e)
{
	this.config = null;
	this.slider = e;
	this.domElement = null;
	this.disable = false;
	this.name = "";
	this.config = {};
	this.opacity = 100;
	this.showTween = null
};
Cute.AbstractControl.prototype = {
	constructor     : Cute.AbstractControl, setup: function (e)
	{
		this.config_ele = e;
		this.domElement.className = e.className || this.config.css_class;
		if (e.getAttribute("style")) {
			this.domElement.setAttribute("style", e.getAttribute("style"));
		}
		this.slider.addEventListener(Cute.SliderEvent.CHANGE_START, this.__effStart, this);
		this.slider.addEventListener(Cute.SliderEvent.CHANGE_END, this.__effEnd, this)
	}, opacityUpdate: function ()
	{
		setOpacity(this.domElement, this.opacity)
	}, visible      : function (e)
	{
		this.domElement.style.display = !e ? "none" : ""
	}, show         : function ()
	{
		if (this.showTween) {
			this.showTween.stop();
		}
		this.showTween = (new TWEEN.Tween(this)).to({opacity: 100}, 450).onUpdate(this.opacityUpdate).start();
		TWEEN.add(this.showTween)
	}, hide         : function ()
	{
		if (this.showTween) {
			this.showTween.stop();
		}
		this.showTween = (new TWEEN.Tween(this)).to({opacity: 0}, 450).onUpdate(this.opacityUpdate).start();
		TWEEN.add(this.showTween)
	}, __effEnd     : function (e)
	{
		this.visible(true);
		if (!this.config.autoHide) {
			this.show();
		}
		if (this.ap) {
			this.slider.setAutoPlay(true)
		}
	}, __effStart   : function (e)
	{
		this.hide()
	}
};
Cute.Next = function (e)
{
	Cute.AbstractControl.prototype.constructor.call(this, e);
	this.domElement = document.createElement("div");
	this.config = {css_class: "br-next"}
};
Cute.rotatorControls.next = Cute.Next;
Cute.Next.prototype = new Cute.AbstractControl;
Cute.Next.prototype.constructor = Cute.Next;
Cute.Next.prototype.setup = function (e)
{
	Cute.AbstractControl.prototype.setup.call(this, e);
	this.domElement.control = this;
	this.domElement.onclick = function ()
	{
		this.control.slider.next()
	}
};
Cute.Next.prototype.show = function ()
{
	Cute.AbstractControl.prototype.show.call(this);
	this.domElement.style.cursor = "pointer"
};
Cute.Next.prototype.hide = function ()
{
	Cute.AbstractControl.prototype.hide.call(this);
	this.domElement.style.cursor = ""
};
Cute.Previous = function (e)
{
	Cute.Next.call(this, e);
	this.config = {css_class: "br-previous"}
};
Cute.rotatorControls.previous = Cute.Previous;
Cute.Previous.prototype = new Cute.Next;
Cute.Previous.prototype.constructor = Cute.Previous;
Cute.Previous.prototype.setup = function (e)
{
	Cute.Next.prototype.setup.call(this, e);
	this.domElement.onclick = function ()
	{
		this.control.slider.previous()
	}
};
Cute.CircleTimer = function (e)
{
	Cute.AbstractControl.call(this, e);
	this.domElement = document.createElement("div");
	this.lbrowser = Cute.FallBack.ua.browser.name.toLowerCase() == "ie" && parseInt(Cute.FallBack.ua.browser.major) < 9;
	if (this.lbrowser) {
		return;
	}
	this.config = {color: "#fff", stroke: 10, radius: 4, css_class: "br-circle-timer"};
	this.overpause = false;
	this.canvas = document.createElement("canvas");
	this.dot = document.createElement("div");
	this.ctx = this.canvas.getContext("2d");
	this.prog = 0;
	this.drawTween = null
};
Cute.rotatorControls.circletimer = Cute.CircleTimer;
Cute.CircleTimer.prototype = new Cute.AbstractControl;
Cute.CircleTimer.prototype.constructor = Cute.CircleTimer;
Cute.CircleTimer.prototype.setup = function (e)
{
	if (this.lbrowser) {
		return;
	}
	Cute.AbstractControl.prototype.setup.call(this, e);
	this.config.color = e.getAttribute("data-color") || this.config.color;
	if (e.getAttribute("data-stroke")) {
		this.config.stroke = parseInt(e.getAttribute("data-stroke"));
	}
	if (e.getAttribute("data-radius")) {
		this.config.radius = parseInt(e.getAttribute("data-radius"));
	}
	this.__w = (this.config.radius + this.config.stroke) * 2;
	this.canvas.width = this.__w;
	this.canvas.height = this.__w;
	this.canvas.className = "br-timer-stroke";
	this.canvas.style.position = "absolute";
	this.dot.className = "br-timer-dot";
	this.dot.style.position = "relative";
	this.dot.style.left = (this.__w - 10) * .5 + "px";
	this.dot.style.top = (this.__w - 12) * .5 + "px";
	this.domElement.slider = this.slider;
	this.domElement.onclick = function ()
	{
		if (!Cute.AbstractControl.paused) {
			Cute.AbstractControl.paused = true;
			this.slider.setAutoPlay(false)
		}
		else {
			Cute.AbstractControl.paused = false;
			this.slider.setAutoPlay(true)
		}
	};
	this.slider.addEventListener(Cute.SliderEvent.WATING, this.update, this);
	this.domElement.appendChild(this.canvas);
	this.domElement.appendChild(this.dot)
};
Cute.CircleTimer.prototype.update = function (e)
{
	if (this.drawTween) {
		this.drawTween.stop();
	}
	this.drawTween = (new TWEEN.Tween(this)).to({prog: this.slider.delayProgress() * .01}, 300).easing(TWEEN.Easing.Circular.EaseOut).onUpdate(this.draw).start()
};
Cute.CircleTimer.prototype.draw = function ()
{
	this.ctx.clearRect(0, 0, this.__w, this.__w);
	this.ctx.beginPath();
	this.ctx.arc(this.__w * .5, this.__w * .5, this.config.radius, Math.PI * 1.5, Math.PI * 1.5 + 2 * Math.PI * this.prog, false);
	this.ctx.strokeStyle = this.config.color;
	this.ctx.lineWidth = this.config.stroke;
	this.ctx.stroke()
};
Cute.CircleTimer.prototype.show = function ()
{
	Cute.AbstractControl.prototype.show.call(this);
	this.domElement.style.cursor = "pointer"
};
Cute.CircleTimer.prototype.hide = function ()
{
	Cute.AbstractControl.prototype.hide.call(this);
	this.domElement.style.cursor = ""
};
Cute.Thumb = function (e, t)
{
	this.domElement = document.createElement("div");
	this.domElement.className = "br-thumb-" + t;
	this.imgCont = document.createElement("div");
	this.imgCont.className = "br-thumb-img";
	this.imgCont.style.overflow = "hidden";
	this.img = new Image;
	this.img.thumb = this;
	this.img.onload = this.thumbLoaded;
	this.img.src = e;
	this.img.style.position = "absolute";
	this.img.style.filter = "inherit";
	this.frame = document.createElement("div");
	this.frame.style.position = "absolute";
	this.frame.style.zIndex = "1";
	this.frame.className = "br-thumb-frame";
	this.frame.style.filter = "inherit";
	this.thumb_pos = 1;
	this.imgCont.appendChild(this.img);
	this.domElement.appendChild(this.imgCont);
	this.domElement.appendChild(this.frame)
};
Cute.Thumb.prototype = {
	constructor: Cute.Thumb, thumbLoaded: function ()
	{
		this.thumb.imgLoaded = true;
		if (this.thumb.rts) {
			this.thumb.show()
		}
	}, ut      : function ()
	{
		this.img.style.transform = "scale(" + this.thumb_pos + ")";
		this.img.style.webkitTransform = "scale(" + this.thumb_pos + ")";
		this.img.style.MozTransform = "scale(" + this.thumb_pos + ") rotate(0.1deg)";
		this.img.style.msTransform = "scale(" + this.thumb_pos + ")";
		this.img.style.OTransform = "scale(" + this.thumb_pos + ")"
	}, show    : function ()
	{
		if (!this.imgLoaded) {
			this.rts = true;
			return
		}
	}, reset   : function ()
	{
		this.rts = false;
		if (this.st) {
			this.st.stop();
			this.st = null
		}
	}
};
Cute.SlideControl = function (e)
{
	Cute.AbstractControl.call(this, e);
	this.config = {css_class: "br-slidecontrol", thumb: true, thumb_align: "bottom"};
	this.domElement = document.createElement("div");
	this.points_ul = document.createElement("ul");
	this.points = []
};
Cute.rotatorControls.slidecontrol = Cute.SlideControl;
Cute.SlideControl.prototype = new Cute.AbstractControl;
Cute.SlideControl.prototype.constructor = Cute.SlideControl;
Cute.SlideControl.prototype.setup = function (e)
{
	Cute.AbstractControl.prototype.setup.call(this, e);
	this.domElement.appendChild(this.points_ul);
	this.slider.addEventListener(Cute.SliderEvent.CHANGE_NEXT_SLIDE, this.update, this);
	this.config.thumb = e.getAttribute("data-thumb") != "false";
	this.config.thumb_align = e.getAttribute("data-thumbalign") || "bottom";
	var t;
	for (var n = 0, r = this.slider.getSlideList().length; n < r; ++n) {
		t = new Cute.SlideControl.Point(this.slider, this.slider.getSlideList()[n], this);
		if (n == this.slider.getCurrentSlideIndex()) {
			this.selectedPoint = t;
			t.select()
		}
		t.index = n;
		this.points_ul.appendChild(t.domElement);
		this.points.push(t)
	}
};
Cute.SlideControl.prototype.update = function ()
{
	if (this.selectedPoint && this.slider.getCurrentSlideIndex() == this.selectedPoint.index) {
		return;
	}
	if (this.selectedPoint) {
		this.selectedPoint.unselect();
	}
	this.selectedPoint = this.points[this.slider.getCurrentSlideIndex()];
	this.selectedPoint.select()
};
Cute.SlideControl.prototype.show = function ()
{
	Cute.AbstractControl.prototype.show.call(this);
	this.disable = false;
	this.domElement.style.cursor = "pointer"
};
Cute.SlideControl.prototype.hide = function ()
{
	Cute.AbstractControl.prototype.hide.call(this);
	this.disable = true;
	this.domElement.style.cursor = "default"
};
Cute.SlideControl.Point = function (e, t, n)
{
	this.domElement = document.createElement("li");
	this.slider = e;
	this.index = 0;
	this.domElement.point = this;
	this.sc = n;
	this.domElement.onclick = function ()
	{
		if (this.point.sc.disable) {
			return;
		}
		this.point.changeSlide()
	};
	if (Cute.FallBack.ua.browser.name == "IE") {
		this.domElement.style.filter = "inherit";
	}
	this.selectedElement = document.createElement("span");
	this.selectedElement.className = "br-control-selected";
	this.selectOpacity = 0;
	this.uo();
	if (n.config.thumb) {
		this.thumb = new Cute.Thumb(t.thumb, n.config.thumb_align);
		this.domElement.onmouseover = function ()
		{
			this.point.showThumb()
		};
		this.domElement.onmouseout = function ()
		{
			this.point.hideThumb()
		};
		this.thumb_pos = 0;
		this.drawThumb();
		this.thumb.domElement.style.display = "none";
		this.domElement.appendChild(this.thumb.domElement);
		this.thumb.align = n.config.thumb_align
	}
	this.domElement.appendChild(this.selectedElement);
	this.selectTween = null
};
Cute.SlideControl.Point.prototype = {
	constructor : Cute.SlideControl.Point, align: "bottom", changeSlide: function ()
	{
		this.slider.gotoSlide(this.index, true)
	}, uo       : function ()
	{
	}, select   : function ()
	{
		if (this.selectTween) {
			this.selectTween.stop();
		}
		this.selectedElement.style.display = "block"
	}, unselect : function ()
	{
		if (this.selectTween) {
			this.selectTween.stop();
		}
		this.selectedElement.style.display = "none"
	}, drawThumb: function ()
	{
		setOpacity(this.thumb.domElement, this.thumb_pos);
		if (this.sc.config.thumb_align == "up") {
			this.thumb.domElement.style.top = 10 - this.thumb.frame.offsetHeight + -this.thumb_pos * .1 + "px";
		}
		else {
			this.thumb.domElement.style.top = 24 + -this.thumb_pos * .1 + "px"
		}
	}, showThumb: function ()
	{
		this.domElement.style.zIndex = this.slider.getSlideList().length;
		if (this.thumbTween) {
			this.thumbTween.stop();
		}
		this.thumb.show();
		this.thumb.domElement.style.display = "";
		this.thumbTween = (new TWEEN.Tween(this)).to({thumb_pos: 100}, 700).onUpdate(this.drawThumb).easing(TWEEN.Easing.Quartic.EaseOut).start()
	}, hideThumb: function ()
	{
		this.domElement.style.zIndex = 0;
		if (this.thumbTween) {
			this.thumbTween.stop();
		}
		this.thumb.reset();
		this.thumbTween = (new TWEEN.Tween(this)).to({thumb_pos: 0}, 250).onUpdate(this.drawThumb).start().onComplete(function ()
		{
			this.thumb.domElement.style.display = "none"
		})
	}
};
Cute.SlideInfo = function (e)
{
	Cute.AbstractControl.call(this, e);
	this.config = {css_class: "br-slideinfo", align: "bottom"};
	this.domElement = document.createElement("div");
	this.content = document.createElement("div");
	this.poition = 0
};
Cute.rotatorControls.slideinfo = Cute.SlideInfo;
Cute.SlideInfo.prototype = new Cute.AbstractControl;
Cute.SlideInfo.prototype.constructor = Cute.SlideInfo;
Cute.SlideInfo.prototype.setup = function (e)
{
	Cute.AbstractControl.prototype.setup.call(this, e);
	this.domElement.style.overflow = "hidden";
	this.domElement.style.position = "absolute";
	this.domElement.style.display = "none";
	this.content.className = "br-infocontent";
	this.content.style.position = "relative";
	this.eff = e.getAttribute("data-effect") || "slide";
	this.domElement.appendChild(this.content)
};
Cute.SlideInfo.prototype.update = function ()
{
	if (this.data) {
		if (this.eff == "fade") {
			setOpacity(this.content, this.position);
		}
		else {
			this.content.style[this.data.align] = this.position + "px"
		}
	}
};
Cute.SlideInfo.prototype.show = function ()
{
	this.domElement.style.display = "";
	if (this.showTween) {
		this.showTween.stop();
	}
	this.data = this.slider.getCurrentSlide().pluginData.info;
	if (!this.data) {
		this.disable = true;
		this.content.className = "";
		this.content.innerHTML = "";
		return
	}
	else {
		this.disable = false;
	}
	this.content.innerHTML = this.data.text;
	this.content.className = "br-infocontent " + this.data.align + " " + this.data._class || "";
	this.domElement.style.width = this.data.align == "left" || this.data.align == "right" ? "auto" : "100%";
	this.domElement.style.height = this.data.align == "bottom" || this.data.align == "top" ? "auto" : "100%";
	this.domElement.style.left = "";
	this.domElement.style.right = "";
	this.domElement.style.bottom = "";
	this.domElement.style.top = "";
	this.content.style.left = "";
	this.content.style.right = "";
	this.content.style.bottom = "";
	this.content.style.top = "";
	if (this.eff == "slide") {
		this.position = -(this.data.align == "bottom" || this.data.align == "top" ? this.content.offsetHeight : this.content.offsetWidth);
	}
	else {
		this.position = 0;
	}
	this.domElement.style[this.data.align] = "0px";
	this.update();
	this.showTween = (new TWEEN.Tween(this)).to({position: this.eff == "slide" ? 0 : 100}, 950).delay(this.data.delay).easing(TWEEN.Easing.Quartic.EaseInOut).onUpdate(this.update).start();
	TWEEN.add(this.showTween)
};
Cute.SlideInfo.prototype.hide = function ()
{
	if (this.disable) {
		return;
	}
	if (this.showTween) {
		this.showTween.stop();
	}
	this.showTween = (new TWEEN.Tween(this)).to({position: this.eff != "slide" ? 0 : -(this.data.align == "bottom" || this.data.align == "top" ? this.content.offsetHeight : this.content.offsetWidth)}, 850).easing(TWEEN.Easing.Quartic.EaseInOut).onUpdate(this.update).start();
	TWEEN.add(this.showTween)
};
Cute.BarTimer = function (e)
{
	Cute.AbstractControl.call(this, e);
	this.config = {css_class: "br-bar-timer"};
	this.domElement = document.createElement("div");
	this.prog = 0
};
Cute.rotatorControls.bartimer = Cute.BarTimer;
Cute.BarTimer.prototype = new Cute.AbstractControl;
Cute.BarTimer.prototype.constructor = Cute.BarTimer;
Cute.BarTimer.prototype.update = function (e)
{
	if (this.drawTween) {
		this.drawTween.stop();
	}
	this.drawTween = (new TWEEN.Tween(this)).to({prog: this.slider.delayProgress() * .0102}, 300).easing(TWEEN.Easing.Quartic.EaseOut).onUpdate(this.draw).start()
};
Cute.BarTimer.prototype.draw = function ()
{
	var e = this.prog * this.slider.width;
	this.glow.style.left = e - this.glow.offsetWidth + "px";
	this.bar.style.width = Math.max(0, e - 5) + "px"
};
Cute.BarTimer.prototype.setup = function (e)
{
	Cute.AbstractControl.prototype.setup.call(this, e);
	this.slider.bartimer = this;
	this.domElement.style.width = "100%";
	this.domElement.style.overflow = "hidden";
	this.glow = document.createElement("div");
	this.glow.className = "br-timer-glow";
	this.glow.style.position = "relative";
	this.bar = document.createElement("div");
	this.bar.className = "br-timer-bar";
	this.domElement.appendChild(this.glow);
	this.domElement.appendChild(this.bar);
	this.slider.addEventListener(Cute.SliderEvent.WATING, this.update, this);
	this.draw()
};
Cute.Captions = function (e)
{
	Cute.AbstractControl.call(this, e);
	this.config = {css_class: "br-captions"};
	this.domElement = document.createElement("div");
	this.captions = [];
	this.overpause = false
};
Cute.rotatorControls.captions = Cute.Captions;
Cute.Captions.prototype = new Cute.AbstractControl;
Cute.Captions.prototype.constructor = Cute.Captions;
Cute.Captions.prototype.setup = function (e)
{
	Cute.AbstractControl.prototype.setup.call(this, e);
	this.domElement.style.width = "100%";
	this.domElement.style.height = "100%";
	this.domElement.style.position = "absolute"
};
Cute.Captions.prototype.show = function ()
{
	this.data = this.slider.getCurrentSlide().pluginData.captions;
	this.slide_index = this.slider.getCurrentSlideIndex();
	if (!this.captions[this.slide_index] && this.data) {
		this.captions[this.slide_index] = [];
		var e = this.data.getElementsByTagName("li");
		var t;
		for (var n = 0, r = e.length; n < r; ++n) {
			t = new Cute.Caption;
			t.add(e[n].innerHTML, e[n].className);
			t.delay = Number(e[n].getAttribute("data-delay")) || 0;
			t.effect = e[n].getAttribute("data-effect") || "fade";
			this.captions[this.slide_index].push(t)
		}
	}
	if (this.data) {
		for (var n = 0, r = this.captions[this.slide_index].length; n < r; ++n) {
			this.domElement.appendChild(this.captions[this.slide_index][n].domElement);
			this.captions[this.slide_index][n].show()
		}
	}
};
Cute.Captions.prototype.hide = function ()
{
	if (this.captions[this.slide_index]) {
		for (var e = 0, t = this.captions[this.slide_index].length; e < t; ++e) {
			this.captions[this.slide_index][e].hide()
		}
	}
};
Cute.Caption = function ()
{
	this.domElement = document.createElement("div");
	this.content = document.createElement("div")
};
Cute.Caption.prototype = {
	constructro: Cute.Caption, effect: "fade", add: function (e, t)
	{
		this.content.innerHTML = e;
		this.content.className = "br-caption-content";
		this.content.style.position = "relative";
		this.domElement.className = t;
		this.domElement.style.overflow = "hidden";
		this.domElement.appendChild(this.content)
	}, fade    : function ()
	{
		setOpacity(this.domElement, this.show_pos)
	}, slide   : function ()
	{
		this.content.style.left = -this.domElement.offsetWidth * (1 - this.show_pos * .01) + "px"
	}, show    : function ()
	{
		if (this.showTween) {
			this.showTween.stop();
		}
		this.show_pos = 0;
		this[this.effect]();
		this.showTween = (new TWEEN.Tween(this)).to({show_pos: 100}, 1e3).delay(this.delay).easing(TWEEN.Easing.Quartic.EaseInOut).onUpdate(this[this.effect]).delay(this.delay).start();
		TWEEN.add(this.showTween)
	}, hide    : function ()
	{
		if (this.showTween) {
			this.showTween.stop();
		}
		this.showTween = (new TWEEN.Tween(this)).to({show_pos: 0}, 1e3).easing(TWEEN.Easing.Quartic.EaseInOut).onUpdate(this[this.effect]).onComplete(this.remove).start()
	}, remove  : function ()
	{
		if (this.domElement.parentElement) {
			this.domElement.parentElement.removeChild(this.domElement)
		}
	}
};
Cute.VideoControl = function (e)
{
	Cute.AbstractControl.call(this, e);
	this.config = {css_class: "br-video", width: 300, height: 200};
	this.domElement = document.createElement("div");
	this.video_ele = document.createElement("iframe");
	this.closeBtn = document.createElement("div");
	this.overPlay = document.createElement("div");
	this.videoContainer = document.createElement("div");
	this.domElement.style.position = "absolute";
	this.vopacity = 0;
	this.videoFade = function ()
	{
		setOpacity(this.videoContainer, this.vopacity)
	}
};
Cute.rotatorControls.video = Cute.VideoControl;
Cute.VideoControl.prototype = new Cute.AbstractControl;
Cute.VideoControl.prototype.constructor = Cute.VideoControl;
Cute.VideoControl.prototype.setup = function (e)
{
	Cute.AbstractControl.prototype.setup.call(this, e);
	this.video_ele.setAttribute("allowFullScreen", "");
	this.video_ele.setAttribute("frameborder", "0");
	this.overPlay.targ = this;
	this.overPlay.onclick = function ()
	{
		this.targ.showVideo()
	};
	this.overPlay.className = "play-btn";
	this.closeBtn.targ = this;
	this.closeBtn.onclick = function ()
	{
		this.targ.hideVideo()
	};
	this.closeBtn.className = "close-btn";
	this.videoContainer.className = "video-cont";
	this.domElement.style.width = "100%";
	this.domElement.style.height = "100%";
	this.video_ele.style.width = "100%";
	this.video_ele.style.height = "100%";
	this.video_ele.style.background = "black";
	this.domElement.appendChild(this.overPlay);
	this.domElement.appendChild(this.videoContainer);
	this.videoContainer.appendChild(this.closeBtn);
	this.videoContainer.style.display = "none";
	setOpacity(this.videoContainer, 0)
};
Cute.VideoControl.prototype.showVideo = function ()
{
	this.videoContainer.style.display = "";
	this.videoContainer.appendChild(this.video_ele);
	this.video_ele.className = this.data.className || this.config.css_class;
	if (this.video_ele.getAttribute("src") != this.data.getAttribute("href")) {
		this.video_ele.setAttribute("src", this.data.getAttribute("href") || "about:blank");
	}
	if (this.videoTween) {
		this.videoTween.stop();
	}
	this.videoTween = (new TWEEN.Tween(this)).to({vopacity: 100}, 400).onUpdate(this.videoFade).start();
	this.slider.rotator.pause()
};
Cute.VideoControl.prototype.hideVideo = function ()
{
	if (this.videoTween) {
		this.videoTween.stop();
	}
	this.videoTween = (new TWEEN.Tween(this)).to({vopacity: 0}, 400).onUpdate(this.videoFade).start();
	this.videoTween.onComplete(function ()
	{
		this.video_ele.setAttribute("src", "about:blank");
		this.videoContainer.removeChild(this.video_ele);
		this.videoContainer.style.display = "none"
	})
};
Cute.VideoControl.prototype.show = function ()
{
	this.data = this.slider.getCurrentSlide().pluginData.video;
	if (!this.data) {
		this.domElement.style.display = "none";
		return
	}
	this.domElement.style.display = "";
	Cute.AbstractControl.prototype.show.call(this)
};
Cute.VideoControl.prototype.hide = function ()
{
	Cute.AbstractControl.prototype.hide.call(this);
	this.showTween.onComplete(function ()
	{
		if (this.video_ele.parentElement) {
			this.videoContainer.removeChild(this.video_ele);
		}
		this.domElement.style.display = "none";
		this.videoContainer.style.display = "none";
		if (this.videoTween) {
			this.videoTween.stop()
		}
	})
};
Cute.LinkControl = function (e)
{
	Cute.AbstractControl.call(this, e);
	this.config = {css_class: "br-link"};
	this.domElement = document.createElement("div");
	this.domElement.style.position = "absolute"
};
Cute.rotatorControls.link = Cute.LinkControl;
Cute.LinkControl.prototype = new Cute.AbstractControl;
Cute.LinkControl.prototype.constructor = Cute.LinkControl;
Cute.LinkControl.prototype.setup = function (e)
{
	Cute.AbstractControl.prototype.setup.call(this, e);
	this.domElement.lc = this;
	this.domElement.style.width = "100%";
	this.domElement.style.height = "100%";
	this.domElement.style.cursor = "pointer"
};
Cute.LinkControl.prototype.gotoURL = function ()
{
	window.open(this.lc.link.href, this.lc.link.target || "_self")
};
Cute.LinkControl.prototype.show = function ()
{
	this.link = this.slider.getCurrentSlide().pluginData.link;
	if (this.link) {
		this.domElement.style.display = "";
		this.domElement.onclick = this.gotoURL
	}
	else {
		this.domElement.style.display = "none";
		this.domElement.onclick = null
	}
};
Cute.LinkControl.prototype.hide = function ()
{
	this.domElement.style.display = "none";
	this.domElement.onclick = null
};
Cute.Loading = function ()
{
	this.domElement = document.createElement("div");
	this.domElement.className = "br-loading";
	this.domElement.style.display = "none";
	this.animEle = document.createElement("div");
	this.animEle.className = "img";
	this.domElement.appendChild(this.animEle);
	this.opacity = 0
};
Cute.Loading.prototype = {
	constructor: Cute.Loading, opacityUpdate: function ()
	{
		setOpacity(this.domElement, this.opacity)
	}, show    : function ()
	{
		if (this.showTween) {
			this.showTween.stop();
		}
		this.domElement.style.display = "";
		this.showTween = (new TWEEN.Tween(this)).to({opacity: 100}, 450).onUpdate(this.opacityUpdate).start()
	}, hide    : function ()
	{
		if (this.showTween) {
			this.showTween.stop();
		}
		this.showTween = (new TWEEN.Tween(this)).to({opacity: 0}, 450).onUpdate(this.opacityUpdate).start();
		this.domElement.style.display = "none"
	}
};
Cute.ThumbList = function (e, t)
{
	Cute.AbstractControl.call(this, e);
	this.config = {css_class: "br-thumblist", type: "vertical"};
	this.domElement = document.createElement("div");
	this.thumbs = []
};
Cute.rotatorControls.thumblist = Cute.ThumbList;
Cute.ThumbList.prototype = new Cute.AbstractControl;
Cute.ThumbList.prototype.constructor = Cute.ThumbList;
Cute.ThumbList.prototype.setup = function (e)
{
	Cute.AbstractControl.prototype.setup.call(this, e);
	this.config.type = e.getAttribute("data-dir") || "vertical";
	this.config.autohide = e.getAttribute("data-autohide") == "true";
	this.domElement.className += " " + this.config.type;
	this.list = new Cute.ItemList(this.domElement);
	this.list.type = this.config.type;
	this.list.frame.className = "br-thumblist-frame";
	this.list.content.className = "br-thumblist-content";
	this.list.downright.className = "br-thumblist-next";
	this.list.upleft.className = "br-thumblist-previous";
	this.slider.addEventListener(Cute.SliderEvent.CHANGE_NEXT_SLIDE, this.update, this);
	var t;
	for (var n = 0, r = this.slider.getSlideList().length; n < r; ++n) {
		t = new Cute.ListThumb(this.slider.getSlideList()[n].thumb, this.slider, this);
		t.index = n;
		this.thumbs.push(t);
		this.list.addItem(t.element)
	}
	this.list.sc.setup()
};
Cute.ThumbList.prototype.update = function ()
{
	if (this.selectedThumb && this.slider.getCurrentSlideIndex() == this.selectedThumb.index) {
		return;
	}
	if (this.selectedThumb) {
		this.selectedThumb.unselect();
	}
	this.selectedThumb = this.thumbs[this.slider.getCurrentSlideIndex()];
	this.selectedThumb.select()
};
Cute.ThumbList.prototype.show = function ()
{
	if (this.config.autohide) {
		Cute.AbstractControl.prototype.show.call(this);
	}
	this.disable = false
};
Cute.ThumbList.prototype.hide = function ()
{
	if (this.config.autohide) {
		Cute.AbstractControl.prototype.hide.call(this);
	}
	this.disable = true
};
Cute.ListThumb = function (e, t, n)
{
	this.img = new Image;
	this.img.src = e;
	this.element = document.createElement("div");
	this.element.className = "br-list-thumb";
	this.select_ele = document.createElement("div");
	this.select_ele.className = "br-list-thumb-select";
	this.element.appendChild(this.img);
	this.element.appendChild(this.select_ele);
	setOpacity(this.select_ele, 0);
	this.opacity = 0;
	var r = this;
	if (n.list.sc.isTouch()) {
		this.element.addEventListener("touchend", function (e)
		{
			if (r.selected || n.disable || n.list.sc.moved) {
				return;
			}
			t.gotoSlide(r.index, true);
			e.preventDefault();
			e.stopPropagation()
		}, false)
	}
	else {
		this.element.onclick = function ()
		{
			if (r.selected || n.disable || n.list.sc.moved) {
				return;
			}
			t.gotoSlide(r.index, true)
		}
	}
};
Cute.ListThumb.prototype = {
	constructor: Cute.ListThumb, opacityUpdate: function ()
	{
		setOpacity(this.select_ele, this.opacity)
	}, select  : function ()
	{
		if (this.selected) {
			return;
		}
		this.selected = true;
		if (this.showTween) {
			this.showTween = null;
		}
		this.showTween = (new TWEEN.Tween(this)).to({opacity: 100}, 450).onUpdate(this.opacityUpdate).start()
	}, unselect: function ()
	{
		if (!this.selected) {
			return;
		}
		this.selected = false;
		if (this.showTween) {
			this.showTween = null;
		}
		this.showTween = (new TWEEN.Tween(this)).to({opacity: 0}, 450).onUpdate(this.opacityUpdate).start()
	}
};
Cute.InfoList = function (e, t)
{
	Cute.AbstractControl.call(this, e);
	this.config = {css_class: "br-infolist", type: "vertical"};
	this.domElement = document.createElement("div");
	this.items = []
};
Cute.rotatorControls.infolist = Cute.InfoList;
Cute.InfoList.prototype = new Cute.AbstractControl;
Cute.InfoList.prototype.constructor = Cute.InfoList;
Cute.InfoList.prototype.setup = function (e)
{
	Cute.AbstractControl.prototype.setup.call(this, e);
	this.config.type = e.getAttribute("data-dir") || "vertical";
	this.config.autohide = e.getAttribute("data-autohide") == "true";
	this.domElement.className += " " + this.config.type;
	this.list = new Cute.ItemList(this.domElement);
	this.list.type = this.config.type;
	this.list.frame.className = "br-infolist-frame";
	this.list.content.className = "br-infolist-content";
	this.list.downright.className = "br-infolist-next";
	this.list.upleft.className = "br-infolist-previous";
	this.slider.addEventListener(Cute.SliderEvent.CHANGE_NEXT_SLIDE, this.update, this);
	var t;
	for (var n = 0, r = this.slider.getSlideList().length; n < r; ++n) {
		t = new Cute.ListItem(this.slider.getSlideList()[n].pluginData.info, this.slider, this);
		t.index = n;
		this.items.push(t);
		this.list.addItem(t.element)
	}
	this.list.sc.setup()
};
Cute.InfoList.prototype.update = function ()
{
	if (this.selectedThumb && this.slider.getCurrentSlideIndex() == this.selectedThumb.index) {
		return;
	}
	if (this.selectedThumb) {
		this.selectedThumb.unselect();
	}
	this.selectedThumb = this.items[this.slider.getCurrentSlideIndex()];
	this.selectedThumb.select()
};
Cute.InfoList.prototype.show = function ()
{
	if (this.config.autohide) {
		Cute.AbstractControl.prototype.show.call(this);
	}
	this.disable = false
};
Cute.InfoList.prototype.hide = function ()
{
	if (this.config.autohide) {
		Cute.AbstractControl.prototype.hide.call(this);
	}
	this.disable = true
};
Cute.ListItem = function (e, t, n)
{
	this.element = document.createElement("div");
	this.element.className = "br-slist-item";
	this.select_ele = document.createElement("div");
	this.select_ele.className = "br-slist-item-select";
	this.content = document.createElement("div");
	this.content.innerHTML = e ? e.text : "";
	this.content.className = "br-slist-item-content";
	this.element.appendChild(this.select_ele);
	this.element.appendChild(this.content);
	setOpacity(this.select_ele, 0);
	this.opacity = 0;
	var r = this;
	if (n.list.sc.isTouch()) {
		this.element.addEventListener("touchend", function (e)
		{
			if (r.selected || n.disable || n.list.sc.moved) {
				return;
			}
			t.gotoSlide(r.index, true);
			e.preventDefault();
			e.stopPropagation()
		}, false)
	}
	else {
		this.element.onclick = function ()
		{
			if (r.selected || n.disable || n.list.sc.moved) {
				return;
			}
			t.gotoSlide(r.index, true)
		}
	}
};
Cute.ListItem.prototype = {
	constructor: Cute.ListThumb, opacityUpdate: function ()
	{
		setOpacity(this.select_ele, this.opacity)
	}, select  : function ()
	{
		if (this.selected) {
			return;
		}
		this.selected = true;
		if (this.showTween) {
			this.showTween = null;
		}
		this.showTween = (new TWEEN.Tween(this)).to({opacity: 100}, 450).onUpdate(this.opacityUpdate).start()
	}, unselect: function ()
	{
		if (!this.selected) {
			return;
		}
		this.selected = false;
		if (this.showTween) {
			this.showTween = null;
		}
		this.showTween = (new TWEEN.Tween(this)).to({opacity: 0}, 450).onUpdate(this.opacityUpdate).start()
	}
};
Cute.TouchNavigation = function (e, t)
{
	this.isTouch = function ()
	{
		try {
			document.createEvent("TouchEvent");
			return true
		}
		catch (e) {
			return false
		}
	};
	var n = this.isTouch();
	var r = false;
	var i = 0;
	var s = 0;
	var o;
	this.__touchStart = function (e)
	{
		r = true;
		s = i = e.touches[0].pageX;
		o = setTimeout(function ()
		{
			r = false
		}, 3e3)
	};
	this.__touchMove = function (e)
	{
		if (!r) {
			return;
		}
		if (Math.abs(s - e.touches[0].pageX) >= 10) {
			e.preventDefault();
		}
		s = e.touches[0].pageX
	};
	this.__touchEnd = function (n)
	{
		if (!r) {
			return;
		}
		r = false;
		clearTimeout(o);
		if (s - i > e.offsetWidth / 10) {
			t.next();
		}
		else if (s - i < -e.offsetWidth / 10) {
			t.previous();
		}
		i = s = 0
	};
	if (n) {
		e.addEventListener("touchstart", this.__touchStart);
		e.addEventListener("touchmove", this.__touchMove);
		e.addEventListener("touchend", this.__touchEnd)
	}
};
Cute.Slider = function ()
{
	this.slides = [];
	this.controls = [];
	this.slideManager = new Cute.SlideManager;
	this.imgLoaded = false;
	this.mlcl = false;
	this.api = this.slideManager
};
Cute.Slider.prototype = {
	constructor          : Cute.Slider, setup: function (e, t, n)
	{
		yepnope.injectCss(n);
		this.fallBack = new Cute.FallBack;
		this.element = document.getElementById(e);
		this.wrapper = document.getElementById(t);
		if (Cute.FallBack.isIE) {
			this.element.className += " cute-ie";
		}
		else if (Cute.isMobileDevice) {
			this.element.className += " cute-device";
		}
		if (Cute.FallBack.isIE8) {
			this.element.className += " cute-ie8";
		}
		else if (Cute.FallBack.isIE7) {
			this.element.className += " cute-ie7";
		}
		this.wrapper.slider = this;
		window.addResizeListener(this.__onresize, this);
		this.aspect = Number(this.element.getAttribute("data-width")) / Number(this.element.getAttribute("data-height"));
		this.__setSize();
		this.slideManager.resize();
		this.slideManager.rotator = this;
		this.controlLayer = document.createElement("div");
		this.controlLayer.style.visibility = "hidden";
		this.contentLoading = new Cute.Loading;
		this.contentLoading.domElement.className = "br-large-loading";
		this.contentLoading.show();
		this.element.appendChild(this.contentLoading.domElement);
		if (this.element.getAttribute("data-force")) {
			this.fallBack.force = this.element.getAttribute("data-force");
		}
		var r = this.element.getElementsByTagName("ul");
		for (var i = 0, s = r.length; i < s; ++i) {
			if (r[i].getAttribute("data-type") == "slides") {
				this.slidesElement = r[i];
			}
			else if (r[i].getAttribute("data-type") == "controls") {
				this;
			}
			this.controlsElement = r[i]
		}
		if (this.element.getAttribute("data-shuffle") == "true") {
			this.__shuffleSlides();
		}
		this.__createSlides();
		if (this.controlsElement) {
			this.__createControls();
		}
		this.element.appendChild(this.slideManager.domElement);
		document.getElementById(e).style.visibility = "visible";
		document.getElementById(e).style.overflow = "visible";
		var o = new Cute.ModuleLoader(this.fallBack);
		o.onComplete = {listener: this.__onModuleReady, ref: this};
		o.loadModule()
	}, __shuffleSlides   : function ()
	{
		var e = this.slidesElement.children;
		var t = e[0].getElementsByTagName("img")[0];
		t.setAttribute("data-src", t.getAttribute("src"));
		for (var n = 0, i = e.length; n < i; ++n) {
			r = Math.floor(Math.random() * (i - 1));
			if (n != r) {
				this.slidesElement.insertBefore(e[n], e[r]);
				e = this.slidesElement.children
			}
		}
		t = e[0].getElementsByTagName("img")[0];
		t.setAttribute("src", t.getAttribute("data-src"))
	}, __setSize         : function ()
	{
		this.slideManager.width = this.wrapper.clientWidth;
		this.slideManager.height = this.wrapper.clientWidth / this.aspect;
		this.slideManager.vpWidth = this.slideManager.width + this.slideManager.width * .2;
		this.slideManager.vpHeight = this.slideManager.height + this.slideManager.height * .2;
		this.element.style.width = this.slideManager.width + "px";
		this.element.style.height = this.slideManager.height + "px";
		this.lastWidth = this.slideManager.width
	}, __onresize        : function ()
	{
		if (this.lastWidth == this.wrapper.clientWidth) {
			return;
		}
		this.__setSize();
		this.slideManager.resize()
	}, __onModuleReady   : function ()
	{
		this.mlcl = true;
		if (this.imgLoaded) {
			this.__start()
		}
	}, __onImgLoaded     : function ()
	{
		this.slide.addContent(this);
		if (this.rotator.mlcl) {
			this.rotator.__start();
		}
		this.rotator.imgLoaded = true;
		this.slide = null;
		this.rotator = null
	}, __start           : function ()
	{
		var e = this.fallBack.getType();
		switch (e) {
			case Cute.FallBack.CANVAS:
				this.slideManager._viewClass = Aroma.ThreeView;
				break;
			case Cute.FallBack.CSS3D:
				this.slideManager._viewClass = Aroma.CSS3DView;
				Aroma.CSS3DCube.light = !Cute.FallBack.isMobileDevice;
				break;
			case Cute.FallBack.DOM2D:
				this.slideManager._viewClass = Aroma.DivView;
				break
		}
		this.showControls();
		this.slideManager.start();
		if (!Cute.Ticker.Tweenisadded) {
			Cute.Ticker.add(TWEEN.update, TWEEN);
			Cute.Ticker.Tweenisadded = true
		}
		Cute.Ticker.add(this.slideManager._timer.update, this.slideManager._timer);
		Cute.Ticker.start();
		this.element.removeChild(this.contentLoading.domElement)
	}, __parseTransValues: function (e, t)
	{
		var n = [];
		var r = e.split(" ").join().split(",");
		for (var i = 0, s = r.length; i < s; i++) {
			if (t) {
				if (Transitions2D[r[i]]) {
					n.push(Transitions2D[r[i]])
				}
			}
			else {
				if (Transitions3D[r[i]]) {
					n.push(Transitions3D[r[i]])
				}
			}
		}
		r = null;
		return n
	}, __createSlides    : function ()
	{
		var e = null;
		var t = 0;
		while (this.slidesElement.children.length != 0) {
			var n = this.slidesElement.firstElementChild || this.slidesElement.children[0];
			e = new Cute.Slide(this.slideManager);
			e.dataElement = n;
			e.delay = n.getAttribute("data-delay");
			e.transitions2D = this.__parseTransValues(n.getAttribute("data-trans2d"), true);
			e.transitions3D = this.__parseTransValues(n.getAttribute("data-trans3d"), false);
			e.rotator = this;
			var r = n.children;
			for (var i = 0, s = r.length; i < s; ++i) {
				if (r[i].nodeName === "IMG") {
					if (t == 0) {
						e.src = r[i].getAttribute("src");
						var o = new Image;
						o.slide = e;
						o.rotator = this;
						o.onload = this.__onImgLoaded;
						o.src = e.src
					}
					else {
						e.src = r[i].getAttribute("data-src")
					}
					e.thumb = r[i].getAttribute("data-thumb");
					continue
				}
				if (r[i].nodeName === "DIV" && r[i].getAttribute("data-type") == "info") {
					e.pluginData.info = {
						text  : r[i].innerHTML,
						_class: r[i].className,
						align : r[i].getAttribute("data-align") || "bottom",
						delay : Number(r[i].getAttribute("data-delay")) || 0
					};
					continue
				}
				if (r[i].nodeName === "UL" && r[i].getAttribute("data-type") == "captions") {
					e.pluginData.captions = r[i];
					continue
				}
				if (r[i].nodeName === "A" && r[i].getAttribute("data-type") == "video") {
					e.pluginData.video = r[i];
					continue
				}
				if (r[i].nodeName === "A" && r[i].getAttribute("data-type") == "link") {
					e.pluginData.link = {href: r[i].getAttribute("href"), target: r[i].getAttribute("target")};
					continue
				}
			}
			this.slides.push(e);
			this.slideManager.pushSlide(e);
			this.slidesElement.removeChild(n);
			t++
		}
		this.element.removeChild(this.slidesElement)
	}, __createControls  : function ()
	{
		var e = this.controlsElement.getElementsByTagName("li");
		var t;
		var n;
		this.element.appendChild(this.controlLayer);
		this.controlLayer.className = "br-controls";
		if (this.element.getAttribute("data-overpause") != "false" && !Cute.FallBack.isMobileDevice) {
			this.controlLayer.slideManager = this.slideManager;
			this.controlLayer.rotator = this;
			var r = function ()
			{
				if (this.slideManager._status == "changing" || this.slideManager._status == "loading") {
					return;
				}
				this.slideManager.setAutoPlay(false)
			};
			var i = function ()
			{
				if (!Cute.AbstractControl.paused) {
					if (this.slideManager._status == "changing" || this.slideManager._status == "loading") {
						this.rotator.ap = true;
						return
					}
					this.rotator.ap = false;
					this.slideManager.setAutoPlay(true)
				}
			};
			this.controlLayer.onmouseover = r;
			this.controlLayer.onmouseout = i;
			this.slideManager.addEventListener(Cute.SliderEvent.CHANGE_END, this.__effEnd, this)
		}
		var s = new Cute.TouchNavigation(this.controlLayer, this.api);
		this.controlLayer.style.width = "100%";
		this.controlLayer.style.height = "100%";
		for (var o = 0, u = e.length; o < u; ++o) {
			t = e[o].getAttribute("data-type");
			if (t && Cute.rotatorControls[t]) {
				n = new Cute.rotatorControls[t](this.slideManager);
				this.controlLayer.appendChild(n.domElement);
				n.setup(e[o]);
				this.controls.push(n)
			}
		}
		this.loading = new Cute.Loading;
		this.element.appendChild(this.loading.domElement);
		this.slideManager.addEventListener(Cute.SliderEvent.WATING_FOR_NEXT, this.showLoading, this);
		this.slideManager.addEventListener(Cute.SliderEvent.CHANGE_START, this.hideLoading, this);
		this.element.removeChild(this.controlsElement)
	}, __effEnd          : function (e)
	{
		if (this.ap) {
			this.slideManager.setAutoPlay(true)
		}
	}, showLoading       : function (e)
	{
		this.lis = true;
		this.loading.show()
	}, hideLoading       : function (e)
	{
		if (this.lis) {
			this.lis = false;
			this.loading.hide()
		}
	}, showControls      : function ()
	{
		this.contentLoading.hide();
		this.controlLayer.style.visibility = "visible"
	}, play              : function ()
	{
		Cute.AbstractControl.paused = false;
		this.api.setAutoPlay(true)
	}, pause             : function ()
	{
		Cute.AbstractControl.paused = true;
		this.api.setAutoPlay(false)
	}
};
// source --> http://www.turktakip.net/wp-content/plugins/CuteSlider/js/cute.transitions.all.js?ver=1.1.1 
window.Transitions2D={tr41:{duration:1.8,overlapping:.05,row:5,col:1,selector:new Aroma.SerialSelector,effect:new Cute.Effect4({ease:TWEEN.Easing.Exponential,dir:"horizontal",push:true})},tr40:{duration:1.8,overlapping:.001,row:5,col:1,selector:new Aroma.SerialSelector,effect:new Cute.Effect4({ease:TWEEN.Easing.Exponential,push:true})},tr39:{duration:1.8,overlapping:.05,row:1,col:8,selector:new Aroma.SerialSelector,effect:new Cute.Effect4({ease:TWEEN.Easing.Exponential,push:true})},tr38:{duration:1.8,overlapping:.02,row:2,col:4,selector:new Aroma.SerialSelector,effect:new Cute.Effect3({ease:TWEEN.Easing.Exponential,push:true})},tr37:{duration:1.8,overlapping:.02,row:1,col:10,selector:new Aroma.SerialSelector,effect:new Cute.Effect3({ease:TWEEN.Easing.Quartic,push:true})},tr36:{duration:1.2,overlapping:.05,row:5,col:1,selector:new Aroma.SerialSelector,effect:new Cute.Effect3({ease:TWEEN.Easing.Quartic,push:true})},tr35:{duration:2.2,overlapping:.02,row:1,col:10,selector:new Aroma.RandSelector,effect:new Cute.Effect2({ease:TWEEN.Easing.Quartic,dir:"t",push:true})},tr34:{duration:2.2,overlapping:.03,row:1,col:10,selector:new Aroma.SerialSelector,effect:new Cute.Effect2({ease:TWEEN.Easing.Exponential,dir:"t",push:true})},tr33:{duration:2,overlapping:.04,row:4,col:4,selector:new Aroma.RandSelector,effect:new Cute.Effect2({ease:TWEEN.Easing.Quintic,dir:"br",push:false})},tr32:{duration:2,overlapping:.04,row:4,col:4,selector:new Aroma.RandSelector,effect:new Cute.Effect2({ease:TWEEN.Easing.Quintic,dir:"tl",push:false})},tr31:{duration:2,overlapping:.04,row:4,col:4,selector:new Aroma.SerialSelector,effect:new Cute.Effect2({ease:TWEEN.Easing.Quintic,dir:"tl",push:false})},tr30:{duration:2,overlapping:.05,row:5,col:1,selector:new Aroma.SerialSelector,effect:new Cute.Effect2({ease:TWEEN.Easing.Quintic,dir:"tl",push:true})},tr29:{duration:2,overlapping:.05,row:4,col:4,selector:new Aroma.DiagonalSelector,effect:new Cute.Effect2({ease:TWEEN.Easing.Quintic,dir:"tl",push:true})},tr28:{duration:2,overlapping:.05,row:1,col:8,selector:new Aroma.SerialSelector,effect:new Cute.Effect2({ease:TWEEN.Easing.Quintic,dir:"bl",push:true})},tr27:{duration:2,overlapping:.05,row:1,col:8,selector:new Aroma.SerialSelector,effect:new Cute.Effect2({ease:TWEEN.Easing.Quintic,dir:"b",push:true})},tr26:{duration:2,overlapping:.05,row:1,col:8,selector:new Aroma.SerialSelector,effect:new Cute.Effect2({ease:TWEEN.Easing.Quintic,dir:"b"})},tr25:{duration:2,overlapping:.05,row:1,col:8,selector:new Aroma.SerialSelector,effect:new Cute.Effect2({ease:TWEEN.Easing.Quintic,dir:"t"})},tr24:{duration:2,overlapping:.06,row:5,col:1,selector:new Aroma.RandSelector,effect:new Cute.Effect2({ease:TWEEN.Easing.Exponential,dir:"l",push:true})},tr23:{duration:2,overlapping:.06,row:5,col:1,selector:new Aroma.RandSelector,effect:new Cute.Effect2({ease:TWEEN.Easing.Exponential,dir:"r"})},tr22:{duration:2,overlapping:.06,row:5,col:1,selector:new Aroma.SerialSelector,effect:new Cute.Effect2({ease:TWEEN.Easing.Exponential,dir:"r"})},tr21:{duration:2,overlapping:.06,row:5,col:1,selector:new Aroma.SerialSelector,effect:new Cute.Effect2({ease:TWEEN.Easing.Exponential,dir:"l"})},tr20:{duration:2.2,overlapping:.05,row:5,col:1,selector:new Aroma.SerialSelector,effect:new Cute.Effect2({ease:TWEEN.Easing.Exponential,dir:"l",push:true})},tr19:{duration:1.4,overlapping:.05,row:1,col:10,selector:new Aroma.SerialSelector,effect:new Cute.Effect2({ease:TWEEN.Easing.Quartic,dir:"l",push:true})},tr18:{duration:1.8,overlapping:1e-4,row:1,col:1,selector:new Aroma.SerialSelector,effect:new Cute.Effect2({ease:TWEEN.Easing.Quintic,dir:"l"})},tr17:{duration:1.8,overlapping:1e-4,row:1,col:1,selector:new Aroma.SerialSelector,effect:new Cute.Effect2({ease:TWEEN.Easing.Quintic,dir:"b"})},tr16:{duration:1.8,overlapping:1e-4,row:1,col:1,selector:new Aroma.SerialSelector,effect:new Cute.Effect2({ease:TWEEN.Easing.Quintic,dir:"b",push:true})},tr15:{duration:1.4,overlapping:1e-4,row:1,col:1,selector:new Aroma.SerialSelector,effect:new Cute.Effect2({ease:TWEEN.Easing.Quartic,dir:"t",push:true})},tr14:{duration:1.8,overlapping:1e-4,row:1,col:1,selector:new Aroma.SerialSelector,effect:new Cute.Effect2({ease:TWEEN.Easing.Quintic,dir:"l",push:true})},tr13:{duration:1.8,overlapping:1e-4,row:1,col:1,selector:new Aroma.SerialSelector,effect:new Cute.Effect2({ease:TWEEN.Easing.Quintic,push:true})},tr12:{duration:1.2,overlapping:.025,row:5,col:5,selector:new Aroma.RandSelector,effect:new Cute.Effect1},tr11:{duration:1.2,overlapping:.025,row:5,col:5,selector:new Aroma.DiagonalSelector("tr"),effect:new Cute.Effect1},tr10:{duration:1.2,overlapping:.025,row:5,col:5,selector:new Aroma.DiagonalSelector("tl"),effect:new Cute.Effect1},tr9:{duration:1.2,overlapping:.025,row:5,col:5,selector:new Aroma.DiagonalSelector("bl"),effect:new Cute.Effect1},tr8:{duration:1.5,overlapping:.025,row:5,col:5,selector:new Aroma.DiagonalSelector("br"),effect:new Cute.Effect1},tr7:{duration:1.8,overlapping:.05,row:5,col:5,selector:new Aroma.SerialSelector("brl",false),effect:new Cute.Effect1},tr6:{duration:1.7,overlapping:.05,row:5,col:5,selector:new Aroma.SerialSelector("trl",true),effect:new Cute.Effect1},tr5:{duration:.9,overlapping:.08,row:8,col:1,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect1},tr4:{duration:.9,overlapping:.08,row:8,col:1,selector:new Aroma.SerialSelector("brl"),effect:new Cute.Effect1},tr3:{duration:.9,overlapping:.08,row:1,col:10,selector:new Aroma.RandSelector,effect:new Cute.Effect1},tr2:{duration:1.2,overlapping:.05,row:1,col:10,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect1},tr1:{duration:1.2,overlapping:.08,row:1,col:10,selector:new Aroma.SerialSelector,effect:new Cute.Effect1}};window.Transitions3D={tr64:{duration:4.5,overlapping:.021,row:4,col:4,selector:new Aroma.RandSelector,effect:new Cute.Effect12({ease:TWEEN.Easing.Back,zmove:-600,depth:10,sidecolor:7829367})},tr63:{duration:4.5,overlapping:.021,row:4,col:4,selector:new Aroma.RandSelector,effect:new Cute.Effect11({ease:TWEEN.Easing.Back,dir:"tl",zmove:-600,depth:10,sidecolor:7829367})},tr62:{duration:3.5,overlapping:.021,row:1,col:10,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect11({ease:TWEEN.Easing.Quartic,dir:"tr",zmove:-100,depth:10,sidecolor:7829367})},tr61:{duration:3.5,overlapping:.021,row:1,col:5,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect11({ease:TWEEN.Easing.Quartic,dir:"tr",zmove:-400,depth:10,sidecolor:7829367})},tr60:{duration:3.5,overlapping:.021,row:1,col:7,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect10({ease:TWEEN.Easing.Exponential,dir:"tr",zmove:-400,depth:20,sidecolor:7829367})},tr59:{duration:3.5,overlapping:1e-4,row:5,col:1,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect10({ease:TWEEN.Easing.Exponential,depth:20,sidecolor:7829367})},tr58:{duration:3.5,overlapping:.08,row:1,col:4,selector:new Aroma.RandSelector,effect:new Cute.Effect10({ease:TWEEN.Easing.Exponential,zmove:-100,dir:"vertical",sidecolor:7829367})},tr57:{duration:3.5,overlapping:.08,row:1,col:8,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect10({ease:TWEEN.Easing.Exponential,zmove:-100,dir:"vertical",sidecolor:7829367})},tr56:{duration:3.5,overlapping:1e-4,row:1,col:8,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect10({ease:TWEEN.Easing.Exponential,zmove:-700,sidecolor:7829367})},tr55:{duration:3.5,overlapping:1e-4,row:5,col:1,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect10({ease:TWEEN.Easing.Exponential,zmove:-1200,dir:"horizontal",sidecolor:7829367})},tr54:{duration:2.8,overlapping:.03,row:4,col:1,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect10({ease:TWEEN.Easing.Exponential,zmove:-1200,dir:"horizontal",sidecolor:7829367,depth:20})},tr53:{duration:3.5,overlapping:.03,row:1,col:7,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect10({ease:TWEEN.Easing.Exponential,sidecolor:7829367,depth:20})},tr52:{duration:2,overlapping:.07,row:5,col:1,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect10({ease:TWEEN.Easing.Cubic,dir:"horizontal",sidecolor:7829367,yspace:5,zmove:-1e3})},tr51:{duration:3.5,overlapping:.08,row:6,col:1,selector:new Aroma.SerialSelector("brl"),effect:new Cute.Effect10({ease:TWEEN.Easing.Exponential,zmove:-1200,dir:"horizontal",sidecolor:7829367})},tr50:{duration:3.5,overlapping:.08,row:6,col:1,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect10({ease:TWEEN.Easing.Exponential,zmove:-1200,dir:"horizontal",sidecolor:7829367})},tr49:{duration:3.5,overlapping:.021,row:1,col:8,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect10({ease:TWEEN.Easing.Exponential,dir:"horizontal",xspace:-20,depth:10,sidecolor:7829367})},tr48:{duration:3.5,overlapping:.021,row:4,col:1,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect10({ease:TWEEN.Easing.Exponential,dir:"vertical",yspace:-20,depth:10,sidecolor:7829367})},tr47:{duration:3.5,overlapping:.021,row:8,col:1,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect10({ease:TWEEN.Easing.Exponential,dir:"vertical",depth:10,sidecolor:7829367})},tr46:{duration:3.5,overlapping:.021,row:1,col:8,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect10({ease:TWEEN.Easing.Exponential,dir:"tr",depth:10,sidecolor:7829367})},tr45:{duration:1.6,overlapping:.07,row:5,col:1,selector:new Aroma.SerialSelector("brl"),effect:new Cute.Effect10({ease:TWEEN.Easing.Cubic,dir:"horizontal",sidecolor:7829367})},tr44:{duration:2.5,overlapping:.02,row:1,col:8,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect10({ease:TWEEN.Easing.Exponential,dir:"vertical",sidecolor:7829367})},tr43:{duration:1.5,overlapping:.03,row:5,col:1,selector:new Aroma.SerialSelector("brl"),effect:new Cute.Effect9({ease:TWEEN.Easing.Cubic,sidecolor:7829367})},tr42:{duration:2.5,overlapping:.03,row:1,col:8,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect9({ease:TWEEN.Easing.Exponential,xspace:5,zmove:-500,sidecolor:7829367})},tr41:{duration:2.5,overlapping:.03,row:1,col:7,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect9({ease:TWEEN.Easing.Exponential,depth:10,xspace:5,zmove:-500,sidecolor:7829367})},tr40:{duration:3.5,overlapping:.02,row:3,col:1,selector:new Aroma.RandSelector,effect:new Cute.Effect9({ease:TWEEN.Easing.Back,depth:15,sidecolor:7829367,zmove:-200})},tr39:{duration:3.5,overlapping:.02,row:2,col:3,selector:new Aroma.RandSelector,effect:new Cute.Effect9({ease:TWEEN.Easing.Exponential,depth:15,sidecolor:7829367,zmove:-200})},tr38:{duration:3.5,overlapping:.02,row:1,col:5,selector:new Aroma.SerialSelector,effect:new Cute.Effect9({ease:TWEEN.Easing.Exponential,depth:15,sidecolor:7829367,zmove:-200})},tr37:{duration:3.5,overlapping:.02,row:1,col:7,selector:new Aroma.SerialSelector,effect:new Cute.Effect9({ease:TWEEN.Easing.Exponential,depth:10,sidecolor:7829367})},tr36:{duration:2.3,overlapping:.08,row:2,col:1,selector:new Aroma.SerialSelector,effect:new Cute.Effect8({ease:TWEEN.Easing.Exponential,dir:"l",zmove:-1700,xspace:5,sidecolor:7829367})},tr35:{duration:3.3,overlapping:.03,row:1,col:7,selector:new Aroma.SerialSelector,effect:new Cute.Effect8({ease:TWEEN.Easing.Back,dir:"u",zmove:-600,stack:true,xspace:5,sidecolor:7829367})},tr34:{duration:3.3,overlapping:.03,row:1,col:5,selector:new Aroma.SerialSelector,effect:new Cute.Effect8({ease:TWEEN.Easing.Back,dir:"r",zmove:-600,stack:true,xspace:5,sidecolor:7829367})},tr33:{duration:3.3,overlapping:.03,row:5,col:1,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect8({ease:TWEEN.Easing.Back,dir:"r",zmove:-600,stack:true,yspace:5,sidecolor:7829367})},tr32:{duration:2.8,overlapping:.03,row:1,col:5,selector:new Aroma.SerialSelector,effect:new Cute.Effect8({ease:TWEEN.Easing.Exponential,sidecolor:3355443,depth:10,dir:"l"})},tr31:{duration:2.8,overlapping:.03,row:8,col:1,selector:new Aroma.SerialSelector,effect:new Cute.Effect8({ease:TWEEN.Easing.Exponential,sidecolor:3355443,depth:10,dir:"u"})},tr30:{duration:2.3,overlapping:.03,row:5,col:1,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect8({ease:TWEEN.Easing.Exponential,dir:"r",zmove:-1500,yspace:5,sidecolor:7829367})},tr29:{duration:4.6,overlapping:.01,row:11,col:1,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect8({ease:TWEEN.Easing.Back,dir:"r",zmove:-600,yspace:5,sidecolor:3355443,stack:true,balance:.6})},tr28:{duration:2.8,overlapping:.03,row:4,col:1,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect8({ease:TWEEN.Easing.Exponential,dir:"r",zmove:-1600,sidecolor:3355443,depth:18})},tr27:{duration:1.6,overlapping:.05,row:5,col:1,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect8({ease:TWEEN.Easing.Cubic,dir:"r",zmove:-800,sidecolor:3355443,depth:20})},tr26:{duration:2.5,overlapping:.02,row:1,col:8,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect8({ease:TWEEN.Easing.Exponential,sidecolor:3355443,depth:20})},tr25:{duration:2.8,overlapping:.03,row:8,col:1,selector:new Aroma.SerialSelector,effect:new Cute.Effect8({ease:TWEEN.Easing.Exponential,sidecolor:3355443,dir:"u"})},tr24:{duration:2.8,overlapping:.03,row:1,col:13,selector:new Aroma.SerialSelector,effect:new Cute.Effect8({ease:TWEEN.Easing.Exponential,sidecolor:3355443,dir:"l"})},tr23:{duration:2.3,overlapping:.05,row:5,col:1,selector:new Aroma.SerialSelector,effect:new Cute.Effect8({ease:TWEEN.Easing.Cubic,sidecolor:3355443,dir:"r",yspace:5,zmove:-1200})},tr22:{duration:2,overlapping:.03,row:1,col:8,selector:new Aroma.SerialSelector("brl"),effect:new Cute.Effect8({ease:TWEEN.Easing.Back,sidecolor:3355443,side:"t"})},tr21:{duration:2.8,overlapping:.03,row:5,col:1,selector:new Aroma.RandSelector,effect:new Cute.Effect8({ease:TWEEN.Easing.Exponential,sidecolor:3355443,dir:"l"})},tr20:{duration:2.8,overlapping:.03,row:5,col:1,selector:new Aroma.SerialSelector("brl"),effect:new Cute.Effect8({ease:TWEEN.Easing.Exponential,sidecolor:3355443,dir:"l"})},tr19:{duration:2.2,overlapping:.02,row:1,col:8,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect8({ease:TWEEN.Easing.Exponential,sidecolor:3355443})},tr18:{duration:2,overlapping:1e-4,row:5,col:1,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect7({ease:TWEEN.Easing.Exponential})},tr17:{duration:1.7,overlapping:.08,row:1,col:5,selector:new Aroma.SerialSelector,effect:new Cute.Effect7({ease:TWEEN.Easing.Quintic})},tr16:{duration:1.7,overlapping:.03,row:8,col:1,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect7({ease:TWEEN.Easing.Back,xspace:15})},tr15:{duration:1.7,overlapping:.07,row:4,col:1,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect7({ease:TWEEN.Easing.Quartic,dir:"horizontal"})},tr14:{duration:1.7,overlapping:.05,row:1,col:4,selector:new Aroma.SerialSelector("trl"),effect:new Cute.Effect7({ease:TWEEN.Easing.Back})},tr13:{duration:1.6,overlapping:.07,row:2,col:4,selector:new Aroma.SerialSelector,effect:new Cute.Effect6({ease:TWEEN.Easing.Back,side:"l"})},tr12:{duration:1.6,overlapping:.07,row:1,col:6,selector:new Aroma.SerialSelector,effect:new Cute.Effect6({ease:TWEEN.Easing.Back,side:"t"})},tr11:{duration:3.5,overlapping:.025,row:5,col:1,selector:new Aroma.RandSelector,effect:new Cute.Effect5({ease:TWEEN.Easing.Exponential,side:"r"})},tr10:{duration:3.5,overlapping:.025,row:1,col:5,selector:new Aroma.RandSelector,effect:new Cute.Effect5({ease:TWEEN.Easing.Exponential,side:"t"})},tr9:{duration:2,overlapping:.08,row:5,col:1,selector:new Aroma.SerialSelector,effect:new Cute.Effect5({ease:TWEEN.Easing.Quadratic,side:"r",zmove:-800})},tr8:{duration:2.4,overlapping:.04,row:1,col:10,selector:new Aroma.SerialSelector,effect:new Cute.Effect5({ease:TWEEN.Easing.Quartic,side:"b",zmove:-800})},tr7:{duration:2,overlapping:.07,row:5,col:1,selector:new Aroma.SerialSelector("blu"),effect:new Cute.Effect5({ease:TWEEN.Easing.Cubic,side:"r",zmove:-550})},tr6:{duration:1.7,overlapping:.03,row:1,col:8,selector:new Aroma.SerialSelector,effect:new Cute.Effect5({ease:TWEEN.Easing.Back,side:"t",zmove:-250})},tr5:{duration:2.6,overlapping:.03,row:5,col:1,selector:new Aroma.RandSelector,effect:new Cute.Effect5({ease:TWEEN.Easing.Exponential,side:"r"})},tr4:{duration:1.8,overlapping:.08,row:5,col:1,selector:new Aroma.SerialSelector,effect:new Cute.Effect5({ease:TWEEN.Easing.Quartic,side:"l",zmove:-600})},tr3:{duration:1.8,overlapping:.08,row:5,col:1,selector:new Aroma.SerialSelector,effect:new Cute.Effect5({ease:TWEEN.Easing.Quartic,side:"l"})},tr2:{duration:1.6,overlapping:.08,row:5,col:1,selector:new Aroma.SerialSelector,effect:new Cute.Effect5({ease:TWEEN.Easing.Cubic,side:"b"})},tr1:{duration:1.6,overlapping:.08,row:1,col:7,selector:new Aroma.SerialSelector,effect:new Cute.Effect5({ease:TWEEN.Easing.Cubic,side:"l"})}};