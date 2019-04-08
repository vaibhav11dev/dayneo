(function(a, b) {
    a.ui = a.ui || {};
    var c, d = Math.max, e = Math.abs, f = Math.round, g = /left|center|right/, h = /top|center|bottom/, i = /[\+\-]\d+(\.[\d]+)?%?/, j = /^\w+/, k = /%$/, l = a.fn.pos;
    function m(a, b, c) {
        return [ parseFloat(a[0]) * (k.test(a[0]) ? b / 100 : 1), parseFloat(a[1]) * (k.test(a[1]) ? c / 100 : 1) ];
    }
    function n(b, c) {
        return parseInt(a.css(b, c), 10) || 0;
    }
    function o(b) {
        var c = b[0];
        if (c.nodeType === 9) {
            return {
                width: b.width(),
                height: b.height(),
                offset: {
                    top: 0,
                    left: 0
                }
            };
        }
        if (a.isWindow(c)) {
            return {
                width: b.width(),
                height: b.height(),
                offset: {
                    top: b.scrollTop(),
                    left: b.scrollLeft()
                }
            };
        }
        if (c.preventDefault) {
            return {
                width: 0,
                height: 0,
                offset: {
                    top: c.pageY,
                    left: c.pageX
                }
            };
        }
        return {
            width: b.outerWidth(),
            height: b.outerHeight(),
            offset: b.offset()
        };
    }
    a.pos = {
        scrollbarWidth: function() {
            if (c !== b) {
                return c;
            }
            var d, e, f = a("<div style='display:block;position:absolute;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'></div></div>"), g = f.children()[0];
            a("body").append(f);
            d = g.offsetWidth;
            f.css("overflow", "scroll");
            e = g.offsetWidth;
            if (d === e) {
                e = f[0].clientWidth;
            }
            f.remove();
            return c = d - e;
        },
        getScrollInfo: function(b) {
            var c = b.isWindow || b.isDocument ? "" : b.element.css("overflow-x"), d = b.isWindow || b.isDocument ? "" : b.element.css("overflow-y"), e = c === "scroll" || c === "auto" && b.width < b.element[0].scrollWidth, f = d === "scroll" || d === "auto" && b.height < b.element[0].scrollHeight;
            return {
                width: f ? a.pos.scrollbarWidth() : 0,
                height: e ? a.pos.scrollbarWidth() : 0
            };
        },
        getWithinInfo: function(b) {
            var c = a(b || window), d = a.isWindow(c[0]), e = !!c[0] && c[0].nodeType === 9;
            return {
                element: c,
                isWindow: d,
                isDocument: e,
                offset: c.offset() || {
                    left: 0,
                    top: 0
                },
                scrollLeft: c.scrollLeft(),
                scrollTop: c.scrollTop(),
                width: d ? c.width() : c.outerWidth(),
                height: d ? c.height() : c.outerHeight()
            };
        }
    };
    a.fn.pos = function(b) {
        if (!b || !b.of) {
            return l.apply(this, arguments);
        }
        b = a.extend({}, b);
        var c, k, p, q, r, s, t = a(b.of), u = a.pos.getWithinInfo(b.within), v = a.pos.getScrollInfo(u), w = (b.collision || "flip").split(" "), x = {};
        s = o(t);
        if (t[0].preventDefault) {
            b.at = "left top";
        }
        k = s.width;
        p = s.height;
        q = s.offset;
        r = a.extend({}, q);
        a.each([ "my", "at" ], function() {
            var a = (b[this] || "").split(" "), c, d;
            if (a.length === 1) {
                a = g.test(a[0]) ? a.concat([ "center" ]) : h.test(a[0]) ? [ "center" ].concat(a) : [ "center", "center" ];
            }
            a[0] = g.test(a[0]) ? a[0] : "center";
            a[1] = h.test(a[1]) ? a[1] : "center";
            c = i.exec(a[0]);
            d = i.exec(a[1]);
            x[this] = [ c ? c[0] : 0, d ? d[0] : 0 ];
            b[this] = [ j.exec(a[0])[0], j.exec(a[1])[0] ];
        });
        if (w.length === 1) {
            w[1] = w[0];
        }
        if (b.at[0] === "right") {
            r.left += k;
        } else if (b.at[0] === "center") {
            r.left += k / 2;
        }
        if (b.at[1] === "bottom") {
            r.top += p;
        } else if (b.at[1] === "center") {
            r.top += p / 2;
        }
        c = m(x.at, k, p);
        r.left += c[0];
        r.top += c[1];
        return this.each(function() {
            var g, h, i = a(this), j = i.outerWidth(), l = i.outerHeight(), o = n(this, "marginLeft"), s = n(this, "marginTop"), y = j + o + n(this, "marginRight") + v.width, z = l + s + n(this, "marginBottom") + v.height, A = a.extend({}, r), B = m(x.my, i.outerWidth(), i.outerHeight());
            if (b.my[0] === "right") {
                A.left -= j;
            } else if (b.my[0] === "center") {
                A.left -= j / 2;
            }
            if (b.my[1] === "bottom") {
                A.top -= l;
            } else if (b.my[1] === "center") {
                A.top -= l / 2;
            }
            A.left += B[0];
            A.top += B[1];
            if (!a.support.offsetFractions) {
                A.left = f(A.left);
                A.top = f(A.top);
            }
            g = {
                marginLeft: o,
                marginTop: s
            };
            a.each([ "left", "top" ], function(d, e) {
                if (a.ui.pos[w[d]]) {
                    a.ui.pos[w[d]][e](A, {
                        targetWidth: k,
                        targetHeight: p,
                        elemWidth: j,
                        elemHeight: l,
                        collisionPosition: g,
                        collisionWidth: y,
                        collisionHeight: z,
                        offset: [ c[0] + B[0], c[1] + B[1] ],
                        my: b.my,
                        at: b.at,
                        within: u,
                        elem: i
                    });
                }
            });
            if (b.using) {
                h = function(a) {
                    var c = q.left - A.left, f = c + k - j, g = q.top - A.top, h = g + p - l, m = {
                        target: {
                            element: t,
                            left: q.left,
                            top: q.top,
                            width: k,
                            height: p
                        },
                        element: {
                            element: i,
                            left: A.left,
                            top: A.top,
                            width: j,
                            height: l
                        },
                        horizontal: f < 0 ? "left" : c > 0 ? "right" : "center",
                        vertical: h < 0 ? "top" : g > 0 ? "bottom" : "middle"
                    };
                    if (k < j && e(c + f) < k) {
                        m.horizontal = "center";
                    }
                    if (p < l && e(g + h) < p) {
                        m.vertical = "middle";
                    }
                    if (d(e(c), e(f)) > d(e(g), e(h))) {
                        m.important = "horizontal";
                    } else {
                        m.important = "vertical";
                    }
                    b.using.call(this, a, m);
                };
            }
            i.offset(a.extend(A, {
                using: h
            }));
        });
    };
    a.ui.pos = {
        _trigger: function(a, b, c, d) {
            if (b.elem) {
                b.elem.trigger({
                    type: c,
                    position: a,
                    positionData: b,
                    triggered: d
                });
            }
        },
        fit: {
            left: function(b, c) {
                a.ui.pos._trigger(b, c, "posCollide", "fitLeft");
                var e = c.within, f = e.isWindow ? e.scrollLeft : e.offset.left, g = e.width, h = b.left - c.collisionPosition.marginLeft, i = f - h, j = h + c.collisionWidth - g - f, k;
                if (c.collisionWidth > g) {
                    if (i > 0 && j <= 0) {
                        k = b.left + i + c.collisionWidth - g - f;
                        b.left += i - k;
                    } else if (j > 0 && i <= 0) {
                        b.left = f;
                    } else {
                        if (i > j) {
                            b.left = f + g - c.collisionWidth;
                        } else {
                            b.left = f;
                        }
                    }
                } else if (i > 0) {
                    b.left += i;
                } else if (j > 0) {
                    b.left -= j;
                } else {
                    b.left = d(b.left - h, b.left);
                }
                a.ui.pos._trigger(b, c, "posCollided", "fitLeft");
            },
            top: function(b, c) {
                a.ui.pos._trigger(b, c, "posCollide", "fitTop");
                var e = c.within, f = e.isWindow ? e.scrollTop : e.offset.top, g = c.within.height, h = b.top - c.collisionPosition.marginTop, i = f - h, j = h + c.collisionHeight - g - f, k;
                if (c.collisionHeight > g) {
                    if (i > 0 && j <= 0) {
                        k = b.top + i + c.collisionHeight - g - f;
                        b.top += i - k;
                    } else if (j > 0 && i <= 0) {
                        b.top = f;
                    } else {
                        if (i > j) {
                            b.top = f + g - c.collisionHeight;
                        } else {
                            b.top = f;
                        }
                    }
                } else if (i > 0) {
                    b.top += i;
                } else if (j > 0) {
                    b.top -= j;
                } else {
                    b.top = d(b.top - h, b.top);
                }
                a.ui.pos._trigger(b, c, "posCollided", "fitTop");
            }
        },
        flip: {
            left: function(b, c) {
                a.ui.pos._trigger(b, c, "posCollide", "flipLeft");
                var d = c.within, f = d.offset.left + d.scrollLeft, g = d.width, h = d.isWindow ? d.scrollLeft : d.offset.left, i = b.left - c.collisionPosition.marginLeft, j = i - h, k = i + c.collisionWidth - g - h, l = c.my[0] === "left" ? -c.elemWidth : c.my[0] === "right" ? c.elemWidth : 0, m = c.at[0] === "left" ? c.targetWidth : c.at[0] === "right" ? -c.targetWidth : 0, n = -2 * c.offset[0], o, p;
                if (j < 0) {
                    o = b.left + l + m + n + c.collisionWidth - g - f;
                    if (o < 0 || o < e(j)) {
                        b.left += l + m + n;
                    }
                } else if (k > 0) {
                    p = b.left - c.collisionPosition.marginLeft + l + m + n - h;
                    if (p > 0 || e(p) < k) {
                        b.left += l + m + n;
                    }
                }
                a.ui.pos._trigger(b, c, "posCollided", "flipLeft");
            },
            top: function(b, c) {
                a.ui.pos._trigger(b, c, "posCollide", "flipTop");
                var d = c.within, f = d.offset.top + d.scrollTop, g = d.height, h = d.isWindow ? d.scrollTop : d.offset.top, i = b.top - c.collisionPosition.marginTop, j = i - h, k = i + c.collisionHeight - g - h, l = c.my[1] === "top", m = l ? -c.elemHeight : c.my[1] === "bottom" ? c.elemHeight : 0, n = c.at[1] === "top" ? c.targetHeight : c.at[1] === "bottom" ? -c.targetHeight : 0, o = -2 * c.offset[1], p, q;
                if (j < 0) {
                    q = b.top + m + n + o + c.collisionHeight - g - f;
                    if (b.top + m + n + o > j && (q < 0 || q < e(j))) {
                        b.top += m + n + o;
                    }
                } else if (k > 0) {
                    p = b.top - c.collisionPosition.marginTop + m + n + o - h;
                    if (b.top + m + n + o > k && (p > 0 || e(p) < k)) {
                        b.top += m + n + o;
                    }
                }
                a.ui.pos._trigger(b, c, "posCollided", "flipTop");
            }
        },
        flipfit: {
            left: function() {
                a.ui.pos.flip.left.apply(this, arguments);
                a.ui.pos.fit.left.apply(this, arguments);
            },
            top: function() {
                a.ui.pos.flip.top.apply(this, arguments);
                a.ui.pos.fit.top.apply(this, arguments);
            }
        }
    };
    (function() {
        var b, c, d, e, f, g = document.getElementsByTagName("body")[0], h = document.createElement("div");
        b = document.createElement(g ? "div" : "body");
        d = {
            visibility: "hidden",
            width: 0,
            height: 0,
            border: 0,
            margin: 0,
            background: "none"
        };
        if (g) {
            a.extend(d, {
                position: "absolute",
                left: "-1000px",
                top: "-1000px"
            });
        }
        for (f in d) {
            b.style[f] = d[f];
        }
        b.appendChild(h);
        c = g || document.documentElement;
        c.insertBefore(b, c.firstChild);
        h.style.cssText = "position: absolute; left: 10.7432222px;";
        e = a(h).offset().left;
        a.support.offsetFractions = e > 10 && e < 11;
        b.innerHTML = "";
        c.removeChild(b);
    })();
})(jQuery);

(function(a) {
    "use strict";
    if (typeof define === "function" && define.amd) {
        define([ "jquery" ], a);
    } else if (window.jQuery && !window.jQuery.fn.iconpicker) {
        a(window.jQuery);
    }
})(function(a) {
    "use strict";
    var b = {
        isEmpty: function(a) {
            return a === false || a === "" || a === null || a === undefined;
        },
        isEmptyObject: function(a) {
            return this.isEmpty(a) === true || a.length === 0;
        },
        isElement: function(b) {
            return a(b).length > 0;
        },
        isString: function(a) {
            return typeof a === "string" || a instanceof String;
        },
        isArray: function(b) {
            return a.isArray(b);
        },
        inArray: function(b, c) {
            return a.inArray(b, c) !== -1;
        },
        throwError: function(a) {
            throw "Font Awesome Icon Picker Exception: " + a;
        }
    };
    var c = function(d, e) {
        this._id = c._idCounter++;
        this.element = a(d).addClass("iconpicker-element");
        this._trigger("iconpickerCreate");
        this.options = a.extend({}, c.defaultOptions, this.element.data(), e);
        this.options.templates = a.extend({}, c.defaultOptions.templates, this.options.templates);
        this.options.originalPlacement = this.options.placement;
        this.container = b.isElement(this.options.container) ? a(this.options.container) : false;
        if (this.container === false) {
            if (this.element.is(".dropdown-toggle")) {
                this.container = a("~ .dropdown-menu:first", this.element);
            } else {
                this.container = this.element.is("input,textarea,button,.btn") ? this.element.parent() : this.element;
            }
        }
        this.container.addClass("iconpicker-container");
        if (this.isDropdownMenu()) {
            this.options.templates.search = false;
            this.options.templates.buttons = false;
            this.options.placement = "inline";
        }
        this.input = this.element.is("input,textarea") ? this.element.addClass("iconpicker-input") : false;
        if (this.input === false) {
            this.input = this.container.find(this.options.input);
            if (!this.input.is("input,textarea")) {
                this.input = false;
            }
        }
        this.component = this.isDropdownMenu() ? this.container.parent().find(this.options.component) : this.container.find(this.options.component);
        if (this.component.length === 0) {
            this.component = false;
        } else {
            this.component.find("i").addClass("iconpicker-component");
        }
        this._createPopover();
        this._createIconpicker();
        if (this.getAcceptButton().length === 0) {
            this.options.mustAccept = false;
        }
        if (this.isInputGroup()) {
            this.container.parent().append(this.popover);
        } else {
            this.container.append(this.popover);
        }
        this._bindElementEvents();
        this._bindWindowEvents();
        this.update(this.options.selected);
        if (this.isInline()) {
            this.show();
        }
        this._trigger("iconpickerCreated");
    };
    c._idCounter = 0;
    c.defaultOptions = {
        title: false,
        selected: false,
        defaultValue: false,
        placement: "bottom",
        collision: "none",
        animation: true,
        hideOnSelect: false,
        showFooter: false,
        searchInFooter: false,
        mustAccept: false,
        selectedCustomClass: "bg-primary",
        icons: [],
        fullClassFormatter: function(a) {
            return a;
        },
        input: "input,.iconpicker-input",
        inputSearch: false,
        container: false,
        component: ".input-group-addon,.iconpicker-component",
        templates: {
            popover: '<div class="iconpicker-popover popover">' + '<div class="popover-title"></div><div class="popover-content"></div></div>',
            footer: '<div class="popover-footer"></div>',
            buttons: '<button class="iconpicker-btn iconpicker-btn-cancel btn btn-default btn-sm">Cancel</button>' + ' <button class="iconpicker-btn iconpicker-btn-accept btn btn-primary btn-sm">Accept</button>',
            search: '<input type="search" class="form-control iconpicker-search" placeholder="Type to filter" />',
            iconpicker: '<div class="iconpicker"><div class="iconpicker-items"></div></div>',
            iconpickerItem: '<a role="button" href="#" class="iconpicker-item"><i></i></a>'
        }
    };
    c.batch = function(b, c) {
        var d = Array.prototype.slice.call(arguments, 2);
        return a(b).each(function() {
            var b = a(this).data("iconpicker");
            if (!!b) {
                b[c].apply(b, d);
            }
        });
    };
    c.prototype = {
        constructor: c,
        options: {},
        _id: 0,
        _trigger: function(b, c) {
            c = c || {};
            this.element.trigger(a.extend({
                type: b,
                iconpickerInstance: this
            }, c));
        },
        _createPopover: function() {
            this.popover = a(this.options.templates.popover);
            var c = this.popover.find(".popover-title");
            if (!!this.options.title) {
                c.append(a('<div class="popover-title-text">' + this.options.title + "</div>"));
            }
            if (this.hasSeparatedSearchInput() && !this.options.searchInFooter) {
                c.append(this.options.templates.search);
            } else if (!this.options.title) {
                c.remove();
            }
            if (this.options.showFooter && !b.isEmpty(this.options.templates.footer)) {
                var d = a(this.options.templates.footer);
                if (this.hasSeparatedSearchInput() && this.options.searchInFooter) {
                    d.append(a(this.options.templates.search));
                }
                if (!b.isEmpty(this.options.templates.buttons)) {
                    d.append(a(this.options.templates.buttons));
                }
                this.popover.append(d);
            }
            if (this.options.animation === true) {
                this.popover.addClass("fade");
            }
            return this.popover;
        },
        _createIconpicker: function() {
            var b = this;
            this.iconpicker = a(this.options.templates.iconpicker);
            var c = function(c) {
                var d = a(this);
                if (d.is("i")) {
                    d = d.parent();
                }
                b._trigger("iconpickerSelect", {
                    iconpickerItem: d,
                    iconpickerValue: b.iconpickerValue
                });
                if (b.options.mustAccept === false) {
                    b.update(d.data("iconpickerValue"));
                    b._trigger("iconpickerSelected", {
                        iconpickerItem: this,
                        iconpickerValue: b.iconpickerValue
                    });
                } else {
                    b.update(d.data("iconpickerValue"), true);
                }
                if (b.options.hideOnSelect && b.options.mustAccept === false) {
                    b.hide();
                }
                c.preventDefault();
                return false;
            };
            for (var d in this.options.icons) {
                if (typeof this.options.icons[d] === "string") {
                    var e = a(this.options.templates.iconpickerItem);
                    e.find("i").addClass(this.options.fullClassFormatter(this.options.icons[d]));
                    e.data("iconpickerValue", this.options.icons[d]).on("click.iconpicker", c);
                    this.iconpicker.find(".iconpicker-items").append(e.attr("title", "." + this.options.icons[d]));
                }
            }
            this.popover.find(".popover-content").append(this.iconpicker);
            return this.iconpicker;
        },
        _isEventInsideIconpicker: function(b) {
            var c = a(b.target);
            if ((!c.hasClass("iconpicker-element") || c.hasClass("iconpicker-element") && !c.is(this.element)) && c.parents(".iconpicker-popover").length === 0) {
                return false;
            }
            return true;
        },
        _bindElementEvents: function() {
            var c = this;
            this.getSearchInput().on("keyup.iconpicker", function() {
                c.filter(a(this).val().toLowerCase());
            });
            this.getAcceptButton().on("click.iconpicker", function() {
                var a = c.iconpicker.find(".iconpicker-selected").get(0);
                c.update(c.iconpickerValue);
                c._trigger("iconpickerSelected", {
                    iconpickerItem: a,
                    iconpickerValue: c.iconpickerValue
                });
                if (!c.isInline()) {
                    c.hide();
                }
            });
            this.getCancelButton().on("click.iconpicker", function() {
                if (!c.isInline()) {
                    c.hide();
                }
            });
            this.element.on("focus.iconpicker", function(a) {
                c.show();
                a.stopPropagation();
            });
            if (this.hasComponent()) {
                this.component.on("click.iconpicker", function() {
                    c.toggle();
                });
            }
            if (this.hasInput()) {
                this.input.on("keyup.iconpicker", function(d) {
                    if (!b.inArray(d.keyCode, [ 38, 40, 37, 39, 16, 17, 18, 9, 8, 91, 93, 20, 46, 186, 190, 46, 78, 188, 44, 86 ])) {
                        c.update();
                    } else {
                        c._updateFormGroupStatus(c.getValid(this.value) !== false);
                    }
                    if (c.options.inputSearch === true) {
                        c.filter(a(this).val().toLowerCase());
                    }
                });
            }
        },
        _bindWindowEvents: function() {
            var b = a(window.document);
            var c = this;
            var d = ".iconpicker.inst" + this._id;
            a(window).on("resize.iconpicker" + d + " orientationchange.iconpicker" + d, function(a) {
                if (c.popover.hasClass("in")) {
                    c.updatePlacement();
                }
            });
            if (!c.isInline()) {
                b.on("mouseup" + d, function(a) {
                    if (!c._isEventInsideIconpicker(a) && !c.isInline()) {
                        c.hide();
                    }
                    a.stopPropagation();
                    a.preventDefault();
                    return false;
                });
            }
            return false;
        },
        _unbindElementEvents: function() {
            this.popover.off(".iconpicker");
            this.element.off(".iconpicker");
            if (this.hasInput()) {
                this.input.off(".iconpicker");
            }
            if (this.hasComponent()) {
                this.component.off(".iconpicker");
            }
            if (this.hasContainer()) {
                this.container.off(".iconpicker");
            }
        },
        _unbindWindowEvents: function() {
            a(window).off(".iconpicker.inst" + this._id);
            a(window.document).off(".iconpicker.inst" + this._id);
        },
        updatePlacement: function(b, c) {
            b = b || this.options.placement;
            this.options.placement = b;
            c = c || this.options.collision;
            c = c === true ? "flip" : c;
            var d = {
                at: "right bottom",
                my: "right top",
                of: this.hasInput() && !this.isInputGroup() ? this.input : this.container,
                collision: c === true ? "flip" : c,
                within: window
            };
            this.popover.removeClass("inline topLeftCorner topLeft top topRight topRightCorner " + "rightTop right rightBottom bottomRight bottomRightCorner " + "bottom bottomLeft bottomLeftCorner leftBottom left leftTop");
            if (typeof b === "object") {
                return this.popover.pos(a.extend({}, d, b));
            }
            switch (b) {
              case "inline":
                {
                    d = false;
                }
                break;

              case "topLeftCorner":
                {
                    d.my = "right bottom";
                    d.at = "left top";
                }
                break;

              case "topLeft":
                {
                    d.my = "left bottom";
                    d.at = "left top";
                }
                break;

              case "top":
                {
                    d.my = "center bottom";
                    d.at = "center top";
                }
                break;

              case "topRight":
                {
                    d.my = "right bottom";
                    d.at = "right top";
                }
                break;

              case "topRightCorner":
                {
                    d.my = "left bottom";
                    d.at = "right top";
                }
                break;

              case "rightTop":
                {
                    d.my = "left bottom";
                    d.at = "right center";
                }
                break;

              case "right":
                {
                    d.my = "left center";
                    d.at = "right center";
                }
                break;

              case "rightBottom":
                {
                    d.my = "left top";
                    d.at = "right center";
                }
                break;

              case "bottomRightCorner":
                {
                    d.my = "left top";
                    d.at = "right bottom";
                }
                break;

              case "bottomRight":
                {
                    d.my = "right top";
                    d.at = "right bottom";
                }
                break;

              case "bottom":
                {
                    d.my = "center top";
                    d.at = "center bottom";
                }
                break;

              case "bottomLeft":
                {
                    d.my = "left top";
                    d.at = "left bottom";
                }
                break;

              case "bottomLeftCorner":
                {
                    d.my = "right top";
                    d.at = "left bottom";
                }
                break;

              case "leftBottom":
                {
                    d.my = "right top";
                    d.at = "left center";
                }
                break;

              case "left":
                {
                    d.my = "right center";
                    d.at = "left center";
                }
                break;

              case "leftTop":
                {
                    d.my = "right bottom";
                    d.at = "left center";
                }
                break;

              default:
                {
                    return false;
                }
                break;
            }
            this.popover.css({
                display: this.options.placement === "inline" ? "" : "block"
            });
            if (d !== false) {
                //this.popover.pos(d).css("maxWidth", a(window).width() - this.container.offset().left - 5);
            } else {
                this.popover.css({
                    top: "auto",
                    right: "auto",
                    bottom: "auto",
                    //left: "auto",
                    maxWidth: "none"
                });
            }
            this.popover.addClass(this.options.placement);
            return true;
        },
        _updateComponents: function() {
            this.iconpicker.find(".iconpicker-item.iconpicker-selected").removeClass("iconpicker-selected " + this.options.selectedCustomClass);
            if (this.iconpickerValue) {
                this.iconpicker.find("." + this.options.fullClassFormatter(this.iconpickerValue).replace(/ /g, ".")).parent().addClass("iconpicker-selected " + this.options.selectedCustomClass);
            }
            if (this.hasComponent()) {
                var a = this.component.find("i");
                if (a.length > 0) {
                    a.attr("class", this.options.fullClassFormatter(this.iconpickerValue));
                } else {
                    this.component.html(this.getHtml());
                }
            }
        },
        _updateFormGroupStatus: function(a) {
            if (this.hasInput()) {
                if (a !== false) {
                    this.input.parents(".form-group:first").removeClass("has-error");
                } else {
                    this.input.parents(".form-group:first").addClass("has-error");
                }
                return true;
            }
            return false;
        },
        getValid: function(c) {
            if (!b.isString(c)) {
                c = "";
            }
            var d = c === "";
            c = a.trim(c);
            if (b.inArray(c, this.options.icons) || d) {
                return c;
            }
            return false;
        },
        setValue: function(a) {
            var b = this.getValid(a);
            if (b !== false) {
                this.iconpickerValue = b;
                this._trigger("iconpickerSetValue", {
                    iconpickerValue: b
                });
                return this.iconpickerValue;
            } else {
                this._trigger("iconpickerInvalid", {
                    iconpickerValue: a
                });
                return false;
            }
        },
        getHtml: function() {
            return '<i class="' + this.options.fullClassFormatter(this.iconpickerValue) + '"></i>';
        },
        setSourceValue: function(a) {
            a = this.setValue(a);
            if (a !== false && a !== "") {
                if (this.hasInput()) {
                    this.input.val(this.iconpickerValue);
                } else {
                    this.element.data("iconpickerValue", this.iconpickerValue);
                }
                this._trigger("iconpickerSetSourceValue", {
                    iconpickerValue: a
                });
            }
            return a;
        },
        getSourceValue: function(a) {
            a = a || this.options.defaultValue;
            var b = a;
            if (this.hasInput()) {
                b = this.input.val();
            } else {
                b = this.element.data("iconpickerValue");
            }
            if (b === undefined || b === "" || b === null || b === false) {
                b = a;
            }
            return b;
        },
        hasInput: function() {
            return this.input !== false;
        },
        isInputSearch: function() {
            return this.hasInput() && this.options.inputSearch === true;
        },
        isInputGroup: function() {
            return this.container.is(".input-group");
        },
        isDropdownMenu: function() {
            return this.container.is(".dropdown-menu");
        },
        hasSeparatedSearchInput: function() {
            return this.options.templates.search !== false && !this.isInputSearch();
        },
        hasComponent: function() {
            return this.component !== false;
        },
        hasContainer: function() {
            return this.container !== false;
        },
        getAcceptButton: function() {
            return this.popover.find(".iconpicker-btn-accept");
        },
        getCancelButton: function() {
            return this.popover.find(".iconpicker-btn-cancel");
        },
        getSearchInput: function() {
            return this.popover.find(".iconpicker-search");
        },
        filter: function(c) {
            if (b.isEmpty(c)) {
                this.iconpicker.find(".iconpicker-item").show();
                return a(false);
            } else {
                var d = [];
                this.iconpicker.find(".iconpicker-item").each(function() {
                    var b = a(this);
                    var e = b.attr("title").toLowerCase();
                    var f = false;
                    try {
                        f = new RegExp(c, "g");
                    } catch (a) {
                        f = false;
                    }
                    if (f !== false && e.match(f)) {
                        d.push(b);
                        b.show();
                    } else {
                        b.hide();
                    }
                });
                return d;
            }
        },
        show: function() {
            if (this.popover.hasClass("in")) {
                return false;
            }
            a.iconpicker.batch(a(".iconpicker-popover.in:not(.inline)").not(this.popover), "hide");
            this._trigger("iconpickerShow");
            this.updatePlacement();
            this.popover.addClass("in");
            setTimeout(a.proxy(function() {
                this.popover.css("display", this.isInline() ? "" : "block");
                this._trigger("iconpickerShown");
            }, this), this.options.animation ? 300 : 1);
        },
        hide: function() {
            if (!this.popover.hasClass("in")) {
                return false;
            }
            this._trigger("iconpickerHide");
            this.popover.removeClass("in");
            setTimeout(a.proxy(function() {
                this.popover.css("display", "none");
                this.getSearchInput().val("");
                this.filter("");
                this._trigger("iconpickerHidden");
            }, this), this.options.animation ? 300 : 1);
        },
        toggle: function() {
            if (this.popover.is(":visible")) {
                this.hide();
            } else {
                this.show(true);
            }
        },
        update: function(a, b) {
            a = a ? a : this.getSourceValue(this.iconpickerValue);
            this._trigger("iconpickerUpdate");
            if (b === true) {
                a = this.setValue(a);
            } else {
                a = this.setSourceValue(a);
                this._updateFormGroupStatus(a !== false);
            }
            if (a !== false) {
                this._updateComponents();
            }
            this._trigger("iconpickerUpdated");
            return a;
        },
        destroy: function() {
            this._trigger("iconpickerDestroy");
            this.element.removeData("iconpicker").removeData("iconpickerValue").removeClass("iconpicker-element");
            this._unbindElementEvents();
            this._unbindWindowEvents();
            a(this.popover).remove();
            this._trigger("iconpickerDestroyed");
        },
        disable: function() {
            if (this.hasInput()) {
                this.input.prop("disabled", true);
                return true;
            }
            return false;
        },
        enable: function() {
            if (this.hasInput()) {
                this.input.prop("disabled", false);
                return true;
            }
            return false;
        },
        isDisabled: function() {
            if (this.hasInput()) {
                return this.input.prop("disabled") === true;
            }
            return false;
        },
        isInline: function() {
            return this.options.placement === "inline" || this.popover.hasClass("inline");
        }
    };
    a.iconpicker = c;
    a.fn.iconpicker = function(b) {
        return this.each(function() {
            var d = a(this);
            if (!d.data("iconpicker")) {
                d.data("iconpicker", new c(this, typeof b === "object" ? b : {}));
            }
        });
    };
    c.defaultOptions.icons = [ "fab fa-500px",
"fab fa-accessible-icon",
"fab fa-accusoft",
"fas fa-address-book", "far fa-address-book",
"fas fa-address-card", "far fa-address-card",
"fas fa-adjust",
"fab fa-adn",
"fab fa-adversal",
"fab fa-affiliatetheme",
"fab fa-algolia",
"fas fa-align-center",
"fas fa-align-justify",
"fas fa-align-left",
"fas fa-align-right",
"fab fa-amazon",
"fas fa-ambulance",
"fas fa-american-sign-language-interpreting",
"fab fa-amilia",
"fas fa-anchor",
"fab fa-android",
"fab fa-angellist",
"fas fa-angle-double-down",
"fas fa-angle-double-left",
"fas fa-angle-double-right",
"fas fa-angle-double-up",
"fas fa-angle-down",
"fas fa-angle-left",
"fas fa-angle-right",
"fas fa-angle-up",
"fab fa-angrycreative",
"fab fa-angular",
"fab fa-app-store",
"fab fa-app-store-ios",
"fab fa-apper",
"fab fa-apple",
"fab fa-apple-pay",
"fas fa-archive",
"fas fa-arrow-alt-circle-down", "far fa-arrow-alt-circle-down",
"fas fa-arrow-alt-circle-left", "far fa-arrow-alt-circle-left",
"fas fa-arrow-alt-circle-right", "far fa-arrow-alt-circle-right",
"fas fa-arrow-alt-circle-up", "far fa-arrow-alt-circle-up",
"fas fa-arrow-circle-down",
"fas fa-arrow-circle-left",
"fas fa-arrow-circle-right",
"fas fa-arrow-circle-up",
"fas fa-arrow-down",
"fas fa-arrow-left",
"fas fa-arrow-right",
"fas fa-arrow-up",
"fas fa-arrows-alt",
"fas fa-arrows-alt-h",
"fas fa-arrows-alt-v",
"fas fa-assistive-listening-systems",
"fas fa-asterisk",
"fab fa-asymmetrik",
"fas fa-at",
"fab fa-audible",
"fas fa-audio-description",
"fab fa-autoprefixer",
"fab fa-avianex",
"fab fa-aviato",
"fab fa-aws",
"fas fa-backward",
"fas fa-balance-scale",
"fas fa-ban",
"fab fa-bandcamp",
"fas fa-barcode",
"fas fa-bars",
"fas fa-bath",
"fas fa-battery-empty",
"fas fa-battery-full",
"fas fa-battery-half",
"fas fa-battery-quarter",
"fas fa-battery-three-quarters",
"fas fa-bed",
"fas fa-beer",
"fab fa-behance",
"fab fa-behance-square",
"fas fa-bell", "far fa-bell",
"fas fa-bell-slash", "far fa-bell-slash",
"fas fa-bicycle",
"fab fa-bimobject",
"fas fa-binoculars",
"fas fa-birthday-cake",
"fab fa-bitbucket",
"fab fa-bitcoin",
"fab fa-bity",
"fab fa-black-tie",
"fab fa-blackberry",
"fas fa-blind",
"fab fa-blogger",
"fab fa-blogger-b",
"fab fa-bluetooth",
"fab fa-bluetooth-b",
"fas fa-bold",
"fas fa-bolt",
"fas fa-bomb",
"fas fa-book",
"fas fa-bookmark", "far fa-bookmark",
"fas fa-braille",
"fas fa-briefcase",
"fab fa-btc",
"fas fa-bug",
"fas fa-building", "far fa-building",
"fas fa-bullhorn",
"fas fa-bullseye",
"fab fa-buromobelexperte",
"fas fa-bus",
"fab fa-buysellads",
"fas fa-calculator",
"fas fa-calendar", "far fa-calendar",
"fas fa-calendar-alt", "far fa-calendar-alt",
"fas fa-calendar-check", "far fa-calendar-check",
"fas fa-calendar-minus", "far fa-calendar-minus",
"fas fa-calendar-plus", "far fa-calendar-plus",
"fas fa-calendar-times", "far fa-calendar-times",
"fas fa-camera",
"fas fa-camera-retro",
"fas fa-car",
"fas fa-caret-down",
"fas fa-caret-left",
"fas fa-caret-right",
"fas fa-caret-square-down", "far fa-caret-square-down",
"fas fa-caret-square-left", "far fa-caret-square-left",
"fas fa-caret-square-right", "far fa-caret-square-right",
"fas fa-caret-square-up", "far fa-caret-square-up",
"fas fa-caret-up",
"fas fa-cart-arrow-down",
"fas fa-cart-plus",
"fab fa-cc-amex",
"fab fa-cc-apple-pay",
"fab fa-cc-diners-club",
"fab fa-cc-discover",
"fab fa-cc-jcb",
"fab fa-cc-mastercard",
"fab fa-cc-paypal",
"fab fa-cc-stripe",
"fab fa-cc-visa",
"fab fa-centercode",
"fas fa-certificate",
"fas fa-chart-area",
"fas fa-chart-bar", "far fa-chart-bar",
"fas fa-chart-line",
"fas fa-chart-pie",
"fas fa-check",
"fas fa-check-circle", "far fa-check-circle",
"fas fa-check-square", "far fa-check-square",
"fas fa-chevron-circle-down",
"fas fa-chevron-circle-left",
"fas fa-chevron-circle-right",
"fas fa-chevron-circle-up",
"fas fa-chevron-down",
"fas fa-chevron-left",
"fas fa-chevron-right",
"fas fa-chevron-up",
"fas fa-child",
"fab fa-chrome",
"fas fa-circle", "far fa-circle",
"fas fa-circle-notch",
"fas fa-clipboard", "far fa-clipboard",
"fas fa-clock", "far fa-clock",
"fas fa-clone", "far fa-clone",
"fas fa-closed-captioning", "far fa-closed-captioning",
"fas fa-cloud",
"fas fa-cloud-download-alt",
"fas fa-cloud-upload-alt",
"fab fa-cloudscale",
"fab fa-cloudsmith",
"fab fa-cloudversify",
"fas fa-code",
"fas fa-code-branch",
"fab fa-codepen",
"fab fa-codiepie",
"fas fa-coffee",
"fas fa-cog",
"fas fa-cogs",
"fas fa-columns",
"fas fa-comment", "far fa-comment",
"fas fa-comment-alt", "far fa-comment-alt",
"fas fa-comments", "far fa-comments",
"fas fa-compass", "far fa-compass",
"fas fa-compress",
"fab fa-connectdevelop",
"fab fa-contao",
"fas fa-copy", "far fa-copy",
"fas fa-copyright", "far fa-copyright",
"fab fa-cpanel",
"fab fa-creative-commons",
"fas fa-credit-card", "far fa-credit-card",
"fas fa-crop",
"fas fa-crosshairs",
"fab fa-css3",
"fab fa-css3-alt",
"fas fa-cube",
"fas fa-cubes",
"fas fa-cut",
"fab fa-cuttlefish",
"fab fa-d-and-d",
"fab fa-dashcube",
"fas fa-database",
"fas fa-deaf",
"fab fa-delicious",
"fab fa-deploydog",
"fab fa-deskpro",
"fas fa-desktop",
"fab fa-deviantart",
"fab fa-digg",
"fab fa-digital-ocean",
"fab fa-discord",
"fab fa-discourse",
"fab fa-dochub",
"fab fa-docker",
"fas fa-dollar-sign",
"fas fa-dot-circle", "far fa-dot-circle",
"fas fa-download",
"fab fa-draft2digital",
"fab fa-dribbble",
"fab fa-dribbble-square",
"fab fa-dropbox",
"fab fa-drupal",
"fab fa-dyalog",
"fab fa-earlybirds",
"fab fa-edge",
"fas fa-edit", "far fa-edit",
"fas fa-eject",
"fas fa-ellipsis-h",
"fas fa-ellipsis-v",
"fab fa-ember",
"fab fa-empire",
"fas fa-envelope", "far fa-envelope",
"fas fa-envelope-open", "far fa-envelope-open",
"fas fa-envelope-square",
"fab fa-envira",
"fas fa-eraser",
"fab fa-erlang",
"fab fa-etsy",
"fas fa-euro-sign",
"fas fa-exchange-alt",
"fas fa-exclamation",
"fas fa-exclamation-circle",
"fas fa-exclamation-triangle",
"fas fa-expand",
"fas fa-expand-arrows-alt",
"fab fa-expeditedssl",
"fas fa-external-link-alt",
"fas fa-external-link-square-alt",
"fas fa-eye",
"fas fa-eye-dropper",
"fas fa-eye-slash", "far fa-eye-slash",
"fab fa-facebook",
"fab fa-facebook-f",
"fab fa-facebook-messenger",
"fab fa-facebook-square",
"fas fa-fast-backward",
"fas fa-fast-forward",
"fas fa-fax",
"fas fa-female",
"fas fa-fighter-jet",
"fas fa-file", "far fa-file",
"fas fa-file-alt", "far fa-file-alt",
"fas fa-file-archive", "far fa-file-archive",
"fas fa-file-audio", "far fa-file-audio",
"fas fa-file-code", "far fa-file-code",
"fas fa-file-excel", "far fa-file-excel",
"fas fa-file-image", "far fa-file-image",
"fas fa-file-pdf", "far fa-file-pdf",
"fas fa-file-powerpoint", "far fa-file-powerpoint",
"fas fa-file-video", "far fa-file-video",
"fas fa-file-word", "far fa-file-word",
"fas fa-film",
"fas fa-filter",
"fas fa-fire",
"fas fa-fire-extinguisher",
"fab fa-firefox",
"fab fa-first-order",
"fab fa-firstdraft",
"fas fa-flag", "far fa-flag",
"fas fa-flag-checkered",
"fas fa-flask",
"fab fa-flickr",
"fab fa-fly",
"fas fa-folder", "far fa-folder",
"fas fa-folder-open", "far fa-folder-open",
"fas fa-font",
"fab fa-font-awesome",
"fab fa-font-awesome-alt",
"fab fa-font-awesome-flag",
"fab fa-fonticons",
"fab fa-fonticons-fi",
"fab fa-fort-awesome",
"fab fa-fort-awesome-alt",
"fab fa-forumbee",
"fas fa-forward",
"fab fa-foursquare",
"fab fa-free-code-camp",
"fab fa-freebsd",
"fas fa-frown", "far fa-frown",
"fas fa-futbol", "far fa-futbol",
"fas fa-gamepad",
"fas fa-gavel",
"fas fa-gem", "far fa-gem",
"fas fa-genderless",
"fab fa-get-pocket",
"fab fa-gg",
"fab fa-gg-circle",
"fas fa-gift",
"fab fa-git",
"fab fa-git-square",
"fab fa-github",
"fab fa-github-alt",
"fab fa-github-square",
"fab fa-gitkraken",
"fab fa-gitlab",
"fab fa-gitter",
"fas fa-glass-martini",
"fab fa-glide",
"fab fa-glide-g",
"fas fa-globe",
"fab fa-gofore",
"fab fa-goodreads",
"fab fa-goodreads-g",
"fab fa-google",
"fab fa-google-drive",
"fab fa-google-play",
"fab fa-google-plus",
"fab fa-google-plus-g",
"fab fa-google-plus-square",
"fab fa-google-wallet",
"fas fa-graduation-cap",
"fab fa-gratipay",
"fab fa-grav",
"fab fa-gripfire",
"fab fa-grunt",
"fab fa-gulp",
"fas fa-h-square",
"fab fa-hacker-news",
"fab fa-hacker-news-square",
"fas fa-hand-lizard", "far fa-hand-lizard",
"fas fa-hand-paper", "far fa-hand-paper",
"fas fa-hand-peace", "far fa-hand-peace",
"fas fa-hand-point-down", "far fa-hand-point-down",
"fas fa-hand-point-left", "far fa-hand-point-left",
"fas fa-hand-point-right", "far fa-hand-point-right",
"fas fa-hand-point-up", "far fa-hand-point-up",
"fas fa-hand-pointer", "far fa-hand-pointer",
"fas fa-hand-rock", "far fa-hand-rock",
"fas fa-hand-scissors", "far fa-hand-scissors",
"fas fa-hand-spock", "far fa-hand-spock",
"fas fa-handshake", "far fa-handshake",
"fas fa-hashtag",
"fas fa-hdd", "far fa-hdd",
"fas fa-heading",
"fas fa-headphones",
"fas fa-heart", "far fa-heart",
"fas fa-heartbeat",
"fab fa-hire-a-helper",
"fas fa-history",
"fas fa-home",
"fab fa-hooli",
"fas fa-hospital", "far fa-hospital",
"fab fa-hotjar",
"fas fa-hourglass", "far fa-hourglass",
"fas fa-hourglass-end",
"fas fa-hourglass-half",
"fas fa-hourglass-start",
"fab fa-houzz",
"fab fa-html5",
"fab fa-hubspot",
"fas fa-i-cursor",
"fas fa-id-badge", "far fa-id-badge",
"fas fa-id-card", "far fa-id-card",
"fas fa-image", "far fa-image",
"fas fa-images", "far fa-images",
"fab fa-imdb",
"fas fa-inbox",
"fas fa-indent",
"fas fa-industry",
"fas fa-info",
"fas fa-info-circle",
"fab fa-instagram",
"fab fa-internet-explorer",
"fab fa-ioxhost",
"fas fa-italic",
"fab fa-itunes",
"fab fa-itunes-note",
"fab fa-jenkins",
"fab fa-joget",
"fab fa-joomla",
"fab fa-js",
"fab fa-js-square",
"fab fa-jsfiddle",
"fas fa-key",
"fas fa-keyboard", "far fa-keyboard",
"fab fa-keycdn",
"fab fa-kickstarter",
"fab fa-kickstarter-k",
"fas fa-language",
"fas fa-laptop",
"fab fa-laravel",
"fab fa-lastfm",
"fab fa-lastfm-square",
"fas fa-leaf",
"fab fa-leanpub",
"fas fa-lemon", "far fa-lemon",
"fab fa-less",
"fas fa-level-down-alt",
"fas fa-level-up-alt",
"fas fa-life-ring", "far fa-life-ring",
"fas fa-lightbulb", "far fa-lightbulb",
"fab fa-line",
"fas fa-link",
"fab fa-linkedin",
"fab fa-linkedin-in",
"fab fa-linode",
"fab fa-linux",
"fas fa-lira-sign",
"fas fa-list",
"fas fa-list-alt", "far fa-list-alt",
"fas fa-list-ol",
"fas fa-list-ul",
"fas fa-location-arrow",
"fas fa-lock",
"fas fa-lock-open",
"fas fa-long-arrow-alt-down",
"fas fa-long-arrow-alt-left",
"fas fa-long-arrow-alt-right",
"fas fa-long-arrow-alt-up",
"fas fa-low-vision",
"fab fa-lyft",
"fab fa-magento",
"fas fa-magic",
"fas fa-magnet",
"fas fa-male",
"fas fa-map", "far fa-map",
"fas fa-map-marker",
"fas fa-map-marker-alt",
"fas fa-map-pin",
"fas fa-map-signs",
"fas fa-mars",
"fas fa-mars-double",
"fas fa-mars-stroke",
"fas fa-mars-stroke-h",
"fas fa-mars-stroke-v",
"fab fa-maxcdn",
"fab fa-medapps",
"fab fa-medium",
"fab fa-medium-m",
"fas fa-medkit",
"fab fa-medrt",
"fab fa-meetup",
"fas fa-meh", "far fa-meh",
"fas fa-mercury",
"fas fa-microchip",
"fas fa-microphone",
"fas fa-microphone-slash",
"fab fa-microsoft",
"fas fa-minus",
"fas fa-minus-circle",
"fas fa-minus-square", "far fa-minus-square",
"fab fa-mix",
"fab fa-mixcloud",
"fab fa-mizuni",
"fas fa-mobile",
"fas fa-mobile-alt",
"fab fa-modx",
"fab fa-monero",
"fas fa-money-bill-alt", "far fa-money-bill-alt",
"fas fa-moon", "far fa-moon",
"fas fa-motorcycle",
"fas fa-mouse-pointer",
"fas fa-music",
"fab fa-napster",
"fas fa-neuter",
"fas fa-newspaper", "far fa-newspaper",
"fab fa-nintendo-switch",
"fab fa-node",
"fab fa-node-js",
"fab fa-npm",
"fab fa-ns8",
"fab fa-nutritionix",
"fas fa-object-group", "far fa-object-group",
"fas fa-object-ungroup", "far fa-object-ungroup",
"fab fa-odnoklassniki",
"fab fa-odnoklassniki-square",
"fab fa-opencart",
"fab fa-openid",
"fab fa-opera",
"fab fa-optin-monster",
"fab fa-osi",
"fas fa-outdent",
"fab fa-page4",
"fab fa-pagelines",
"fas fa-paint-brush",
"fab fa-palfed",
"fas fa-paper-plane", "far fa-paper-plane",
"fas fa-paperclip",
"fas fa-paragraph",
"fas fa-paste",
"fab fa-patreon",
"fas fa-pause",
"fas fa-pause-circle", "far fa-pause-circle",
"fas fa-paw",
"fab fa-paypal",
"fas fa-pen-square",
"fas fa-pencil-alt",
"fas fa-percent",
"fab fa-periscope",
"fab fa-phabricator",
"fab fa-phoenix-framework",
"fas fa-phone",
"fas fa-phone-square",
"fas fa-phone-volume",
"fab fa-pied-piper",
"fab fa-pied-piper-alt",
"fab fa-pied-piper-pp",
"fab fa-pinterest",
"fab fa-pinterest-p",
"fab fa-pinterest-square",
"fas fa-plane",
"fas fa-play",
"fas fa-play-circle", "far fa-play-circle",
"fab fa-playstation",
"fas fa-plug",
"fas fa-plus",
"fas fa-plus-circle",
"fas fa-plus-square", "far fa-plus-square",
"fas fa-podcast",
"fas fa-pound-sign",
"fas fa-power-off",
"fas fa-print",
"fab fa-product-hunt",
"fab fa-pushed",
"fas fa-puzzle-piece",
"fab fa-python",
"fab fa-qq",
"fas fa-qrcode",
"fas fa-question",
"fas fa-question-circle", "far fa-question-circle",
"fab fa-quora",
"fas fa-quote-left",
"fas fa-quote-right",
"fas fa-random",
"fab fa-ravelry",
"fab fa-react",
"fab fa-rebel",
"fas fa-recycle",
"fab fa-red-river",
"fab fa-reddit",
"fab fa-reddit-alien",
"fab fa-reddit-square",
"fas fa-redo",
"fas fa-redo-alt",
"fas fa-registered", "far fa-registered",
"fab fa-rendact",
"fab fa-renren",
"fas fa-reply",
"fas fa-reply-all",
"fab fa-replyd",
"fab fa-resolving",
"fas fa-retweet",
"fas fa-road",
"fas fa-rocket",
"fab fa-rocketchat",
"fab fa-rockrms",
"fas fa-rss",
"fas fa-rss-square",
"fas fa-ruble-sign",
"fas fa-rupee-sign",
"fab fa-safari",
"fab fa-sass",
"fas fa-save", "far fa-save",
"fab fa-schlix",
"fab fa-scribd",
"fas fa-search",
"fas fa-search-minus",
"fas fa-search-plus",
"fab fa-searchengin",
"fab fa-sellcast",
"fab fa-sellsy",
"fas fa-server",
"fab fa-servicestack",
"fas fa-share",
"fas fa-share-alt",
"fas fa-share-alt-square",
"fas fa-share-square", "far fa-share-square",
"fas fa-shekel-sign",
"fas fa-shield-alt",
"fas fa-ship",
"fab fa-shirtsinbulk",
"fas fa-shopping-bag",
"fas fa-shopping-basket",
"fas fa-shopping-cart",
"fas fa-shower",
"fas fa-sign-in-alt",
"fas fa-sign-language",
"fas fa-sign-out-alt",
"fas fa-signal",
"fab fa-simplybuilt",
"fab fa-sistrix",
"fas fa-sitemap",
"fab fa-skyatlas",
"fab fa-skype",
"fab fa-slack",
"fab fa-slack-hash",
"fas fa-sliders-h",
"fab fa-slideshare",
"fas fa-smile", "far fa-smile",
"fab fa-snapchat",
"fab fa-snapchat-ghost",
"fab fa-snapchat-square",
"fas fa-snowflake", "far fa-snowflake",
"fas fa-sort",
"fas fa-sort-alpha-down",
"fas fa-sort-alpha-up",
"fas fa-sort-amount-down",
"fas fa-sort-amount-up",
"fas fa-sort-down",
"fas fa-sort-numeric-down",
"fas fa-sort-numeric-up",
"fas fa-sort-up",
"fab fa-soundcloud",
"fas fa-space-shuttle",
"fab fa-speakap",
"fas fa-spinner",
"fab fa-spotify",
"fas fa-square", "far fa-square",
"fab fa-stack-exchange",
"fab fa-stack-overflow",
"fas fa-star", "far fa-star",
"fas fa-star-half", "far fa-star-half",
"fab fa-staylinked",
"fab fa-steam",
"fab fa-steam-square",
"fab fa-steam-symbol",
"fas fa-step-backward",
"fas fa-step-forward",
"fas fa-stethoscope",
"fab fa-sticker-mule",
"fas fa-sticky-note", "far fa-sticky-note",
"fas fa-stop",
"fas fa-stop-circle", "far fa-stop-circle",
"fab fa-strava",
"fas fa-street-view",
"fas fa-strikethrough",
"fab fa-stripe",
"fab fa-stripe-s",
"fab fa-studiovinari",
"fab fa-stumbleupon",
"fab fa-stumbleupon-circle",
"fas fa-subscript",
"fas fa-subway",
"fas fa-suitcase",
"fas fa-sun", "far fa-sun",
"fab fa-superpowers",
"fas fa-superscript",
"fab fa-supple",
"fas fa-sync",
"fas fa-sync-alt",
"fas fa-table",
"fas fa-tablet",
"fas fa-tablet-alt",
"fas fa-tachometer-alt",
"fas fa-tag",
"fas fa-tags",
"fas fa-tasks",
"fas fa-taxi",
"fab fa-telegram",
"fab fa-telegram-plane",
"fab fa-tencent-weibo",
"fas fa-terminal",
"fas fa-text-height",
"fas fa-text-width",
"fas fa-th",
"fas fa-th-large",
"fas fa-th-list",
"fab fa-themeisle",
"fas fa-thermometer-empty",
"fas fa-thermometer-full",
"fas fa-thermometer-half",
"fas fa-thermometer-quarter",
"fas fa-thermometer-three-quarters",
"fas fa-thumbs-down", "far fa-thumbs-down",
"fas fa-thumbs-up", "far fa-thumbs-up",
"fas fa-thumbtack",
"fas fa-ticket-alt",
"fas fa-times",
"fas fa-times-circle", "far fa-times-circle",
"fas fa-tint",
"fas fa-toggle-off",
"fas fa-toggle-on",
"fas fa-trademark",
"fas fa-train",
"fas fa-transgender",
"fas fa-transgender-alt",
"fas fa-trash",
"fas fa-trash-alt", "far fa-trash-alt",
"fas fa-tree",
"fab fa-trello",
"fab fa-tripadvisor",
"fas fa-trophy",
"fas fa-truck",
"fas fa-tty",
"fab fa-tumblr",
"fab fa-tumblr-square",
"fas fa-tv",
"fab fa-twitch",
"fab fa-twitter",
"fab fa-twitter-square",
"fab fa-typo3",
"fab fa-uber",
"fab fa-uikit",
"fas fa-umbrella",
"fas fa-underline",
"fas fa-undo",
"fas fa-undo-alt",
"fab fa-uniregistry",
"fas fa-universal-access",
"fas fa-university",
"fas fa-unlink",
"fas fa-unlock",
"fas fa-unlock-alt",
"fab fa-untappd",
"fas fa-upload",
"fab fa-usb",
"fas fa-user", "far fa-user",
"fas fa-user-circle", "far fa-user-circle",
"fas fa-user-md",
"fas fa-user-plus",
"fas fa-user-secret",
"fas fa-user-times",
"fas fa-users",
"fab fa-ussunnah",
"fas fa-utensil-spoon",
"fas fa-utensils",
"fab fa-vaadin",
"fas fa-venus",
"fas fa-venus-double",
"fas fa-venus-mars",
"fab fa-viacoin",
"fab fa-viadeo",
"fab fa-viadeo-square",
"fab fa-viber",
"fas fa-video",
"fab fa-vimeo",
"fab fa-vimeo-square",
"fab fa-vimeo-v",
"fab fa-vine",
"fab fa-vk",
"fab fa-vnv",
"fas fa-volume-down",
"fas fa-volume-off",
"fas fa-volume-up",
"fab fa-vuejs",
"fab fa-weibo",
"fab fa-weixin",
"fab fa-whatsapp",
"fab fa-whatsapp-square",
"fas fa-wheelchair",
"fab fa-whmcs",
"fas fa-wifi",
"fab fa-wikipedia-w",
"fas fa-window-close", "far fa-window-close",
"fas fa-window-maximize", "far fa-window-maximize",
"fas fa-window-minimize",
"fas fa-window-restore", "far fa-window-restore",
"fab fa-windows",
"fas fa-won-sign",
"fab fa-wordpress",
"fab fa-wordpress-simple",
"fab fa-wpbeginner",
"fab fa-wpexplorer",
"fab fa-wpforms",
"fas fa-wrench",
"fab fa-xbox",
"fab fa-xing",
"fab fa-xing-square",
"fab fa-y-combinator",
"fab fa-yahoo",
"fab fa-yandex",
"fab fa-yandex-international",
"fab fa-yelp",
"fas fa-yen-sign",
"fab fa-yoast",
"fab fa-youtube" ];
});

jQuery(document).ready(function ($) {
    $('input.iconpicker-icon').iconpicker();
});
